# Theme

Moduł do obsługi skórek i plików widoków spoza modułów.

#### Instalacja

Aby korzystać z tego modułu oprócz standardowego dodania w bootstrap.php należy zdefiniować ścieżkę do katalogu skórek `themes`. Należy to zrobić w głównym folderze index.php

	$themes = 'theme';
	if ( ! is_dir($themes) AND is_dir(DOCROOT.$themes))
	$themes = DOCROOT.$themes;
	define('THEMEPATH', realpath($themes).DIRECTORY_SEPARATOR);
	unset($application, $modules, $system, $themes);

#### Podstawowy opis

Moduł ten jest rozszerzeniem klasy `View`. Działa w identyczny sposób jak klasa `View` jednak wczytywanie pliku widoku odbywa się z katalogu `themes/nazwa_skórki`. Przykład:

	\Kohana\Theme::factory('widok')

Zostanie pobrany plik `themes/theme/widok.php` gdzie wartość `theme` jest określona w pliku konfiguracyjnym `config/theme.php`. 

	\Kohana\Theme::factory('innytheme.widok')	

Zostanie pobrany plik `themes/innytheme/widok.php` gdzie wartość `theme` określona w pliku konfiguracyjnym `config/theme.php` jest pomijana - widok zawsze będzie szukany w `innytheme`.

W momencie gdy plik nie jest znajdowany w katalogu `themes` jest szukany w katalogach `views` modułów. Klasa `Theme` dziedziczy po `View` wszystkie jej metody takie jak bind() czy set() oraz render().
