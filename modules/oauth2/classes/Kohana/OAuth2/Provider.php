<?php namespace Kohana\OAuth2;

abstract class Provider
{

	public $name;
	public $uid_key = 'uid';
	public $callback;
	protected $params = array();
	protected $method = 'GET';
	protected $scope;
	protected $scope_seperator = ',';

	public function __construct(array $options = array())
	{
		if ( ! $this->name)
		{
			$this->name = strtolower(substr(get_class($this), strlen('\\Kohana\\OAuth2\\Provider\\')));
		}

		if (empty($options['id']))
		{
			throw new \Kohana\Exception('Required option not provided: id');
		}

		$this->client_id = $options['id'];
		
		isset($options['callback']) and $this->callback = $options['callback'];
		isset($options['secret']) and $this->client_secret = $options['secret'];
		isset($options['scope']) and $this->scope = $options['scope'];
		
		$this->redirect_uri = \Kohana\URL::site(\Kohana\Request::current()->uri());
	}

	public function __get($key)
	{
		return $this->$key;
	}


	abstract public function url_authorize();

	abstract public function url_access_token();

	public function authorize($options = array())
	{
		$state = md5(uniqid(rand(), TRUE));
		\Kohana\Session::instance()->set('state', $state);

		$params = array(
			'client_id' 		=> $this->client_id,
			'redirect_uri' 		=> isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri,
			'state' 			=> $state,
			'scope'				=> is_array($this->scope) ? implode($this->scope_seperator, $this->scope) : $this->scope,
			'response_type' 	=> 'code',
			//'approval_prompt'   => 'force' // - google force-recheck
		);
		
		\Kohana\Request::current()->redirect($this->url_authorize().'?'.http_build_query($params));
	}

	public function access($code, $options = array())
	{
		$params = array(
			'client_id' 	=> $this->client_id,
			'client_secret' => $this->client_secret,
			'grant_type' 	=> isset($options['grant_type']) ? $options['grant_type'] : 'authorization_code',
		);

		switch ($params['grant_type'])
		{
			case 'authorization_code':
				$params['code'] = $code;
				$params['redirect_uri'] = isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri;
			break;

			case 'refresh_token':
				$params['refresh_token'] = $code;
			break;
		}

		$response = null;	
		$url = $this->url_access_token();

		switch ($this->method)
		{
			case 'GET':

				// Need to switch to Request library, but need to test it on one that works
				$url .= '?'.http_build_query($params);
				$response = file_get_contents($url);

				parse_str($response, $return);

			break;

			case 'POST':

				$opts = array(
					'http' => array(
						'method'  => 'POST',
						'header'  => 'Content-type: application/x-www-form-urlencoded',
						'content' => http_build_query($params),
					)
				);

				$_default_opts = stream_context_get_params(stream_context_get_default());
				$context = stream_context_create(array_merge_recursive($_default_opts['options'], $opts));
				$response = file_get_contents($url, false, $context);

				$return = json_decode($response, true);

			break;

			default:
				throw new \Kohana\Exception("Method '{$this->method}' must be either GET or POST");
		}

		if ( ! empty($return['error']))
		{
			throw new \Kohana\Exception($return);
		}
		
		switch ($params['grant_type'])
		{
			case 'authorization_code':
				return \Kohana\OAuth2\Token::factory('access', $return);
			break;

			case 'refresh_token':
				return \Kohana\OAuth2\Token::factory('refresh', $return);
			break;
		}
		
	}

}
