<?php namespace Controller;

class Modul extends \Controller\Index {

	public function action_index()
	{
		if($this->sub === 'index')
		{
			$view = \Kohana\View::factory('starter/modules')->bind('menu',$this->menu);
			$this->text = $view;
		}
	}

	public function sub()
	{
		$this->ctitle = 'Moduły i dodatki';
		$this->csubtitle = 'Moduły i dodatki zintegrowane z Hanariu';
	}
}
