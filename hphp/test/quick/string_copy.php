<?hh

function main($str) {
  $arr = array();
  for ($i = 0; $i < 3; ++$i) {
    $str[2] = (string)$i;
    $arr[] = $str;
  }
  var_dump($arr);
}
<<__EntryPoint>> function main_entry(): void {
$a = array('hello there' => 0);
foreach ($a as $key => $value) {
  main($key);
}
}
