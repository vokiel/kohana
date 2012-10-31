<?php namespace Controller;

class Roadmap extends \Controller\Index {


	// load config file
	public function menu()
	{
		$menu = array(
			array('slug'=>'index','title'=>'Lista planowanych zmian'),
			array('slug'=>'bootstrap','title'=>'Lista planowanych modułów'),
		);

		return $menu;
	}

	// load config file
	public function sub()
	{
		$this->ctitle = 'Plan rozwoju';
		$this->csubtitle = 'Planowane zmiany, nowe moduły';
	}
}
