<?php namespace Controller;

class Doc extends \Controller\Index {

	public function menu()
	{
		$menu = array(
			array('slug'=>'index','title'=>'Lista testów'),
		);

		return $menu;
	}

	// load config file
	public function sub()
	{
		$this->ctitle = 'Testy';
		$this->csubtitle = 'Kontroler do wykonywania testów';
	}

	public function action_config()
	{
		$config = Kohana::$config->load('curl');
		$arr = Debug::vars($config);
		$this->response->body($arr);
	}

	// sample create table

	public function action_createtable()
	{

		$table = \Kohana\Database\Table::factory('test')
				->add_column(array('type'=>'int unsigned','name'=>'id','auto_increment'=>TRUE, 'nullable'=>FALSE))
				->add_column(array('type'=>'int unsigned','name'=>'uid', 'nullable'=>FALSE))
				->add_column(array('type'=>'varchar','name'=>'name','max_length'=>32,'default'=>'Radek','nullable'=> FALSE))
				->add_constraint('check',array('id', '>=', 0))
				->add_constraint('primary_key','id')
				->add_constraint('key','uid')
				->add_constraint('foreign_key',array('uid', 'users', 'id'))
				->add_option('ENGINE','InnoDB')
				->add_option('auto_increment',1)
				->create();

	}

	// sample DROP table

	public function action_droptable()
	{

		$table = \Kohana\DB::drop('table','test')->execute();

	}

	// sample DROP constraint

	public function action_dropconstraint()
	{

		$table = \Kohana\DB::alter('test')->drop('fk_test_uid_users_id','foreign key')->execute();

	}

	//sample add constraint

	public function action_addconstraint()
	{
		$fk = \Kohana\Database\Constraint::foreign_key('uid','test')->references('users', 'id')->on_update('cascade')->on_delete('cascade');
		$table = \Kohana\DB::alter('test')->add($fk)->execute();

	}

	public function action_addcolumn()
	{
			$column = array('type'=>'varchar','name'=>'onut','max_length'=>32,'default'=>'Radek','nullable'=> FALSE,'after'=>'uid');
			$c = \Kohana\Database\Column::factory($column['type']);
			foreach ($column as $key => $val)
			{
				$c->$key = $val;
			}
		$table = \Kohana\DB::alter('test')->add($c)->execute();

	}
	// sample DROP constraint

	public function action_dropcolumn()
	{

		$table = \Kohana\DB::alter('test')->drop('onut','column')->execute();

	}
}
