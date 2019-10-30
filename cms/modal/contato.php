<?php
    if (!file_exists(include_once('../../db/conexao.php')))
        include_once('../../db/conexao.php');

    if (isset($_POST['action'])) {
        if (strtolower($_POST['action']) === 'visualize')  {

            $conexao = conexao_mysql();
            $id = $_POST['id'];
            $sql = "SELECT * FROM contatos WHERE id=" . $id . ";";
            $select = mysqli_query($conexao, $sql);

            if ($rs_contato = mysqli_fetch_array($select)) {
                $nome = $rs_contato['nome'];
                $telefone = $rs_contato['telefone'];
                $celular = $rs_contato['celular'];
                $email = $rs_contato['email'];
                $home_page = $rs_contato['home_page'];
                $facebook = $rs_contato['facebook'];
                $sugestao_critica = $rs_contato['sugestao_critica'];
                $mensagem = $rs_contato['mensagem'];
                $sexo = $rs_contato['sexo'];
                $profissao = $rs_contato['profissao'];
            }
        }
    }
?>
<html>
    <head>

    </head>

    <body>
        <table border='1'>
            <tr> 
                <td>Nome:</td>
                <td><?=$nome?></td>
            </tr>

            <tr> 
                <td>Telefone:</td>
                <td><?=$telefone?></td>
            </tr>

            <tr> 
                <td>Celular:</td>
                <td><?=$celular?></td>
            </tr>

            <tr> 
                <td>E-mail:</td>
                <td><?=$email?></td>
            </tr>

            <tr> 
                <td>Homepage:</td>
                <td><?=$home_page?></td>
            </tr>

            <tr> 
                <td>Facebook:</td>
                <td><?=$facebook?></td>
            </tr>

            <tr> 
                <td>Sugestão/Crítica:</td>
                <td>
                    <?php
                    if ($sugestao_critica === 'critica')
                        echo('Crítica');
                    elseif ($sugestao_critica === 'sugestao')
                        echo('Sugestão'); 
                    ?>
                </td>
            </tr>

            <tr> 
                <td>Mensagem:</td>
                <td><?=$mensagem?></td>
            </tr>

            <tr> 
                <td>Sexo:</td>
                <td>
                    <?php
                    if ($sexo === 'M')
                        echo('Masculino');
                    elseif ($sexo === 'F')
                        echo('Feminino'); 
                    ?>
                </td>
            </tr>

            <tr> 
                <td>Profissão:</td>
                <td><?=$profissao?></td>
            </tr>
        </table>
    </body>
</html>