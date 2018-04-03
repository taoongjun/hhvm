(**
 * Copyright (c) 2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the "hack" directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 *)

open Utils
open ServerCommandTypes

module TLazyHeap = Typing_lazy_heap

exception Nonfatal_rpc_exception of exn * string * ServerEnv.env


(* Some client commands require full check to be run in order to update global
 * state that they depend on *)
let rpc_command_needs_full_check : type a. a t -> bool = function
  (* global error list is not updated during small checks *)
  | STATUS _ -> true
  (* newly subscribed client will need a full list of errors *)
  | SUBSCRIBE_DIAGNOSTIC _ -> true
  (* some Ai stuff - calls to those will likely never be interleaved with IDE
   * file sync commands (and resulting small checks), but putting it here just
   * to be safe *)
  | FIND_DEPENDENT_FILES _ -> true
  | TRACE_AI _ -> true
  | AI_QUERY _ -> true
  (* Finding references uses global dependency table *)
  | FIND_REFS _ -> true
  | IDE_FIND_REFS _ -> true
  | SAVE_STATE _ -> true
  (* Codebase-wide rename, uses find references *)
  | REFACTOR _ -> true
  (* Same case as Ai commands *)
  | CREATE_CHECKPOINT _ -> true
  | RETRIEVE_CHECKPOINT _ -> true
  | DELETE_CHECKPOINT _ -> true
  | _ -> false

let command_needs_full_check = function
  | Rpc x -> rpc_command_needs_full_check x
  | Stream BUILD _ -> true (* Build doesn't fully support lazy decl *)
  | Stream LIST_FILES -> true (* Same as Rpc STATUS *)
  | _ -> false

let full_recheck_if_needed' genv env msg =
  if
    (not env.ServerEnv.needs_full_check) &&
    (Relative_path.Set.is_empty env.ServerEnv.ide_needs_parsing)
  then
    env
  else
  if not @@ command_needs_full_check msg then env else
  let env, _, _ = ServerTypeCheck.(check genv env Full_check) in
  env

let ignore_ide = function
  | Rpc (STATUS true) -> true
  | _ -> false

let apply_changes env changes =
  Relative_path.Map.fold changes
    ~init:env
    ~f:begin fun path content env ->
      ServerFileSync.open_file env (Relative_path.to_absolute path) content
    end

let get_unsaved_changes env  =
  let changes = ServerFileSync.get_unsaved_changes env in
  Relative_path.Map.(map ~f:fst changes, map ~f:snd changes)

let full_recheck_if_needed genv env msg =
  if ignore_ide msg then
    let ide, disk = get_unsaved_changes env in
    let env = apply_changes env disk in
    let env = full_recheck_if_needed' genv env msg in
    apply_changes env ide
  else
    full_recheck_if_needed' genv env msg

(****************************************************************************)
(* Called by the client *)
(****************************************************************************)

exception Remote_fatal_exception of Marshal_tools.remote_exception_data
exception Remote_nonfatal_exception of Marshal_tools.remote_exception_data

let rec wait_for_rpc_response fd push_messages =
  match Marshal_tools.from_fd_with_preamble fd with
  | Response r -> r, List.rev push_messages
  | Push (ServerCommandTypes.FATAL_EXCEPTION remote_e_data) ->
    raise (Remote_fatal_exception remote_e_data)
  | Push (ServerCommandTypes.NONFATAL_EXCEPTION remote_e_data) ->
    raise (Remote_nonfatal_exception remote_e_data)
  | Push m -> wait_for_rpc_response fd (m :: push_messages)
  | Hello -> failwith "unexpected hello after connection already established"
  | Ping -> failwith "unexpected ping on persistent connection"

let rpc_persistent :
  type a. Timeout.in_channel * out_channel -> a t -> a * push list
= fun (_, oc) cmd ->
  Marshal.to_channel oc (Rpc cmd) [];
  flush oc;
  let fd = Unix.descr_of_out_channel oc in
  wait_for_rpc_response fd []

let stream_request oc cmd =
  Marshal.to_channel oc (Stream cmd) [];
  flush oc

let connect_debug oc =
  Marshal.to_channel oc Debug [];
  flush oc

let send_connection_type oc t =
  Marshal.to_channel oc t [];
  flush oc

(****************************************************************************)
(* Called by the server *)
(****************************************************************************)

(** Stream response for this command. Returns true if the command needs
 * to force flush the notifier to complete.  *)
let stream_response (genv:ServerEnv.genv) env (ic, oc) ~cmd =
  match cmd with
  | LIST_FILES ->
      ServerEnv.list_files env oc;
      ServerUtils.shutdown_client (ic, oc)
  | LIST_MODES ->
      Relative_path.Map.iter env.ServerEnv.files_info begin fun fn fileinfo ->
        match Relative_path.prefix fn with
        | Relative_path.Root ->
          let mode = match fileinfo.FileInfo.file_mode with
            | None | Some FileInfo.Mphp -> "php"
            | Some FileInfo.Mdecl -> "decl"
            | Some FileInfo.Mpartial -> "partial"
            | Some FileInfo.Mstrict -> "strict" in
          Printf.fprintf oc "%s\t%s\n" mode (Relative_path.to_absolute fn)
        | _ -> ()
      end;
      flush oc;
      ServerUtils.shutdown_client (ic, oc)
  | SHOW name ->
      output_string oc "starting\n";
      SharedMem.invalidate_caches();
      let qual_name = if name.[0] = '\\' then name else ("\\"^name) in
      output_string oc "class:\n";
      let class_name =
        match NamingGlobal.GEnv.type_canon_name qual_name with
        | None ->
          let () = output_string oc "Missing from naming env\n" in qual_name
        | Some canon ->
          let p = unsafe_opt
            @@ NamingGlobal.GEnv.type_pos env.ServerEnv.tcopt canon in
          let () = output_string oc ((Pos.string (Pos.to_absolute p))^"\n") in
          canon
      in
      let class_ = TLazyHeap.get_class env.ServerEnv.tcopt class_name in
      (match class_ with
      | None -> output_string oc "Missing from typing env\n"
      | Some c ->
          let class_str = Typing_print.class_ env.ServerEnv.tcopt c in
          output_string oc (class_str^"\n")
      );
      output_string oc "\nfunction:\n";
      let fun_name =
        match NamingGlobal.GEnv.fun_canon_name qual_name with
        | None ->
          let () = output_string oc "Missing from naming env\n" in qual_name
        | Some canon ->
          let p = unsafe_opt
            @@ NamingGlobal.GEnv.fun_pos env.ServerEnv.tcopt canon in
          let () = output_string oc ((Pos.string (Pos.to_absolute p))^"\n") in
          canon
      in
      let fun_ = TLazyHeap.get_fun env.ServerEnv.tcopt fun_name in
      (match fun_ with
      | None ->
          output_string oc "Missing from typing env\n"
      | Some f ->
          let fun_str = Typing_print.fun_ env.ServerEnv.tcopt f in
          output_string oc (fun_str^"\n")
      );
      output_string oc "\nglobal const:\n";
      (match NamingGlobal.GEnv.gconst_pos env.ServerEnv.tcopt qual_name with
      | Some p -> output_string oc (Pos.string (Pos.to_absolute p)^"\n")
      | None -> output_string oc "Missing from naming env\n");
      let gconst_ty = TLazyHeap.get_gconst env.ServerEnv.tcopt qual_name in
      (match gconst_ty with
      | None -> output_string oc "Missing from typing env\n"
      | Some gc ->
          let gconst_str = Typing_print.gconst env.ServerEnv.tcopt gc in
          output_string oc ("ty: "^gconst_str^"\n")
      );
      output_string oc "typedef:\n";
      (match NamingGlobal.GEnv.typedef_pos env.ServerEnv.tcopt qual_name with
      | Some p -> output_string oc (Pos.string (Pos.to_absolute p)^"\n")
      | None -> output_string oc "Missing from naming env\n");
      let tdef = TLazyHeap.get_typedef env.ServerEnv.tcopt qual_name in
      (match tdef with
      | None ->
          output_string oc "Missing from typing env\n"
      | Some td ->
          let td_str = Typing_print.typedef env.ServerEnv.tcopt td in
          output_string oc (td_str^"\n")
      );
      flush oc;
      ServerUtils.shutdown_client (ic, oc)
  | BUILD build_opts ->
      BuildMain.go build_opts genv env oc;
      ServerUtils.shutdown_client (ic, oc)

let handle
    (genv: ServerEnv.genv)
    (env: ServerEnv.env)
    (client: ClientProvider.client)
  : ServerEnv.env =
  let msg = ClientProvider.read_client_msg client in
  let env = full_recheck_if_needed genv env msg in
  match msg with
  | Rpc cmd ->
    begin try
      ClientProvider.ping client;
      let t = Unix.gettimeofday () in
      let new_env, response = ServerRpc.handle
        ~is_stale:env.ServerEnv.recent_recheck_loop_stats.ServerEnv.updates_stale
        genv env cmd in
      let cmd_string = ServerCommandTypesUtils.debug_describe_t cmd in
      HackEventLogger.handled_command cmd_string t;
      ClientProvider.send_response_to_client client response;
      if ServerCommandTypes.is_disconnect_rpc cmd ||
          not @@ (ClientProvider.is_persistent client)
        then ClientProvider.shutdown_client client;
      if ServerCommandTypes.is_kill_rpc cmd then ServerUtils.die_nicely ();
      new_env
    with e ->
      let stack = Printexc.get_backtrace () in
      if ServerCommandTypes.is_critical_rpc cmd then raise e
      else raise (Nonfatal_rpc_exception (e, stack, env))
    end
  | Stream cmd ->
      let ic, oc = ClientProvider.get_channels client in
      stream_response genv env (ic, oc) ~cmd;
      env
  | Debug ->
      let ic, oc = ClientProvider.get_channels client in
      genv.ServerEnv.debug_channels <- Some (ic, oc);
      ServerDebug.say_hello genv;
      env
