<?php namespace Kohana\Database\Constraint;

class Check extends \Kohana\Database\Constraint {
	
	/**
	 * An associated array of checks done by this constraint
	 * 
	 * @var array
	 */
	protected $_checks;
	
	/**
	 * Initializes a new check constraint object.
	 * 
	 * @param	string	The name of the column to perform the statement on.
	 * @param	string	The opertor to compare the value with.
	 * @param	mixed	The value to compare the column with via the operator.
	 * @return	void
	 */
	public function __construct($column, $operator, $value)
	{
		$this->name = 'ck_'.$column;
		
		$this->_checks[] = array(
			$column,
			$operator,
			$value
		);
	}
	
	/**
	 * Adds a check statement using the AND keyword.
	 *
	 * @param	string	The name of the column to perform the statement on.
	 * @param	string	The opertor to compare the value with.
	 * @param	mixed	The value to compare the column with via the operator.
	 * @return	Database_Constraint_Check
	 */
	public function check_and($column, $operator, $value)
	{
		$this->_add_rule($column, $operator, $value, 'AND');
		
		return $this;
	}
	
	/**
	 * Adds a check statement using the OR keyword.
	 *
	 * @param	string	The name of the column to perform the statement on.
	 * @param	string	The opertor to compare the value with.
	 * @param	mixed	The value to compare the column with via the operator.
	 * @return	Database_Constraint_Check
	 */
	public function check_or($column, $operator, $value)
	{
		$this->_add_rule($column, $operator, $value, 'OR');
		
		return $this;
	}
	
	public function compile(\Kohana\Database $db = NULL)
	{
		if ($db === NULL)
		{
			$db = \Kohana\Database::instance();
		}
		
		$sql = 'CONSTRAINT '.$db->quote_identifier($this->name).' CHECK (';
		
		foreach ($this->_checks as $check)
		{
			$key = key($check);
			
			if ( ! is_int($key))
			{
				$sql .= ' '.$key.' ';
				$check = current($check[$key]);
			}
			
			list($column, $operator, $value) = $check;
			
			$column = $db->quote_identifier($column);
			$value = $db->quote($value);
			
			$sql .= $column.$operator.$value;
		}
		
		return $sql.')';
	}
	
	public function drop($table, \Kohana\Database $db = NULL)
	{
		if ($db === NULL)
		{
			$db = \Kohana\Database::instance();
		}
		
		$this->compile($db);
		
		return \Kohana\DB::alter($table)
			->drop($this->name, 'constraint')
			->execute($db);
	}
	
	/**
	 * Adds a check statement using a defined key
	 *
	 * @param	string	The name of the column to perform the statement on.
	 * @param	string	The opertor to compare the value with.
	 * @param	mixed	The value to compare the column with via the operator.
	 * @param	string	The key that seperates this operator from the rest.
	 * @return	Database_Constraint_Check
	 */
	protected function _add_rule($column, $operator, $value, $key)
	{
		$this->name .= '_'.$column;
		
		$this->_checks[] = array(
			'OR' => array(
				$column,
				$operator,
				$value
			)
		);
	}
	
} // End Database_Constraint_Check
