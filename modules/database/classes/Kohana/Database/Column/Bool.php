<?php namespace Kohana\Database\Column;

class Bool extends \Kohana\Database\Column {
	
	public function parameters($set = NULL)
	{
		return NULL;
	}
	
	protected function _load_schema(array $schema)
	{
		return;
	}
	
	protected function _constraints()
	{
		return array();
	}
	
} // End Database_Column_Bool
