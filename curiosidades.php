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
            Frajola's Pizzaria - Curiosidades
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
        <div id="curiosidades">
            <div class="conteudo center">

                <!-- Redes sociais -->
                <?php
                    if (!file_exists(include_once("./include/redes_sociais.php")))
                        include_once("./include/redes_sociais.php");
                ?>

                <section>
                    <h2 class="section_title">
                        CURIOSIDADES
                    </h2>

                    <?php
                    $sql = "SELECT * from curiosidades;";
             
                    $select = mysqli_query($conexao, $sql);

                    while ($rs_curiosity = mysqli_fetch_array($select)) { 
                        if ($rs_curiosity['status']) {?>
                            <div class="curiosidade">
                                <!-- Texto da curiosidade -->
                                <div class="texto_curiosidade">
                                    <p>
                                        <?=$rs_curiosity['texto']?>    
                                    </p>
                                </div>

                                <!-- Imagem da curiosidade -->
                                <div class="curiosidades_imagem">
                                    <img src="cms/db/uploads/<?=$rs_curiosity['imagem']?>" class="responsive_img" alt="Pizzaiolo Ricardo">
                                </div>
                            </div>
                    <?php }} ?>
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