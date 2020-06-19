<?php
class controller_404 extends app\core\controller
{
	function __construct() {
		$this->view = new app\core\View();
	}
	function action_index($data) {
		$this->view->generate('404_view.php', 'template_view.php');
	}
}