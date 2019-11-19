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
        $sql = 'SELECT * FROM filiais WHERE id=' . $id . ';';
        $select = mysqli_query($conexao, $sql);

        if ($rs_branch = mysqli_fetch_array($select)) {
            $address = $rs_branch['endereco'];
            $number = $rs_branch['numero'];
            $city = $rs_branch['cidade'];
            $district = $rs_branch['bairro'];
            $uf = $rs_branch['uf'];
            $cep = $rs_branch['cep'];
            $telephone = $rs_branch['telefone'];
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
                    Filiais
                </h2>

                <form name="frm_branches" method="POST" action="./db/salvar_filial.php<?php if (isset($id)) echo('?action=edit&id=' . $id); ?>">
                    <div>
                        <input type="text" value="<?=@$address?>" name="txt_address" id="txt_address" required placeholder="Endereço*" onkeypress="return validarLetrasNumeros(event, '', 50, 'txt_address')" style="width: 48%; margin-right: 1%; " />
                        <input type="text" value="<?=@$district?>" name="txt_district" id="txt_district" required readonly placeholder="Bairro*" style="width: 40%; margin-right: 1%;" />
                        <input type="text" value="<?=@$number?>" name="txt_number" id="txt_number" required placeholder="Número*" onkeypress="return validarLetrasNumeros(event, 'string', 5, 'txt_number')" style="width: 10%;" />
                    </div>

                    <div>
                        <input type="text" value="<?=@$cep?>" name="txt_cep" id="txt_cep" required placeholder="CEP*" style="width: 20%; margin-right: 1%;" />
                        <input type="text" value="<?=@$city?>" name="txt_city" id="txt_city" required readonly placeholder="Cidade*" style="width: 39%; margin-right: 1%;" />
                        <input type="text" value="<?=@$uf?>" name="txt_uf" id="txt_uf" required readonly placeholder="Estado*" style="width: 39%;" />
                    </div>

                    <input type="text" value="<?=@$telephone?>" name="txt_telephone" id="txt_telephone" required placeholder="Telefone*" />
                    <input type="button" value="Ver no mapa" id="btn_maps" />

                    <iframe id="maps_frame" style="display: none;"></iframe>

                    <input type="submit" name="btn_submit" value="<?=$button?>" />
                </form> 

                <table>
                    <tr id="tbl-header">
                        <td>ENDEREÇO</td>
                        <td>CIDADE</td>
                        <td>TELEFONE</td>
                        <td>ESTADO</td>
                        <td>OPÇÕES</td>
                    </tr>

                    <?php
                    $sql = "SELECT * from filiais;";
             
                    $select = mysqli_query($conexao, $sql);

                    while ($rs_branch = mysqli_fetch_array($select)) { ?>
                        <tr>
                            <td> 
                                <?=$rs_branch['endereco'] . ', ' . $rs_branch['numero'] . ' - ' . $rs_branch['bairro']?>
                            </td>

                            <td> 
                                <?=$rs_branch['cidade']?>
                            </td>

                            <td>
                                <?=$rs_branch['telefone']?>
                            </td>

                            <td class="tbl-enable-disable"> <?php
                                if ($rs_branch['status'])
                                    echo('
                                    <a href="./db/status_filial.php?action=disable&id='. $rs_branch['id'] .'">
                                        <img src="./img/on.png" alt="Desabilitar" title="Desabilitar" /> 
                                    </a>');
                                else   
                                    echo('
                                    <a href="./db/status_filial.php?action=enable&id='. $rs_branch['id'] .'">
                                        <img src="./img/off.png" alt="Habilitar" title="Habilitar" /> 
                                    </a>'); ?>
                            </td>

                            <td>
                                <a href="./filiais.php?action=edit&id=<?=$rs_branch['id']?>">
                                    <img src="./img/edit.png" alt="Editar" title="Editar" />
                                </a>

                                <a href="./db/deletar_filial.php?action=delete&id=<?=$rs_branch['id']?>" onclick="return confirm('Deseja realmente excluir esse registro?');">
                                    <img src="./img/remove.png" alt="Remover" title="Remover" />
                                </a>

                                <a href="#" class="handleModalView" onclick="showModalData(<?=$rs_branch['id']?>);">
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
        <script src="../js/jquery.mask.js"></script>
        <script src="../js/validation.js"></script>
        <script>
            /* Masks */
            $('#txt_cep').mask('00000-000');
            $('#txt_telephone').mask(mascara_telefone, opcoes_telefone);

            /* Search CEP on ViaCEP API */
            $('#txt_cep').keyup(function() {
                if ($('#txt_cep').val().length === 9) {
                    const proxy = 'https://cors-anywhere.herokuapp.com/';
                    const url = `http://www.viacep.com.br/ws/${$('#txt_cep').val()}/json/`;

                    fetch(proxy + url, { mode: 'cors' })
                        .then(res => res.json())
                        .then(data => {
                            $('#txt_district').val(data.bairro);
                            $('#txt_city').val(data.localidade);
                            $('#txt_uf').val(data.uf);
                        });
                }
            });

            /* Search on maps */
            $('#btn_maps').click(function() {
                const address = $('#txt_address').val().replace(' ', '+');
                const number = $('#txt_number').val();
                const city = $('#txt_city').val().replace(' ', '+');

                $('#maps_frame').attr('src', `https://www.google.com/maps/embed/v1/place?key=AIzaSyAGC7WOh5rNNOdzumAcK5Otlrqbi4BYbb4&q=${address},${number},${city})`);
                
                $('#maps_frame').show();
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
                    url: './modal/filial.php',
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