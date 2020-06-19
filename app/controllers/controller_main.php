<?php
class controller_Main extends app\core\controller
{
	function __construct() {
		$this->model = new Model_main();
		$this->view = new app\core\View();
	}
	function action_index($data) {
		$result = $this->model->get_data($data);
		$this->view->generate('main_view.php', 'template_view.php', $result);
	} 
}