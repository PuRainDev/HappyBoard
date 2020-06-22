<?php
namespace app\controllers;

class controller_about extends \app\core\controller
{
	function __construct() {
		$this->view = new \app\core\View();
	}
	function action_index($data) {
		$this->view->generate('about_view.php', 'template_view.php');
	}
}