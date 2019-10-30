<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        
        <title>
            Frajola's Pizzaria - Produto do mês
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
        <div id="produto_mes">
            <div class="conteudo center">

                <!-- Redes sociais -->
                <?php
                    if (!file_exists(include_once("./include/redes_sociais.php")))
                        include_once("./include/redes_sociais.php");
                ?>

                <section>
                    <h2 class="section_title">
                        PRODUTO DO MÊS
                    </h2>

                    <div class="produto">
                        <!-- Imagem do produto -->
                        <div class="foto_produto">
                            <img src="img/mussarela.jpg" class="produto_imagem" alt="Pizza Pepperoni">
                        </div>
                        
                        <!-- Informações do produto -->
                        <div class="informacoes_produto">
                            <p>
                                <span class="bold"> Nome: </span> Pizza de Rúcula
                            </p>

                            <p> 
                                <span class="bold"> Descrição: </span> Pizza de rúcula com tomate e queijo mussarela.
                            </p>
                        </div>
                    </div>

                    <!-- Curiosidades e informações do produto -->
                    <div id="texto_produto_mes">
                        <p>
                            A pizza de rúcula com tomate seco é muito saudável e deliciosa. É uma ótima opção para os vegetarianos, além de ser ótima para a saúde.
                        </p>

                        <p>
                            Com um sabor bem peculiar, a rúcula agrada ao paladar de muitos ao mesmo tempo em que outros torcem o nariz só de ouvir falar. Mas a verdura, que faz parte da mesma família do brócolis, da mostarda e do agrião, é na realidade extremamente saudável e pode ser incluída no prato mesmo se você não for muito fã.
                        </p>
                    
                        <p>
                            A rúcula traz benefícios diversos benefícios à saúde, entre eles: diminuição do risco de câncer, melhora da visão e saúde da pele, previne a osteoporose, regula as diabetes, melhora a oxigenação múscular, ajuda na digestão, e além de tudo isso ajuda muito quem quer emagrecer.
                        </p>
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