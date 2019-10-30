<?php
    if (!file_exists(include_once('./conexao.php')))
        include_once('./conexao.php');

    if (isset($_GET['action']) && strtolower($_GET['action']) === 'delete') {

        $conexao = conexao_mysql();
        $id = $_GET['id'];
        $sql = "DELETE FROM contatos WHERE id=" . $id . ";";

        if (mysqli_query($conexao, $sql))
            header('location:../cms/adm_contato.php');
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>