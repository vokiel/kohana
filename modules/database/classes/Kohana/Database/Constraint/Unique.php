<?php namespace Kohana\Database\Constraint;

class Unique extends \Kohana\Database\Constraint {
	
	/**
	 * The list of keys that constitutes the unique index.
	 * 
	 * @var array
	 */
	protected $_keys;
	
	/**
	 * Initiate a UNIQUE constraint.
	 *
	 * @param	array	The list of keys that constitude the unique constraint.
	 * @return	Database_Constraint_Unique	The constraint object.
	 */
	public function __construct($keys)
	{
		if ( ! is_array($keys))
		{
			$keys = array($keys);
		}
		
		$this->name = 'key_'.implode('_', $keys);
		
		$this->_keys = $keys;
	}
	
	public function compile(\Kohana\Database $db = NULL)
	{
		if ($db === NULL)
		{
			$db = \Kohana\Database::instance();
		}
		
		return 'CONSTRAINT '.$db->quote_identifier($this->name).' UNIQUE ('.
			implode(',', array_map(array($db, 'quote_identifier'), $this->_keys)).')';
	}
	
	public function drop($table, \Kohana\Database $db = NULL)
	{
		if ($db === NULL)
		{
			$db = \Kohana\Database::instance();
		}
		
		$this->compile($db);
		
		if ($db instanceof \Kohana\Database\MySQL)
		{
			return \Kohana\DB::alter($table)
				->drop($this->name, 'index')
				->execute($db);
		}
		else
		{
			return \Kohana\DB::alter($table)
				->drop($this->name, 'constraint')
				->execute($db);
		}
	}
	
} // End Database_Constraint_Unique
