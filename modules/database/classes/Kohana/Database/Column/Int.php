<?php namespace Kohana\Database\Column;

class Int extends \Kohana\Database\Column {
	
	/**
	 * The maximum value this column can be.
	 * 
	 * @var int
	 */
	public $max_value;
	
	/**
	 * The minimum value this column can be.
	 * 
	 * @var int
	 */
	public $min_value;
	
	/**
	 * The number of digits the value can be at maximum value.
	 * 
	 * @var int
	 */
	public $scale;
	
	/**
	 * Whether the integer field is auto incremented.
	 * 
	 * @var bool
	 */
	public $auto_increment;
	
	public function parameters($set = NULL)
	{
		if ($set === NULL)
		{
			return isset($this->scale) ? array($this->scale) : array();
		}
		else
		{
			$this->scale = $set;
		}
	}
	
	protected function _load_schema(array $schema)
	{
		$this->scale = \Kohana\Arr::get($schema, 'numeric_scale');
		$this->max_value = \Kohana\Arr::get($schema, 'max');
		$this->min_value = \Kohana\Arr::get($schema, 'min');
	}
	
	protected function _constraints()
	{
		if ($this->auto_increment)
		{
			return array('auto_increment');
		}
		
		return array();
	}
	
} // End Database_Column_Int
