<?php
namespace app\models;

class model_main implements \app\core\model
{
	public function get_data($data)
	{	
		$config = \app\core\config::getInstance('config.ini');
		$db_config = $config::get_db_data();
		
		$dbhost = $db_config['dbhost'];
		$dbuser = $db_config['dbuser'];
		$dbpass = $db_config['dbpass'];
		$db = $db_config['db'];
		$mysqli = new \mysqli($dbhost, $dbuser, $dbpass,$db);

		if ($mysqli -> connect_errno) {
			echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
			exit();
		}
		$mysqli -> query("SET NAMES utf8");

		//SHOW TABLE STATUS quickly returns array with data about db. Countains number of rows at index 4
		if ($result = $mysqli -> query("SHOW TABLE STATUS;")) {
			$response = $result -> fetch_all();
			$result -> free_result();
		}
		if ($response['0']['4'] == 0) return array('0'=>array('2'=>"Пусто :(",'3'=>'Оставьте первым свое объявление!','4'=>'Ну пожалуйста'));

		if ($result = $mysqli -> query("SELECT * FROM ads ORDER BY id DESC LIMIT 20")) {
			$response = $result -> fetch_all();
			$result -> free_result();
		}

		$mysqli -> close();
		return $response;
	}
}
