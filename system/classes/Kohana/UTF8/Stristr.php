<?php namespace Kohana\UTF8;

class Stristr{

	public static function _stristr($str, $search)
	{
		if (\Kohana\UTF8::is_ascii($str) AND \Kohana\UTF8::is_ascii($search))
			return stristr($str, $search);

		if ($search == '')
			return $str;

		$str_lower = \Kohana\UTF8::strtolower($str);
		$search_lower = \Kohana\UTF8::strtolower($search);

		preg_match('/^(.*?)'.preg_quote($search_lower, '/').'/s', $str_lower, $matches);

		if (isset($matches[1]))
			return substr($str, strlen($matches[1]));

		return FALSE;
	}

}
