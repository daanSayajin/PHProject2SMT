<?php
if (!file_exists(include_once('models/DAO/MySqlConnection.php'))) 
    include_once('models/DAO/MySqlConnection.php');

if (!file_exists(include_once('models/Category.php'))) 
    include_once('models/Category.php');

class CategoryDAO {
    private $connection;

    public function __construct() {
        $mySqlConnection = new MySqlConnection();
        $this->connection = $mySqlConnection->connect();
    }

    public function insert(Category $category) {
        $sql = 'INSERT INTO categorias (nome)
                VALUES (?)';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $category->getName()
        );

        return $stm->execute($stmData);
    }

    public function update(Category $category) {
        $sql = 'UPDATE categorias SET nome=? WHERE id=?';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $category->getName(),
            $category->getId()
        );

        return $stm->execute($stmData);
    }

    public function updateStatus($id, $status) {
        $sql = 'UPDATE categorias SET status=? WHERE id=?';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $status,
            $id
        );

        return $stm->execute($stmData);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM categorias WHERE id={$id}";
    
        return $this->connection->query($sql);
    }

    public function selectAll() {
        $sql = 'SELECT * FROM categorias';
        $select = $this->connection->query($sql);

        $categories = array();

        while ($rsCategory = $select->fetch(PDO::FETCH_ASSOC)) 
            $categories[] = new Category($rsCategory['nome'], $rsCategory['status'], $rsCategory['id']);

        return $categories;
    }

    public function selectById($id) {
        $sql = "SELECT * FROM categorias WHERE id={$id}";
        $select = $this->connection->query($sql);

        $category = array();

        if ($rsCategory = $select->fetch(PDO::FETCH_ASSOC)) 
            $category = new Category($rsCategory['nome'], $rsCategory['status'], $rsCategory['id']);

        return $category;
    }
}
?>