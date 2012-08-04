<?php namespace Kohana;
/**
 * Model base class. All models should extend this class.
 *
 * @package    Kohana
 * @category   Models
 * @author     Kohana Team
 * @copyright  (c) 2008-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
abstract class Model {

	/**
	 * Create a new model instance.
	 *
	 *     $model = Model::factory($name);
	 *
	 * @param   string   model name
	 * @return  Model
	 */
	public static function factory($name)
	{
		// Add the model prefix
		$class = 'Model\\'.$name;

		return new $class;
	}

} // End Model
