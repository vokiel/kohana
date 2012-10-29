<?php namespace Kohana\Database\Column;

class String extends \Kohana\Database\Column {
	
	/**
	 * The maximum length of the column in bytes.
	 * 
	 * @var	int
	 */
	public $max_length;
	
	/**
	 * Whether the column is fixed in length.
	 * 
	 * @var	bool
	 */
	public $exact;
	
	/**
	 * Whether the column is colated to store binary data.
	 * 
	 * @var	bool
	 */
	public $binary;
	
	public function parameters($set = NULL)
	{
		if ($this->exact)
		{
			return array();
		}
		else
		{
			if ($set === NULL)
			{
				return isset($this->max_length) ? array($this->max_length) : array();
			}
			else
			{
				$this->max_length = $set;
			}
		}
	}
	
	protected function _load_schema(array $schema)
	{
		$this->max_length = \Kohana\Arr::get($schema, 'character_maximum_length');
		$this->binary = \Kohana\Arr::get($schema, 'binary', FALSE);
		$this->exact = \Kohana\Arr::get($schema, 'exact', FALSE);
	}
	
	protected function _constraints()
	{
		if ($this->binary)
		{
			return array('binary');
		}
		
		return array();
	}
	
} // End Database_Column_String
