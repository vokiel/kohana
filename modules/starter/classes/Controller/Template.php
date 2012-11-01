<?php namespace Controller;

use Kohana;
use Kohana\View as View; 
use Kohana\Debug as Debug; 
use Kohana\Route as Route; 
use Kohana\URL as URL; 

class Template extends \Kohana\Controller\Template {

	public $auto_render = TRUE;
	public $template;
	public $media;
	public $title;
	public $ctitle,$csubtitle;
	public $controller,$action,$sub,$page,$menu,$text,$header,$content,$leftbar,$footer;

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
				'href'	=> URL::base().$this->media->uri(array('file' => 'img/favicon.ico')),
			),
			'shortcut icon2' => array(
				'rel'	=> 'shortcut icon',
				'href'	=> URL::base().$this->media->uri(array('file' => 'img/favicon.ico')),
				'type'	=> 'image/x-icon',
			),
		);

		$mainmenu = $this->mainmenu();
		$this->template->navbar = View::factory('navbar')->bind('active',$this->controller)->bind('menu',$mainmenu);

		if($this->controller === 'index')
		{
			$this->header = View::factory('header');
			$this->leftbar = '';
			$this->title = $this->title.' - Strona główna';
			$this->content = View::factory($this->controller.DIRECTORY_SEPARATOR.$this->sub);
		}
		else{
			$this->menu();
			$this->sub();
			$this->text();
			$this->title = $this->title.' - '.$this->ctitle;

			$this->header = View::factory('subheader')->bind('ctitle',$this->ctitle)->bind('csubtitle',$this->csubtitle);
			$this->leftbar = View::factory('leftbar')->bind('controller',$this->controller)->bind('sub',$this->sub)->bind('menu',$this->menu)->bind('page',$this->page);
			$this->content = View::factory('main')->bind('menu',$this->leftbar)->bind('text',$this->text);
		}
		$this->template->title = $this->title;
		$this->template->header = $this->header;
		$this->template->content = $this->content;
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

	public function menu()
	{
		$group = $this->controller;
		$this->menu = Kohana::$config->load('guide')->$group;
	}

	public function text()
	{
		$file = $this->sub;
		if(!empty($this->page))
		{
			$file = $this->sub.'.'.$this->page;
		}

		$file = Kohana::find_file('guide', $this->controller.DIRECTORY_SEPARATOR.$file, 'md');
		if(!empty($file))
		{
			$this->text = \Kohana\Markdown::parse(file_get_contents($file));
		}
		else
		{
			$this->text = '';
		}

	}

	public function after()
	{
		parent::after();
		$this->response->body($this->template);

	}
}
