<?php namespace Kohana\OAuth2\Token;

class Authorize extends \Kohana\OAuth2\Token
{
	/**
	 * @var  string  code
	 */
	protected $code;

	/**
	 * @var  string  redirect_uri
	 */
	protected $redirect_uri;

	/**
	 * Sets the token, expiry, etc values.
	 *
	 * @param   array   token options
	 * @return  void
	 */
	public function __construct(array $options)
	{
		if ( ! isset($options['code']))
	    {
            throw new \Kohana\Exception('Required option not passed: code');
        }

        elseif ( ! isset($options['redirect_uri']))
        {
            throw new \Kohana\Exception('Required option not passed: redirect_uri');
        }
		
		$this->code = $options['code'];
		$this->redirect_uri = $options['redirect_uri'];
	}

	/**
	 * Returns the token key.
	 *
	 * @return  string
	 */
	public function __toString()
	{
		return (string) $this->code;
	}

} // End OAuth2_Token_Access
