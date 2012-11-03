<?php namespace Kohana\Sitemap;

interface Sinterface
{
	/**
	 *
	 */
	public function create();

	/**
	 * 
	 */
	public function root(\DOMElement & $root);
}
