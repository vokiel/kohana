<?php namespace Controller;

class Roadmap extends \Controller\Index {

	public function menu()
	{
		$menu = array(
			array('slug'=>'index','title'=>'Lista planowanych zmian'),
			array('slug'=>'bootstrap','title'=>'Lista planowanych modułów'),
		);

		return $menu;
	}

	public function sub()
	{
		$this->ctitle = 'Plan rozwoju';
		$this->csubtitle = 'Planowane zmiany, nowe moduły';
	}
}
