<?hh <<__EntryPoint>> function main(): void {
try { var_dump(time_sleep_until('goofy')); } catch (Exception $e) { echo "\n".'Warning: '.$e->getMessage().' in '.__FILE__.' on line '.__LINE__."\n"; }
}
