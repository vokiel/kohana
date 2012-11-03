# Debug Toolbar

Moduł znajdujący się pod adresem [https://github.com/biakaveron/debug-toolbar](https://github.com/biakaveron/debug-toolbar) dostosowany do Hanariu. Jest jeden z najpopularniejszych modułów tego typu dla Kohany, dodatkowo wspódziający z FirePHP.

#### Instalcja i użycie

Aby zainstalować moduł należy standardowo udostępnić go `bootstrap.php` oraz zmodyfikować plik konfiguracyjny w module `config/debug_toolbar.php`.

	//'auto_render' => Kohana::$environment > Kohana::PRODUCTION,
	'auto_render' => FALSE,

Aktualne ustawienie wyłącza renderowanie modułu. W przypadku odkomentowania wcześniejszej lini i usnięcia drugiej - renderowanie zależy od ustawienia statusu aplikacji. 
