<?php namespace Controller;

class Tutorial extends \Controller\Index {

	public function menu()
	{
		$menu = array(
			array('slug'=>'index','title'=>'Filozofia pracy'),
			array('slug'=>'templates','title'=>'System szablonów'),
			array('slug'=>'themes','title'=>'Tworzenie skórek'),
			array('slug'=>'modules','title'=>'Tworzenie modułów'),
			array('slug'=>'libs','title'=>'Praca z bibliotekami'),
			array('slug'=>'models','title'=>'Praca z modelem'),
			array('slug'=>'benchs','title'=>'Wydajność głupcze!'),
		);

		return $menu;
	}

	public function sub()
	{
		$this->ctitle = 'Tutoriale i wskazówki';
		$this->csubtitle = 'Dobre rady i wskazówki jak pracować z Hanariu';
	}
}
