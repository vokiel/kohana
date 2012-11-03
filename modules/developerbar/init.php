<?php namespace Kohana;
if(Kohana::$environment !== Kohana::PRODUCTION)
{	
	$objDeveloperBar = Developerbar::factory();
	register_shutdown_function(array(&$objDeveloperBar,'render'));
}
