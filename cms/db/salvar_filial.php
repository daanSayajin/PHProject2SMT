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

        $address = $_POST['txt_address'];
        $number = $_POST['txt_number'];
        $city = $_POST['txt_city'];
        $district = $_POST['txt_district'];
        $uf = $_POST['txt_uf'];
        $cep = $_POST['txt_cep'];
        $telephone = $_POST['txt_telephone'];
        
        $conexao = conexao_mysql();

        if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit') {
            $sql = "UPDATE filiais 
                    SET endereco='".$address."',
                        numero='".$number."',
                        cidade='".$city."',
                        bairro='".$district."',
                        uf='".$uf."',
                        cep='".$cep."',
                        telefone='".$telephone."'
                        WHERE id=" . $_GET['id'] . ';';
        } else {
            $sql = "INSERT INTO filiais (endereco, numero, cidade, bairro, uf, cep, telefone, status)
                    VALUES ('".$address."',
                            '".$number."',
                            '".$city."',
                            '".$district."',
                            '".$uf."',
                            '".$cep."',
                            '".$telephone."',
                            1);";
        }

        if (mysqli_query($conexao, $sql))
            header('location:../filiais.php');
        else 
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>