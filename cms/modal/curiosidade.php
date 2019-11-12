<?php
    if (!file_exists(include_once('../../db/conexao.php')))
        include_once('../../db/conexao.php');

    if (isset($_POST['action'])) {
        if (strtolower($_POST['action']) === 'visualize')  {

            $conexao = conexao_mysql();
            $id = $_POST['id'];
            $sql = "SELECT * FROM curiosidades WHERE id=" . $id . ";";
            $select = mysqli_query($conexao, $sql);

            if ($rs_curiosity = mysqli_fetch_array($select)) {
                $curiosity = $rs_curiosity['texto'];
                $image = $rs_curiosity['imagem'];
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
                <td>Curiosidade:</td>
                <td><?=$curiosity?></td>
            </tr>

            <tr>
                <td colspan="2"><img src="db/uploads/<?=$image?>" /></td>
            </tr>
        </table>
    </body>
</html>