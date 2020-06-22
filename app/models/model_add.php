<?php
namespace app\models;

class model_add implements \app\core\model
{
	public function get_data($useless)
	{	
		$config = \app\core\config::getInstance('config.ini');
		$captcha = $config::get_recaptcha_data();
		
		$data['msg'] = '';
		$data['public_captcha_key'] = $captcha['recaptcha_public_key'];
		
		if(isset($_POST['g-recaptcha-response'])){
			
			if ($_POST['g-recaptcha-response'] == '') {
				$data['msg'] = 'no_captcha';
				return $data;
			}
			
			if (!isset($_POST['inputHeader'])) {
				$data['msg'] = 'no_header';
				return $data;
			}
			if (!isset($_POST['inputContent'])) {
				$data['msg'] = 'no_content';
				return $data;
			}
			if (!isset($_POST['inputContacts'])) {
				$data['msg'] = 'no_contacts';
				return $data;
			}
			
			$response=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$captcha['recaptcha_secret_key'].'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
			
			$g_response = json_decode($response);
			if($g_response->success!==true) {
				$data['msg'] = 'invalid_captcha';
			}
			
			$db_config = $config::get_db_data();
			
			$dbhost = $db_config['dbhost'];
			$dbuser = $db_config['dbuser'];
			$dbpass = $db_config['dbpass'];
			$db = $db_config['db'];
			$mysqli = new \mysqli($dbhost, $dbuser, $dbpass,$db);

			if ($mysqli -> connect_errno) {
				echo 'Failed to connect to MySQL: ' . $mysqli -> connect_error;
				exit();
			}
			
			$_POST['inputHeader'] = $mysqli->real_escape_string(trim($_POST['inputHeader']));
			$_POST['inputContent'] = $mysqli->real_escape_string(trim($_POST['inputContent']));
			$_POST['inputContacts'] = $mysqli->real_escape_string(trim($_POST['inputContacts']));
			$hash = hash('sha256', $_POST['inputContent']);
			
			$mysqli -> query('SET NAMES utf8');
			
			if ($result = $mysqli -> query("SELECT * FROM ads WHERE hash = \"$hash\"")) {
				$response = $result -> fetch_all();
				$result -> free_result();
			}
			if (!empty($response)){
				$data['msg'] = 'ads_duplication';
				return $data;
			}
			$mysqli -> query('INSERT INTO ads (id, hash, header, content, author) VALUES (NULL, "'.$hash.'", "'.$_POST['inputHeader'].'", "'.$_POST['inputContent'].'", "'.$_POST['inputContacts'].'");');
			
			$data['msg'] = 'success';
			return $data;
			
		} return $data;
	}
}