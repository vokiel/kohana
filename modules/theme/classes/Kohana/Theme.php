<?php namespace Kohana;

class Theme extends \Kohana\View {

	protected $_theme;

	public function __construct($file = NULL, array $data = NULL)
	{

        $dirs = explode('.', $file);
        $count = count($dirs);

        if($count === 1){

            	$file = $file;
            	$this->_theme = Session::instance()->get('theme');

		if(empty($this->_theme)){
		
		$this->_theme = Kohana::$config->load('theme')->theme;
		Session::instance()->set('theme',$this->_theme);

		}

        }
        else{
            list($theme, $file) = $dirs;
	            if (is_dir(THEMEPATH.DIRECTORY_SEPARATOR.$theme))
	            {
		            $this->_theme = $theme;
	            }
	            else{
		           $this->_file = Kohana::find_file('views', 'theme/themeempty');
	            }
        }

		if ($file !== NULL)
		{
			$this->set_filename($file);
		}

		if ( $data !== NULL)
		{
			// Add the values to the current data
			$this->_data = $data + $this->_data;

		}

	}

	public static function factory($file = NULL, array $data = NULL)
	{
		return new Theme($file, $data);
	}

	/**
	 * Sets the view filename from theme.
	 */
	public function set_filename($file)
	{

	if (is_file(THEMEPATH.DIRECTORY_SEPARATOR.$this->_theme.DIRECTORY_SEPARATOR.$file.EXT))
	{
		$found = THEMEPATH.DIRECTORY_SEPARATOR.$this->_theme.DIRECTORY_SEPARATOR.$file.EXT;
	}
	else{
		$path = Kohana::find_file('views', $file);
		if (($path) === FALSE)
		{
			$found = Kohana::find_file('views', 'theme/themeemptyview');
		}
		else{
			$found = $path;
		}
	}
		// Store the file path locally
        	if(empty($this->_file)){ $this->_file = $found; }

		return $this;
	}

	public static function set_themescript($files,$themes,$theme)
	{
	
		$scripts = array();
		foreach($files as $f){
			$scripts[] = $themes->uri(array('file' => $theme.DIRECTORY_SEPARATOR.$f));
		}
		return $scripts;

	}

	public static function set_themestyle($files,$themes,$theme)
	{
	
		$styles = array();
		foreach($files as $f=>$type){
			$styles[$themes->uri(array('file' => $theme.DIRECTORY_SEPARATOR.$f))] = $type;
		}
		return $styles;

	}

	public static function set_modulescript($files,$media)
	{
	
		$scripts = array();
		foreach($files as $f){
			$scripts[] = $media->uri(array('file' => $f));
		}
		return $scripts;

	}

	public static function set_modulestyle($files,$media)
	{
	
		$styles = array();
		foreach($files as $f=>$type){
			$styles[] = array('file' => $media->uri(array('file' => $f)), 'type' => $type);
		}
		return $styles;

	}
}

