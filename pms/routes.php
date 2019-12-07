<?php
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
    header('location:./');
    die();
}

$controller = ucfirst($_GET['controller']) . 'Controller';
$action = $_GET['action'];

if (!file_exists(include_once("controllers/{$controller}.php")))
    include_once("controllers/{$controller}.php");

$controller = new $controller;
echo $controller->$action(isset($_GET['id']) ? $_GET['id'] : null);
?>  