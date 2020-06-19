<?php
namespace app\core;
abstract class controller {
	
	public $model;
	public $view;
	
	function __construct() {
		$this->view = new View();
	}
	
	abstract public function action_index($data);
}