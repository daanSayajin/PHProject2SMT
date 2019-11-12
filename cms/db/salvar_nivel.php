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

    if (isset($_POST['btn_submit'])) {

        $name = $_POST['txt_name'];
        $adm_content = isset($_POST['chk_content']) ? 1 : 0;
        $adm_contact = isset($_POST['chk_contact']) ? 1 : 0;
        $adm_users = isset($_POST['chk_users']) ? 1 : 0;
        
        $conexao = conexao_mysql();

        if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit') {
            $sql = "UPDATE niveis 
                    SET nome='".$name."',
                        adm_conteudo=".$adm_content.",
                        adm_contato=".$adm_contact.",
                        adm_usuarios=".$adm_users." 
                        WHERE id=" . $_GET['id'] . ';';
        } else {
            $sql = "INSERT INTO niveis (nome, adm_conteudo, adm_contato, adm_usuarios, status)
                    VALUES ('".$name."',
                            ".$adm_content.",
                            ".$adm_contact.",
                            ".$adm_users.",
                            1);";
        }

        if (mysqli_query($conexao, $sql))
            header('location:../niveis.php');
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>