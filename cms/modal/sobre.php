<?php
    if (!file_exists(include_once('../../db/conexao.php')))
        include_once('../../db/conexao.php');

    if (isset($_POST['action'])) {
        if (strtolower($_POST['action']) === 'visualize')  {

            $conexao = conexao_mysql();
            $id = $_POST['id'];
            $sql = "SELECT * FROM sobre_nos WHERE id=" . $id . ";";
            $select = mysqli_query($conexao, $sql);

            if ($rs_about = mysqli_fetch_array($select)) {
                $about = $rs_about['texto'];
                $image = $rs_about['imagem'];
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
                <td>Texto:</td>
                <td><?=$about?></td>
            </tr>

            <tr>
                <td colspan="2"> <?php
                    if ($image) { ?>
                        <img src="db/uploads/<?=$image?>" /> 
                    <?php } else { ?>
                        -
                    <?php } ?>
                </td>
            </tr>
        </table>
    </body>
</html>