<?php
if (!file_exists(include_once('models/DAO/MySqlConnection.php'))) 
    include_once('models/DAO/MySqlConnection.php');

if (!file_exists(include_once('models/Product.php'))) 
    include_once('models/Product.php');

class ProductDAO {
    private $connection;

    public function __construct() {
        $mySqlConnection = new MySqlConnection();
        $this->connection = $mySqlConnection->connect();
    }

    public function insert(Product $product) {
        $sql = 'INSERT INTO produtos (nome, descricao, preco, desconto, produto_mes)
                VALUES (?, ?, ?, ?, ?)';

        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $product->getName(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getDiscount(),
            $product->getIsProductOfTheMonth()
        );

        return $stm->execute($stmData);
    }

    public function update(Product $product) {
        $sql = 'UPDATE produtos SET nome=?, descricao=?, preco=?, desconto=?, produto_mes=? WHERE id=?';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $product->getName(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getDiscount(),
            $product->getIsProductOfTheMonth(),
            $product->getId()
        );

        return $stm->execute($stmData);
    }

    public function updateStatus($id, $status) {
        $sql = 'UPDATE produtos SET status=? WHERE id=?';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $status,
            $id
        );

        return $stm->execute($stmData);
    }

    public function delete($id) {
        $sql = "DELETE FROM produtos WHERE id={$id}";
    
        return $this->connection->query($sql);
    }

    public function selectAll() {
        $sql = 'SELECT * FROM produtos';
        $select = $this->connection->query($sql);

        $products = array();

        while ($rsProduct = $select->fetch(PDO::FETCH_ASSOC)) 
            $products[] = new Product($rsProduct['nome'], $rsProduct['descricao'], $rsProduct['preco'], $rsProduct['desconto'], $rsProduct['produto_mes'], $rsProduct['status'], $rsProduct['id']);

        return $products;
    }

    public function selectById($id) {
        $sql = "SELECT * FROM produtos WHERE id={$id}";
        $select = $this->connection->query($sql);

        $product = array();

        if ($rsProduct = $select->fetch(PDO::FETCH_ASSOC)) 
            $product = new Product($rsProduct['nome'], $rsProduct['descricao'], $rsProduct['preco'], $rsProduct['desconto'], $rsProduct['produto_mes'], $rsProduct['status'], $rsProduct['id']);

        return $product;
    }
}
?>