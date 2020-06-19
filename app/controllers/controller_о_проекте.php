<?php
class controller_о_проекте extends app\core\controller
{
	function __construct() {
		$this->view = new app\core\View();
	}
	function action_index($data) {
		$this->view->generate('о_проекте_view.php', 'template_view.php');
	}
}