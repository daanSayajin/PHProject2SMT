<?php
    if (!file_exists(include_once('../../db/conexao.php')))
        include_once('../../db/conexao.php');

    if (!file_exists(include_once('../include/permission.php')))
        include_once('../include/permission.php');

    if (!isset($_SESSION['username'])) {
        header('location:../../'); 
        return;
    }

    if (!hasPermission('adm_usuarios')) {
        header('location:../'); 
        return;
    } 

    if (isset($_GET['action'])) {

        $id = $_GET['id'];
        
        $conexao = conexao_mysql();

        if (strtolower($_GET['action']) === 'enable') 
            $sql = 'UPDATE niveis SET status=1 WHERE id=' . $id . ';';
        elseif (strtolower($_GET['action']) === 'disable')
            $sql = 'UPDATE niveis SET status=0 WHERE id=' . $id . ';';

        if (mysqli_query($conexao, $sql))
            header('location:../niveis.php');
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>