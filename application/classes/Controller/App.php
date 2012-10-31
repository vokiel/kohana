<?php namespace Controller;

class App extends \Controller\Index {

	public function menu()
	{
		$menu = array(
			array('slug'=>'index','title'=>'Hanariu (strona)'),
			array('slug'=>'riupress','title'=>'Riupress - blog'),
			array('slug'=>'filemon','title'=>'Filemon - koszyk zakupów'),
			array('slug'=>'adpress','title'=>'Adpress - system banerowy'),
			array('slug'=>'uke','title'=>'Uke CRM'),
		);

		return $menu;
	}

	public function sub()
	{
		$this->ctitle = 'Gotowe rozwiązania';
		$this->csubtitle = 'Projekty oparte w Hanariu';
	}

}
