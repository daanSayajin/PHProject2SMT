<?php
    if (!file_exists(include_once("./conexao.php")))
        include_once("./conexao.php");

    $conexao = conexao_mysql();

    if (isset($_POST["btn_enviar"])) {
        
        $nome = $_POST["txt_nome"];
        $telefone = $_POST["txt_telefone"];
        $celular = $_POST["txt_celular"];
        $email = $_POST["txt_email"];
        $home_page = $_POST["txt_home_page"];
        $facebook = $_POST["txt_facebook"];
        $sugestao_critica = $_POST["rdo_sugestao_critica"];
        $mensagem = $_POST["txt_mensagem"];
        $sexo = $_POST["rdo_sexo"];
        $profissao = $_POST["txt_profissao"];

        $sql = "INSERT INTO contatos (nome, telefone, celular, email, home_page, facebook, sugestao_critica, mensagem, sexo, profissao) 
                VALUES ('".$nome."',
                        '".$telefone."',
                        '".$celular."',
                        '".$email."', 
                        '".$home_page."', 
                        '".$facebook."', 
                        '".$sugestao_critica."',
                        '".$mensagem."',
                        '".$sexo."',
                        '".$profissao."');";

        if (mysqli_query($conexao, $sql)) 
            header("location:../contato.php");
        else
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
?>