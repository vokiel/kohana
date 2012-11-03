# Developerbar

Developerbar wyświetla przydatne informacje na temat aplikacji. Bazuje na module "Kohana Debug Toolbar" <http://pifantastic.com/kohana-debug-toolbar/> dla Kohany v2.3 (by Aaron Forsander).  Repozytorium modułu: [https://github.com/marcelorodrigo/developerbar](https://github.com/marcelorodrigo/developerbar).

Uwaga - moduł ten zawiera jedynie podstawowe informacje. Jeśli chcesz możesz skorzystać z bardziej rozbudowanego modułu: debug-toolbar.

### Użycie

- standardowo wrzucamy moduł do katalogu modułów i włączamy go w pliku `bootstrap.php`
- w pliku `init.php` modułu mamy opcję wyłączającą działanie moduł jeśli nasza aplikacja ma status inny niż produkcyjny


### Dodatkowe ustawienia

Poza deklaracjami w bootstrap i init, które mają wpływ na to czy moduł działa czy nie można dokonywać też "ręcznego" włączenia/wyłączenia poprzez:

	Developerbar::factory()->enabled(true); // włączenie
	Developerbar::factory()->enabled(false); // wyłączenie

Domyślnie w init.php moduł jest ręcznie wyłączony. 
