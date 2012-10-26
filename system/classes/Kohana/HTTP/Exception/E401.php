<?php namespace Kohana\HTTP\Exception;

class E401 extends Expected {

	/**
	 * @var   integer    HTTP 401 Unauthorized
	 */
	protected $_code = 401;

	/**
	 * Specifies the WWW-Authenticate challenge.
	 * 
	 * @param  string  $challenge  WWW-Authenticate challenge (eg `Basic realm="Control Panel"`)
	 */
	public function authenticate($challenge = NULL)
	{
		if ($challenge === NULL)
			return $this->headers('www-authenticate');
		
		$this->headers('www-authenticate', $challenge);

		return $this;
	}

	/**
	 * Validate this exception contains everything needed to continue.
	 * 
	 * @throws Kohana_Exception
	 * @return bool
	 */
	public function check()
	{
		if ($this->headers('www-authenticate') === NULL)
			throw new \Kohana\Exception('A \'www-authenticate\' header must be specified for a HTTP 401 Unauthorized');

		return TRUE;
	}
}
