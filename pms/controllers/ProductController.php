<?php
if (!file_exists(include_once('models/Product.php'))) 
    include_once('models/Product.php');

if (!file_exists(include_once('models/DAO/ProductDAO.php'))) 
    include_once('models/DAO/ProductDAO.php');

class ProductController {
    private $productDAO;
    private $product;

    public function __construct() {
        $this->productDAO = new ProductDAO();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->product = new Product($_POST['name'], $_POST['description'], $_POST['price'], $_POST['discount'], $_POST['isProductOfTheMonth'] === 'true' ? 1 : 0);
    }

    public function insert() {
        $insert = $this->productDAO->insert($this->product);

        if ($insert[0]) 
            $json = array('status' => 'ok', 'insertedId' => $insert[1]);
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function update($id) {
        $this->product->setId($id);

        if ($this->productDAO->update($this->product)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function updateStatus($id, $status) {
        if ($this->productDAO->updateStatus($id, $status === 'true' ? 1 : 0)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');
        
        return json_encode($json);
    }

    public function delete($id) {
        if ($this->productDAO->delete($id)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function selectAll() {
        $products = [];

        foreach($this->productDAO->selectAll() as $product) {
            array_push($products, array(
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
                'discount' => $product->getDiscount(),
                'isProductOfTheMonth' => boolval($product->getIsProductOfTheMonth()),
                'status' => boolval($product->getStatus())
            ));
        }

        return json_encode($products);
    }

    public function selectById($id) {
        if ($product = $this->productDAO->selectById($id)) {
            $product = array(
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
                'discount' => $product->getDiscount(),
                'isProductOfTheMonth' => boolval($product->getIsProductOfTheMonth()),
                'status' => ($product->getStatus())
            );
        }

        return json_encode($product);
    }
}
?>