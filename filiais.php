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
                    <iframe id="maps_frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.9471173561988!2d-46.82937448447622!3d-23.53440436648363!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cf01d679015269%3A0x88a5d548c3ff1412!2sBarufs.!5e0!3m2!1spt-BR!2sbr!4v1568850499797!5m2!1spt-BR!2sbr" allowfullscreen=""></iframe>
                
                    <!-- Informações das filiais -->
                    <div id="informacoes_filiais">
                        <p class="bold margin-bottom-10"> CARAPICUIBA - COHAB II </p>
                        <p> Rua Uberlândia, 41 - Cohab II / Carapicuíba (SP) </p>
                        <p> Tel: 11 4188-5739 / 11 4167-6620 </p>
                        <div class="input">
                            <input type="button" onclick="alter_frame('www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.9471173561988!2d-46.82937448447622!3d-23.53440436648363!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cf01d679015269%3A0x88a5d548c3ff1412!2sBarufs.!5e0!3m2!1spt-BR!2sbr!4v1568850499797!5m2!1spt-BR!2sbr')" class="margin-bottom-25 btn" value="VER NO MAPA">
                        </div>

                        <p class="bold margin-bottom-10"> JANDIRA - CENTRO </p>
                        <p> Rua Elton Silva, 905 - Centro / Jandira (SP) </p>
                        <p> Tel: 11 6254-4897 / WhatsApp: 11 96750-5978 </p>
                        <div class="input">
                            <input type="button" onclick="alter_frame('www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3658.1029153567983!2d-46.90027078502276!3d-23.528800584699074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cf0154039cb55b%3A0xadf34a919f156950!2sSENAI%20Jandira%20-%20Professor%20Vicente%20Amato!5e0!3m2!1spt-BR!2sbr!4v1568764278201!5m2!1spt-BR!2sbr')" class="margin-bottom-25 btn" value="VER NO MAPA">
                        </div>
                    </div>
                </section>
            </div>
        </div>
        
        <!-- Rodapé -->
        <?php
            if (!file_exists(include_once("./include/footer.php")))
                include_once("./include/footer.php");
        ?>

        <!-- Altera a localização no mapa -->
        <script>
            function alter_frame(frame) {
                document.getElementById("maps_frame").src = "https://" + frame;
            }
        </script>
    </body>
</html>