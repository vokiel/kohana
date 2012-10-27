<?php namespace Kohana\UTF8;

class Ucwords{

	public static function _ucfirst($str)
	{
		if (\Kohana\UTF8::is_ascii($str))
			return ucfirst($str);

		preg_match('/^(.?)(.*)$/us', $str, $matches);
		return \Kohana\UTF8::strtoupper($matches[1]).$matches[2];
	}

}
