<?php
if (!file_exists(include_once('models/DAO/MySqlConnection.php'))) 
    include_once('models/DAO/MySqlConnection.php');

if (!file_exists(include_once('models/Login.php'))) 
    include_once('models/Login.php');

class LoginDAO {
    private $connection;

    public function __construct() {
        $mySqlConnection = new MySqlConnection();
        $this->connection = $mySqlConnection->connect();
    }

    public function selectAll() {
        $sql = 'SELECT * FROM usuarios';
        $select = $this->conexao->query($sql);

        $contatos = array();

        while ($rsUsuarios = $select->fetch(PDO::FETCH_ASSOC)) 
            $contatos[] = new Login($rsUsuarios['email'], $rsUsuarios['senha'], $rsUsuarios['id']);

        return $contatos;
    }
}
?>