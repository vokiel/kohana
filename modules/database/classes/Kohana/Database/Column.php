<?php namespace Kohana\Database;

abstract class Column {
	
	/**
	 * Creates a new database column object driver with the specified details.
	 *
	 * @param	string	The column's datatype.
	 * @param	Database	The database object.
	 * @return	Database_Column
	 */
	public static function factory($datatype, $db = NULL)
	{
		if ($db === NULL OR ! $db instanceof \Kohana\Database)
		{
			$db = \Kohana\Database::instance();
		}
		
		$schema = $db->datatype($datatype);
		
		$class = '\\Kohana\\Database\\Column\\'.ucfirst($schema['type']);
		
		if (class_exists($class))
		{
			$obj = new $class($db, $schema);
			$obj->datatype = $datatype;
			
			return $obj;
		}
		else
		{
			throw new \Kohana\Exception('The given schema type :type is not supported by the current dbforge build.', array(
				':type'	=> $schema['type']
			));
		}
	}
	
	/**
	 * Returns the introspected column object if it exists, otherwise null.
	 * 
	 * @param	string	The name of the table
	 * @param	string	The name of the column
	 * @return	object|null
	 */
	public static function instance($table, $name)
	{
		if ($table = Table::instance($table))
		{
			$db = \Kohana\Database::instance();
			
			if ($column = $db->list_columns($table->name, $name))
			{
				$class = '\\Kohana\\Database\\Column\\'.ucfirst($column['type']);
				
				if (class_exists($class))
				{
					$column = new $class($db, $column);
				}
				else
				{
					throw new \Kohana\Exception('The given schema type :type is not supported by the current dbforge build.', array(
						':type'	=> $column['type']
					));
				}
			}
		}
		
		return NULL;
	}
	
	/**
	 * The name of the column.
	 * 
	 * @var	string
	 */
	public $name;
	
	/**
	 * The default value of the column.
	 * 
	 * @var	mixed
	 */
	public $default;
	
	/**
	 * Whether the column is nullable.
	 * 
	 * @var	bool
	 */
	public $nullable;
	
	/**
	 * The column's datatype.
	 * 
	 * @var	string
	 */
	public $datatype;
	
	/**
	 * The ordinal position of the column.
	 * 
	 * @var	int
	 */
	public $ordinal_position;
	
	/**
	 * 
	 * 
	 * @var unknown_type
	 */
	protected $_parameters;
	
	/**
	 * Whether the value is loaded or not.
	 * 
	 * @var	bool
	 */
	protected $_loaded = FALSE;
	
	/**
	 * The parent database object.
	 * 
	 * @var	Database
	 */
	protected $_db;
	
	/**
	 * The name of the column.
	 * 
	 * @param	Database	The parent database object.
	 * @param	array	The schema information.
	 * @return	void
	 */
	public function __construct($database, array $schema = NULL)
	{
		$this->_db = $database;
		
		if ($schema !== NULL)
		{
			$this->name = \Kohana\Arr::get($schema, 'column_name');
			$this->default = \Kohana\Arr::get($schema, 'column_default');
			$this->is_nullable = \Kohana\Arr::get($schema, 'is_nullable') === 'YES';
			$this->ordinal_position = \Kohana\Arr::get($schema, 'ordinal_position');
			$this->datatype = \Kohana\Arr::get($schema, 'data_type');
			
			$this->_load_schema($schema);
			
			$this->_loaded = TRUE;
		}
	}

	/**
	 * Returns whether the column is loaded from the database or not.
	 * 
	 * @return	bool
	 */
	public function loaded()
	{
		return $this->_loaded;
	}
	
	/**
	 * Sets or gets the datatype parameters.
	 * 
	 * @param	mixed	The parameters to set.
	 * @return	array
	 */
	public function parameters($set = NULL)
	{
		if ($set === NULL)
		{
			return $this->_parameters;
		}
		else
		{
			if ( ! is_array($set))
			{
				$set = array($set);
			}
			
			$this->_parameters = $set;
		}
	}
	
	/**
	 * Compiles the column into a SQL statement.
	 * 
	 * @param	Database	The database object.
	 * @return	string
	 */
	final public function compile($db = NULL)
	{
		return Query\Builder::compile_column($this, $db);
	}
	
	/**
	 * Returns the column's constraints.
	 * 
	 * @return	array
	 */
	final public function constraints()
	{
		$constraints = array();
		
		if ($this->nullable === FALSE)
		{
			$constraints[] = 'not null';
		}
		
		if ($this->default)
		{
			$constraints['default'] = $this->default;
		}
		
		return array_merge($constraints, $this->_constraints());
	}
	
	/**
	 * Cloned columns are not loaded.
	 * 
	 * @return	void
	 */
	public function __clone()
	{
		$this->_loaded = FALSE;
	}
	
	/**
	 * Loads the schema data for specific datatype properties.
	 * 
	 * @param	array	The schema information.
	 * @return	void
	 */
	abstract protected function _load_schema(array $schema);
	
	/**
	 * Compiles the column's datatype parameters and returns them as an array.
	 * 
	 * @return	array
	 */
	abstract protected function _constraints();
	
} // End Database_Column
