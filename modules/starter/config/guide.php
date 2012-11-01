<?php defined('SYSPATH') OR die('No direct script access.');

return array
(
	'doc' => array(
			array('slug'=>'index','title'=>'Start z Hanariu'),
			array('slug'=>'doc','title'=>'Dokumentacja','menu'=>array(
					array('slug'=>'podstrona1','title'=>'Przykładowa podstrona 1'),
					array('slug'=>'podstrona2','title'=>'Przykładowa podstrona 1'),
			)),
			array('slug'=>'bootstrap','title'=>'Ustawienia i konfiguracja'),
			array('slug'=>'namespace','title'=>'Przestrzenie nazw'),
			array('slug'=>'controller','title'=>'Kontroler'),
			array('slug'=>'model','title'=>'Model'),
			array('slug'=>'view','title'=>'Widok'),
			array('slug'=>'helper','title'=>'Helpery'),
			array('slug'=>'routing','title'=>'Routing'),
			array('slug'=>'database','title'=>'Baza danych'),
		),
	'tutorial' => array(
			array('slug'=>'index','title'=>'Filozofia pracy'),
			array('slug'=>'templates','title'=>'System szablonów'),
			array('slug'=>'themes','title'=>'Tworzenie skórek'),
			array('slug'=>'modules','title'=>'Tworzenie modułów'),
			array('slug'=>'libs','title'=>'Praca z bibliotekami'),
			array('slug'=>'models','title'=>'Praca z modelem'),
			array('slug'=>'benchs','title'=>'Wydajność głupcze!'),
		),
	'modul' => array(
			array('slug'=>'index','title'=>'Informacja o modułach','is_doc'=>0,'is_tutorial'=>0,'status'=>4),
		),
	'app' => array(
			array('slug'=>'index','title'=>'Hanariu (strona)'),
			array('slug'=>'riupress','title'=>'Riupress - blog'),
			array('slug'=>'filemon','title'=>'Filemon - koszyk zakupów'),
			array('slug'=>'adpress','title'=>'Adpress - system banerowy'),
			array('slug'=>'uke','title'=>'Uke CRM'),
		),
	'roadmap' => array(
			array('slug'=>'index','title'=>'Lista planowanych zmian'),
			array('slug'=>'bootstrap','title'=>'Lista planowanych modułów'),
		),
);
