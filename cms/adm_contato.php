<?php
    if (!file_exists(include_once('../db/conexao.php')))
        include_once('../db/conexao.php');

    if (!file_exists(include_once('./include/permission.php')))
        include_once('./include/permission.php');

    if (!hasPermission('adm_contato')) 
        header('location:./'); 
    
    if (isset($_POST['btn_filter'])) {

        $filter = $_POST['slt_filter'];
        header('location:./adm_contato.php?filter=' . $filter);

    } elseif (isset($_POSt['btn_clear_filter']))
        header('location:./adm_contato.php');
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
            <div id="handle-contact" class="content center">
                <h1>
                    <strong> Administração do Fale Conosco </strong>
                </h1>      
                
                <!-- Formulário do filtro -->
                <form name="frm_filter" action="./adm_contato.php" method="post">
                    <select name="slt_filter">
                        <option value="critica" <?php if (@$_GET['filter'] === 'critica') echo('selected') ?>>Crítica</option>
                        <option value="sugestao" <?php if (@$_GET['filter'] === 'sugestao') echo('selected') ?>>Sugestão</option>
                    </select>
    
                    <input type="submit" name="btn_filter" value="Filtrar" />
                    <input type="submit" name="btn_clear_filter" value="Limpar Filtro" />
                </form>

                <!-- Listagem das mensagens -->
                <table>
                    <tr id="tbl-header">
                        <td>NOME</td>
                        <td>TELEFONE</td>
                        <td>EMAIL</td>
                        <td>CRITICA/SUGESTAO</td>
                        <td>OPÇÕES</td>
                    </tr>

                    <?php
                    if (isset($_GET['filter'])) {

                        if ($_GET['filter'] === 'sugestao') 
                            $sql = "SELECT * from contatos WHERE sugestao_critica='sugestao';";
                        elseif ($_GET['filter'] === 'critica')
                            $sql = "SELECT * from contatos WHERE sugestao_critica='critica';";

                    } else 
                        $sql = "SELECT * from contatos;";
             
                    $select = mysqli_query($conexao, $sql);

                    while ($rs_contato = mysqli_fetch_array($select)) { ?>
                        <tr>
                            <td><?=$rs_contato['nome']?></td>
                            <td><?=$rs_contato['telefone']?></td>
                            <td><?=$rs_contato['email']?></td>
                            <td>
                                <?php
                                if ($rs_contato['sugestao_critica'] === 'critica')
                                    echo('Crítica');
                                elseif ($rs_contato['sugestao_critica'] === 'sugestao')
                                    echo('Sugestão');
                                ?>
                            </td>
                            <td>
                                <a href="./db/deletar_contato.php?action=delete&id=<?=$rs_contato['id']?>" onclick="return confirm('Deseja realmente excluir esse registro?');">
                                    <img src="./img/remove.png" alt="Remover" title="Remover" />
                                </a>

                                <a href="#" class="handleModalView" onclick="showModalData(<?=$rs_contato['id']?>);">
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
            /* Show modal */
            $(document).ready(function() {
                $('.handleModalView').click(function() {
                    $('#modal-container').slideDown(250);
                })
            });

            /* Hide modal on 'modal-close' click */
            $(document).ready(function() {
                $('#modal-close').click(function() {
                    $('#modal-container').fadeOut(100);
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
                    $("#modal-container").fadeOut(100);
            });

            /* Ajax function to show modal data */
            function showModalData(id) {
                $.ajax({
                    type: 'POST',
                    url: './modal/contato.php',
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