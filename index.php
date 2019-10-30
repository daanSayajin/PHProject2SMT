<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">

        <title>
            Frajola's Pizzaria
        </title>
        
        <link rel="icon" href="img/logo.png">
        <link href="css/styles.css" rel="stylesheet" type="text/css">
        <link href="css/flickity.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    </head>

    <body>
        <!-- Cabeçalho -->
        <?php
            if (!file_exists(include_once("./include/header.php")))
                include_once("./include/header.php");
        ?>
        
        <!-- Slider -->
        <?php 
            if (!file_exists(include_once("./include/slider.php")))
                include_once("./include/slider.php");
        ?>
        
        <!-- Loja -->
        <section id="loja">

            <!-- Validação no W3C -->
            <h2 class="nothing">
                nothing
            </h2>
            
            <div class="conteudo center">

                <!-- Redes sociais -->
                <?php
                    if (!file_exists(include_once("./include/redes_sociais.php")))
                        include_once("./include/redes_sociais.php");
                ?>

                <!-- Menu de navegação da loja -->
                <nav id="area_menu_cardapio">
                    <ul id="menu_cardapio">
                        <li class="menu_cardapio_itens"> Especiais da Casa 
                            <ul class="submenu">
                                <li class="submenu_itens"> Portuguesa </li>
                                <li class="submenu_itens"> Moda A </li>
                                <li class="submenu_itens"> Mussarela </li>
                            </ul>
                        </li>
                        <li class="menu_cardapio_itens"> Veganas
                            <ul class="submenu">
                                <li class="submenu_itens"> Berinjela </li>
                                <li class="submenu_itens"> Couve-flor </li>
                                <li class="submenu_itens"> Batata Doce </li>
                                <li class="submenu_itens"> Mandioca </li>
                            </ul>
                        </li>
                        <li class="menu_cardapio_itens"> Doces
                            <ul class="submenu">
                                <li class="submenu_itens"> Ao leite </li>
                                <li class="submenu_itens"> Amargo </li>
                                <li class="submenu_itens"> Branco </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                
                <!-- Produtos -->
                <div id="produtos">
                    <?php 
                    for ($i = 0; $i < 15; $i++) { ?>
                        <div class="produto">
                            <div class="foto_produto">
                                <img src="img/pepperoni.jpg" class="produto_imagem" alt="Pizza Pepperoni">
                            </div>
                            
                            <div class="informacoes_produto">
                                <p>
                                    <span class="bold"> Nome: </span> Pizza de Pepperoni
                                </p>

                                <p>
                                    <span class="bold"> Descrição: </span> Pizza de calabresa com pimenta, queijo mussarela e molho de tomate.
                                </p>

                                <p class="preco bold">
                                    R$ 30,00
                                </p>

                                <a>
                                    Detalhes
                                </a>
                            </div>
                        </div>  
                    <?php } ?>
                </div>
            </div>
        </section>
        
        <!-- Rodapé -->
        <?php
            if (!file_exists(include_once("./include/footer.php")))
                include_once("./include/footer.php");
        ?>
        
        <script src="js/jquery.js"></script>
        <script src="js/flickity.js"></script>
        <script src="js/slider.js"></script>
    </body>
</html>