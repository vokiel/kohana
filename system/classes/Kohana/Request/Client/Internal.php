<?php namespace Kohana\Request\Client;
/**
 * Request Client for internal execution
 *
 * @package    Kohana
 * @category   Base
 * @author     Kohana Team
 * @copyright  (c) 2008-2012 Kohana Team
 * @license    http://kohanaframework.org/license
 * @since      3.1.0
 */
class Internal extends \Kohana\Request\Client {

	/**
	 * @var    array
	 */
	protected $_previous_environment;

	/**
	 * Processes the request, executing the controller action that handles this
	 * request, determined by the [Route].
	 *
	 *     $request->execute();
	 *
	 * @param   Request $request
	 * @return  Response
	 * @throws  Kohana_Exception
	 * @uses    [Kohana::$profiling]
	 * @uses    [Profiler]
	 */
	public function execute_request(\Kohana\Request $request, \Kohana\Response $response)
	{
		// Create the class prefix
		$prefix = 'Controller\\';

		// Directory
		$directory = $request->directory();

		// Controller
		$controller = $request->controller();

		if ($directory)
		{
			// Add the directory name to the class prefix
			$prefix .= str_replace(array('\\', '/'), '_', trim($directory, '/')).'_';
		}

		if (\Kohana\Kohana::$profiling)
		{
			// Set the benchmark name
			$benchmark = '"'.$request->uri().'"';

			if ($request !== \Kohana\Request::$initial AND \Kohana\Request::$current)
			{
				// Add the parent request uri
				$benchmark .= ' « "'.\Kohana\Request::$current->uri().'"';
			}

			// Start benchmarking
			$benchmark = \Kohana\Profiler::start('Requests', $benchmark);
		}

		// Store the currently active request
		$previous = \Kohana\Request::$current;

		// Change the current request to this request
		\Kohana\Request::$current = $request;

		// Is this the initial request
		$initial_request = ($request === \Kohana\Request::$initial);

		try
		{
			if ( ! class_exists($prefix.$controller))
			{
				throw \Kohana\HTTP\Exception::factory(404,
					'The requested URL :uri was not found on this server.',
					array(':uri' => $request->uri())
				)->request($request);
			}

			// Load the controller using reflection
			$class = new \ReflectionClass($prefix.$controller);

			if ($class->isAbstract())
			{
				throw new \Kohana\Exception(
					'Cannot create instances of abstract :controller',
					array(':controller' => $prefix.$controller)
				);
			}

			// Create a new instance of the controller
			$controller = $class->newInstance($request, $response);

			// Run the controller's execute() method
			$response = $class->getMethod('execute')->invoke($controller);

			if ( ! $response instanceof \Kohana\Response)
			{
				// Controller failed to return a Response.
				throw new \Kohana\Exception('Controller failed to return a Response');
			}
		}
		catch (\Kohana\HTTP\Exception $e)
		{
			// Get the response via the Exception
			$response = $e->get_response();
		}
		catch (\Exception $e)
		{
			// Generate an appropriate Response object
			$response = \Kohana\Exception::_handler($e);
		}

		// Restore the previous request
		\Kohana\Request::$current = $previous;

		if (isset($benchmark))
		{
			// Stop the benchmark
			\Kohana\Profiler::stop($benchmark);
		}

		// Return the response
		return $response;
	}
} // End Kohana_Request_Client_Internal
