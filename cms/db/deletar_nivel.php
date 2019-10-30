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

    if (isset($_GET['action']) && strtolower($_GET['action']) === 'delete') {

        $conexao = conexao_mysql();
        $id = $_GET['id'];
        $sql = 'DELETE FROM niveis WHERE id=' . $id . ';';
        
        if (mysqli_query($conexao, $sql))
            header('location:../niveis.php');
        else 
            echo("
                <script>
                    alert('ERRO: Existe um usuário com permissões desse nível!');
                    location.href = '../niveis.php';
                </script>");
    }
?>