# Analytics

Moduł zaimplementowany z repozytorium [KohAnalytics](http://github.com/matoakley/KohAnalytics) wykorzystujący [GAPI](http://code.google.com/p/gapi-google-analytics-php-interface/)

#### Korzystanie z modułu

Dodajemy użytkownika, hasło, id GA w `config/analytics.php`.

- Raport miesięczny: `Analytics::instance()->monthly_visit_count()`
- Można dodać parametry `$start_date`, `$end_date` i `$metrics` (domyślnie `array('pageviews', 'visits')`)
- Raport dzienny: `Analytics::instance()->daily_visit_count()`
- Raport na podstawie parametrów: `Analytics::instance()->query('date', array('pageviews', 'visits'), NULL, 100)`

#### Linki do dokumentacji GAPI

[http://code.google.com/p/gapi-google-analytics-php-interface/wiki/UsingFilterControl](http://code.google.com/p/gapi-google-analytics-php-interface/wiki/UsingFilterControl)

[http://code.google.com/p/gapi-google-analytics-php-interface/wiki/GAPIDocumentation](http://code.google.com/p/gapi-google-analytics-php-interface/wiki/GAPIDocumentation)
