# Sender

Sender to helper implementujący bibliotekę [Swiftmailer](http://github.com/swiftmailer/swiftmailer) służącą do wysyłania wiadomości email. Sender korzysta z wysyłania wiadomości email za pomocą smtp.

#### Konfiguracja

W pliku `config/sender.php` należy podać:

Parametr         | Opis
---------------- | ------------ | --------- | -------- | -----------
hostname             | nazwę serwer poczty smtp
username         | użytkownik/konto z którego będzie wysyłana poczta - najczęściej jest to pełen adres email
password             | hasło do konta w/w użytkownika
port   | port serwera smtp poczty

#### Przykład użycia

Podstawowy przykład wykorzystania Sendera:

		$mailer = \Kohana\Sender::connect();
		$message = \Swift_Message::newInstance()
			->setSubject('Temat')
			->setFrom(array('nadawca@serwer.pl' => 'Nadawca'))
			->setTo(array('odbiorca@serwer.pl'))
			->setBody('Treść wiadomości', 'text/html');
		$mailer->send($message);

Wszystkie opcje i możliwości opisane są na stronie [http://swiftmailer.org/docs/introduction.html](http://swiftmailer.org/docs/introduction.html).
