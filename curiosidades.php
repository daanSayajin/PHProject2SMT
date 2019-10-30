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

                    <div class="curiosidade">
                        <!-- Texto da curiosidade -->
                        <div class="texto_curiosidade">
                            <p>
                                Ricardo, nosso pizzaiolo, é reconhecido como o mais habilidoso de São Paulo e é descendente de italianos. Ele já passou por experiências nas mais famosas pizzarias de São Paulo e têm mais de 10 certificados nos cursos da "University of Pizza".
                            </p>

                            <p>
                                Ricardo faz as pizzas escutando Heavy Metal, já que seu pai, também grande pizzaiolo, tinha o costume de fazer as pizzas na sua empresa escutando Heavy Metal.
                            </p>

                            <p>
                                Ricardo foi criado na Itália até os 10 anos de idade e depois foi trazido ao Brasil. Começou a fazer pizzas com 7 anos por influência de seu pai, que atuava fazendo pizzas há 15 anos e era renomado o melhor pizzaiolo de Veneza.
                            </p>
                        </div>

                        <!-- Imagem da curiosidade -->
                        <div class="curiosidades_imagem">
                            <img src="img/pizzaiolo.jpg" class="responsive_img" alt="Pizzaiolo Ricardo">
                        </div>
                    </div>

                    <div class="curiosidade">
                        <div class="curiosidades_imagem" id="imagem_curiosidade_2">
                            <img src="img/forno.jpg" class="responsive_img" alt="Fornos Frajola's">
                        </div>

                        <div class="texto_curiosidade" id="texto_curiosidade_2">
                            <p>
                                Nossos fornos são importados do Canadá, onde é fabricado os melhores fornos do mundo. As pizzarias mais famosas do mundo, como por exemplo a "Spacca Napoli" e a "L'Antica da Michele", utilizam os fornos fabricados pela fireEmblem, empresa que fabrica os fornos no Canadá. 
                            </p>

                            <p>
                                Utilizamos temperos importados da Índia e frutas e legumes importados da China. Todos os produtos são da maior qualidade e importados dos melhores importadores de tal produto.
                            </p>

                            <p>
                                A lenha utilizada nos nossos fornos é produzida por nós mesmos, numa fazenda onde plantamos milhares de árvores todos os anos, que abastecem os nossos fornos e consequentemente responsáveis por trazer pizza de qualidade aos nossos consumidores. 
                            </p>
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
    </body>
</html>