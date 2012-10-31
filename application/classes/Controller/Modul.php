<?php namespace Controller;

class Modul extends \Controller\Index {


	// load config file
	public function menu()
	{
		$menu = array(
			array('slug'=>'index','title'=>'Informacja o modułach'),
			array('slug'=>'cache','title'=>'Cache'),
			array('slug'=>'database','title'=>'Database'),
			array('slug'=>'feed','title'=>'Feed'),
			array('slug'=>'image','title'=>'Image'),
			array('slug'=>'pagination','title'=>'Pagination'),
			array('slug'=>'markdown','title'=>'Markdown'),
			array('slug'=>'theme','title'=>'Theme'),
			array('slug'=>'sitemap','title'=>'Sitemap'),
			array('slug'=>'breadcrumb','title'=>'Breadcrumb'),
			array('slug'=>'simpleauth','title'=>'Simple Auth'),
			array('slug'=>'profilertoolbar','title'=>'Profilertoolbar'),
			array('slug'=>'kostache','title'=>'Kostache'),
			array('slug'=>'analitics','title'=>'Google analitics'),
			array('slug'=>'riudb','title'=>'Riu DB'),
			array('slug'=>'menu','title'=>'Menu generator'),
			array('slug'=>'swiftmailer','title'=>'Swift Mailer'),
			array('slug'=>'bootstrap','title'=>'Bootstrap template'),
			array('slug'=>'markitup','title'=>'Markitup editor'),
			array('slug'=>'wysibb','title'=>'WysiBB editor'),
			array('slug'=>'oauth2','title'=>'OAuth2 client'),
		);

		return $menu;
	}

	// load config file
	public function sub()
	{
		$this->ctitle = 'Moduły i dodatki';
		$this->csubtitle = 'Moduły i dodatki zintegrowane z Hanariu';
	}
}
