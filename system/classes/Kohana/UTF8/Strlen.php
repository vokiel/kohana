<?php namespace Kohana\UTF8;

class Strlen{

	public static function _strlen($str)
	{
		if (\Kohana\UTF8::is_ascii($str))
			return strlen($str);

		return strlen(utf8_decode($str));
	}

}
