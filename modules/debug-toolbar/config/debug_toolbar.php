<?php defined('SYSPATH') or die('No direct script access.');

return array(
	//'auto_render' => Kohana::$environment > Kohana::PRODUCTION,
	'auto_render' => FALSE,
	'minimized' => FALSE,
	'firephp_enabled' => TRUE,
	'panels' => array(
		'benchmarks'		=> TRUE,
		'database'			=> TRUE,
		'vars'				=> TRUE,
		'ajax'				=> TRUE,
		'files'				=> TRUE,
		'modules'			=> TRUE,
		'routes'			=> TRUE,
		'customs'           => TRUE,
	),
	'align' => 'right',
	'secret_key' => FALSE,
);
