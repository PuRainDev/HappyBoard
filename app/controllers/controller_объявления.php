<?php
class controller_объявления extends app\core\controller
{
	function __construct() {
		$this->model = new Model_объявления();
		$this->view = new app\core\View();
	}
	function action_index($data) {
		if ($data == '') $data = 1;
		$result = $this->model->get_data($data);
		$this->view->generate('ads_view.php', 'template_view.php', $result);
	}
}