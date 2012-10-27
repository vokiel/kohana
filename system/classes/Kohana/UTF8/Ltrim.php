<?php namespace Kohana\UTF8;

class Ltrim{

	public static function _ltrim($str, $charlist = NULL)
	{
		if ($charlist === NULL)
			return ltrim($str);

		if (\Kohana\UTF8::is_ascii($charlist))
			return ltrim($str, $charlist);

		$charlist = preg_replace('#[-\[\]:\\\\^/]#', '\\\\$0', $charlist);

		return preg_replace('/^['.$charlist.']+/u', '', $str);
	}

}
