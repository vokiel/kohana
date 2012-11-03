# Kostache

Kostache to moduł implementujący system szablonów [Mustache](http://defunkt.github.com/mustache/).


#### Użycie

W folderze classes/View/ znajdują się klasy widoków w których nadajemy wartości zmiennym

classes/View/Example.php

	<?php namespace View;
	class Example extends \Kohana\Kostache
	{
		public $foo = 'bar';
	}

Szablony umieszczane są w folderze templates/

templates/example.mustache

	This is a {{foo}}

W kontrolerze wystarczy wywołać:

	$view = new \View\Example;
	echo $view;

Aby otrzymać:

	"This is a bar"

#### Części szablonu

Aby korzystać z części szablony musisz je zdeklarować za pomocą (>) i nazwy, np. {{>header}}.

Definujesz części za pomocą tablicy $_partials w klasie widoku.  Klucze to zmienne, wartości to ścieżki do plików.

	protected $_partials = array(
		'header' => 'header',         // Załaduje templates/header.mustache
		'footer' => 'footer/default', // Załaduje templates/footer/default.mustache
	);

#### Korzystanie z  \Kohana\Kostache\Layout class

Kostache\Layout rozszerze możliwości szblonu. Aby korzystać z tego należy roszerzyć klasę widoku o Kostache\Layout i dzięki temu określić szablon który zastąpi templates/layout.mustache. Jedyneym wymaganiem jest zdefiniowanie częśći {{>content}}.

Jeśli z tego korzystasz, ale chcesz renderować tylko fragment a nie cały szablon ustaw $render_layout na FALSE. .

    $view = new \View\Post\List;
    if ($this->request !== \Kohana\Request::instance) // Is internal request
    {
        $view->render_layout = FALSE;
    }

#### Mustache - dokumentacja

Szczegóły znajdziesz pod adresami:

[PHP Mustache](http://github.com/bobthecow/mustache.php)

[Original Mustache](http://defunkt.github.com/mustache/)


#### Kompleksowy przykład 

Model (Przykład korzysta z [AutoModeler](http://github.com/zombor/Auto-Modeler)):

	class \Model\Test extends \AutoModeler
	{
		protected $_table_name = 'tests';

		protected $_data = array(
			'id' => '',
			'name' => '',
			'value' => '',
		);

		protected $_rules = array(
			'name' => array('not_empty'),
			'value' => array('not_empty'),
		);
	}

View:

	class \View\Example extends \Kohana\Kostache
	{
		public $title = 'Testing';

		public function things()
		{
			return Inflector::plural(get_class(new \Model\Test));
		}

		public function tests()
		{
			$tests = array();
			foreach (\AutoModeler::factory('test')->fetch_all() as $test)
			{
				$tests[] = $test->as_array();
			}
			return $tests;
		}
	}

Template:

	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8" />
			<title>{{title}}</title>
		</head>
		<body>
			<h1>{{title}}</h1>
			<p>Here are all my {{things}}:</p>
			<ul>
				{{#tests}}
				<li><strong>{{id}}:</strong> ({{name}}:{{value}})</li>
				{{/tests}}
			</ul>
		</body>
	</html>

Controller:

	class \Controller\Welcome extends \Kohana\Controller {

		public function action_index()
		{
			echo new \View\Example;
		}

	} // End Welcome

#### Pobieranie jednego obiektu

Model (Przykład korzysta z [AutoModeler](http://github.com/zombor/Auto-Modeler)):

	class \Model\Test extends \AutoModeler
	{
		protected $_table_name = 'tests';

		protected $_data = array(
			'id' => '',
			'name' => '',
			'value' => '',
		);

		protected $_rules = array(
			'name' => array('not_empty'),
			'value' => array('not_empty'),
		);
	}

View:

	class \View\Singular extends \Kohana\Kostache
	{
		protected $_pragmas = array(Kostache::PRAGMA_DOT_NOTATION => TRUE);

		public $thing_id = NULL;
		public $title = 'Testing';

		public function thing()
		{
			return new \Model\Test($this->thing_id);
		}
	}

Template:

	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8" />
			<title>{{title}}</title>
		</head>
		<body>
			<h1>{{title}}</h1>
			<p>This is just one thing:</p>
			<h2>{{thing.id}}</h2>
			<ul>
				<li>Name: {{thing.name}}</li>
				<li>Value: {{thing.value}}</li>
			</ul>
		</body>
	</html>

Controller:

	class \Controller\Welcome extends \Kohana\Controller {

		public function action_singular($id)
		{
			$view = new \View\Singular;
			$view->thing_id = $id;
			echo $view;
		}
	} // End Welcome
