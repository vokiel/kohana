<?php namespace Kohana\Session;

use Exception as Exception;
/**
 * @package    Kohana
 * @category   Exceptions
 * @author     Kohana Team
 * @copyright  (c) 2009-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Exception extends Exception {
	const SESSION_CORRUPT = 1;
}
