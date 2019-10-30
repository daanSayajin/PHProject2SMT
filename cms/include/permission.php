<?php
    if (!isset($_SESSION))
        session_start();

    function hasPermission($permission) {
        $conexao = conexao_mysql();
        $sql = 'SELECT * FROM niveis WHERE id=' . $_SESSION['id_level'] . ';';
        $select = mysqli_query($conexao, $sql);
    
        if ($rs_user = mysqli_fetch_array($select)) {
            if ($rs_user[$permission])
                return true;
        }

        return false;
    }
?>