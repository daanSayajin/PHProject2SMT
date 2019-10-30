<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        
        <title>
            Frajola's Pizzaria - Promoções
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

        <!-- Promoções -->
        <div id="promocoes">
            <div class="conteudo center">
                
                <!-- Redes sociais -->
                <?php
                    if (!file_exists(include_once("./include/redes_sociais.php")))
                        include_once("./include/redes_sociais.php");
                ?>

                <section>
                    <h2 class="section_title">
                        PROMOÇÕES
                    </h2>

                    <!-- Menu de navegação das promoções -->
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
                        for ($i = 0; $i < 2; $i++) { ?>
                            <div class="produto">
                                <div class="foto_produto">
                                    <img src="img/mussarela.jpg" class="produto_imagem" alt="Pizza Pepperoni">
                                </div>
                                
                                <div class="informacoes_produto">
                                    <p>
                                        <span class="bold"> Nome: </span> Pizza de Rúcula
                                    </p>

                                    <p> 
                                        <span class="bold"> Descrição: </span> Pizza de rúcula com tomate, queijo mussarela e molho de tomate.
                                    </p>

                                    <p class="preco">
                                        <span class="line-through"> R$ 32,00 </span> 
                                        <span class="nothing"> - </span> 
                                        <span class="bold"> 25,00 </span>
                                    </p>

                                    <a>
                                        Detalhes
                                    </a>
                                </div>
                            </div>  
                        <?php } ?>
                    </div>
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