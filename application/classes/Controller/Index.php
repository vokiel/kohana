<?php namespace Controller;

class Index extends \Controller\Template {

	// welcome default
	public function action_index()
	{

	}

	// load config file
	public function action_config()
	{
		$config = Kohana::$config->load('curl');
		$this->template->content = Debug::vars($config);
	}
}
