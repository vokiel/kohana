<?php namespace Kohana\OAuth2;

class OAuth2 {

	public static function provider($name, array $options = NULL)
	{
		$name = ucfirst(strtolower($name));

		$class = '\\Kohana\\OAuth2\\Provider\\'.$name;

		return new $class($options);
	}

}
