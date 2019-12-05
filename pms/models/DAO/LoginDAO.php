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
                WHERE adm_produtos=1';
        $select = $this->connection->query($sql);

        $usuarios = array();

        while ($rsUsuario = $select->fetch(PDO::FETCH_ASSOC)) 
            $usuarios[] = new Login($rsUsuario['email'], $rsUsuario['senha'], $rsUsuario['id']);

        return $usuarios;
    }
}
?>