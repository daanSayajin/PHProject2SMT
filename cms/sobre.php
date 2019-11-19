<?php
    if (!file_exists(include_once('../db/conexao.php')))
        include_once('../db/conexao.php');

    if (!file_exists(include_once('./include/permission.php')))
        include_once('./include/permission.php');

    if (!hasPermission('adm_conteudo')) 
        header('location:./'); 

    $button = 'Cadastrar';
    $conexao = conexao_mysql();
    
    if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit') {
        $id = $_GET['id'];

        $conexao = conexao_mysql();
        $sql = 'SELECT * FROM sobre_nos WHERE id=' . $id . ';';
        $select = mysqli_query($conexao, $sql);

        if ($rs_about = mysqli_fetch_array($select)) {
            $about = $rs_about['texto'];
            $image = $rs_about['imagem'];
            $text_position = $rs_about['posicao_texto'];
        }

        $button = "Editar";

        if (!mysqli_query($conexao, $sql))
            echo("<script>alert('ERRO: Falha ao executar o script no banco de dados!');</script>");
    }
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
        <!-- Modal -->
        <div id="modal-container">
            <div id="modal">    
                <header>
                    <img src="./img/remove.png" title="Fechar" id="modal-close" />
                </header>

                <div id="modal-data">

                </div>
            </div>
        </div>

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
                    Sobre nós
                </h2>

                <form name="frm_about_us" id="frm_about_us" enctype="multipart/form-data" method="POST" action="./db/salvar_sobre.php<?php if (isset($id)) echo('?action=edit&id=' . $id . '&image=' . $image); ?>">
                    <div>
                        <textarea name="txt_about" placeholder="Sobre*" required><?=@$about?></textarea>
                        
                        <label id="thumbnail" style="background-image: url('db/uploads/<?=@$image?>'); border: <?php if (isset($image)) { echo('none'); } ?>;">
                            <input type="file" name="fl_about" id="img-about" accept="image/png, image/jpeg, image/jpg" />
                            <img src="./img/camera.svg" id="camera-icon" alt="Select icon" style="display: <?php if (isset($image)) { echo('none'); } ?>;" />
                        </label>
                    </div>

                    <select name="slt_text_position" required>
                        <option value="">Posição do texto*</option>
                        <option value="esquerda" <?php if (@$text_position === 'esquerda') { echo('selected'); } ?>>Esquerda</option>     
                        <option value="direita" <?php if (@$text_position === 'direita') { echo('selected'); } ?>>Direita</option>
                    </select>
                    
                    <input type="submit" name="btn_submit" value="<?=$button?>" />
                </form> 

                <table>
                    <tr id="tbl-header">
                        <td>TEXTO</td>
                        <td>IMAGEM</td>
                        <td>POSIÇÃO DO TEXTO</td>
                        <td>ESTADO</td>
                        <td>OPÇÕES</td>
                    </tr>

                    <?php
                    $sql = "SELECT * from sobre_nos;";
             
                    $select = mysqli_query($conexao, $sql);

                    while ($rs_about = mysqli_fetch_array($select)) { ?>
                        <tr>
                            <td> 
                                <?=substr($rs_about['texto'], 0, 48) . '...'?>
                            </td>

                            <td> <?php
                                if ($rs_about['imagem']) { ?>
                                    <img src="db/uploads/<?=$rs_about['imagem']?>" class="preview" /> 
                                <?php } else { ?>
                                    -
                                <?php } ?>  
                            </td>

                            <td> <?php
                                if ($rs_about['posicao_texto'] === 'esquerda')
                                    echo('Esquerda');
                                else   
                                    echo('Direita'); ?>
                            </td>

                            <td class="tbl-enable-disable"> <?php
                                if ($rs_about['status'])
                                    echo('
                                    <a href="./db/status_sobre.php?action=disable&id='. $rs_about['id'] .'">
                                        <img src="./img/on.png" alt="Desabilitar" title="Desabilitar" /> 
                                    </a>');
                                else   
                                    echo('
                                    <a href="./db/status_sobre.php?action=enable&id='. $rs_about['id'] .'">
                                        <img src="./img/off.png" alt="Habilitar" title="Habilitar" /> 
                                    </a>'); ?>
                            </td>

                            <td>
                                <a href="./sobre.php?action=edit&id=<?=$rs_about['id']?>">
                                    <img src="./img/edit.png" alt="Editar" title="Editar" />
                                </a>

                                <a href="./db/deletar_sobre.php?action=delete&id=<?=$rs_about['id']?>&image=<?=$rs_about['imagem']?>" onclick="return confirm('Deseja realmente excluir esse registro?');">
                                    <img src="./img/remove.png" alt="Remover" title="Remover" />
                                </a>

                                <a href="#" class="handleModalView" onclick="showModalData(<?=$rs_about['id']?>);">
                                    <img src="./img/search.png" alt="Visualizar"  title="Visualizar" />
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <!-- Rodapé -->
        <?php 
            if (!file_exists(include_once('./include/footer.php')))
                include_once('./include/footer.php'); 
        ?>

        <script src="../js/jquery.js"></script>
        <script>
            var $imageAbout = document.getElementById('img-about');
            var $thumbnail = document.getElementById('thumbnail');
            var $cameraIcon = document.getElementById('camera-icon');
            
            $imageAbout.addEventListener('change', function(e) {
                const url = URL.createObjectURL(e.target.files[0]);

                $thumbnail.style.backgroundImage = `url(${url})`;
                $thumbnail.style.border = 'none';
                $cameraIcon.style.display = 'none';
            });

            $('#frm_about_us').submit(function(event) {
                event.preventDefault();

                const file = $(this).find("input[type=file]")[0].files[0];
                
                if (file) {
                    if (file.size / 1024 >= 2000) {
                        alert('ERRO: O tamanho da imagem selecionada ultrapassou 2 megabytes!');
                        return;
                    }

                    const validExts = ['jpg', 'png', 'jpeg'];
                    const fileExt = file.name.split('.')[1];
                    if ($.inArray(fileExt, validExts) === -1) {
                        alert('ERRO: Só é permitido efetuar o cadastro de imagens!');
                        return;
                    }
                }

                this.submit();
            });

            /* Show modal */
            $(document).ready(function() {
                $('.handleModalView').click(function() {
                    $('#modal-container').slideDown(250);
                })
            });

            /* Hide modal on 'modal-close' click */
            $(document).ready(function() {
                $('#modal-close').click(function() {
                    $('#modal-container').slideUp(100);
                })
            });

             /* Hide modal if you click anything other than it */
             $(document).click(function(event) {
                if (!$(event.target).closest('#modal, .handleModalView').length) 
                    $("#modal-container").slideUp(100);
            });

            /* Hide modal on press esc */
            $(document).keyup(function(event) {
                if (event.key === "Escape") 
                    $("#modal-container").slideUp(100);
            });

            /* Ajax function to show modal data */
            function showModalData(id) {
                $.ajax({
                    type: 'POST',
                    url: './modal/sobre.php',
                    data: {
                        action: 'visualize',
                        id: id
                    }, 
                    success: function(data) {
                        $('#modal-data').html(data);
                    }
                });
            }
        </script>
    </body>
</html>