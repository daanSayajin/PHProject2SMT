<?php
    if (!file_exists(include_once('db/conexao.php')))
        include_once('db/conexao.php');

    $conexao = conexao_mysql();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        
        <title>
            Frajola's Pizzaria - Sobre
        </title>
        
        <link rel="icon" href="img/logo.png">
        <link href="css/styles.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    </head>

    <body>
        <!-- Cabeçalho -->
        <?php
            if (!file_exists(include_once("./include/header.php")))
                include_once("./include/header.php");
        ?>
            
        <!-- Contato -->
        <div id="sobre">
            <div class="conteudo center">

                <!-- Redes sociais -->
                <?php
                    if (!file_exists(include_once("./include/redes_sociais.php")))
                        include_once("./include/redes_sociais.php");
                ?>

                <section>
                    <h2 class="section_title">
                        SOBRE A FRAJOLA'S
                    </h2>

                    <?php
                    $sql = "SELECT * from sobre_nos;";
             
                    $select = mysqli_query($conexao, $sql);

                    while ($rs_about = mysqli_fetch_array($select)) { 
                        if ($rs_about['status']) {
                            if ($rs_about['posicao_texto'] === 'esquerda') { ?>
                                <div class="sobre">
                                    <!-- Texto -->
                                    <div class="texto_sobre" <?php if (!$rs_about['imagem']) { echo("style='width: 100%'"); } ?>>
                                        <p>
                                            <?=$rs_about['texto']?>    
                                        </p>
                                    </div>

                                    <!-- Imagem -->
                                    <?php if ($rs_about['imagem']) { ?>
                                        <div class="sobre_imagem">
                                            <img src="cms/db/uploads/<?=$rs_about['imagem']?>" class="responsive_img" alt="Pizzaiolo Ricardo">
                                        </div>
                                    <?php } ?>
                                </div>
                    <?php } else { ?>
                                <div class="sobre">
                                    <!-- Imagem -->
                                    <?php if ($rs_about['imagem']) { ?>
                                        <div class="sobre_imagem">
                                            <img src="cms/db/uploads/<?=$rs_about['imagem']?>" class="responsive_img" alt="Pizzaiolo Ricardo">
                                        </div>
                                    <?php } ?>

                                    <!-- Texto  -->
                                    <div class="texto_sobre" <?php if (!$rs_about['imagem']) { echo("style='width: 100%'"); } ?>>
                                        <p>
                                            <?=$rs_about['texto']?>    
                                        </p>
                                    </div>
                                </div>
                    <?php }}} ?>
                </section>
            </div>
        </div>
        
        <!-- Rodapé -->
        <?php
            if (!file_exists(include_once("./include/footer.php")))
                include_once("./include/footer.php");
        ?>
    </body>
</html>