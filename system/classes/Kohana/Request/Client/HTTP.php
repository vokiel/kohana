<?php namespace Kohana\Request\Client;
/**
 * [Request_Client_External] HTTP driver performs external requests using the
 * php-http extention. To use this driver, ensure the following is completed
 * before executing an external request- ideally in the application bootstrap.
 * 
 * @example
 * 
 *       // In application bootstrap
 *       Request_Client_External::$client = 'Request_Client_HTTP';
 * 
 * @package    Kohana
 * @category   Base
 * @author     Kohana Team
 * @copyright  (c) 2008-2012 Kohana Team
 * @license    http://kohanaframework.org/license
 * @uses       [PECL HTTP](http://php.net/manual/en/book.http.php)
 */
class HTTP extends External {

	/**
	 * Creates a new `Request_Client` object,
	 * allows for dependency injection.
	 *
	 * @param   array    $params Params
	 * @throws  Request_Exception
	 */
	public function __construct(array $params = array())
	{
		// Check that PECL HTTP supports requests
		if ( ! http_support(HTTP_SUPPORT_REQUESTS))
		{
			throw new \Kohana\Exception('Need HTTP request support!');
		}

		// Carry on
		parent::__construct($params);
	}

	/**
	 * @var     array     curl options
	 * @link    http://www.php.net/manual/function.curl-setopt
	 */
	protected $_options = array();

	/**
	 * Sends the HTTP message [Request] to a remote server and processes
	 * the response.
	 *
	 * @param   Request   $request  request to send
	 * @param   Response  $request  response to send
	 * @return  Response
	 */
	public function _send_message(\Kohana\Request $request, \Kohana\Response $response)
	{
		$http_method_mapping = array(
			\Kohana\HTTP\Request::GET     => \HTTPRequest::METH_GET,
			\Kohana\HTTP\Request::HEAD    => \HTTPRequest::METH_HEAD,
			\Kohana\HTTP\Request::POST    => \HTTPRequest::METH_POST,
			\Kohana\HTTP\Request::PUT     => \HTTPRequest::METH_PUT,
			\Kohana\HTTP\Request::DELETE  => \HTTPRequest::METH_DELETE,
			\Kohana\HTTP\Request::OPTIONS => \HTTPRequest::METH_OPTIONS,
			\Kohana\HTTP\Request::TRACE   => \HTTPRequest::METH_TRACE,
			\Kohana\HTTP\Request::CONNECT => \HTTPRequest::METH_CONNECT,
		);

		// Create an http request object
		$http_request = new \HTTPRequest($request->uri(), $http_method_mapping[$request->method()]);

		if ($this->_options)
		{
			// Set custom options
			$http_request->setOptions($this->_options);
		}

		// Set headers
		$http_request->setHeaders($request->headers()->getArrayCopy());

		// Set cookies
		$http_request->setCookies($request->cookie());

		// Set query data (?foo=bar&bar=foo)
		$http_request->setQueryData($request->query());

		// Set the body
		if ($request->method() == \Kohana\HTTP\Request::PUT)
		{
			$http_request->addPutData($request->body());
		}
		else
		{
			$http_request->setBody($request->body());
		}

		try
		{
			$http_request->send();
		}
		catch (\HTTPRequestException $e)
		{
			throw new \Kohana\Exception($e->getMessage());
		}
		catch (\HTTPMalformedHeaderException $e)
		{
			throw new \Kohana\Exception($e->getMessage());
		}
		catch (\HTTPEncodingException $e)
		{
			throw new \Kohana\Exception($e->getMessage());
		}

		// Build the response
		$response->status($http_request->getResponseCode())
			->headers($http_request->getResponseHeader())
			->cookie($http_request->getResponseCookies())
			->body($http_request->getResponseBody());

		return $response;
	}

} // End Kohana_Request_Client_HTTP
