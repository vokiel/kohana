<?php namespace Kohana\UTF8;

class Strpos{

	public static function _strpos($str, $search, $offset = 0)
	{
		$offset = (int) $offset;

		if (\Kohana\UTF8::is_ascii($str) AND \Kohana\UTF8::is_ascii($search))
			return strpos($str, $search, $offset);

		if ($offset == 0)
		{
			$array = explode($search, $str, 2);
			return isset($array[1]) ? \Kohana\UTF8::strlen($array[0]) : FALSE;
		}

		$str = \Kohana\UTF8::substr($str, $offset);
		$pos = \Kohana\UTF8::strpos($str, $search);
		return ($pos === FALSE) ? FALSE : ($pos + $offset);
	}

}
