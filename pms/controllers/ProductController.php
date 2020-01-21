<?php
if (!file_exists(include_once('models/Product.php'))) 
    include_once('models/Product.php');

if (!file_exists(include_once('models/DAO/ProductDAO.php'))) 
    include_once('models/DAO/ProductDAO.php');

if (!file_exists(include_once('../cms/include/upload.php'))) 
    include_once('../cms/include/upload.php');

class ProductController {
    private $productDAO;
    private $product;

    public function __construct() {
        $this->productDAO = new ProductDAO();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->product = new Product($_POST['name'], $_POST['description'], $_POST['price'], $_POST['discount'], $_POST['isProductOfTheMonth'] === 'true' ? 1 : 0);
    }

    public function insert() {
        $uploadedFile = uploadImage('image', 'uploads/');

        if (!$uploadedFile) 
            $json = array('status' => 'error');
        else {
            $this->product->setImagePath($uploadedFile);
            $insert = $this->productDAO->insert($this->product);

            if ($insert[0]) 
                $json = array('status' => 'ok', 'insertedId' => $insert[1]);
            else
                $json = array('status' => 'error');
        }   

        return json_encode($json);
    }

    public function update($id) {
        $this->product->setId($id);

        if (isset($_FILES['image'])) {
            $uploadedFile = uploadImage('image', 'uploads/');

            if (!$uploadedFile)
                $json = array('status' => 'error');
            else {
                $this->product->setImagePath($uploadedFile);

                $product = $this->productDAO->selectById($id);
                unlink('uploads/' . $product->getImagePath());
            }
        }

        if ($this->productDAO->update($this->product, isset($_FILES['image']) ? true : false)) 
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

    public function incrementClick($id) {
        if ($this->productDAO->incrementClick($id))
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function delete($id) {
        $product = $this->productDAO->selectById($id);
        unlink('uploads/' . $product->getImagePath());

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
                'image' => $product->getImagePath(),
                'clicks' => $product->getClicks(),
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
                'image' => $product->getImagePath(),
                'clicks' => $product->getClicks(),
                'status' => ($product->getStatus())
            );
        }

        return json_encode($product);
    }
}
?>