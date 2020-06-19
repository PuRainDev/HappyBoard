<?php
/*

based on https://habr.com/ru/post/150267/

*/
namespace app\core;
class route
{
	function start()
	{
		$controller_name = 'Main';
		$data = '';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if ( !empty($routes[1]) ) {	
			$controller_name = $this->sanitaze_params($routes[1]);
		}
		
		if ( !empty($routes[2]) ) {
			$data = $this->sanitaze_params($routes[2]);
		}

		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;

		$model_file = strtolower($model_name).'.php';
		if(file_exists("app/models/".$model_file)) {
			require "app/models/".$model_file;
		}

		$controller_file = strtolower($controller_name).'.php';
		if(file_exists("app/controllers/".$controller_file)) {
			require "app/controllers/".$controller_file;
		} else {
			$controller_name = 'controller_404';
			$data = '';
			require "app/controllers/controller_404.php";
		}
		
		$controller = new $controller_name;
		
		$controller->action_index($data);
	
	}
	 private function sanitaze_params($text) {
		return explode('?',urldecode($text))['0'];
	 }
}
