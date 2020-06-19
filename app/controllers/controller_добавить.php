<?php
class controller_добавить extends app\core\controller
{
	function __construct() {
		$this->model = new Model_добавить();
		$this->view = new app\core\View();

	}
	function action_index($data) {
		$result = $this->model->get_data($data);
		$this->view->generate('add_view.php', 'template_view.php', $result);
	}
}