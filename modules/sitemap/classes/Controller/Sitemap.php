<?php namespace Controller;

class Sitemap extends \Kohana\Controller {

	public function action_index()
	{
		$sitemap = new \Kohana\Sitemap;
		$url = new \Kohana\Sitemap\URL;
		$url->set_loc('http://google.com')
		    ->set_last_mod(1276800492)
		    ->set_change_frequency('daily')
		    ->set_priority(1);
		$sitemap->add($url);
		$output = $sitemap->render();
		$this->response->body($output);;
	}
}
