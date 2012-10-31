<?php namespace Controller;

class Doc extends \Controller\Index {

	public function menu()
	{
		$menu = array(
			array('slug'=>'index','title'=>'Początek z Hanariu'),
			array('slug'=>'bootstrap','title'=>'Ustawienia i konfiguracja'),
			array('slug'=>'namespace','title'=>'Przestrzenie nazw'),
			array('slug'=>'controller','title'=>'Kontroler'),
			array('slug'=>'model','title'=>'Model'),
			array('slug'=>'view','title'=>'Widok'),
			array('slug'=>'helper','title'=>'Helpery'),
			array('slug'=>'routing','title'=>'Routing'),
			array('slug'=>'database','title'=>'Baza danych'),
		);

		return $menu;
	}

	public function sub()
	{
		$this->ctitle = 'Dokumentacja';
		$this->csubtitle = 'Opis podstawowych funkcjonalności Hanariu';
	}
}
