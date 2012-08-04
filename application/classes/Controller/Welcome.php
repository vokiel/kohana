<?php namespace Kohana\Controller;

use Controller  as Controller;
use View  as View;

class Welcome extends Controller {

	public function action_index()
	{
		$view = View::factory('profiler/stats');
		//$view = View::factory('hello');
		$this->response->body($view);
	}

} // End Welcome
