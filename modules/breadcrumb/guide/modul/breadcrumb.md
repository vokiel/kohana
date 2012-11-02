# Breadcrumb

Moduł tzw okruszków służy do tworzenia nawigacji pomocniczej pokazującej użytkownikowi w jakim miejscu strony (lub jej struktury) się znajduje. Okruszki stanowią dobrą praktykę dla każdej strony bez względu na jej przeznaczenie i wielkość, a przy rozbudowanych stronach stanowią często podstawowy element nawigacji ułatwiający użytkownikowi poruszenie się po stronie. 

### Podstawowy opis

Klasa okruszków dla Hanariu jest najprostszą i jednocześnie najbardziej uniwersalną klasą dostępną dla Kohany. Okruszki inicjujemy za pomocą:

	$bread = \Kohana\Breadcrumb::factory()

Tworzona jest tablica zawierająca dane dla określonego okruszka - jako pierwszy element zawsze dodawany jest link do strony głównej wywoływany za pomocą `URL::base()` ( ustawienie w `boostrap.php`). Następne elementy dodajemy za pomocą `add()`:

	$bread->add($url, $crumb, $title = FALSE, $param = 1);

Poszczególne parametry:

Parametr         | Typ      | Wymagany    | Domyślnie | Opis
---------------- | ------------ | --------- | -------- | -----------
$url              | __string__   | tak | -       |  Element adresu url, najczęściej kontroler, akcja, paramtetr
$crumb         | __string__   | tak | -      | Tytuł linku/okruszka - <a>$crumb</a>
$title             | __string__     | nie      | FALSE      | Tytuł linku/okruszka znajdujący się w atrybucie title linka - <a title="$title"></a> - może być inny da seo
$param   | __int__   | nie      | 1         | Na podstawie tego parametru budowany jest adres okuszka - określamy od jakiego elementu ma się zaczynać

Zwrócenie danych/tablicy z okruszkami w domyślnym widoku:

	$bread->render();

### Szczegóły działania

Tworząc obiekt okruszków za pomocą fabryki możmy dodać dodatkowy parametr `$view`, czyli ścieżkę do naszego widoku (zamiast domyślnego 'breadcrumb'). Możemy dodać dowolną ilość okruszków. Z powodu tego, że nie zawsze struktura strony odpowiada zasobowi url paramtetr `$param` daje możliwość ustawienia od którego elemntu powinien zaczynać się url okruszka. Przykład:

	\Kohana\Breadcrumb::factory('okruszki/widok') // tworzy okruszek nr 1 - Strona główna wskazujący na adres '/'
		->add('blog','Blog') // tworzy okruszek nr 2 - wskazujący na adres '/blog'
		->add('10/tytul-wpisu','Tytuł wpisu', FALSE,0) // tworzy okruszek nr 3 - wskazujący na adres '/10/tytul-wpisu'
		->add('edit','Edytuj ten wpis') // tworzy okruszek nr 4 - dzidziczy adres po poprzednim - wskazując na adres '/10/tytul-wpisu/edit'
		->add('edit','Edytuj wszystkie wpisy','Przejdź do edycji wszystkich',2) // tworzy okruszek nr 5 - dzidziczy adres po okruszku nr 2 - wskazując na adres '/blog/edit'
		->render();

W domyślnym widoku tablica okruszków wyświetlana jest jako lista `ul` z linkami (oprócz ostatniego okruszka). W w/w przykładzie okurszki nie korzystają z domyślnego widoku, lecz z `okruszki/widok`. Widok wczytywany jest za pomocą klasy `View`.
		
