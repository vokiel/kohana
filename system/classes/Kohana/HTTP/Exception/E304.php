<?php namespace Kohana\HTTP\Exception;

class E304 extends Expected {

	/**
	 * @var   integer    HTTP 304 Not Modified
	 */
	protected $_code = 304;
	
}
