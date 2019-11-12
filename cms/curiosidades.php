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
        $sql = 'SELECT * FROM curiosidades WHERE id=' . $id . ';';
        $select = mysqli_query($conexao, $sql);

        if ($rs_curiosity = mysqli_fetch_array($select)) {
            $curiosity = $rs_curiosity['texto'];
            $image = $rs_curiosity['imagem'];
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
                    Curiosidades
                </h2>

                <form name="frm_curiosities" enctype="multipart/form-data" method="POST" action="./db/salvar_curiosidade.php<?php if (isset($id)) echo('?action=edit&id=' . $id . '&image=' . $image); ?>">
                    <div>
                        <textarea name="txt_curiosity" placeholder="Curiosidade*" required><?=@$curiosity?></textarea>
                        
                        <label id="thumbnail" style="background-image: url('db/uploads/<?=@$image?>'); border: <?php if (isset($image)) { echo('none'); } ?>;">
                            <input type="file" name="fl_curiosity" id="img-curiosity" accept="image/png, image/jpeg, image/jpg" />
                            <img src="./img/camera.svg" id="camera-icon" alt="Select icon" style="display: <?php if (isset($image)) { echo('none'); } ?>;" />
                        </label>
                    </div>
                    
                    <input type="submit" name="btn_submit" value="<?=$button?>" />
                </form> 

                <table>
                    <tr id="tbl-header">
                        <td>CURIOSIDADE</td>
                        <td>IMAGEM</td>
                        <td>ESTADO</td>
                        <td>OPÇÕES</td>
                    </tr>

                    <?php
                    $sql = "SELECT * from curiosidades;";
             
                    $select = mysqli_query($conexao, $sql);

                    while ($rs_curiosity = mysqli_fetch_array($select)) { ?>
                        <tr>
                            <td> 
                                <?=substr($rs_curiosity['texto'], 0, 48) . '...'?>
                            </td>

                            <td>
                                <img src="db/uploads/<?=$rs_curiosity['imagem']?>" class="preview" />
                            </td>

                            <td class="tbl-enable-disable"> <?php
                                if ($rs_curiosity['status'])
                                    echo('
                                    <a href="./db/status_curiosidade.php?action=disable&id='. $rs_curiosity['id'] .'">
                                        <img src="./img/on.png" alt="Desabilitar" title="Desabilitar" /> 
                                    </a>');
                                else   
                                    echo('
                                    <a href="./db/status_curiosidade.php?action=enable&id='. $rs_curiosity['id'] .'">
                                        <img src="./img/off.png" alt="Habilitar" title="Habilitar" /> 
                                    </a>'); ?>
                            </td>

                            <td>
                                <a href="./curiosidades.php?action=edit&id=<?=$rs_curiosity['id']?>">
                                    <img src="./img/edit.png" alt="Editar" title="Editar" />
                                </a>

                                <a href="./db/deletar_curiosidade.php?action=delete&id=<?=$rs_curiosity['id']?>&image=<?=$rs_curiosity['imagem']?>" onclick="return confirm('Deseja realmente excluir esse registro?');">
                                    <img src="./img/remove.png" alt="Remover" title="Remover" />
                                </a>

                                <a href="#" class="handleModalView" onclick="showModalData(<?=$rs_curiosity['id']?>);">
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
            var $imageCuriosity = document.getElementById('img-curiosity');
            var $thumbnail = document.getElementById('thumbnail');
            var $cameraIcon = document.getElementById('camera-icon');
            
            $imageCuriosity.addEventListener('change', function(e) {
                const url = URL.createObjectURL(e.target.files[0]);

                $thumbnail.style.backgroundImage = `url(${url})`;
                $thumbnail.style.border = 'none';
                $cameraIcon.style.display = 'none';
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

            /* Hide modal on press esc */
            $(document).keyup(function(event) {
                if (event.key === "Escape") 
                    $("#modal-container").slideUp(100);
            });

            /* Ajax function to show modal data */
            function showModalData(id) {
                $.ajax({
                    type: 'POST',
                    url: './modal/curiosidade.php',
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