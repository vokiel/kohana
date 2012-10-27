<?php namespace Controller;

use Kohana\View as View; 

class Welcome extends \Kohana\Controller {

	public function action_index()
	{
		$stats = View::factory('profiler/stats');
		$this->response->body($stats);
	}

}
