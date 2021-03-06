<?hh

function LV($x) { return __hhvm_intrinsics\launder_value($x); }

<<__NEVER_INLINE>> function print_header($title) {
  echo "$title\n";
  echo "+---------+------+------+------+------+------+------+------+------+------+\n";
  echo "| VAR     | <    | <=   | >    | >=   | ==   | !=   | ===  | !==  | <=>  |\n";
  echo "+=========+======+======+======+======+======+======+======+======+======+";
}
<<__NEVER_INLINE>> function print_footer() {
  echo "\n+---------+------+------+------+------+------+------+------+------+------+\n\n";
}
<<__NEVER_INLINE>> function begin_row($var) {
  printf("\n| %-7s |", "\$$var");
}
<<__NEVER_INLINE>> function C(bool $v) {
  printf(" %-4s |", $v ? 'T' : 'F');
}
<<__NEVER_INLINE>> function I(int $v) {
  printf(" %-4d |", $v);
}
<<__NEVER_INLINE>> function E() {
  printf("    * |");
}

<<__NEVER_INLINE>> function compare_varray_empty_static() {
  $va = varray[];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $va ? VAR');
  begin_row('true');
    C($va<$tr);C($va<=$tr);C($va>$tr);C($va>=$tr);C($va==$tr);C($va!=$tr);
    C($va===$tr);C($va!==$tr);I($va<=>$tr);
  begin_row('false');
    C($va<$fa);C($va<=$fa);C($va>$fa);C($va>=$fa);C($va==$fa);C($va!=$fa);
    C($va===$fa);C($va!==$fa);I($va<=>$fa);
  begin_row('null');
    C($va<$nu);C($va<=$nu);C($va>$nu);C($va>=$nu);C($va==$nu);C($va!=$nu);
    C($va===$nu);C($va!==$nu);I($va<=>$nu);
  print_footer();

  print_header('[static] VAR ? $va');
  begin_row('true');
    C($tr<$va);C($tr<=$va);C($tr>$va);C($tr>=$va);C($tr==$va);C($tr!=$va);
    C($tr===$va);C($tr!==$va);I($tr<=>$va);
  begin_row('false');
    C($fa<$va);C($fa<=$va);C($fa>$va);C($fa>=$va);C($fa==$va);C($fa!=$va);
    C($fa===$va);C($fa!==$va);I($fa<=>$va);
  begin_row('null');
    C($nu<$va);C($nu<=$va);C($nu>$va);C($nu>=$va);C($nu==$va);C($nu!=$va);
    C($nu===$va);C($nu!==$va);I($nu<=>$va);
  print_footer();
}

<<__NEVER_INLINE>> function compare_varray_empty_dynamic() {
  $va = LV(varray[]);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $va ? VAR');
  begin_row('true');
    C($va<$tr);C($va<=$tr);C($va>$tr);C($va>=$tr);C($va==$tr);C($va!=$tr);
    C($va===$tr);C($va!==$tr);I($va<=>$tr);
  begin_row('false');
    C($va<$fa);C($va<=$fa);C($va>$fa);C($va>=$fa);C($va==$fa);C($va!=$fa);
    C($va===$fa);C($va!==$fa);I($va<=>$fa);
  begin_row('null');
    C($va<$nu);C($va<=$nu);C($va>$nu);C($va>=$nu);C($va==$nu);C($va!=$nu);
    C($va===$nu);C($va!==$nu);I($va<=>$nu);
  print_footer();

  print_header('[dynamic] VAR ? $va');
  begin_row('true');
    C($tr<$va);C($tr<=$va);C($tr>$va);C($tr>=$va);C($tr==$va);C($tr!=$va);
    C($tr===$va);C($tr!==$va);I($tr<=>$va);
  begin_row('false');
    C($fa<$va);C($fa<=$va);C($fa>$va);C($fa>=$va);C($fa==$va);C($fa!=$va);
    C($fa===$va);C($fa!==$va);I($fa<=>$va);
  begin_row('null');
    C($nu<$va);C($nu<=$va);C($nu>$va);C($nu>=$va);C($nu==$va);C($nu!=$va);
    C($nu===$va);C($nu!==$va);I($nu<=>$va);
  print_footer();
}

<<__NEVER_INLINE>> function compare_varray_nonempty_static() {
  $vx = varray[42, 'foo'];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $vx ? VAR');
  begin_row('true');
    C($vx<$tr);C($vx<=$tr);C($vx>$tr);C($vx>=$tr);C($vx==$tr);C($vx!=$tr);
    C($vx===$tr);C($vx!==$tr);I($vx<=>$tr);
  begin_row('false');
    C($vx<$fa);C($vx<=$fa);C($vx>$fa);C($vx>=$fa);C($vx==$fa);C($vx!=$fa);
    C($vx===$fa);C($vx!==$fa);I($vx<=>$fa);
  begin_row('null');
    C($vx<$nu);C($vx<=$nu);C($vx>$nu);C($vx>=$nu);C($vx==$nu);C($vx!=$nu);
    C($vx===$nu);C($vx!==$nu);I($vx<=>$nu);
  print_footer();

  print_header('[static] VAR ? $vx');
  begin_row('true');
    C($tr<$vx);C($tr<=$vx);C($tr>$vx);C($tr>=$vx);C($tr==$vx);C($tr!=$vx);
    C($tr===$vx);C($tr!==$vx);I($tr<=>$vx);
  begin_row('false');
    C($fa<$vx);C($fa<=$vx);C($fa>$vx);C($fa>=$vx);C($fa==$vx);C($fa!=$vx);
    C($fa===$vx);C($fa!==$vx);I($fa<=>$vx);
  begin_row('null');
    C($nu<$vx);C($nu<=$vx);C($nu>$vx);C($nu>=$vx);C($nu==$vx);C($nu!=$vx);
    C($nu===$vx);C($nu!==$vx);I($nu<=>$vx);
  print_footer();
}

<<__NEVER_INLINE>> function compare_varray_nonempty_dynamic() {
  $vx = LV(varray[42, 'foo']);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $vx ? VAR');
  begin_row('true');
    C($vx<$tr);C($vx<=$tr);C($vx>$tr);C($vx>=$tr);C($vx==$tr);C($vx!=$tr);
    C($vx===$tr);C($vx!==$tr);I($vx<=>$tr);
  begin_row('false');
    C($vx<$fa);C($vx<=$fa);C($vx>$fa);C($vx>=$fa);C($vx==$fa);C($vx!=$fa);
    C($vx===$fa);C($vx!==$fa);I($vx<=>$fa);
  begin_row('null');
    C($vx<$nu);C($vx<=$nu);C($vx>$nu);C($vx>=$nu);C($vx==$nu);C($vx!=$nu);
    C($vx===$nu);C($vx!==$nu);I($vx<=>$nu);
  print_footer();

  print_header('[dynamic] VAR ? $vx');
  begin_row('true');
    C($tr<$vx);C($tr<=$vx);C($tr>$vx);C($tr>=$vx);C($tr==$vx);C($tr!=$vx);
    C($tr===$vx);C($tr!==$vx);I($tr<=>$vx);
  begin_row('false');
    C($fa<$vx);C($fa<=$vx);C($fa>$vx);C($fa>=$vx);C($fa==$vx);C($fa!=$vx);
    C($fa===$vx);C($fa!==$vx);I($fa<=>$vx);
  begin_row('null');
    C($nu<$vx);C($nu<=$vx);C($nu>$vx);C($nu>=$vx);C($nu==$vx);C($nu!=$vx);
    C($nu===$vx);C($nu!==$vx);I($nu<=>$vx);
  print_footer();
}

<<__NEVER_INLINE>> function compare_darray_empty_static() {
  $da = darray[];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $da ? VAR');
  begin_row('true');
    C($da<$tr);C($da<=$tr);C($da>$tr);C($da>=$tr);C($da==$tr);C($da!=$tr);
    C($da===$tr);C($da!==$tr);I($da<=>$tr);
  begin_row('false');
    C($da<$fa);C($da<=$fa);C($da>$fa);C($da>=$fa);C($da==$fa);C($da!=$fa);
    C($da===$fa);C($da!==$fa);I($da<=>$fa);
  begin_row('null');
    C($da<$nu);C($da<=$nu);C($da>$nu);C($da>=$nu);C($da==$nu);C($da!=$nu);
    C($da===$nu);C($da!==$nu);I($da<=>$nu);
  print_footer();

  print_header('[static] VAR ? $da');
  begin_row('true');
    C($tr<$da);C($tr<=$da);C($tr>$da);C($tr>=$da);C($tr==$da);C($tr!=$da);
    C($tr===$da);C($tr!==$da);I($tr<=>$da);
  begin_row('false');
    C($fa<$da);C($fa<=$da);C($fa>$da);C($fa>=$da);C($fa==$da);C($fa!=$da);
    C($fa===$da);C($fa!==$da);I($fa<=>$da);
  begin_row('null');
    C($nu<$da);C($nu<=$da);C($nu>$da);C($nu>=$da);C($nu==$da);C($nu!=$da);
    C($nu===$da);C($nu!==$da);I($nu<=>$da);
  print_footer();
}

<<__NEVER_INLINE>> function compare_darray_empty_dynamic() {
  $da = LV(darray[]);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $da ? VAR');
  begin_row('true');
    C($da<$tr);C($da<=$tr);C($da>$tr);C($da>=$tr);C($da==$tr);C($da!=$tr);
    C($da===$tr);C($da!==$tr);I($da<=>$tr);
  begin_row('false');
    C($da<$fa);C($da<=$fa);C($da>$fa);C($da>=$fa);C($da==$fa);C($da!=$fa);
    C($da===$fa);C($da!==$fa);I($da<=>$fa);
  begin_row('null');
    C($da<$nu);C($da<=$nu);C($da>$nu);C($da>=$nu);C($da==$nu);C($da!=$nu);
    C($da===$nu);C($da!==$nu);I($da<=>$nu);
  print_footer();

  print_header('[dynamic] VAR ? $da');
  begin_row('true');
    C($tr<$da);C($tr<=$da);C($tr>$da);C($tr>=$da);C($tr==$da);C($tr!=$da);
    C($tr===$da);C($tr!==$da);I($tr<=>$da);
  begin_row('false');
    C($fa<$da);C($fa<=$da);C($fa>$da);C($fa>=$da);C($fa==$da);C($fa!=$da);
    C($fa===$da);C($fa!==$da);I($fa<=>$da);
  begin_row('null');
    C($nu<$da);C($nu<=$da);C($nu>$da);C($nu>=$da);C($nu==$da);C($nu!=$da);
    C($nu===$da);C($nu!==$da);I($nu<=>$da);
  print_footer();
}

<<__NEVER_INLINE>> function compare_darray_nonempty_static() {
  $dx = darray['foo' => 42, 'bar' => 'baz'];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $dx ? VAR');
  begin_row('true');
    C($dx<$tr);C($dx<=$tr);C($dx>$tr);C($dx>=$tr);C($dx==$tr);C($dx!=$tr);
    C($dx===$tr);C($dx!==$tr);I($dx<=>$tr);
  begin_row('false');
    C($dx<$fa);C($dx<=$fa);C($dx>$fa);C($dx>=$fa);C($dx==$fa);C($dx!=$fa);
    C($dx===$fa);C($dx!==$fa);I($dx<=>$fa);
  begin_row('null');
    C($dx<$nu);C($dx<=$nu);C($dx>$nu);C($dx>=$nu);C($dx==$nu);C($dx!=$nu);
    C($dx===$nu);C($dx!==$nu);I($dx<=>$nu);
  print_footer();

  print_header('[static] VAR ? $dx');
  begin_row('true');
    C($tr<$dx);C($tr<=$dx);C($tr>$dx);C($tr>=$dx);C($tr==$dx);C($tr!=$dx);
    C($tr===$dx);C($tr!==$dx);I($tr<=>$dx);
  begin_row('false');
    C($fa<$dx);C($fa<=$dx);C($fa>$dx);C($fa>=$dx);C($fa==$dx);C($fa!=$dx);
    C($fa===$dx);C($fa!==$dx);I($fa<=>$dx);
  begin_row('null');
    C($nu<$dx);C($nu<=$dx);C($nu>$dx);C($nu>=$dx);C($nu==$dx);C($nu!=$dx);
    C($nu===$dx);C($nu!==$dx);I($nu<=>$dx);
  print_footer();
}

<<__NEVER_INLINE>> function compare_darray_nonempty_dynamic() {
  $dx = LV(darray['foo' => 42, 'bar' => 'baz']);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $dx ? VAR');
  begin_row('true');
    C($dx<$tr);C($dx<=$tr);C($dx>$tr);C($dx>=$tr);C($dx==$tr);C($dx!=$tr);
    C($dx===$tr);C($dx!==$tr);I($dx<=>$tr);
  begin_row('false');
    C($dx<$fa);C($dx<=$fa);C($dx>$fa);C($dx>=$fa);C($dx==$fa);C($dx!=$fa);
    C($dx===$fa);C($dx!==$fa);I($dx<=>$fa);
  begin_row('null');
    C($dx<$nu);C($dx<=$nu);C($dx>$nu);C($dx>=$nu);C($dx==$nu);C($dx!=$nu);
    C($dx===$nu);C($dx!==$nu);I($dx<=>$nu);
  print_footer();

  print_header('[dynamic] VAR ? $dx');
  begin_row('true');
    C($tr<$dx);C($tr<=$dx);C($tr>$dx);C($tr>=$dx);C($tr==$dx);C($tr!=$dx);
    C($tr===$dx);C($tr!==$dx);I($tr<=>$dx);
  begin_row('false');
    C($fa<$dx);C($fa<=$dx);C($fa>$dx);C($fa>=$dx);C($fa==$dx);C($fa!=$dx);
    C($fa===$dx);C($fa!==$dx);I($fa<=>$dx);
  begin_row('null');
    C($nu<$dx);C($nu<=$dx);C($nu>$dx);C($nu>=$dx);C($nu==$dx);C($nu!=$dx);
    C($nu===$dx);C($nu!==$dx);I($nu<=>$dx);
  print_footer();
}

<<__NEVER_INLINE>> function compare_vec_empty_static() {
  $ve = vec[];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $ve ? VAR');
  begin_row('true');
    try { C($ve<  $tr); } catch (Exception $_) { E(); }
    try { C($ve<= $tr); } catch (Exception $_) { E(); }
    try { C($ve > $tr); } catch (Exception $_) { E(); }
    try { C($ve >=$tr); } catch (Exception $_) { E(); }
    C($ve ==$tr);
    C($ve !=$tr);
    C($ve===$tr);
    C($ve!==$tr);
    try { I($ve<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($ve<  $fa); } catch (Exception $_) { E(); }
    try { C($ve<= $fa); } catch (Exception $_) { E(); }
    try { C($ve > $fa); } catch (Exception $_) { E(); }
    try { C($ve >=$fa); } catch (Exception $_) { E(); }
    C($ve ==$fa);
    C($ve !=$fa);
    C($ve===$fa);
    C($ve!==$fa);
    try { I($ve<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($ve<  $nu); } catch (Exception $_) { E(); }
    try { C($ve<= $nu); } catch (Exception $_) { E(); }
    try { C($ve > $nu); } catch (Exception $_) { E(); }
    try { C($ve >=$nu); } catch (Exception $_) { E(); }
    C($ve ==$nu);
    C($ve !=$nu);
    C($ve===$nu);
    C($ve!==$nu);
    try { I($ve<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[static] VAR ? $ve');
  begin_row('true');
    try { C($tr<  $ve); } catch (Exception $_) { E(); }
    try { C($tr<= $ve); } catch (Exception $_) { E(); }
    try { C($tr > $ve); } catch (Exception $_) { E(); }
    try { C($tr >=$ve); } catch (Exception $_) { E(); }
    C($tr ==$ve);
    C($tr !=$ve);
    C($tr===$ve);
    C($tr!==$ve);
    try { I($tr<=>$ve); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $ve); } catch (Exception $_) { E(); }
    try { C($fa<= $ve); } catch (Exception $_) { E(); }
    try { C($fa > $ve); } catch (Exception $_) { E(); }
    try { C($fa >=$ve); } catch (Exception $_) { E(); }
    C($fa ==$ve);
    C($fa !=$ve);
    C($fa===$ve);
    C($fa!==$ve);
    try { I($fa<=>$ve); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $ve); } catch (Exception $_) { E(); }
    try { C($nu<= $ve); } catch (Exception $_) { E(); }
    try { C($nu > $ve); } catch (Exception $_) { E(); }
    try { C($nu >=$ve); } catch (Exception $_) { E(); }
    C($nu ==$ve);
    C($nu !=$ve);
    C($nu===$ve);
    C($nu!==$ve);
    try { I($nu<=>$ve); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_vec_empty_dynamic() {
  $ve = LV(vec[]);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $ve ? VAR');
  begin_row('true');
    try { C($ve<  $tr); } catch (Exception $_) { E(); }
    try { C($ve<= $tr); } catch (Exception $_) { E(); }
    try { C($ve > $tr); } catch (Exception $_) { E(); }
    try { C($ve >=$tr); } catch (Exception $_) { E(); }
    C($ve ==$tr);
    C($ve !=$tr);
    C($ve===$tr);
    C($ve!==$tr);
    try { I($ve<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($ve<  $fa); } catch (Exception $_) { E(); }
    try { C($ve<= $fa); } catch (Exception $_) { E(); }
    try { C($ve > $fa); } catch (Exception $_) { E(); }
    try { C($ve >=$fa); } catch (Exception $_) { E(); }
    C($ve ==$fa);
    C($ve !=$fa);
    C($ve===$fa);
    C($ve!==$fa);
    try { I($ve<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($ve<  $nu); } catch (Exception $_) { E(); }
    try { C($ve<= $nu); } catch (Exception $_) { E(); }
    try { C($ve > $nu); } catch (Exception $_) { E(); }
    try { C($ve >=$nu); } catch (Exception $_) { E(); }
    C($ve ==$nu);
    C($ve !=$nu);
    C($ve===$nu);
    C($ve!==$nu);
    try { I($ve<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[dynamic] VAR ? $ve');
  begin_row('true');
    try { C($tr<  $ve); } catch (Exception $_) { E(); }
    try { C($tr<= $ve); } catch (Exception $_) { E(); }
    try { C($tr > $ve); } catch (Exception $_) { E(); }
    try { C($tr >=$ve); } catch (Exception $_) { E(); }
    C($tr ==$ve);
    C($tr !=$ve);
    C($tr===$ve);
    C($tr!==$ve);
    try { I($tr<=>$ve); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $ve); } catch (Exception $_) { E(); }
    try { C($fa<= $ve); } catch (Exception $_) { E(); }
    try { C($fa > $ve); } catch (Exception $_) { E(); }
    try { C($fa >=$ve); } catch (Exception $_) { E(); }
    C($fa ==$ve);
    C($fa !=$ve);
    C($fa===$ve);
    C($fa!==$ve);
    try { I($fa<=>$ve); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $ve); } catch (Exception $_) { E(); }
    try { C($nu<= $ve); } catch (Exception $_) { E(); }
    try { C($nu > $ve); } catch (Exception $_) { E(); }
    try { C($nu >=$ve); } catch (Exception $_) { E(); }
    C($nu ==$ve);
    C($nu !=$ve);
    C($nu===$ve);
    C($nu!==$ve);
    try { I($nu<=>$ve); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_vec_nonempty_static() {
  $vz = vec[42, 'foo'];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $vz ? VAR');
  begin_row('true');
    try { C($vz<  $tr); } catch (Exception $_) { E(); }
    try { C($vz<= $tr); } catch (Exception $_) { E(); }
    try { C($vz > $tr); } catch (Exception $_) { E(); }
    try { C($vz >=$tr); } catch (Exception $_) { E(); }
    C($vz ==$tr);
    C($vz !=$tr);
    C($vz===$tr);
    C($vz!==$tr);
    try { I($vz<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($vz<  $fa); } catch (Exception $_) { E(); }
    try { C($vz<= $fa); } catch (Exception $_) { E(); }
    try { C($vz > $fa); } catch (Exception $_) { E(); }
    try { C($vz >=$fa); } catch (Exception $_) { E(); }
    C($vz ==$fa);
    C($vz !=$fa);
    C($vz===$fa);
    C($vz!==$fa);
    try { I($vz<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($vz<  $nu); } catch (Exception $_) { E(); }
    try { C($vz<= $nu); } catch (Exception $_) { E(); }
    try { C($vz > $nu); } catch (Exception $_) { E(); }
    try { C($vz >=$nu); } catch (Exception $_) { E(); }
    C($vz ==$nu);
    C($vz !=$nu);
    C($vz===$nu);
    C($vz!==$nu);
    try { I($vz<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[static] VAR ? $vz');
  begin_row('true');
    try { C($tr<  $vz); } catch (Exception $_) { E(); }
    try { C($tr<= $vz); } catch (Exception $_) { E(); }
    try { C($tr > $vz); } catch (Exception $_) { E(); }
    try { C($tr >=$vz); } catch (Exception $_) { E(); }
    C($tr ==$vz);
    C($tr !=$vz);
    C($tr===$vz);
    C($tr!==$vz);
    try { I($tr<=>$vz); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $vz); } catch (Exception $_) { E(); }
    try { C($fa<= $vz); } catch (Exception $_) { E(); }
    try { C($fa > $vz); } catch (Exception $_) { E(); }
    try { C($fa >=$vz); } catch (Exception $_) { E(); }
    C($fa ==$vz);
    C($fa !=$vz);
    C($fa===$vz);
    C($fa!==$vz);
    try { I($fa<=>$vz); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $vz); } catch (Exception $_) { E(); }
    try { C($nu<= $vz); } catch (Exception $_) { E(); }
    try { C($nu > $vz); } catch (Exception $_) { E(); }
    try { C($nu >=$vz); } catch (Exception $_) { E(); }
    C($nu ==$vz);
    C($nu !=$vz);
    C($nu===$vz);
    C($nu!==$vz);
    try { I($nu<=>$vz); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_vec_nonempty_dynamic() {
  $vz = LV(vec[42, 'foo']);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $vz ? VAR');
  begin_row('true');
    try { C($vz<  $tr); } catch (Exception $_) { E(); }
    try { C($vz<= $tr); } catch (Exception $_) { E(); }
    try { C($vz > $tr); } catch (Exception $_) { E(); }
    try { C($vz >=$tr); } catch (Exception $_) { E(); }
    C($vz ==$tr);
    C($vz !=$tr);
    C($vz===$tr);
    C($vz!==$tr);
    try { I($vz<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($vz<  $fa); } catch (Exception $_) { E(); }
    try { C($vz<= $fa); } catch (Exception $_) { E(); }
    try { C($vz > $fa); } catch (Exception $_) { E(); }
    try { C($vz >=$fa); } catch (Exception $_) { E(); }
    C($vz ==$fa);
    C($vz !=$fa);
    C($vz===$fa);
    C($vz!==$fa);
    try { I($vz<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($vz<  $nu); } catch (Exception $_) { E(); }
    try { C($vz<= $nu); } catch (Exception $_) { E(); }
    try { C($vz > $nu); } catch (Exception $_) { E(); }
    try { C($vz >=$nu); } catch (Exception $_) { E(); }
    C($vz ==$nu);
    C($vz !=$nu);
    C($vz===$nu);
    C($vz!==$nu);
    try { I($vz<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[dynamic] VAR ? $vz');
  begin_row('true');
    try { C($tr<  $vz); } catch (Exception $_) { E(); }
    try { C($tr<= $vz); } catch (Exception $_) { E(); }
    try { C($tr > $vz); } catch (Exception $_) { E(); }
    try { C($tr >=$vz); } catch (Exception $_) { E(); }
    C($tr ==$vz);
    C($tr !=$vz);
    C($tr===$vz);
    C($tr!==$vz);
    try { I($tr<=>$vz); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $vz); } catch (Exception $_) { E(); }
    try { C($fa<= $vz); } catch (Exception $_) { E(); }
    try { C($fa > $vz); } catch (Exception $_) { E(); }
    try { C($fa >=$vz); } catch (Exception $_) { E(); }
    C($fa ==$vz);
    C($fa !=$vz);
    C($fa===$vz);
    C($fa!==$vz);
    try { I($fa<=>$vz); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $vz); } catch (Exception $_) { E(); }
    try { C($nu<= $vz); } catch (Exception $_) { E(); }
    try { C($nu > $vz); } catch (Exception $_) { E(); }
    try { C($nu >=$vz); } catch (Exception $_) { E(); }
    C($nu ==$vz);
    C($nu !=$vz);
    C($nu===$vz);
    C($nu!==$vz);
    try { I($nu<=>$vz); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_dict_empty_static() {
  $di = dict[];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $di ? VAR');
  begin_row('true');
    try { C($di<  $tr); } catch (Exception $_) { E(); }
    try { C($di<= $tr); } catch (Exception $_) { E(); }
    try { C($di > $tr); } catch (Exception $_) { E(); }
    try { C($di >=$tr); } catch (Exception $_) { E(); }
    C($di ==$tr);
    C($di !=$tr);
    C($di===$tr);
    C($di!==$tr);
    try { I($di<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($di<  $fa); } catch (Exception $_) { E(); }
    try { C($di<= $fa); } catch (Exception $_) { E(); }
    try { C($di > $fa); } catch (Exception $_) { E(); }
    try { C($di >=$fa); } catch (Exception $_) { E(); }
    C($di ==$fa);
    C($di !=$fa);
    C($di===$fa);
    C($di!==$fa);
    try { I($di<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($di<  $nu); } catch (Exception $_) { E(); }
    try { C($di<= $nu); } catch (Exception $_) { E(); }
    try { C($di > $nu); } catch (Exception $_) { E(); }
    try { C($di >=$nu); } catch (Exception $_) { E(); }
    C($di ==$nu);
    C($di !=$nu);
    C($di===$nu);
    C($di!==$nu);
    try { I($di<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[static] VAR ? $di');
  begin_row('true');
    try { C($tr<  $di); } catch (Exception $_) { E(); }
    try { C($tr<= $di); } catch (Exception $_) { E(); }
    try { C($tr > $di); } catch (Exception $_) { E(); }
    try { C($tr >=$di); } catch (Exception $_) { E(); }
    C($tr ==$di);
    C($tr !=$di);
    C($tr===$di);
    C($tr!==$di);
    try { I($tr<=>$di); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $di); } catch (Exception $_) { E(); }
    try { C($fa<= $di); } catch (Exception $_) { E(); }
    try { C($fa > $di); } catch (Exception $_) { E(); }
    try { C($fa >=$di); } catch (Exception $_) { E(); }
    C($fa ==$di);
    C($fa !=$di);
    C($fa===$di);
    C($fa!==$di);
    try { I($fa<=>$di); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $di); } catch (Exception $_) { E(); }
    try { C($nu<= $di); } catch (Exception $_) { E(); }
    try { C($nu > $di); } catch (Exception $_) { E(); }
    try { C($nu >=$di); } catch (Exception $_) { E(); }
    C($nu ==$di);
    C($nu !=$di);
    C($nu===$di);
    C($nu!==$di);
    try { I($nu<=>$di); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_dict_empty_dynamic() {
  $di = LV(dict[]);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $di ? VAR');
  begin_row('true');
    try { C($di<  $tr); } catch (Exception $_) { E(); }
    try { C($di<= $tr); } catch (Exception $_) { E(); }
    try { C($di > $tr); } catch (Exception $_) { E(); }
    try { C($di >=$tr); } catch (Exception $_) { E(); }
    C($di ==$tr);
    C($di !=$tr);
    C($di===$tr);
    C($di!==$tr);
    try { I($di<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($di<  $fa); } catch (Exception $_) { E(); }
    try { C($di<= $fa); } catch (Exception $_) { E(); }
    try { C($di > $fa); } catch (Exception $_) { E(); }
    try { C($di >=$fa); } catch (Exception $_) { E(); }
    C($di ==$fa);
    C($di !=$fa);
    C($di===$fa);
    C($di!==$fa);
    try { I($di<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($di<  $nu); } catch (Exception $_) { E(); }
    try { C($di<= $nu); } catch (Exception $_) { E(); }
    try { C($di > $nu); } catch (Exception $_) { E(); }
    try { C($di >=$nu); } catch (Exception $_) { E(); }
    C($di ==$nu);
    C($di !=$nu);
    C($di===$nu);
    C($di!==$nu);
    try { I($di<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[dynamic] VAR ? $di');
  begin_row('true');
    try { C($tr<  $di); } catch (Exception $_) { E(); }
    try { C($tr<= $di); } catch (Exception $_) { E(); }
    try { C($tr > $di); } catch (Exception $_) { E(); }
    try { C($tr >=$di); } catch (Exception $_) { E(); }
    C($tr ==$di);
    C($tr !=$di);
    C($tr===$di);
    C($tr!==$di);
    try { I($tr<=>$di); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $di); } catch (Exception $_) { E(); }
    try { C($fa<= $di); } catch (Exception $_) { E(); }
    try { C($fa > $di); } catch (Exception $_) { E(); }
    try { C($fa >=$di); } catch (Exception $_) { E(); }
    C($fa ==$di);
    C($fa !=$di);
    C($fa===$di);
    C($fa!==$di);
    try { I($fa<=>$di); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $di); } catch (Exception $_) { E(); }
    try { C($nu<= $di); } catch (Exception $_) { E(); }
    try { C($nu > $di); } catch (Exception $_) { E(); }
    try { C($nu >=$di); } catch (Exception $_) { E(); }
    C($nu ==$di);
    C($nu !=$di);
    C($nu===$di);
    C($nu!==$di);
    try { I($nu<=>$di); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_dict_nonempty_static() {
  $dz = dict['foo' => 42, 'bar' => 'baz'];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $dz ? VAR');
  begin_row('true');
    try { C($dz<  $tr); } catch (Exception $_) { E(); }
    try { C($dz<= $tr); } catch (Exception $_) { E(); }
    try { C($dz > $tr); } catch (Exception $_) { E(); }
    try { C($dz >=$tr); } catch (Exception $_) { E(); }
    C($dz ==$tr);
    C($dz !=$tr);
    C($dz===$tr);
    C($dz!==$tr);
    try { I($dz<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($dz<  $fa); } catch (Exception $_) { E(); }
    try { C($dz<= $fa); } catch (Exception $_) { E(); }
    try { C($dz > $fa); } catch (Exception $_) { E(); }
    try { C($dz >=$fa); } catch (Exception $_) { E(); }
    C($dz ==$fa);
    C($dz !=$fa);
    C($dz===$fa);
    C($dz!==$fa);
    try { I($dz<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($dz<  $nu); } catch (Exception $_) { E(); }
    try { C($dz<= $nu); } catch (Exception $_) { E(); }
    try { C($dz > $nu); } catch (Exception $_) { E(); }
    try { C($dz >=$nu); } catch (Exception $_) { E(); }
    C($dz ==$nu);
    C($dz !=$nu);
    C($dz===$nu);
    C($dz!==$nu);
    try { I($dz<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[static] VAR ? $dz');
  begin_row('true');
    try { C($tr<  $dz); } catch (Exception $_) { E(); }
    try { C($tr<= $dz); } catch (Exception $_) { E(); }
    try { C($tr > $dz); } catch (Exception $_) { E(); }
    try { C($tr >=$dz); } catch (Exception $_) { E(); }
    C($tr ==$dz);
    C($tr !=$dz);
    C($tr===$dz);
    C($tr!==$dz);
    try { I($tr<=>$dz); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $dz); } catch (Exception $_) { E(); }
    try { C($fa<= $dz); } catch (Exception $_) { E(); }
    try { C($fa > $dz); } catch (Exception $_) { E(); }
    try { C($fa >=$dz); } catch (Exception $_) { E(); }
    C($fa ==$dz);
    C($fa !=$dz);
    C($fa===$dz);
    C($fa!==$dz);
    try { I($fa<=>$dz); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $dz); } catch (Exception $_) { E(); }
    try { C($nu<= $dz); } catch (Exception $_) { E(); }
    try { C($nu > $dz); } catch (Exception $_) { E(); }
    try { C($nu >=$dz); } catch (Exception $_) { E(); }
    C($nu ==$dz);
    C($nu !=$dz);
    C($nu===$dz);
    C($nu!==$dz);
    try { I($nu<=>$dz); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_dict_nonempty_dynamic() {
  $dz = LV(dict['foo' => 42, 'bar' => 'baz']);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $dz ? VAR');
  begin_row('true');
    try { C($dz<  $tr); } catch (Exception $_) { E(); }
    try { C($dz<= $tr); } catch (Exception $_) { E(); }
    try { C($dz > $tr); } catch (Exception $_) { E(); }
    try { C($dz >=$tr); } catch (Exception $_) { E(); }
    C($dz ==$tr);
    C($dz !=$tr);
    C($dz===$tr);
    C($dz!==$tr);
    try { I($dz<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($dz<  $fa); } catch (Exception $_) { E(); }
    try { C($dz<= $fa); } catch (Exception $_) { E(); }
    try { C($dz > $fa); } catch (Exception $_) { E(); }
    try { C($dz >=$fa); } catch (Exception $_) { E(); }
    C($dz ==$fa);
    C($dz !=$fa);
    C($dz===$fa);
    C($dz!==$fa);
    try { I($dz<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($dz<  $nu); } catch (Exception $_) { E(); }
    try { C($dz<= $nu); } catch (Exception $_) { E(); }
    try { C($dz > $nu); } catch (Exception $_) { E(); }
    try { C($dz >=$nu); } catch (Exception $_) { E(); }
    C($dz ==$nu);
    C($dz !=$nu);
    C($dz===$nu);
    C($dz!==$nu);
    try { I($dz<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[dynamic] VAR ? $dz');
  begin_row('true');
    try { C($tr<  $dz); } catch (Exception $_) { E(); }
    try { C($tr<= $dz); } catch (Exception $_) { E(); }
    try { C($tr > $dz); } catch (Exception $_) { E(); }
    try { C($tr >=$dz); } catch (Exception $_) { E(); }
    C($tr ==$dz);
    C($tr !=$dz);
    C($tr===$dz);
    C($tr!==$dz);
    try { I($tr<=>$dz); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $dz); } catch (Exception $_) { E(); }
    try { C($fa<= $dz); } catch (Exception $_) { E(); }
    try { C($fa > $dz); } catch (Exception $_) { E(); }
    try { C($fa >=$dz); } catch (Exception $_) { E(); }
    C($fa ==$dz);
    C($fa !=$dz);
    C($fa===$dz);
    C($fa!==$dz);
    try { I($fa<=>$dz); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $dz); } catch (Exception $_) { E(); }
    try { C($nu<= $dz); } catch (Exception $_) { E(); }
    try { C($nu > $dz); } catch (Exception $_) { E(); }
    try { C($nu >=$dz); } catch (Exception $_) { E(); }
    C($nu ==$dz);
    C($nu !=$dz);
    C($nu===$dz);
    C($nu!==$dz);
    try { I($nu<=>$dz); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_keyset_empty_static() {
  $ks = keyset[];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $ks ? VAR');
  begin_row('true');
    try { C($ks<  $tr); } catch (Exception $_) { E(); }
    try { C($ks<= $tr); } catch (Exception $_) { E(); }
    try { C($ks > $tr); } catch (Exception $_) { E(); }
    try { C($ks >=$tr); } catch (Exception $_) { E(); }
    C($ks ==$tr);
    C($ks !=$tr);
    C($ks===$tr);
    C($ks!==$tr);
    try { I($ks<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($ks<  $fa); } catch (Exception $_) { E(); }
    try { C($ks<= $fa); } catch (Exception $_) { E(); }
    try { C($ks > $fa); } catch (Exception $_) { E(); }
    try { C($ks >=$fa); } catch (Exception $_) { E(); }
    C($ks ==$fa);
    C($ks !=$fa);
    C($ks===$fa);
    C($ks!==$fa);
    try { I($ks<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($ks<  $nu); } catch (Exception $_) { E(); }
    try { C($ks<= $nu); } catch (Exception $_) { E(); }
    try { C($ks > $nu); } catch (Exception $_) { E(); }
    try { C($ks >=$nu); } catch (Exception $_) { E(); }
    C($ks ==$nu);
    C($ks !=$nu);
    C($ks===$nu);
    C($ks!==$nu);
    try { I($ks<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[static] VAR ? $ks');
  begin_row('true');
    try { C($tr<  $ks); } catch (Exception $_) { E(); }
    try { C($tr<= $ks); } catch (Exception $_) { E(); }
    try { C($tr > $ks); } catch (Exception $_) { E(); }
    try { C($tr >=$ks); } catch (Exception $_) { E(); }
    C($tr ==$ks);
    C($tr !=$ks);
    C($tr===$ks);
    C($tr!==$ks);
    try { I($tr<=>$ks); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $ks); } catch (Exception $_) { E(); }
    try { C($fa<= $ks); } catch (Exception $_) { E(); }
    try { C($fa > $ks); } catch (Exception $_) { E(); }
    try { C($fa >=$ks); } catch (Exception $_) { E(); }
    C($fa ==$ks);
    C($fa !=$ks);
    C($fa===$ks);
    C($fa!==$ks);
    try { I($fa<=>$ks); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $ks); } catch (Exception $_) { E(); }
    try { C($nu<= $ks); } catch (Exception $_) { E(); }
    try { C($nu > $ks); } catch (Exception $_) { E(); }
    try { C($nu >=$ks); } catch (Exception $_) { E(); }
    C($nu ==$ks);
    C($nu !=$ks);
    C($nu===$ks);
    C($nu!==$ks);
    try { I($nu<=>$ks); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_keyset_empty_dynamic() {
  $ks = LV(keyset[]);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $ks ? VAR');
  begin_row('true');
    try { C($ks<  $tr); } catch (Exception $_) { E(); }
    try { C($ks<= $tr); } catch (Exception $_) { E(); }
    try { C($ks > $tr); } catch (Exception $_) { E(); }
    try { C($ks >=$tr); } catch (Exception $_) { E(); }
    C($ks ==$tr);
    C($ks !=$tr);
    C($ks===$tr);
    C($ks!==$tr);
    try { I($ks<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($ks<  $fa); } catch (Exception $_) { E(); }
    try { C($ks<= $fa); } catch (Exception $_) { E(); }
    try { C($ks > $fa); } catch (Exception $_) { E(); }
    try { C($ks >=$fa); } catch (Exception $_) { E(); }
    C($ks ==$fa);
    C($ks !=$fa);
    C($ks===$fa);
    C($ks!==$fa);
    try { I($ks<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($ks<  $nu); } catch (Exception $_) { E(); }
    try { C($ks<= $nu); } catch (Exception $_) { E(); }
    try { C($ks > $nu); } catch (Exception $_) { E(); }
    try { C($ks >=$nu); } catch (Exception $_) { E(); }
    C($ks ==$nu);
    C($ks !=$nu);
    C($ks===$nu);
    C($ks!==$nu);
    try { I($ks<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[dynamic] VAR ? $ks');
  begin_row('true');
    try { C($tr<  $ks); } catch (Exception $_) { E(); }
    try { C($tr<= $ks); } catch (Exception $_) { E(); }
    try { C($tr > $ks); } catch (Exception $_) { E(); }
    try { C($tr >=$ks); } catch (Exception $_) { E(); }
    C($tr ==$ks);
    C($tr !=$ks);
    C($tr===$ks);
    C($tr!==$ks);
    try { I($tr<=>$ks); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $ks); } catch (Exception $_) { E(); }
    try { C($fa<= $ks); } catch (Exception $_) { E(); }
    try { C($fa > $ks); } catch (Exception $_) { E(); }
    try { C($fa >=$ks); } catch (Exception $_) { E(); }
    C($fa ==$ks);
    C($fa !=$ks);
    C($fa===$ks);
    C($fa!==$ks);
    try { I($fa<=>$ks); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $ks); } catch (Exception $_) { E(); }
    try { C($nu<= $ks); } catch (Exception $_) { E(); }
    try { C($nu > $ks); } catch (Exception $_) { E(); }
    try { C($nu >=$ks); } catch (Exception $_) { E(); }
    C($nu ==$ks);
    C($nu !=$ks);
    C($nu===$ks);
    C($nu!==$ks);
    try { I($nu<=>$ks); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_keyset_nonempty_static() {
  $ky = keyset[42, 'foo'];
  $tr = true;
  $fa = false;
  $nu = null;

  print_header('[static] $ky ? VAR');
  begin_row('true');
    try { C($ky<  $tr); } catch (Exception $_) { E(); }
    try { C($ky<= $tr); } catch (Exception $_) { E(); }
    try { C($ky > $tr); } catch (Exception $_) { E(); }
    try { C($ky >=$tr); } catch (Exception $_) { E(); }
    C($ky ==$tr);
    C($ky !=$tr);
    C($ky===$tr);
    C($ky!==$tr);
    try { I($ky<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($ky<  $fa); } catch (Exception $_) { E(); }
    try { C($ky<= $fa); } catch (Exception $_) { E(); }
    try { C($ky > $fa); } catch (Exception $_) { E(); }
    try { C($ky >=$fa); } catch (Exception $_) { E(); }
    C($ky ==$fa);
    C($ky !=$fa);
    C($ky===$fa);
    C($ky!==$fa);
    try { I($ky<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($ky<  $nu); } catch (Exception $_) { E(); }
    try { C($ky<= $nu); } catch (Exception $_) { E(); }
    try { C($ky > $nu); } catch (Exception $_) { E(); }
    try { C($ky >=$nu); } catch (Exception $_) { E(); }
    C($ky ==$nu);
    C($ky !=$nu);
    C($ky===$nu);
    C($ky!==$nu);
    try { I($ky<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[static] VAR ? $ky');
  begin_row('true');
    try { C($tr<  $ky); } catch (Exception $_) { E(); }
    try { C($tr<= $ky); } catch (Exception $_) { E(); }
    try { C($tr > $ky); } catch (Exception $_) { E(); }
    try { C($tr >=$ky); } catch (Exception $_) { E(); }
    C($tr ==$ky);
    C($tr !=$ky);
    C($tr===$ky);
    C($tr!==$ky);
    try { I($tr<=>$ky); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $ky); } catch (Exception $_) { E(); }
    try { C($fa<= $ky); } catch (Exception $_) { E(); }
    try { C($fa > $ky); } catch (Exception $_) { E(); }
    try { C($fa >=$ky); } catch (Exception $_) { E(); }
    C($fa ==$ky);
    C($fa !=$ky);
    C($fa===$ky);
    C($fa!==$ky);
    try { I($fa<=>$ky); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $ky); } catch (Exception $_) { E(); }
    try { C($nu<= $ky); } catch (Exception $_) { E(); }
    try { C($nu > $ky); } catch (Exception $_) { E(); }
    try { C($nu >=$ky); } catch (Exception $_) { E(); }
    C($nu ==$ky);
    C($nu !=$ky);
    C($nu===$ky);
    C($nu!==$ky);
    try { I($nu<=>$ky); } catch (Exception $_) { E(); }
  print_footer();
}

<<__NEVER_INLINE>> function compare_keyset_nonempty_dynamic() {
  $ky = LV(keyset[42, 'foo']);
  $tr = LV(true);
  $fa = LV(false);
  $nu = LV(null);

  print_header('[dynamic] $ky ? VAR');
  begin_row('true');
    try { C($ky<  $tr); } catch (Exception $_) { E(); }
    try { C($ky<= $tr); } catch (Exception $_) { E(); }
    try { C($ky > $tr); } catch (Exception $_) { E(); }
    try { C($ky >=$tr); } catch (Exception $_) { E(); }
    C($ky ==$tr);
    C($ky !=$tr);
    C($ky===$tr);
    C($ky!==$tr);
    try { I($ky<=>$tr); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($ky<  $fa); } catch (Exception $_) { E(); }
    try { C($ky<= $fa); } catch (Exception $_) { E(); }
    try { C($ky > $fa); } catch (Exception $_) { E(); }
    try { C($ky >=$fa); } catch (Exception $_) { E(); }
    C($ky ==$fa);
    C($ky !=$fa);
    C($ky===$fa);
    C($ky!==$fa);
    try { I($ky<=>$fa); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($ky<  $nu); } catch (Exception $_) { E(); }
    try { C($ky<= $nu); } catch (Exception $_) { E(); }
    try { C($ky > $nu); } catch (Exception $_) { E(); }
    try { C($ky >=$nu); } catch (Exception $_) { E(); }
    C($ky ==$nu);
    C($ky !=$nu);
    C($ky===$nu);
    C($ky!==$nu);
    try { I($ky<=>$nu); } catch (Exception $_) { E(); }
  print_footer();

  print_header('[dynamic] VAR ? $ky');
  begin_row('true');
    try { C($tr<  $ky); } catch (Exception $_) { E(); }
    try { C($tr<= $ky); } catch (Exception $_) { E(); }
    try { C($tr > $ky); } catch (Exception $_) { E(); }
    try { C($tr >=$ky); } catch (Exception $_) { E(); }
    C($tr ==$ky);
    C($tr !=$ky);
    C($tr===$ky);
    C($tr!==$ky);
    try { I($tr<=>$ky); } catch (Exception $_) { E(); }
  begin_row('false');
    try { C($fa<  $ky); } catch (Exception $_) { E(); }
    try { C($fa<= $ky); } catch (Exception $_) { E(); }
    try { C($fa > $ky); } catch (Exception $_) { E(); }
    try { C($fa >=$ky); } catch (Exception $_) { E(); }
    C($fa ==$ky);
    C($fa !=$ky);
    C($fa===$ky);
    C($fa!==$ky);
    try { I($fa<=>$ky); } catch (Exception $_) { E(); }
  begin_row('null');
    try { C($nu<  $ky); } catch (Exception $_) { E(); }
    try { C($nu<= $ky); } catch (Exception $_) { E(); }
    try { C($nu > $ky); } catch (Exception $_) { E(); }
    try { C($nu >=$ky); } catch (Exception $_) { E(); }
    C($nu ==$ky);
    C($nu !=$ky);
    C($nu===$ky);
    C($nu!==$ky);
    try { I($nu<=>$ky); } catch (Exception $_) { E(); }
  print_footer();
}

<<__EntryPoint>>
function main() {
  compare_varray_empty_static(); compare_varray_empty_dynamic();
  compare_varray_nonempty_static(); compare_varray_nonempty_dynamic();

  compare_darray_empty_static(); compare_darray_empty_dynamic();
  compare_darray_nonempty_static(); compare_darray_nonempty_dynamic();

  compare_vec_empty_static(); compare_vec_empty_dynamic();
  compare_vec_nonempty_static(); compare_vec_nonempty_dynamic();

  compare_dict_empty_static(); compare_dict_empty_dynamic();
  compare_dict_nonempty_static(); compare_dict_nonempty_dynamic();

  compare_keyset_empty_static(); compare_keyset_empty_dynamic();
  compare_keyset_nonempty_static(); compare_keyset_nonempty_dynamic();
}
