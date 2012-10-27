<?php namespace Kohana\UTF8;

class Strcasecmp{

	public static function _strcasecmp($str1, $str2)
	{
		if (\Kohana\UTF8::is_ascii($str1) AND \Kohana\UTF8::is_ascii($str2))
			return strcasecmp($str1, $str2);

		$str1 = \Kohana\UTF8::strtolower($str1);
		$str2 = \Kohana\UTF8::strtolower($str2);
		return strcmp($str1, $str2);
	}

}
