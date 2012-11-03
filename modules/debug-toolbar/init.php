<?php

// Load FirePHP if it enabled in config
if(\Kohana\Kohana::$config->load('debug_toolbar')->firephp_enabled === TRUE){
	$file = 'firephp/packages/core/lib/FirePHPCore/FirePHP.class';
	$firePHP = \Kohana\Kohana::find_file('vendor', $file);
	if( ! $firePHP) throw new \Kohana\Exception('The FirePHP :file could not be found', array(':file'=>$file));
	require_once $firePHP;
}
// Render Debug Toolbar on the end of application execution
if (\Kohana\Kohana::$config->load('debug_toolbar')->auto_render === TRUE)
    register_shutdown_function('\Kohana\DebugToolbar::render');
