<?php
    if (!file_exists(include_once('../../db/conexao.php')))
        include_once('../../db/conexao.php');

    if (!file_exists(include_once('../include/permission.php')))
        include_once('../include/permission.php');

    if (!file_exists(include_once('../include/upload.php')))
        include_once('../include/upload.php');

    if (!isset($_SESSION['username'])) {
        header('location:../../'); 
        return;
    }

    if (!hasPermission('adm_conteudo')) {
        header('location:../'); 
        return;
    } 

    if (isset($_POST['btn_submit'])) {

        $curiosity = addslashes($_POST['txt_curiosity']);

        if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit') {
            if ($_FILES['fl_curiosity']['name'] === '' && $_FILES['fl_curiosity']['size'] === 0) {
                $sql = "UPDATE curiosidades 
                        SET texto='".$curiosity."'
                        WHERE id=" . $_GET['id'] . ';';  
            } else {

                $encryptedFilename = uploadImage('fl_curiosity', 'uploads/');

                if (!$encryptedFilename)
                    echo("
                        <script>
                            alert('ERRO: Não foi possível enviar o arquivo para o servidor!'); 
                            location.href='../curiosidades.php';
                        </script>");
                else
                    $sql = "UPDATE curiosidades 
                        SET texto='".$curiosity."',
                        imagem='".$encryptedFilename."'
                        WHERE id=" . $_GET['id'] . ';';
            }
        } else {
            if ($_FILES['fl_curiosity']['name'] === '' && $_FILES['fl_curiosity']['size'] === 0) {
                $sql = "INSERT INTO curiosidades (texto, status)
                        VALUES ('".$curiosity."',
                                1);";
            } else {

                $encryptedFilename = uploadImage('fl_curiosity', 'uploads/');

                if (!$encryptedFilename)
                    echo("
                        <script>
                            alert('ERRO: Não foi possível enviar o arquivo para o servidor!'); 
                            location.href='../curiosidades.php';
                        </script>");
                else 
                    $sql = "INSERT INTO curiosidades (texto, imagem, status)
                            VALUES ('".$curiosity."',
                                    '".$encryptedFilename."',
                                    1);";
            }
        }

        $conexao = conexao_mysql();

        if (mysqli_query($conexao, $sql)) {
            if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit' && $_FILES['fl_curiosity']['name'] !== '' && $_FILES['fl_curiosity']['size'] !== 0) 
                unlink('uploads/' . $_GET['image']);  

            header('location:../curiosidades.php');
        }
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>