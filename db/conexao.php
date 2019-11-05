<?php
    function conexao_mysql() {
        $host = "localhost";
        $user = "root";
        $password = "bcd127";
        $database = "db_frajolas";
        
        return mysqli_connect($host, $user, $password, $database);
    }
?>