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

        $about = addslashes($_POST['txt_about']);
        $text_position = $_POST['slt_text_position'];

        if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit') {
            if ($_FILES['fl_about']['name'] === '' && $_FILES['fl_about']['size'] === 0) {
                $sql = "UPDATE sobre_nos 
                        SET texto='".$about."',
                        posicao_texto='".$text_position."'
                        WHERE id=" . $_GET['id'] . ';';  
            } else {

                $encryptedFilename = uploadImage('fl_about', 'uploads/');

                if (!$encryptedFilename)
                    echo("
                        <script>
                            alert('ERRO: Não foi possível enviar o arquivo para o servidor!'); 
                            location.href='../sobre.php';
                        </script>");
                else
                    $sql = "UPDATE sobre_nos 
                        SET texto='".$about."',
                        imagem='".$encryptedFilename."',
                        posicao_texto='".$text_position."'
                        WHERE id=" . $_GET['id'] . ';';
            }
        } else {
            if ($_FILES['fl_about']['name'] === '' && $_FILES['fl_about']['size'] === 0) {
                $sql = "INSERT INTO sobre_nos (texto, posicao_texto, status)
                        VALUES ('".$about."',
                                '".$text_position."',
                                1);";
            } else {

                $encryptedFilename = uploadImage('fl_about', 'uploads/');

                if (!$encryptedFilename)
                    echo("
                        <script>
                            alert('ERRO: Não foi possível enviar o arquivo para o servidor!'); 
                            location.href='../sobre.php';
                        </script>");
                else 
                    $sql = "INSERT INTO sobre_nos (texto, imagem, posicao_texto, status)
                            VALUES ('".$about."',
                                    '".$encryptedFilename."',
                                    '".$text_position."',
                                    1);";
            }
        }

        $conexao = conexao_mysql();

        if (mysqli_query($conexao, $sql)) {
            if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit' && $_FILES['fl_about']['name'] !== '' && $_FILES['fl_about']['size'] !== 0) 
                unlink('uploads/' . $_GET['image']);  

            header('location:../sobre.php');
        }
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>