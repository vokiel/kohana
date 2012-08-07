<?php
// test i18n
echo __('english')."\n";
// wczytanie pliku konfiguracyjnego
echo Request::current()->directory();
echo Debug::vars($config);
// wczytanie wartośc z pliku konfiguracyjnego
//echo Debug::vars($config['sample_value']);
// profiler
//echo View::factory('profiler/stats')."\n";
echo '<br>'.number_format(memory_get_usage() / 1048576, 2);

