<?php namespace Kohana;


class Error extends \Exception {

	public static function handler($msg, $values = array(), $code = 404, $view = false)
	{


			if (Request::$current !== NULL AND Request::current()->is_ajax() === TRUE)
			{
				// Just display the text of the exception
				echo "\n{".__($msg,$values)."}\n";

				exit(1);
			}
			$view = 'error';
			if(!empty($view)){
				$view = $view;
			}
			// Start an output buffer
			ob_start();

			// Include the exception HTML
			if ($view_file = Kohana::find_file('views', 'error/'.$view))
			{
				include $view_file;
			}

			// Display the contents of the output buffer
			echo ob_get_clean();

			exit(1);

	}

} // End Error
