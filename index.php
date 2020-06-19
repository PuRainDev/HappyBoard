<?php
spl_autoload_register();

use app\core\controller;
use app\core\model;
use app\core\view;

$config = parse_ini_file('settings.ini');

$route = new app\core\route();
echo $route->start();