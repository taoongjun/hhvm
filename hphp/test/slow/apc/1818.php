<?hh

class A {
 var $i = 10;
 }

<<__EntryPoint>>
function main_1818() {
$a = array(new A);
apc_store('key1', $a);
$b = __hhvm_intrinsics\apc_fetch_no_check('key1');
$c = $b[0];
$c->i = 100;
apc_store('key2', $b);
$t = __hhvm_intrinsics\apc_fetch_no_check('key2');
var_dump($t[0]->i);
}
