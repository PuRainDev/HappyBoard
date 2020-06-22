<?php
namespace app\controllers;

class controller_ads extends \app\core\controller
{
	function __construct() {
		$this->model = new \app\models\model_ads();
		$this->view = new \app\core\View();
	}
	function action_index($data) {
		if ($data == '') $data = 1;
		if (!is_int($data)) {
			$controller = new controller_404;
			$controller->action_index(null);
			exit();
		}
		$result = $this->model->get_data($data);
		$this->view->generate('ads_view.php', 'template_view.php', $result);
	}
}