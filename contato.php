<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        
        <title>
            Frajola's Pizzaria - Contato
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
        <div id="contato">
            <div class="conteudo center">

                <!-- Redes sociais -->
                <?php
                    if (!file_exists(include_once("./include/redes_sociais.php")))
                        include_once("./include/redes_sociais.php");
                ?>

                <section>
                    <h2 class="section_title">
                        FALE CONOSCO
                    </h2>

                    <!-- Dados da pizzaria -->
                    <div id="dados_frajolas">
                        <p class="bold"> E-mail: </p>
                        <p class="margin-bottom-70"> contato@frajolaspizzaria.com.br </p>
                    
                        <p class="bold"> Telefone: </p>
                        <p> +55 (11) 4188-5739 </p>
                        <p class="margin-bottom-70"> +55 (11) 6254-4897 </p>
                        
                        <p class="bold"> WhatsApp: </p>
                        <p class="margin-bottom-70"> +55 (11) 96750-5978 </p>
                    </div>

                    <!-- Formulário de contato -->
                    <div id="dados_mensagem">
                        <form name="frm_contato" method="post" action="./db/inserir_contato.php">
                            <div class="input">
                                <label for="txt_nome" class="bold">
                                    NOME:
                                </label>

                                <input type="text" name="txt_nome" value="" id="txt_nome" class="txt" onkeypress="return validarLetrasNumeros(event, 'numeric')" required>
                            </div>

                            <div class="input">
                                <label for="txt_telefone" class="bold">
                                    TELEFONE:
                                </label>

                                <input type="text" name="txt_telefone" value="" id="txt_telefone" minlength="14" placeholder="(99) 9999-9999" class="txt" onkeypress="return validarLetrasNumeros(event, 'string')">
                            </div>

                            <div class="input">
                                <label for="txt_celular" class="bold">
                                    CELULAR:
                                </label>

                                <input type="text" name="txt_celular" value="" id="txt_celular" minlength="15" class="txt" placeholder="(99) 99999-9999" onkeypress="return validarLetrasNumeros(event, 'string')" required>
                            </div>

                            <div class="input">
                                <label for="txt_email" class="bold">
                                    E-MAIL:
                                </label>

                                <input type="email" name="txt_email" value="" id="txt_email" class="txt" required>
                            </div>

                            <div class="input">
                                <label for="txt_home_page" class="bold">
                                    HOME PAGE:
                                </label>

                                <input type="text" name="txt_home_page" value="" id="txt_home_page" class="txt">
                            </div>

                            <div class="input">
                                <label for="txt_facebook" class="bold">
                                    FACEBOOK:
                                </label>

                                <input type="text" name="txt_facebook" value="" id="txt_facebook" class="txt">
                            </div>

                            
                            <div class="input">
                                <label for="txt_sugestao" class="bold label_radio_title">
                                    SUGESTÃO/CRÍTICA:
                                </label>

                                <input type="radio" name="rdo_sugestao_critica" id="rdo_sugestao" value="sugestao" data-type="radio">
                                <label for="rdo_sugestao" class="label_radio"> Sugestão </label>
                                <input type="radio" name="rdo_sugestao_critica" id="rdo_critica" value="critica" data-type="radio">
                                <label for="rdo_critica" class="label_radio"> Crítica </label>
                            </div>

                            <div id="mensagem">
                                <div class="input">
                                    <label for="txt_mensagem" class="bold">
                                        MENSAGEM:
                                    </label>

                                    <textarea name="txt_mensagem" id="txt_mensagem" required></textarea> 
                                </div>
                            </div>
                            
                            <div class="input">
                                <label class="bold label_radio_title">
                                    SEXO:
                                </label>

                                <input type="radio" name="rdo_sexo" id="rdo_m" value="M" data-type="radio" required>
                                <label for="rdo_m" class="label_radio"> Masculino </label>
                                <input type="radio" name="rdo_sexo" id="rdo_f" value="F" data-type="radio" required>
                                <label for="rdo_f" class="label_radio"> Feminino </label>
                            </div>

                            <div class="input">
                                <label for="txt_profissao" class="bold">
                                    PROFISSÃO:
                                </label>

                                <input type="text" name="txt_profissao" value="" id="txt_profissao" class="txt" required>
                            </div>

                            <div class="input">
                                <input type="submit" name="btn_enviar" value="ENVIAR" class="btn">
                            </div>
                        </form>
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
        <script src="js/jquery.mask.js"></script>
        <script src="js/validation.js"></script>
    </body>
</html>