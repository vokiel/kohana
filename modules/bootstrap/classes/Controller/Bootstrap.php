<?php namespace Controller;

class Bootstrap extends \Kohana\Controller\Template {

	public $boostrap;
	public $template;
	public $base;
	public $baseurl;
	public $media;
	public $title;
	public $basetitle;
	public $controller;
	public $action;
	public $directory;
	public $navbar;
	public $header;
	public $content;
	public $leftbar;
	public $rightbar;
	public $sidebar;
	public $footer;
	public $breadcrumb;

	public $metas = array();
	public $links = array();
	public $styles = array();
	public $scripts = array();
	public $codes = array();

	public function before()
	{

		if ( ! $this->request->is_ajax() )
		{
			parent::before();

			if ($this->auto_render)
			{


			$this->controller = strtolower($this->request->controller());	
			$this->action = $this->request->action();
			$this->directory = $this->request->directory();
			$this->base = \Kohana\URL::base();

			$this->bootstrap = \Kohana\Kohana::$config->load('bootstrap');
			$this->basetitle =$this->bootstrap->title;
			$this->metas =$this->bootstrap->metas;


			$this->media = \Kohana\Route::get('media/media');
			$this->template = \Kohana\View::factory('bootstrap/template');
			$this->title = $this->basetitle;


			$this->template->styles = array(
				$this->media->uri(array('file' => 'bootstrap/css/bootstrap.min.css'))  => 'screen',
				$this->media->uri(array('file' => 'bootstrap/css/bootstrap-responsive.min.css'))  => 'screen',
				$this->media->uri(array('file' => 'bootstrap/css/prettify.css'))  => 'screen',
				$this->media->uri(array('file' => 'bootstrap/css/bootstrap-wysihtml5.css'))  => 'screen',
				$this->media->uri(array('file' => 'bootstrap/css/colorpicker.css'))  => 'screen',
				$this->media->uri(array('file' => 'bootstrap/css/datepicker.css'))  => 'screen',
				$this->media->uri(array('file' => 'bootstrap/css/timepicker.css'))  => 'screen',
				$this->media->uri(array('file' => 'bootstrap/css/wysiwyg-color.css'))  => 'screen',
				$this->media->uri(array('file' => 'bootstrap/css/validate.css'))  => 'screen',
			);

			$this->template->scripts = array(
				$this->media->uri(array('file' => 'bootstrap/js/html5.js')),
				$this->media->uri(array('file' => 'bootstrap/js/jquery-1.8.2.min.js')),
				$this->media->uri(array('file' => 'bootstrap/js/prettify.js')),
				$this->media->uri(array('file' => 'bootstrap/js/bootstrap.min.js')),
				$this->media->uri(array('file' => 'bootstrap/js/bootstrap-colorpicker.js')),
				$this->media->uri(array('file' => 'bootstrap/js/bootstrap-datepicker.js')),
				$this->media->uri(array('file' => 'bootstrap/js/bootstrap-timepicker.js')),
				$this->media->uri(array('file' => 'bootstrap/js/wysihtml5-0.3.0.min.js')),
				$this->media->uri(array('file' => 'bootstrap/js/bootstrap-wysihtml5.js')),
				$this->media->uri(array('file' => 'bootstrap/js/jquery.validate.min.js')),
				$this->media->uri(array('file' => 'bootstrap/js/init.js')),
			);


			$this->template->metas = array();
			$this->template->links = array();
			$this->template->codes = array();

			$this->template->title = $this->title;
			$this->template->navbar = '';
			$this->template->header = '';
			$this->template->content = \Kohana\View::factory('bootstrap/demo');;
			$this->template->leftbar = '';
			$this->template->rightbar = '';
			$this->template->sidebar = '';
			$this->template->footer = '';
			$this->template->breadcrumb = '';

			$this->links();
			$this->canonicallink();

			}
		}
	}

	public function links()
	{
		$links = array(
			'shortcut icon' => array(
				'rel'	=> 'shortcut icon',
				'href'	=> $this->base.$this->media->uri(array('file' => 'img/favicon.ico')),
			),
			'shortcut icon2' => array(
				'rel'	=> 'shortcut icon',
				'href'	=> $this->base.$this->media->uri(array('file' => 'img/favicon.ico')),
				'type'	=> 'image/x-icon',
			),
			'index' => array(
				'rel'	=> 'index',
				'href'	=> $this->base,
				'title'	=> $this->basetitle,
			),
		);
		$this->links = array_merge($this->links,$links);
	}

	public function canonicallink($canonical = FALSE){

			if(!$canonical)
			{
				$canonical = $this->title;
			}

			$links = array(
				'canonical' => array(
					'rel'	=> 'canonical',
					'href'	=> \Kohana\URL::site(\Kohana\Request::current()->uri()),
					'title'	=> $canonical,
				),
			);

			$this->links = array_merge($this->links, $links);
	}

	public function action_index()
	{

	}

	public function after()
	{
		if ( ! $this->request->is_ajax() )
		{
			if ($this->auto_render)
			{

				$this->template->codes = array_merge( $this->codes, $this->template->codes);
				$this->template->metas = array_merge( $this->metas, $this->template->metas);
				$this->template->links = array_merge( $this->links, $this->template->links);
				$this->template->scripts = array_merge( $this->scripts, $this->template->scripts);
				$this->template->styles = array_merge( $this->styles, $this->template->styles);

				$this->response->body($this->template);
				parent::after();

			}
		}
	}
}
