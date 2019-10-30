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
            <div id="welcome" class="content center">
                <h1>
                    <strong> Bem-vindo ao Sistema de Gerenciamento do Site </strong>
                </h1>
            
                <p>
                    No CMS (Sistema de Gerenciamento do Site) você pode alterar o conteúdo de todas páginas no seu site que não envolvam os produtos, por exemplo: curiosidades, nossas lojas e sobre a empresa. Além disso você pode administrar as mensagens que foram enviadas para a empresa (da página entre em contato).
                </p>           
            </div>
        </div>
        
        <!-- Rodapé -->
        <?php 
            if (!file_exists(include_once('./include/footer.php')))
                include_once('./include/footer.php'); 
        ?>
    </body>
</html>