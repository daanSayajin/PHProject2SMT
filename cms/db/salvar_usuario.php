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

        $level = $_POST['slt_level'];
        $name = $_POST['txt_name'];
        $email = $_POST['txt_email'];
        $password = $_POST['txt_password'];

        $conexao = conexao_mysql();

        if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit') {
            $sql = "UPDATE usuarios 
                    SET id_nivel=".$level.",
                        nome='".$name."',
                        email='".$email."',
                        senha='".$password."' 
                        WHERE id=" . $_GET['id'] . ';';
        } else {
            $sql = "INSERT INTO usuarios (id_nivel, nome, email, senha, status) 
                    VALUES (".$level.",
                            '".$name."',
                            '".$email."',
                            '".$password."',
                            1);";
        }

        if (mysqli_query($conexao, $sql))
            header('location:../usuarios.php');
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>