<?php namespace Kohana;
/**
 * Wrapper for configuration arrays. Multiple configuration readers can be
 * attached to allow loading configuration from files, database, etc.
 *
 * Configuration directives cascade across config sources in the same way that 
 * files cascade across the filesystem.
 *
 * Directives from sources high in the sources list will override ones from those
 * below them.
 *
 * @package    Kohana
 * @category   Configuration
 * @author     Kohana Team
 * @copyright  (c) 2009-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Config {

	// Configuration readers
	protected $_sources = array();

	/**
	 * Load a configuration group. Searches all the config sources, merging all the 
	 * directives found into a single config group.  Any changes made to the config 
	 * in this group will be mirrored across all writable sources.  
	 *
	 *     $array = $config->load($name);
	 *
	 * See [Kohana_Config_Group] for more info
	 *
	 * @param   string  configuration group name
	 * @return  object  Kohana_Config_Group
	 * @throws  Kohana_Exception
	 */
	public function load($group)
	{

		if ($files = Kohana::find_file('config', $group, NULL, TRUE))
		{
			foreach ($files as $file)
			{
				// Merge each file to the configuration array
				$this->_sources = \Arr::merge($this->_sources, Kohana::load($file));
			}
		}

		if( ! count($this->_sources))
		{
			Error::handler('No configuration sources attached');
		}

		if (empty($group))
		{
			Error::handler("Need to specify a config group");
		}

		if ( ! is_string($group))
		{
			Error::handler("Config group must be a string");
		}

		// We search from the "lowest" source and work our way up
		$sources = array_reverse($this->_sources);

		$this->_groups[$group] = new \Config\Group($this, $group, $sources);

		if (isset($path))
		{
			return Arr::path($config, $path, NULL, '.');
		}
		$this->_sources = array();
		return $this->_groups[$group];
	}

}
