# Sitemap

Moduł ten jest zaimplementowaniem modułu [http://github.com/ThePixelDeveloper/kohana-sitemap](http://github.com/ThePixelDeveloper/kohana-sitemap).


#### Podstawowy opis

Moduł obsługuje następujące rodzaje sitemap:

- [Standard](http://www.sitemaps.org/protocol.php)
- [Code Search](http://www.google.com/support/webmasters/bin/answer.py?answer=75224)
- [Geo](http://www.google.com/support/webmasters/bin/answer.py?answer=94554)
- [Mobile](http://www.google.com/support/webmasters/bin/answer.py?answer=34648)
- [News](http://www.google.com/support/webmasters/bin/answer.py?hl=en&answer=74288)
- [Video](http://www.google.com/support/webmasters/bin/answer.py?answer=80472)

#### Podstawowa mapa

Poniżej znajduje się przykład ilustrujący jak działa generowanie podstawowej mapy:

	// Sitemap instance.
	$sitemap = new \Kohana\Sitemap;

	// New basic sitemap.
	$url = new \Kohana\Sitemap\URL;

	// Set arguments.
	$url->set_loc('http://google.com')
	    ->set_last_mod(1276800492)
	    ->set_change_frequency('daily')
	    ->set_priority(1);

	// Add it to sitemap.
	$sitemap->add($url);

	// Render the output.
	$output = $sitemap->render();

	// __toString is also supported.
	echo $sitemap;


Zwrócony wynik:

	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		<url>
			<loc>http://google.com</loc>
			<lastmod>2010-06-17T19:48:12+01:00</lastmod>
			<changefreq>daily</changefreq>
			<priority>1</priority>
		</url>
	</urlset>

#### Requirements

| Argument         | Wymagania                                                                                           |
|------------------|-----------------------------------------------------------------------------------------------------------------|
| loc              | Maksymalnie 2,048 znaków                                                                         |
|                  | Musi przechodzi walidację Validate::url                                                                                         |
| last mod         | Modyfikacja - czas uniksowy                                                                                           |
| change frequency | Możliwe opcje: **always**, **hourly**, **daily**, **weekly**, **monthly**, **yearly**, **never** |
| priority         | Wartość między  **0 (zero)** i **1 (jeden)** oraz **inclusive**.   



#### Cache mapy

Przykład generowania mapy raz na 24 h:

	$cache = \Kohana\Cache::instance();

	if($response = $cache->get('sitemap') === NULL)
	{
		// Sitemap instance.
		$sitemap = new \Kohana\Sitemap;

		// New basic sitemap.
		$url = new \Kohana\Sitemap\URL;

		// Set arguments.
		$url->set_loc('http://google.com')
		    ->set_last_mod(1276800492)
		    ->set_change_frequency('daily')
		    ->set_priority(1);

		// Add it to sitemap.
		$sitemap->add($url);

		// Render the output.
		$response = $sitemap->render();

		// Cache the output for 24 hours.
		$cache->set('sitemap', $response, 86400);
	}

	// Output the sitemap.
	echo $response;

#### Przykładowy kontroler

Do modułu dodano przykładowy kontroler. Plik `init.php` konfiguruje routing dla tworzenia sitemapy standardowej i kompresowanej.
