<?php
    if (!file_exists(include_once('../db/conexao.php')))
        include_once('../db/conexao.php');

    if (!file_exists(include_once('./include/permission.php')))
        include_once('./include/permission.php');
    
    if (!hasPermission('adm_usuarios')) 
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
            <div id="handle-users" class="content center">
                <h1> 
                    <strong> Administração de Usuários </strong>
                </h1>   
                
                <ul>
                    <li>
                        <a href="./niveis.php">
                            <img src="./img/levels.png" alt="Níveis" />
                            <strong> Níveis </strong>
                        </a> 
                    </li>   

                    <li>
                        <a href="./usuarios.php">
                            <img src="./img/users.png" alt="Usuários" />
                            <strong> Usuários </strong>
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