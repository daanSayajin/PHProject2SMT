<?php
class MySqlConnection {
    private $host; 
    private $user;
    private $password;
    private $database;

    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->database = "db_frajolas";
    }

    public function connect() {   
        try {
            $connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password);
        } catch(PDOException $err) {
            return $err->getLine() . $err->getMessage();
        }

        return $connection;
    }
}
?>