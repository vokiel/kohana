# Breadcrumb

Moduł tzw okruszków służy do tworzenia nawigacji pomocniczej pokazującej użytkownikowi w jakim miejscu strony (lub jej struktury) się znajduje. Okruszki stanowią dobrą praktykę dla każdej strony bez względu na jej przeznaczenie i wielkość, a przy rozbudowanych stronach stanowią często podstawowy element nawigacji ułatwiający użytkownikowi poruszenie się po stronie. 

### Opis

Klasa okruszków dla Hanariu jest najprostszą i jednocześnie najbardziej uniwersalną klasą dostępną dla Kohany. Okruszki inicjujemy za pomocą:

	$bread = \Kohana\Breadcrumb::factory()

Tworzona jest tablica zawierająca dane dla określonego okruszka - jako pierwszy element zawsze dodawany jest link do strony głównej wywoływany za pomocą `URL::base()` ( ustawienie w `boostrap.php`). Następne elementy dodajemy za pomocą `add()`:

	$bread->add($url, $crumb, $title = FALSE, $param = 1);

Poszczególne parametry:

Parametr         | Typ      | Wymagany    | Domyślnie | Opis
---------------- | ------------ | --------- | -------- | -----------
$url              | __string__   | tak | -       |  Element adresu url, najczęściej kontroler, akcja, paramtetr
$crumb         | __string__   | tak | -      | Tytuł linku/okruszka - <a>$crumb</a>
$title             | __string__     | nie      | FALSE      | Tytuł linku/okruszka znajdujący się w atrybucie title linka - <a title="$title"></a>
$param   | __int__   | nie      | 1         | Na podstawie tego parametru budowany jest adres okuszka - określamy od jakiego elementu ma się zaczynać
