<?php namespace Kohana;

Route::set('bootstrap', 'bootstrap')
	->defaults(array(
		'controller' => 'bootstrap',
		'action'     => 'index',
	));

