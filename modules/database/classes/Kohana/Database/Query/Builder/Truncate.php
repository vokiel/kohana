<?php namespace Kohana\Database\Query\Builder;

class Truncate extends \Kohana\Database\Query\Builder {
	
	protected $_table;
	
	public function __construct($table)
	{
		$this->_table = $table;
		
		parent::__construct(\Kohana\Database::TRUNCATE, '');
	}
	
	public function compile(\Kohana\Database $db)
	{
		return 'TRUNCATE TABLE '.$db->quote_table($this->_table);
	}
	
	public function reset()
	{
		$this->_table = NULL;
	}
	
} // End Database_Query_Builder_Truncate
