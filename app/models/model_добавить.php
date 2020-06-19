<?php
class model_добавить implements app\core\model
{
	function __construct() {
		$this->view = new app\core\View();
	}
	public function get_data($useless)
	{	
		$data['msg'] = '';
		if(isset($_POST['g-recaptcha-response'])){
			
			if ($_POST['g-recaptcha-response'] == '') {
				$data['msg'] = '<div class="alert alert-danger" role="alert">
  Необходимо пройти капчу!
</div>';
				return $data;
			}
			
			if (!isset($_POST['inputHeader'])) {
				$data['msg'] = '<div class="alert alert-danger" role="alert">
  Необходимо заполнить название!
</div>';
				return $data;
			}
			if (!isset($_POST['inputContent'])) {
				$data['msg'] = '<div class="alert alert-danger" role="alert">
  Необходимо заполнить текст объявления!
</div>';
				return $data;
			}
			if (!isset($_POST['inputContacts'])) {
				$data['msg'] = '<div class="alert alert-danger" role="alert">
  Необходимо заполнить как с вами связаться!
</div>';
				return $data;
			}
			
			$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lfai6YZAAAAAFSY0yxgTwtTRPt19PIZ-9hhRLHI&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
			$g_response = json_decode($response);
			if($g_response->success!==true) {
				$data['msg'] = '<div class="alert alert-danger" role="alert">
  Ошибка прохождения капчи. Повторите попытку позже.
</div>';
			}
			$_POST['inputHeader'] = htmlspecialchars(trim($_POST['inputHeader']));
			$_POST['inputContent'] = htmlspecialchars(trim($_POST['inputContent']));
			$_POST['inputContacts'] = htmlspecialchars(trim($_POST['inputContacts']));
			$hash = hash('sha256', $_POST['inputContent']);
			
			$dbhost = $GLOBALS['config']['dbhost'];
			$dbuser = $GLOBALS['config']['dbuser'];
			$dbpass = $GLOBALS['config']['dbpass'];
			$db = $GLOBALS['config']['db'];
			$mysqli = new mysqli($dbhost, $dbuser, $dbpass,$db);

			if ($mysqli -> connect_errno) {
				echo 'Failed to connect to MySQL: ' . $mysqli -> connect_error;
				exit();
			}
			$mysqli -> query('SET NAMES utf8');
			
			if ($result = $mysqli -> query("SELECT * FROM ads WHERE hash = \"$hash\"")) {
				$response = $result -> fetch_all();
				$result -> free_result();
			}
			if (!empty($response)){
				$data['msg'] = '<div class="alert alert-danger" role="alert">
  Объяление с таким содержанием уже было опубликовано. Попробуйте изменить ваш текст.
</div>';
				return $data;
			}
			$mysqli -> query('INSERT INTO   ads (id, hash, header, content, author) VALUES (NULL, "'.$hash.'", "'.$_POST['inputHeader'].'", "'.$_POST['inputContent'].'", "'.$_POST['inputContacts'].'");');
			
			$data['msg'] = '<div class="alert alert-success" role="alert">
  Объявление успешно опубликовано
</div>';
			return $data;
			
		} return $data;
	}
}