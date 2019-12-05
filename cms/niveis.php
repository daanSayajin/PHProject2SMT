<?php
    if (!file_exists(include_once('../db/conexao.php')))
        include_once('../db/conexao.php');

    if (!file_exists(include_once('./include/permission.php')))
        include_once('./include/permission.php');

    if (!hasPermission('adm_usuarios')) 
        header('location:./'); 

    $button = 'Cadastrar';
    $conexao = conexao_mysql();

    if (isset($_GET['action']) && strtolower($_GET['action']) === 'edit') {
        $id = $_GET['id'];

        $conexao = conexao_mysql();
        $sql = 'SELECT * FROM niveis WHERE id=' . $id . ';';
        $select = mysqli_query($conexao, $sql);

        if ($level = mysqli_fetch_array($select)) {
            $name = $level['nome'];
            $adm_content = $level['adm_conteudo'];
            $adm_contact = $level['adm_contato'];
            $adm_users = $level['adm_usuarios'];
            $adm_products = $level['adm_produtos'];
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
            <div id="handle-users" class="content center">
                <h1> 
                    <strong> Administração de Usuários </strong>
                </h1>   
               
                <h2>
                    Níveis
                </h2>

                <form name="frm_level" method="POST" action="./db/salvar_nivel.php<?php if (isset($id)) echo('?action=edit&id=' . $id); ?>">
                    <input type="text" name="txt_name" value="<?=@$name?>" placeholder="Nome do nível*" required />
                    
                    <div>
                        <label>
                            <input type="checkbox" name="chk_content" <?php if (@$adm_content) echo('checked'); ?>>
                            <span>Administrar Conteúdo</span>
                        </label>
                            
                        <label>
                            <input type="checkbox" name="chk_contact" <?php if (@$adm_contact) echo('checked'); ?>>
                            <span>Administrar Contatos</span>
                        </label>
                            
                        <label>
                            <input type="checkbox" name="chk_users" <?php if (@$adm_users) echo('checked'); ?>>
                            <span>Administrar Usuários</span>
                        </label>

                        <label style="margin-right: 0">
                            <input type="checkbox" name="chk_products" <?php if (@$adm_products) echo('checked'); ?>>
                            <span>Administrar Produtos</span>
                        </label>
                    </div>

                    <input type="submit" name="btn_submit" value="<?=$button?>" />
                </form> 

                <table>
                    <tr id="tbl-header">
                        <td>NOME</td>
                        <td>ADMINISTRAR CONTEÚDO</td>
                        <td>ADMINISTRAR FALE CONOSCO</td>
                        <td>ADMINISTRAR USUÁRIOS</td>
                        <td>ADMINISTRAR PRODUTOS</td>
                        <td>ESTADO</td>
                        <td>OPÇÕES</td>
                    </tr>

                    <?php
                    $sql = "SELECT * from niveis;";
             
                    $select = mysqli_query($conexao, $sql);

                    while ($rs_level = mysqli_fetch_array($select)) { ?>
                        <tr>
                            <td><?=$rs_level['nome']?></td>

                            <td> <?php
                                if ($rs_level['adm_conteudo'])
                                    echo('Sim');
                                else   
                                    echo('Não'); ?>
                            </td>

                            <td> <?php
                                if ($rs_level['adm_contato'])
                                    echo('Sim');
                                else   
                                    echo('Não'); ?>
                            </td>

                            <td> <?php
                                if ($rs_level['adm_usuarios'])
                                    echo('Sim');
                                else   
                                    echo('Não'); ?>
                            </td>

                            <td> <?php
                                if ($rs_level['adm_produtos'])
                                    echo('Sim');
                                else   
                                    echo('Não'); ?>
                            </td>

                            <td class="tbl-enable-disable"> <?php
                                if ($rs_level['status'])
                                    echo('
                                    <a href="./db/status_nivel.php?action=disable&id='. $rs_level['id'] .'">
                                        <img src="./img/on.png" alt="Desabilitar" title="Desabilitar" /> 
                                    </a>');
                                else   
                                    echo('
                                    <a href="./db/status_nivel.php?action=enable&id='. $rs_level['id'] .'">
                                        <img src="./img/off.png" alt="Habilitar" title="Habilitar" /> 
                                    </a>'); ?>
                            </td>

                            <td>
                                <a href="./niveis.php?action=edit&id=<?=$rs_level['id']?>">
                                    <img src="./img/edit.png" alt="Editar" title="Editar" />
                                </a>

                                <a href="./db/deletar_nivel.php?action=delete&id=<?=$rs_level['id']?>" onclick="return confirm('Deseja realmente excluir esse registro?');">
                                    <img src="./img/remove.png" alt="Remover" title="Remover" />
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
    </body>
</html>