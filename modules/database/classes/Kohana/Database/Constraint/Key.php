<?php namespace Kohana\Database\Constraint;

class Key extends \Kohana\Database\Constraint {
	
	/**
	 * List of keys that make up the primary key.
	 * 
	 * @var	array
	 */
	protected $_keys;
	
	/**
	 * Initiates a new primary constraint object.
	 * 
	 * @param	array	The list of columns that make up the primary key.
	 * @return	void
	 */
	public function __construct(array $keys, $table)
	{
		$this->name = implode('_', $keys);
		
		$this->_keys = $keys;
	}
	
	public function compile(\Kohana\Database $db = NULL)
	{
		if ($db === NULL)
		{
			$db = \Kohana\Database::instance();
		}
		
		$key = implode(',', array_map(array($db, 'quote_identifier'), $this->_keys));
		return ' KEY '.$key.' ('.$key.')';
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
				->drop(\Kohana\DB::expr(''), 'primary key')
				->execute($db);
		}
		else
		{
			return \Kohana\DB::alter($table)
				->drop($this->name, 'constraint')
				->execute($db);
		}
	}
	
} // End Database_Constraint_Primary
