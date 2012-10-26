<?php namespace Kohana\Controller\Front;
use Controller  as Controller;
use View  as View;

class Welcome extends Controller {

	public function action_index()
	{
		$core = \Kohana::$config->load('Core');
		$dir = $this->request->directory();
		//$view = View::factory('profiler/stats')->bind('config',$core);
		$view = View::factory('hello')->bind('config',$core);
		$this->response->body($view);
	}

} // End Welcome