<?php namespace Kohana\Database;

class Table {
	
	/**
	 * Retrieves an existing instance of a table from the database. Returns NULL if no table is found.
	 * 
	 * @param	string	The name of the table.
	 * @param	Database	The parent database object.
	 * @return	Database_Table
	 */
	public static function instance($name, \Kohana\Database $db = NULL)
	{
		if ($db === NULL)
		{
			$db = \Kohana\Database::instance();
		}
		
		$schema = $db->list_tables($name);
		
		if ( ! empty($schema))
		{
			return new self($name, $db, $schema);
		}
		
		return NULL;
	}
	
	/**
	 * Creates a new instance of a database table.
	 * 
	 * @param	string	The name of the table.
	 * @param	Database	The parent database object.
	 * @return	Database_Table
	 */
	public static function factory($name, \Kohana\Database $db = NULL)
	{
		if ($db === NULL)
		{
			$db = \Kohana\Database::instance();
		}
		
		return new self($name, $db);
	}
	
	/**
	 * The name of the table.
	 * 
	 * @var string
	 */
	public $name;
	
	/**
	 * The list of columns.
	 * 
	 * @var	array
	 */
	protected $_columns = array();
	
	/**
	 * The list of options.
	 * 
	 * @var	array
	 */
	protected $_options = array();
	
	/**
	 * The list of constraints.
	 * 
	 * @var	array
	 */
	protected $_constraints = array();
	
	/**
	 * Whether the table is loaded or not.
	 * 
	 * @var bool
	 */
	protected $_loaded;
	
	/**
	 * The parent database object.
	 * 
	 * @var	Database
	 */
	protected $_db;
	
	/**
	 * Creates a new table object.
	 *
	 * @param   string   The name of the table.
	 * @param	Database	The parent database object.
	 * @param	array	The schema array if loaded from the database.
	 * @return  void
	 */
	public function __construct($name, $db, array $schema = NULL)
	{
		$this->name = $name;
		$this->_db = $db;
		$this->_loaded = $schema !== NULL;
	}
	
	/**
	 * Whether the table exists in the database or not.
	 * 
	 * @return bool
	 */
	public function loaded()
	{
		return $this->_loaded;
	}
	
	/**
	 * Lists requested or all constraints associated with the table.
	 *
	 * @return  array|Database_Constraint	The list of all the columns
	 */
	public function constraints($name = NULL)
	{
		if ($name === NULL)
		{
			return $this->_constraints;
		}
		else
		{
			return $this->_constraints[$name];
		}
	}
	
	/**
	 * Retrieves an all or an existing table option.
	 *
	 * @param	string	The keyword which the option was defined with, if you're looking for something specific.
	 * @return  array
	 */
	public function options($key = NULL)
	{
		if ($key === NULL)
		{
			return $this->_options;
		}
		else
		{
			return $this->_options[$key];
		}
	}
	
	/**
	 * Returns the column requested or all columns within the table.
	 *
	 * @param	string	The column you want to return, if there is only one.
	 * @return  array|Database_Table_Column
	 */
	public function columns($like = NULL)
	{
		if ($this->_loaded)
		{
			if ($name !== NULL)
			{
				return Column::instance($this->name, $name);
			}
			
			$columns = $this->_db->list_columns($this->name);
			
			foreach ($columns as $name => $schema)
			{
				$this->_columns[$column] = 
					Column::instance($this->name, $name);
			}
		}
		else
		{
			return $this->_columns;
		}
	}
	
	/**
	 * Adds a column to the table. If the table is loaded then the action will be commited to the database.
	 *
	 * @param	Database_Column	The database column.
	 * @return  Database_Table
	 */
	public function add_column(array $column)
	{
		if(!array_key_exists('type', $column) or !array_key_exists('name', $column))
		{
			throw new \Kohana\Exception('Column need to get name and type.');
		}
		else{
			$c = \Kohana\Database\Column::factory($column['type']);
			foreach ($column as $key => $val)
			{
				$c->$key = $val;
			}
			$this->_columns[$column['name']] = $c;
		}

		return $this;
	}
	
	/**
	 * Adds a constraint to the table.
	 *
	 * @param	Database_Constraint	The constraint object.
	 * @return  Database_Table
	 */
	public function add_constraint($type, $val)
	{
		switch ($type)
		{
			case 'check':
				list($column, $operator, $value) = $val;
				$c = \Kohana\Database\Constraint::check($column, $operator, $value);
			break;

			case 'primary_key':
				$c = \Kohana\Database\Constraint::primary_key(array($val),$this->name);
			break;

			case 'key':
				$c = \Kohana\Database\Constraint::key(array($val),$this->name);
			break;

			case 'foreign_key':
				list($key, $reft, $refc) = $val;
				$c = \Kohana\Database\Constraint::foreign_key($key,$this->name)
						->references($reft, $refc)
						->on_update('cascade')
						->on_delete('cascade');
			break;
		}

		if(!empty($c->name))
		{
			$this->_constraints[$c->name] = $c;
		}

		
		return $this;
	}
	
	/**
	 * Adds a table option.
	 * 
	 * Table options are appended to the end of the create statement, typically in MySQL here you would set
	 * the database engine, auto_increment offset, comments etc. Consult your database documentation for
	 * more information.
	 * 
	 * On comilation a typical output would be; KEYWORD=`value` or if value is not set; KEYWORD
	 * 
	 * @see http://dev.mysql.com/doc/refman/5.1/en/create-table.html
	 *
	 * @param	string	The keyword of the option.
	 * @param	string	The value associated with the keyword. This is completely optional depending on your needs.
	 * @return  Database_Table
	 */
	public function add_option($key, $value = NULL)
	{
		if ($value === NULL)
		{
			$this->_options[] = $key;
		}
		else
		{
			$this->_options[$key] = $value;
		}
		
		return $this;
	}
	
	/**
	 * Creates the table.
	 * 
	 * @return 	Database_Table
	 */
	public function create()
	{
		$this->_loaded = TRUE;
		
		\Kohana\DB::create($this->name)
			->columns($this->_columns)
			->constraints($this->_constraints)
			->options($this->_options)
			->execute($this->_db);
			
		return $this;
	}
	
	/**
	 * Cloned tables are not loaded.
	 * 
	 * @return	void
	 */
	public function __clone()
	{
		$this->_loaded = FALSE;
	}
	
} // End Database_Table
