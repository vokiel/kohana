<?php namespace Kohana\OAuth2;

abstract class Token {

	public static function factory($name = 'access', array $options = null)
	{
		$name = ucfirst(strtolower($name));

		$class = '\\Kohana\\OAuth2\\Token\\'.$name;

		return new $class($options);
	}

	public function __get($key)
	{
		return $this->$key;
	}

	public function __isset($key)
	{
		return isset($this->$key);
	}

}
