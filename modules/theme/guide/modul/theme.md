# Theme

Moduł do obsługi skórek i plików widoków spoza modułów.

### Podstawowy opis

Moduł ten jest rozszerzeniem klasy `View`. Działa w identyczny sposób jak klasa `View` jednak wczytywanie pliku widoku odbywa się z katalogu `themes/nazwa_skórki`. Przykład:

	\Kohana\Theme::factory('widok')

Zostanie pobrany plik `themes/theme/widok.php` gdzie wartość `theme` jest określona w pliku konfiguracyjnym `config/theme.php`. 

	\Kohana\Theme::factory('innytheme.widok')	

Zostanie pobrany plik `themes/innytheme/widok.php` gdzie wartość `theme` określona w pliku konfiguracyjnym `config/theme.php` jest pomijana - widok zawsze będzie szukany w `innytheme`.

W momencie gdy plik nie jest znajdowany w katalogu `themes` jest szukany w katalogach `views` modułów. Klasa `Theme` dziedziczy po `View` wszystkie jej metody takie jak bind() czy set() oraz render().
