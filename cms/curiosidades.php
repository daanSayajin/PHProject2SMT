<?php
    if (!file_exists(include_once('../db/conexao.php')))
        include_once('../db/conexao.php');

    if (!file_exists(include_once('./include/permission.php')))
        include_once('./include/permission.php');

    if (!hasPermission('adm_conteudo')) 
        header('location:./'); 

    $button = 'Cadastrar';
    $conexao = conexao_mysql();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        
        <title>
            Frajola's Pizzaria - CMS
        </title>
        
        <link rel="icon" href="./img/icon.png">
        <link href="./css/styles.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Cabeçalho -->
        <?php 
            if (!file_exists(include_once('./include/header.php')))
                include_once('./include/header.php'); 
        ?>

        <!-- Menu -->
        <?php 
            if (!file_exists(include_once('./include/menu.php')))
                include_once('./include/menu.php'); 
        ?>

        <!-- Conteúdo principal -->
        <div id="cms-main-content">
            <div id="handle-content" class="content center">
                <h1> 
                    <strong> Administração de Conteúdo </strong>
                </h1>     
                
                <h2>
                    Curiosidades
                </h2>

                <form name="frm_curiosities" method="POST" action="./db/salvar_curiosidade.php<?php if (isset($id)) echo('?action=edit&id=' . $id); ?>">
                    <textarea name="txt_curiosity" placeholder="Curiosidade*" required><?=@$curiosity?></textarea>
                    
                    <label id="thumbnail">
                        <input type="file" name="img_curiosity" id="img-curiosity" />
                        <img src="./img/camera.svg" id="camera-icon" alt="Select icon" />
                    </label>
                    
                    <input type="submit" name="btn_submit" value="<?=$button?>" />
                </form> 
            </div>
        </div>

        <!-- Rodapé -->
        <?php 
            if (!file_exists(include_once('./include/footer.php')))
                include_once('./include/footer.php'); 
        ?>

        <script>
            var $imageCuriosity = document.getElementById('img-curiosity');
            var $thumbnail = document.getElementById('thumbnail');
            var $cameraIcon = document.getElementById('camera-icon');
            
            $imageCuriosity.addEventListener('change', function(e) {
                const url = URL.createObjectURL(e.target.files[0]);

                $thumbnail.style.backgroundImage = `url(${url})`;
                $thumbnail.style.border = 'none';
                $cameraIcon.style.display = 'none';
            });
        </script>
    </body>
</html>