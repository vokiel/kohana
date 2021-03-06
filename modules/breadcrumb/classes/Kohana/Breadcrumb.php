<?php namespace Kohana;

class Breadcrumb {

  	public $crumbview = 'breadcrumb';
  	public $crumbs = array();
  	public $countcrumbs;

	public function __construct($view = FALSE) 
	{
		if(!empty($empty))
		{
			$this->crumbview = $view;
		}
		$this->countcrumbs = 1;
		$this->crumbs = array( 0 => array('url'=>URL::base(),'crumb'=>__('breadcrumb.crumb'),'title'=>__('breadcrumb.title')));

	}

	public static function factory($view = FALSE)
	{
		return new Breadcrumb($view);

	}

	public function add($url, $crumb, $title = FALSE, $param = 1)
	{

		if($title === FALSE)
		{
			$title = $crumb;
		}

		if($param === 1)
		{
			$key = $this->countcrumbs-1;
			if($key === 0)
			{
				$url = $this->crumbs[$key]['url'].$url;
			}
			else{
				$url = $this->crumbs[$key]['url'].DIRECTORY_SEPARATOR.$url;
			}
		}
		else
		{
			if($param > 0)
			{
				$key = $param-1;
				$url = $this->crumbs[$key]['url'].DIRECTORY_SEPARATOR.$url;
			}
			else{
				$url = $this->crumbs[0]['url'].$url;
			}
		}
	
		$array = array('url'=>$url,'crumb'=>$crumb,'title'=>$title);
		array_push($this->crumbs, $array);
		$this->countcrumbs++;

		return $this;
	}

	public function render()
	{
		return View::factory($this->crumbview)->bind('crumbs',$this->crumbs)->bind('count',$this->countcrumbs)->render();
	}
}
