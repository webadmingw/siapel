<?php
require_once '../config/config.php';
require_once '../app/helpers/Database.php';
require_once '../app/helpers/Helper.php';
require_once '../app/Controllers/HomeController.php';
require_once '../app/Controllers/NewsController.php';
require_once '../app/Controllers/EventController.php';
require_once '../app/Controllers/UserController.php';
require_once '../app/Controllers/LoginController.php';
require_once '../app/Controllers/LogoutController.php';

session_start();

$url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$controllerName = ucfirst($url[1]) . 'Controller';
$methodName = isset($url[2]) ? ($url[2] != "" ? $url[2] : 'index') : 'index';
$params = array_slice($url, 3);

if (file_exists('../app/Controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName;
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], $params);
    } else {
        echo 'Method not found';
    }
} else {
    echo 'Controller not found';
}
