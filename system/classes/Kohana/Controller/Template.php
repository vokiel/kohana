<?php namespace Kohana\Controller;

abstract class Template extends \Kohana\Controller {

	public $template = 'template';
	public $auto_render = TRUE;

	public function before()
	{
		parent::before();

		if ($this->auto_render === TRUE)
		{
			$this->template = \Kohana\View::factory($this->template);
		}
	}

	public function after()
	{
		if ($this->auto_render === TRUE)
		{
			$this->response->body($this->template->render());
		}

		parent::after();
	}

}
