<?php

class Model_User extends Model_Base_Db
{
	protected static $_table_name = 'user';     // テーブル名がモデル名の複数形なら省略可
	protected static $_primariy = array('id');  // プライマリーキーがidなら省略可

	//使用するフィールド名をセット
	protected static $_properties = array(
		'id',
		'name',
		'highScore',
		'score',	
		'updated_at',
		'created_at',
	);

    protected static $_observers = array(
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
        ),
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
    );
}