<?php
$controller = ucfirst($_GET['controller']) . 'Controller';
$action = $_GET['action'];

if (!file_exists(include_once("controllers/{$controller}.php")))
    include_once("controllers/{$controller}.php");

$controller = new $controller;
echo $controller->$action();
?>  