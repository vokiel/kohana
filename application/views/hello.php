<?php
// wczytanie pliku konfiguracyjnego
print_r($config);
echo "<br>";
// wczytanie wartośc z pliku konfiguracyjnego
print_r($config['sample_value']);
echo "<br>";
// profiler
echo View::factory('profiler/stats')."\n";

