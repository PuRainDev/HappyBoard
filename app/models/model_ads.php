<?php
namespace app\models;

class model_ads implements \app\core\model
{
	public function get_data($page_id)
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
		//count of available pages
		$total = $response['0']['4'];
		$count = ceil($response['0']['4']/20);
		if ($count == 0) return array('0'=> array('0'=>array('2'=>"Пусто :(",'3'=>'Оставьте первым свое объявление!','4'=>'Ну пожалуйста')), 'count'=>'1', 'min' => 0, 'max' =>0);
		if ($count < $page_id) return array('0'=>array('2'=>"Ошибка",'3'=>'Не возможно отобразить результат','4'=>'page id is too high'));
		//get ids range for displaying from DB
		$min = $count*20 - $page_id * 20 + 1;
		
		if ($result = $mysqli -> query("SELECT * FROM ads WHERE id >= $min ORDER BY id DESC LIMIT 20;")) {
			$response = $result -> fetch_all();
			$result -> free_result();
		}
		$mysqli -> close();
		
		$gen_data['0'] = $response;
		$gen_data['count'] = $count;
		$gen_data['min'] = $min;
		$gen_data['max'] = $total-($count-1)*20;
		
		return $gen_data;
	}
	
}
