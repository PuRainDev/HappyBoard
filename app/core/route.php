<?php
/*

based on https://habr.com/ru/post/150267/

*/
namespace app\core;

use app\controllers;

class route
{
	public $routes = array(
		'404'=>'controller_404',
		'main'=>'controller_main',
		'добавить'=>'controller_add',
		'о_проекте'=>'controller_about',
		'объявления'=>'controller_ads'
	);
	
	public function start()
	{
		$controller_name = 'main';
		$data = '';
		
		$parsed = explode('/', $_SERVER['REQUEST_URI']);

		if ( !empty($parsed[1]) ) {	
			$controller_name = $this->sanitaze_params($parsed[1]);
		}
		
		if ( !empty($parsed[2]) ) {
			$data = $this->sanitaze_params($parsed[2]);
		}

		if (array_key_exists($controller_name, $this->get_routes())) {
			$controller_name = $this->get_routes($controller_name);
		} else {
			$controller_name = 'controller_404';
			$data = '';		
		}
		
		$full_class_name = '\\app\\controllers\\'.$controller_name;
		$controller = new $full_class_name;
		
		$controller->action_index($data);
	
	}
	
	private function sanitaze_params($text) {
		return strtolower(explode('?',urldecode($text))['0']);
	}
	
	private function get_routes($route = "") {
		return empty($route) ? $this->routes: $this->routes[$route];
	}
}
