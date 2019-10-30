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

                    <div class="sobre">
                        <!-- Área imagem -->
                        <div class="sobre_imagem">
                            <img src="img/pizzaria_1980.jpg" class="responsive_img" alt="Frajola's em 1980">
                        </div>

                        <!-- Área texto -->
                        <div class="texto_sobre">
                            <p>
                                A Frajola's atua no ramo das pizzas desde 1980. Foi inaugurada no dia 21 de abril e a primeira pizzaria a fazer entregas em domicílio de Freguesia do Ó. Fechamos a unidade de Freguesia do Ó e nos instalamos em Carapicuíba. Atualmente temos dezenas de filiais da Frajola's espalhadas pelo estado de São Paulo.
                            </p>

                            <p>
                                A pizzaria possui um atendimento totalmente informatizado, com equipamentos novos, profissionais treinados e instalações modernas e aconchegantes, além do salão com ar condicionado. 
                            </p>

                            <p>
                                Desde nosso nascimento mantemos a necessidade de crescimento sempre junto ao cliente fiel, que sempre foi e sempre será a princípal razão das nossas vendas. Trabalhamos com produtos e equipamentos da maior qualidade, buscando sempre a satisfação do consumidor.
                            </p>

                            <p>
                                Aprendemos a fazer pizza com nossos antepassados napolitanos. O preparo é inteiramente artesanal. A massa é trabalhada com as mãos e descansa por no mínimo 48 horas antes de ser aberta. A pizza é degustada macia, bem assada e suave. As bordas elevadas são douradas e trazem um delicioso aroma. Na hora de recheá-la, além do vínculo com nossas tradições também buscamos referências contemporâneas, interpretando culturas, harmonizando ingredientes e criando novas experiências gastronômicas.
                            </p>
                        </div>
                    </div>

                    <div class="sobre" id="sobre_2">
                        <div class="texto_sobre center">
                            <p>
                                A palavra qualidade tem grande força dentro da Frajola's fazendo com que a melhoria seja significativa em todos os setores diariamente.
                            </p>

                            <p>
                                A tradição dos 39 anos, faz com que a Frajola's ofereça para os seus clientes não somente uma pizza, mas sim, uma pizza com sabor inigualável.
                            </p>

                            <p>
                                <span class="bold italic"> Frajola's, aprecie! </span>
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