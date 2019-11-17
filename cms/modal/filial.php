<?php
    if (!file_exists(include_once('../../db/conexao.php')))
        include_once('../../db/conexao.php');

    if (isset($_POST['action'])) {
        if (strtolower($_POST['action']) === 'visualize')  {

            $conexao = conexao_mysql();
            $id = $_POST['id'];
            $sql = "SELECT * FROM filiais WHERE id=" . $id . ";";
            $select = mysqli_query($conexao, $sql);

            if ($rs_branch = mysqli_fetch_array($select)) {
                $address = $rs_branch['endereco'];
                $number = $rs_branch['numero'];
                $city = $rs_branch['cidade'];
                $district = $rs_branch['bairro'];
                $uf = $rs_branch['uf'];
                $cep = $rs_branch['cep'];
                $telephone = $rs_branch['telefone'];
                
                $maps_url = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyAGC7WOh5rNNOdzumAcK5Otlrqbi4BYbb4&q=' . str_replace(' ', '+', $address) . ',' . $number . ',' . str_replace(' ', '+', $city);
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
                <td>Endereço:</td>
                <td><?=$address?></td>
            </tr>

            <tr> 
                <td>Número:</td>
                <td><?=$number?></td>
            </tr>

            <tr> 
                <td>Cidade:</td>
                <td><?=$city?></td>
            </tr>

            <tr> 
                <td>Bairro:</td>
                <td><?=$district?></td>
            </tr>

            <tr> 
                <td>UF:</td>
                <td><?=$uf?></td>
            </tr>

            <tr> 
                <td>CEP:</td>
                <td><?=$cep?></td>
            </tr>

            <tr> 
                <td>Telefone:</td>
                <td><?=$telephone?></td>
            </tr>

            <tr>
                <td colspan="2"> <?php
                    if ($maps_url) { ?>
                        <iframe src="<?=$maps_url?>" allowfullscreen></iframe>
                    <?php } else { ?>
                        -
                    <?php } ?>
                </td>
            </tr>
        </table>
    </body>
</html>