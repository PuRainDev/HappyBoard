<?php
namespace app\core;

use \app\models;

abstract class controller {
	
	public $model;
	public $view;
	
	abstract public function action_index($data);
}