<?php namespace Kohana;

class Analytics
{
	// Analytics instance
	protected static $_instance;

	/**
	 * Singleton pattern
	 *
	 * @return Auth
	 */
	public static function instance()
	{
		if ( ! isset(Analytics::$_instance))
		{
			// Load the configuration for this type
			$config = Kohana::$config->load('analytics');

			// Create a new session instance
			Analytics::$_instance = new Analytics($config);
		}
	
		return Analytics::$_instance;
	}

	protected $_config;
	protected $_gapi;

	/**
	 * Loads configuration options.
	 *
	 * @return  void
	 */
	public function __construct($config = array())
	{
		// Save the config in the object
		$this->_config = $config;
		
		// Load the GAPI http://code.google.com/p/gapi-google-analytics-php-interface/ library
		require Kohana::find_file('vendor', 'GAPI/gapi.class');
		
		$this->_gapi = new \gapi($this->_config['username'], $this->_config['password']);
		
		// Set the default start and end dates. Maybe take this into config?
		$this->start_date = date('Y-m-d', strtotime('1 month ago'));
		$this->end_date   = date('Y-m-d');
	}

    /**
     * Statistics per day
     * 
     * @param string $start_date
     * @param string $end_date
     * @param mixed $metrics
     * @return array
     */
	public function daily_visit_count($start_date = FALSE, $end_date = FALSE, $metrics = array('pageviews', 'visits'))
	{
		if ( ! $start_date)
		{
			$start_date = date('Y-m-d', strtotime('1 month ago'));
		}

		if ( ! $end_date)
		{
			$end_date = date('Y-m-d');
		}

		// Work out the size for the container needed to hold the results, else we get results missed!
        $days = floor((strtotime($end_date) - strtotime($start_date)) / Date::DAY) + 2;

		$results = $this->_gapi->requestReportData($this->_config['report_id'], array('date'), $metrics, NULL, NULL, $start_date, $end_date, 1, $days);

		$visits = array();
		foreach ($results as $r)
		{
            foreach ($metrics as $metric)
            {
                $visits[$r->getDate()][$metric] = $r->{'get'.ucwords($metric)}();
            }
		}
		ksort($visits);

		return $visits;
	}

    /**
     * Statistica per month
     * 
     * @param string $start_date
     * @param string $end_date
     * @param mixed $metrics
     * @return array
     */
	public function monthly_visit_count($start_date = FALSE, $end_date = FALSE, $metrics = array('pageviews', 'visits'))
	{
		if ( ! $start_date)
		{
			$start_date = date('Y-m-d', strtotime('first day of 6 months ago'));
		}
		
		if ( ! $end_date)
		{
			$end_date = date('Y-m-d', strtotime('last day of last month'));
		}

		// Work out the size for the container needed to hold the results, else we get results missed!
        $months = floor((strtotime($end_date) - strtotime($start_date)) / Date::MONTH) + 2;

		$results = $this->_gapi->requestReportData($this->_config['report_id'], array('month'), $metrics, array('-month'), NULL, $start_date, $end_date, 1, $months);

		$visits = array();
        foreach ($results as $r)
        {
            foreach ($metrics as $metric)
            {
                $visits[$r->getMonth()][$metric] = $r->{'get'.ucwords($metric)}();
            }
        }
		return $visits;
	}

    /**
     * Custom statistics
     * 
     * @param mixed $dimension
     * @param mixed $metrics
     * @param mixed $sort
     * @param mixed $max_results
     * @return array
     */
	public function query($dimension, array $metrics, $sort = NULL, $max_results = NULL)
	{
		if ( ! is_null($sort))
		{
			$sort = array($sort);
		}

		$results = $this->_gapi->requestReportData($this->_config['report_id'], array($dimension), $metrics, $sort, NULL, $this->start_date, $this->end_date, 1, $max_results);

		$data = array();
		foreach ($results as $r)
		{
            foreach ($metrics as $metric)
            {
			    $data[$r->{'get'.ucwords($dimension)}()][$metric] = $r->{'get'.ucwords($metric)}();
            }
		}

		return $data;
	}
}
