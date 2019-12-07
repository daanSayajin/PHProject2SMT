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
        $sql = 'SELECT usuarios.*, niveis.adm_produtos
                FROM usuarios INNER JOIN niveis
                ON usuarios.id_nivel = niveis.id
                WHERE adm_produtos=1 AND usuarios.status=1';
        $select = $this->connection->query($sql);

        $users = array();

        while ($rsUser = $select->fetch(PDO::FETCH_ASSOC)) 
            $users[] = new Login($rsUser['nome'], $rsUser['email'], $rsUser['senha'], $rsUser['id']);

        return $users;
    }

    public function selectById($id) {
        $sql = "SELECT usuarios.*, niveis.adm_produtos
                FROM usuarios INNER JOIN niveis
                ON usuarios.id_nivel = niveis.id
                WHERE adm_produtos=1 AND usuarios.status=1 AND usuarios.id={$id}";
        $select = $this->connection->query($sql);

        $user = array();

        if ($rsUser = $select->fetch(PDO::FETCH_ASSOC)) 
            $user = new Login($rsUser['nome'], $rsUser['email'], $rsUser['senha'], $rsUser['id']);

        return $user;
    }
}
?>