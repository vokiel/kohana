<?php namespace Kohana\Database\Query;
/**
 * Database query builder. See [Query Builder](/database/query/builder) for usage and examples.
 *
 * @package    Kohana/Database
 * @category   Query
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license
 */
abstract class Builder extends \Kohana\Database\Query {

	/**
	 * Compiles an array of JOIN statements into an SQL partial.
	 *
	 * @param   object  $db     Database instance
	 * @param   array   $joins  join statements
	 * @return  string
	 */
	protected function _compile_join(\Kohana\Database $db, array $joins)
	{
		$statements = array();

		foreach ($joins as $join)
		{
			// Compile each of the join statements
			$statements[] = $join->compile($db);
		}

		return implode(' ', $statements);
	}

	/**
	 * Compiles an array of conditions into an SQL partial. Used for WHERE
	 * and HAVING.
	 *
	 * @param   object  $db          Database instance
	 * @param   array   $conditions  condition statements
	 * @return  string
	 */
	protected function _compile_conditions(\Kohana\Database $db, array $conditions)
	{
		$last_condition = NULL;

		$sql = '';
		foreach ($conditions as $group)
		{
			// Process groups of conditions
			foreach ($group as $logic => $condition)
			{
				if ($condition === '(')
				{
					if ( ! empty($sql) AND $last_condition !== '(')
					{
						// Include logic operator
						$sql .= ' '.$logic.' ';
					}

					$sql .= '(';
				}
				elseif ($condition === ')')
				{
					$sql .= ')';
				}
				else
				{
					if ( ! empty($sql) AND $last_condition !== '(')
					{
						// Add the logic operator
						$sql .= ' '.$logic.' ';
					}

					// Split the condition
					list($column, $op, $value) = $condition;

					if ($value === NULL)
					{
						if ($op === '=')
						{
							// Convert "val = NULL" to "val IS NULL"
							$op = 'IS';
						}
						elseif ($op === '!=')
						{
							// Convert "val != NULL" to "valu IS NOT NULL"
							$op = 'IS NOT';
						}
					}

					// Database operators are always uppercase
					$op = strtoupper($op);

					if ($op === 'BETWEEN' AND is_array($value))
					{
						// BETWEEN always has exactly two arguments
						list($min, $max) = $value;

						if ((is_string($min) AND array_key_exists($min, $this->_parameters)) === FALSE)
						{
							// Quote the value, it is not a parameter
							$min = $db->quote($min);
						}

						if ((is_string($max) AND array_key_exists($max, $this->_parameters)) === FALSE)
						{
							// Quote the value, it is not a parameter
							$max = $db->quote($max);
						}

						// Quote the min and max value
						$value = $min.' AND '.$max;
					}
					elseif ((is_string($value) AND array_key_exists($value, $this->_parameters)) === FALSE)
					{
						// Quote the value, it is not a parameter
						$value = $db->quote($value);
					}

					if ($column)
					{
						if (is_array($column))
						{
							// Use the column name
							$column = $db->quote_identifier(reset($column));
						}
						else
						{
							// Apply proper quoting to the column
							$column = $db->quote_column($column);
						}
					}

					// Append the statement to the query
					$sql .= trim($column.' '.$op.' '.$value);
				}

				$last_condition = $condition;
			}
		}

		return $sql;
	}

	/**
	 * Compiles an array of set values into an SQL partial. Used for UPDATE.
	 *
	 * @param   object  $db      Database instance
	 * @param   array   $values  updated values
	 * @return  string
	 */
	protected function _compile_set(\Kohana\Database $db, array $values)
	{
		$set = array();
		foreach ($values as $group)
		{
			// Split the set
			list ($column, $value) = $group;

			// Quote the column name
			$column = $db->quote_column($column);

			if ((is_string($value) AND array_key_exists($value, $this->_parameters)) === FALSE)
			{
				// Quote the value, it is not a parameter
				$value = $db->quote($value);
			}

			$set[$column] = $column.' = '.$value;
		}

		return implode(', ', $set);
	}

	/**
	 * Compiles an array of GROUP BY columns into an SQL partial.
	 *
	 * @param   object  $db       Database instance
	 * @param   array   $columns
	 * @return  string
	 */
	protected function _compile_group_by(\Kohana\Database $db, array $columns)
	{
		$group = array();

		foreach ($columns as $column)
		{
			if (is_array($column))
			{
				// Use the column alias
				$column = $db->quote_identifier(end($column));
			}
			else
			{
				// Apply proper quoting to the column
				$column = $db->quote_column($column);
			}

			$group[] = $column;
		}

		return 'GROUP BY '.implode(', ', $group);
	}

	/**
	 * Compiles an array of ORDER BY statements into an SQL partial.
	 *
	 * @param   object  $db       Database instance
	 * @param   array   $columns  sorting columns
	 * @return  string
	 */
	protected function _compile_order_by(\Kohana\Database $db, array $columns)
	{
		$sort = array();
		foreach ($columns as $group)
		{
			list ($column, $direction) = $group;

			if (is_array($column))
			{
				// Use the column alias
				$column = $db->quote_identifier(end($column));
			}
			else
			{
				// Apply proper quoting to the column
				$column = $db->quote_column($column);
			}

			if ($direction)
			{
				// Make the direction uppercase
				$direction = ' '.strtoupper($direction);
			}

			$sort[] = $column.$direction;
		}

		return 'ORDER BY '.implode(', ', $sort);
	}

	public static function compile_statement(array $statement)
	{
		$sql = '';

		foreach($statement as $key => $value)
		{
			$sql .= strtoupper($key);

			if ($value)
			{
				$sql .= '='.strtoupper($value);
			}

			$sql .= ' ';
		}

		$sql = substr($sql, 0, strlen($sql) - 1);

		return $sql;
	}

	
	public static function compile_column(\Kohana\Database\Column $column, \Kohana\Database $db = NULL)
	{
		if ($db === NULL)
		{
			$db = \Kohana\Database::instance();
		}
		
		$sql = $db->quote_identifier($column->name).' '.
			strtoupper($column->datatype);
			
		$parameters = $column->parameters();
		
		if ( ! empty($parameters))
		{
			$sql .= $db->quote($column->parameters());
		}

		foreach ($column->constraints() as $key => $constraint)
		{
			if ( ! is_int($key))
			{
				$sql .= ' '.strtoupper($key).' '.$db->quote($constraint);
			}
			else
			{
				$sql .= ' '.strtoupper($constraint);
			}
		}
		
		return $sql;
	}


	/**
	 * Reset the current builder status.
	 *
	 * @return  $this
	 */
	abstract public function reset();

} // End Database_Query_Builder
