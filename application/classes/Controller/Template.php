<?php namespace Controller;

use Kohana;
use Kohana\View as View; 
use Kohana\Debug as Debug; 
use Kohana\Route as Route; 

class Template extends \Kohana\Controller\Template {

	public $auto_render = TRUE;
	public $template;
	public $media;
	public $title;
	public $ctitle,$csubtitle;
	public $controller,$action,$sub,$page;

	public function before()
	{
		$this->controller = strtolower($this->request->controller());	
		$this->action = $this->request->action();
		$this->sub = $this->request->param('sub');
		$this->page = $this->request->param('page');

		$this->media = Route::get('media/media');
		$this->template = View::factory('index');
		$this->title = 'Hanariu';


		$this->template->styles = array(
			$this->media->uri(array('file' => 'css/bootstrap.css'))  => 'screen',
			$this->media->uri(array('file' => 'css/bootstrap-responsive.css'))  => 'screen',
			$this->media->uri(array('file' => 'css/docs.css'))  => 'screen',
			$this->media->uri(array('file' => 'css/prettify.css'))  => 'screen',
		);

		$this->template->scripts = array(
			$this->media->uri(array('file' => 'js/html5.js')),
			$this->media->uri(array('file' => 'js/jquery-1.8.2.min.js')),
			$this->media->uri(array('file' => 'js/prettify.js')),
			$this->media->uri(array('file' => 'js/bootstrap.min.js')),
			$this->media->uri(array('file' => 'js/application.js')),
		);

		$this->template->links = array(
			'shortcut icon' => array(
				'rel'	=> 'shortcut icon',
				'href'	=> $this->media->uri(array('file' => 'img/favicon.ico')),
			),
			'shortcut icon2' => array(
				'rel'	=> 'shortcut icon',
				'href'	=> $this->media->uri(array('file' => 'img/favicon.ico')),
				'type'	=> 'image/x-icon',
			),
		);

		$mainmenu = $this->mainmenu();
		$this->template->navbar = View::factory('navbar')->bind('active',$this->controller)->bind('menu',$mainmenu);

		if($this->controller === 'index')
		{
			$header = View::factory('header');
			$leftbar = '';
			$this->title = $this->title.' - Strona główna';
			$content = View::factory($this->controller.DIRECTORY_SEPARATOR.$this->sub);
		}
		else{
			$menu = $this->menu();
			$text = $this->sub();
			$text = $this->text();
			$this->title = $this->title.' - '.$this->ctitle;

			$header = View::factory('subheader')->bind('ctitle',$this->ctitle)->bind('csubtitle',$this->csubtitle);
			$leftbar = View::factory('leftbar')->bind('controller',$this->controller)->bind('sub',$this->sub)->bind('menu',$menu);
			$content = View::factory('main')->bind('menu',$leftbar)->bind('text',$text);
		}
		$this->template->title = $this->title;
		$this->template->header = $header ;
		$this->template->content = $content;
		$this->template->footer = View::factory('footer');

	}

	public function mainmenu()
	{
		$menu = array(
			array('slug'=>'index','title'=>'Strona główna'),
			array('slug'=>'doc','title'=>'Dokumentacja'),
			array('slug'=>'tutorial','title'=>'Tutoriale i wskazówki'),
			array('slug'=>'modul','title'=>'Moduły i dodatki'),
			array('slug'=>'app','title'=>'Gotowe rozwiązania'),
			array('slug'=>'roadmap','title'=>'Plan rozwoju'),
		);

		return $menu;
	}
	public function text()
	{
		return '';
	}

	public function after()
	{
		parent::after();
		$this->response->body($this->template);

	}
}
