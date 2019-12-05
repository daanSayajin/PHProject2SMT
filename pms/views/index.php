<?php
    $page = 'login';

    if (isset($_GET['page']))
        $page = $_GET['page'];  

    if (!file_exists(include_once("views/{$page}/index.html")))
        include_once("views/{$page}/index.html");
?>
