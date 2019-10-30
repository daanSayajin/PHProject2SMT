<?php
    if (!file_exists(include_once('../../db/conexao.php')))
    include_once('../../db/conexao.php');

    if (!file_exists(include_once('../include/permission.php')))
        include_once('../include/permission.php');

    if (!isset($_SESSION['username'])) {
        header('location:../../'); 
        exit();
    }

    if (!hasPermission('adm_usuarios')) {
        header('location:../'); 
        exit();
    } 

    if (isset($_GET['action'])) {

        $id = $_GET['id'];
        
        $conexao = conexao_mysql();

        if (strtolower($_GET['action']) === 'enable') 
            $sql = 'UPDATE usuarios SET status=1 WHERE id=' . $id . ';';
        elseif (strtolower($_GET['action']) === 'disable') 
            $sql = 'UPDATE usuarios SET status=0 WHERE id=' . $id . ';';

        if (mysqli_query($conexao, $sql))
            header('location:../usuarios.php');
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>