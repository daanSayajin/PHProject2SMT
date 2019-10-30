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

        $sql = 'SELECT * FROM usuarios WHERE id='. $id . ';';
        $select = mysqli_query($conexao, $sql);

        if ($user = mysqli_fetch_array($select)) {
            $name = $user['nome'];
            $email = $user['email'];
            $level = $user['id_nivel'];
        }

        $button = 'Editar';

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
                    Usuários
                </h2>

                <form name="frm_user" method="POST" action="./db/salvar_usuario.php<?php if (isset($id)) echo('?action=edit&id=' . $id); ?>">
                    <input type="text" name="txt_name" value="<?=@$name?>" placeholder="Nome*" required />
                    <input type="email" name="txt_email" value="<?=@$email?>" placeholder="Email*" required />
                    <label>
                        <input type="password" name="txt_password" id="txt_password" placeholder="Senha*" required>
                        <img src="./img/show.png" id="show-password-img" alt="Mostrar" onclick="showPassword('txt_password', true);" />
                    </label>
                    <select name="slt_level"> 
                        <?php
                        $sql = 'SELECT * FROM niveis;';
                        $select = mysqli_query($conexao, $sql);

                        while ($rs_nivel = mysqli_fetch_array($select)) { 

                            if ($rs_nivel['status']) { ?>
                                <option value="<?=$rs_nivel['id']?>" <?php if ($rs_nivel['id'] === @$level) echo('selected'); ?>>
                                    <?=$rs_nivel['nome']?>
                                </option>
                        <?php }} ?>
                    </select>

                    <input type="submit" name="btn_submit" value="<?=$button?>" />
                </form> 

                <table>
                    <tr id="tbl-header">
                        <td>NOME</td>
                        <td>E-MAIL</td>
                        <td>NIVEL</td>
                        <td>ESTADO</td>
                        <td>OPÇÕES</td>
                    </tr>

                    <?php
                    $sql = 'SELECT usuarios.*, niveis.nome AS nivel   
                    FROM usuarios INNER JOIN niveis
                    ON usuarios.id_nivel = niveis.id';
                    $select = mysqli_query($conexao, $sql);

                    while ($rs_user = mysqli_fetch_array($select)) { ?>
                        <tr>
                            <td><?=$rs_user['nome']?></td>

                            <td><?=$rs_user['email']?></td>

                            <td><?=$rs_user['nivel']?></td>

                            <td class="tbl-enable-disable"> <?php
                                if ($rs_user['status'])
                                    echo('
                                    <a href="./db/status_usuario.php?action=disable&id='. $rs_user['id'] .'">
                                        <img src="./img/on.png" alt="Desabilitar" title="Desabilitar" /> 
                                    </a>');
                                else   
                                    echo('
                                    <a href="./db/status_usuario.php?action=enable&id='. $rs_user['id'] .'">
                                        <img src="./img/off.png" alt="Habilitar" title="Habilitar" /> 
                                    </a>'); ?>
                            </td>

                            <td>
                                <a href="./usuarios.php?action=edit&id=<?=$rs_user['id']?>">
                                    <img src="./img/edit.png" alt="Editar" title="Editar" />
                                </a>

                                <a href="./db/deletar_usuario.php?action=delete&id=<?=$rs_user['id']?>" onclick="return confirm('Deseja realmente excluir esse registro?');">
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

        <script>
            function showPassword(id, replaceImg = false) {
                const $password = document.getElementById(id);
                
                if ($password.type === 'password')
                    $password.type = 'text'
                else
                    $password.type = 'password'
                
                if (replaceImg) {
                    const $img = document.getElementById('show-password-img');
                    
                    if ($password.type === 'password')
                        $img.src = './img/show.png'
                    else
                        $img.src = './img/hide.jpg'
                }
            }
        </script>
    </body>
</html>