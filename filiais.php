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
            Frajola's Pizzaria - Filiais
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
        
        <!-- Filiais -->
        <div id="filiais">
            <div class="conteudo center">

                <!-- Redes sociais -->
                <?php
                    if (!file_exists(include_once("./include/redes_sociais.php")))
                        include_once("./include/redes_sociais.php");
                ?>

                <section>
                    <h2 class="section_title">
                        NOSSAS LOJAS
                    </h2>

                    <!-- Mapa -->
                    <iframe id="maps_frame" src="" allowfullscreen=""></iframe>
                   
                    <!-- Informações das filiais -->
                    <div id="informacoes_filiais">
                        <?php
                        $sql = "SELECT * from filiais;";
                
                        $select = mysqli_query($conexao, $sql);

                        while ($rs_branch = mysqli_fetch_array($select)) { 
                            if ($rs_branch['status']) { ?>
                            
                                <p class="bold margin-bottom-10"> <?=mb_strtoupper($rs_branch['cidade'])?> - <?=mb_strtoupper($rs_branch['bairro'])?> </p>
                                <p class="txt_maps"> <?=$rs_branch['endereco']?>, <?=$rs_branch['numero']?> - <?=$rs_branch['bairro']?>, <?=$rs_branch['cidade']?>  - <?=$rs_branch['uf']?> </p>
                                <p> Tel: <?=$rs_branch['telefone']?> </p>
                                <div class="input">
                                    <input type="button" class="margin-bottom-25 btn btn_maps" value="VER NO MAPA">
                                </div>
                        <?php }} ?>
                    </div>
                </section>
            </div>
        </div>
        
        <!-- Rodapé -->
        <?php
            if (!file_exists(include_once("./include/footer.php")))
                include_once("./include/footer.php");
        ?>

        <script src="js/jquery.js"></script>
        <script>
            /* Load map of the first branch */
            $(document).ready(function() {
                let txt_maps = document.querySelectorAll('.txt_maps');
                txt_maps = Array.prototype.slice.call(txt_maps);      

                data = txt_maps[0].innerHTML.split('-');
                $('#maps_frame').attr('src', `https://www.google.com/maps/embed/v1/place?key=AIzaSyAGC7WOh5rNNOdzumAcK5Otlrqbi4BYbb4&q=${data[0]},${data[1]},${data[2]})`);
            });

            /* Search in maps on button click */
            let btn_maps = document.querySelectorAll('.btn_maps');
            btn_maps = Array.prototype.slice.call(btn_maps);

            btn_maps.map((btn, i) => btn.addEventListener('click', () => {
                let txt_maps = document.querySelectorAll('.txt_maps');
                txt_maps = Array.prototype.slice.call(txt_maps);        

                data = txt_maps[i].innerHTML.split('-');
                $('#maps_frame').attr('src', `https://www.google.com/maps/embed/v1/place?key=AIzaSyAGC7WOh5rNNOdzumAcK5Otlrqbi4BYbb4&q=${data[0]},${data[1]},${data[2]})`);
            }));
        </script>
    </body>
</html>