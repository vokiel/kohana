<?php namespace Kohana\UTF8;

class Trim{

	public static function _trim($str, $charlist = NULL)
	{
		if ($charlist === NULL)
			return trim($str);

		return \Kohana\UTF8::ltrim(\Kohana\UTF8::rtrim($str, $charlist), $charlist);
	}

}
