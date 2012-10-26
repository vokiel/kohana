<?php namespace Controller;

class Welcome extends \Kohana\Controller {

	public function action_index()
	{
		$oo = \Kohana\View::factory('profiler/stats');
		$this->response->body($oo);
	}

} // End Welcome
