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

    if (isset($_POST['btn_submit'])) {

        $curiosity = addslashes($_POST['txt_curiosity']);



        $filename = pathinfo($_FILES['fl_curiosity']['name'], PATHINFO_FILENAME);
        $ext = pathinfo($_FILES['fl_curiosity']['name'], PATHINFO_EXTENSION);

        $encryptedFilename = hash('md5', uniqid(time() . $filename));
        $encryptedFilename = $encryptedFilename . '.' . $ext;
        $tempFile = $_FILES['fl_curiosity']['tmp_name'];
        
        if (!move_uploaded_file($tempFile, 'uploads/' . $encryptedFilename)) {
            echo("
                <script>
                    alert('ERRO: Não foi possível enviar o arquivo para o servidor!'); 
                    location.href='../curiosidades.php';
                </script>"); 

            return;
        }

        $conexao = conexao_mysql();

        if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit') {
            $sql = "UPDATE curiosidades 
                    SET texto='".$curiosity."',
                        adm_conteudo=".$encryptedFilename.",
                        WHERE id=" . $_GET['id'] . ';';
        } else {
            $sql = "INSERT INTO curiosidades (texto, imagem, status)
                    VALUES ('".$curiosity."',
                            '".$encryptedFilename."',
                            1);";
        }   

        if (mysqli_query($conexao, $sql))
            header('location:../curiosidades.php');
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>