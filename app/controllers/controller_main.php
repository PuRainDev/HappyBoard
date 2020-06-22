<?php
namespace app\controllers;

class controller_main extends \app\core\controller
{
	function __construct() {
		$this->model = new \app\models\model_main();
		$this->view = new \app\core\View();
	}
	function action_index($data) {
		print_r($this->$view);
		$result = $this->model->get_data($data);
		$this->view->generate('main_view.php', 'template_view.php', $result);
	} 
}