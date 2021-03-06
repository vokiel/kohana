<?php namespace Kohana\Kostache;
/**
 * Mustache templates for Kohana.
 *
 * @package    Kostache
 * @category   Base
 * @author     Jeremy Bush <jeremy.bush@kohanaframework.org>
 * @author     Woody Gilk <woody.gilk@kohanaframework.org>
 * @copyright  (c) 2010-2012 Jeremy Bush
 * @copyright  (c) 2011-2012 Woody Gilk
 * @license    MIT
 */
class Layout extends \Kohana\Kostache {

	/**
	 * @var  string  partial name for content
	 */
	const CONTENT_PARTIAL = 'content';

	/**
	 * @var  boolean  render template in layout?
	 */
	public $render_layout = TRUE;

	/**
	 * @var  string  layout path
	 */
	protected $_layout = 'layout';

	public function render()
	{
		if ( ! $this->render_layout)
		{
			return parent::render();
		}

		$partials = $this->_partials;

		$partials[\Kohana\Kostache\Layout::CONTENT_PARTIAL] = $this->_template;

		$template = $this->_load($this->_layout);

		return $this->_stash($template, $this, $partials)->render();
	}

}
