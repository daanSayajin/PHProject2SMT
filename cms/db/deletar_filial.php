<?php
    if (!file_exists(include_once('../../db/conexao.php')))
        include_once('../../db/conexao.php');

    if (!file_exists(include_once('../include/permission.php')))
        include_once('../include/permission.php');

    if (!isset($_SESSION['username'])) {
        header('location:../../'); 
        return;
    }

    if (!hasPermission('adm_conteudo')) {
        header('location:../'); 
        return;
    } 

    if (isset($_GET['action']) && strtolower($_GET['action']) === 'delete') {

        $conexao = conexao_mysql();
        $id = $_GET['id'];
        $sql = "DELETE FROM filiais WHERE id=" . $id . ";";

        if (mysqli_query($conexao, $sql)) 
            header('location:../filiais.php');
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>