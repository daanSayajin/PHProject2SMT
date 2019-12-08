<?php
if (!file_exists(include_once('models/DAO/MySqlConnection.php'))) 
    include_once('models/DAO/MySqlConnection.php');

if (!file_exists(include_once('models/Subcategory.php'))) 
    include_once('models/Subcategory.php');

class SubcategoryDAO {
    private $connection;

    public function __construct() {
        $mySqlConnection = new MySqlConnection();
        $this->connection = $mySqlConnection->connect();
    }

    public function insert(Subcategory $subcategory) {
        $sql = 'INSERT INTO subcategorias (nome)
                VALUES (?)';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $subcategory->getName()
        );

        return $stm->execute($stmData);
    }

    public function update(Subcategory $subcategory) {
        $sql = 'UPDATE subcategorias SET nome=? WHERE id=?';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $subcategory->getName(),
            $subcategory->getId()
        );

        return $stm->execute($stmData);
    }

    
    public function updateStatus($id, $status) {
        $sql = 'UPDATE subcategorias SET status=? WHERE id=?';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $status,
            $id
        );

        return $stm->execute($stmData);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM subcategorias WHERE id={$id}";
    
        return $this->connection->query($sql);
    }

    public function selectAll() {
        $sql = 'SELECT * FROM subcategorias';
        $select = $this->connection->query($sql);

        $subcategories = array();

        while ($rsSubcategory = $select->fetch(PDO::FETCH_ASSOC)) 
            $subcategories[] = new Subcategory($rsSubcategory['nome'], $rsSubcategory['status'], $rsSubcategory['id']);

        return $subcategories;
    }

    public function selectById($id) {
        $sql = "SELECT * FROM subcategorias WHERE id={$id}";
        $select = $this->connection->query($sql);

        $subcategory = array();

        if ($rsSubcategory = $select->fetch(PDO::FETCH_ASSOC)) 
            $subcategory = new Subcategory($rsSubcategory['nome'], $rsSubcategory['status'], $rsSubcategory['id']);

        return $subcategory;
    }
}
?>