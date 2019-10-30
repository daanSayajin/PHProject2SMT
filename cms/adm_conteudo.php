<?php
    if (!file_exists(include_once('../db/conexao.php')))
        include_once('../db/conexao.php');

    if (!file_exists(include_once('./include/permission.php')))
        include_once('./include/permission.php');

    if (!hasPermission('adm_conteudo')) 
        header('location:./'); 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        
        <title>
            Frajola's Pizzaria - CMS
        </title>
        
        <link rel="icon" href="./img/icon.png">
        <link href="./css/styles.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Cabeçalho -->
        <?php 
            if (!file_exists(include_once('./include/header.php')))
                include_once('./include/header.php'); 
        ?>

        <!-- Menu -->
        <?php 
            if (!file_exists(include_once('./include/menu.php')))
                include_once('./include/menu.php'); 
        ?>

        <!-- Conteúdo principal -->
        <div id="cms-main-content">
            <div id="handle-content" class="content center">
                <h1> 
                    <strong> Administração de Conteúdo </strong>
                </h1>     
                
                <ul>
                    <li>
                        <a href="./curiosidades.php">
                            <img src="./img/curiosity.png" alt="Curiosidades" />
                            <strong> Curiosidades </strong>
                        </a> 
                    </li>   

                    <li>
                        <a href="./filiais.php">
                            <img src="./img/branches.png" alt="Filiais" />
                            <strong> Nossas lojas </strong>
                        </a> 
                    </li>  

                    <li>
                        <a href="./sobre.php">
                            <img src="./img/about.jpg" alt="Sobre" />
                            <strong> Sobre </strong>
                        </a> 
                    </li>                     
                </ul>
            </div>
        </div>

        <!-- Rodapé -->
        <?php 
            if (!file_exists(include_once('./include/footer.php')))
                include_once('./include/footer.php'); 
        ?>
    </body>
</html>