<?php namespace Controller;

use Kohana;
use Kohana\View as View; 
use Kohana\Debug as Debug; 

class Welcome extends \Kohana\Controller {

	// load profiler stats

	public function action_index()
	{
		$stats = View::factory('profiler/stats');
		$this->response->body($stats);
	}

	// load config file

	public function action_config()
	{
		$config = Kohana::$config->load('curl');
		$arr = Debug::vars($config);
		$this->response->body($arr);
	}

}
