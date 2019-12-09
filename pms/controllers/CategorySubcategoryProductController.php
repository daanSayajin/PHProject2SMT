<?php
if (!file_exists(include_once('models/DAO/CategorySubcategoryProductDAO.php'))) 
    include_once('models/DAO/CategorySubcategoryProductDAO.php');

if (!file_exists(include_once('models/CategorySubcategoryProduct.php'))) 
    include_once('models/CategorySubcategoryProduct.php');

if (!file_exists(include_once('models/Category.php'))) 
    include_once('models/Category.php');

if (!file_exists(include_once('models/Subcategory.php'))) 
    include_once('models/Subcategory.php');

if (!file_exists(include_once('models/Product.php'))) 
    include_once('models/Product.php');

class CategorySubcategoryProductController {
    private $categorySubcategoryProductDAO;
    private $categorySubcategoryProduct;

    public function __construct() {
        $this->categorySubcategoryProductDAO = new CategorySubcategoryProductDAO();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->categorySubcategoryProduct = new CategorySubcategoryProduct(new Category(null, null, $_POST['id_category']), new Subcategory(null, null, $_POST['id_subcategory']), new Product(null, null, null, null, null, null, $_POST['id_product']));
    }

    public function insert() {
        if ($this->categorySubcategoryProductDAO->insert($this->categorySubcategoryProduct)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }
    
    public function deleteByProductId($idProduct) {
        if ($this->categorySubcategoryProductDAO->deleteByProductId($idProduct)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function selectAll() {
        $categoriesSubcategoriesProducts = [];

        foreach($this->categorySubcategoryProductDAO->selectAll() as $categorySubcategoryProduct) {
            array_push($categoriesSubcategoriesProducts, array(
                'id' => $categorySubcategoryProduct->getId(),
                'id_category' => $categorySubcategoryProduct->getCategory()->getId(),
                'id_subcategory' => $categorySubcategoryProduct->getSubcategory()->getId(),
                'id_product' => $categorySubcategoryProduct->getProduct()->getId(),
                'name' => $categorySubcategoryProduct->getProduct()->getName(),
                'description' => $categorySubcategoryProduct->getProduct()->getDescription(),
                'price' => $categorySubcategoryProduct->getProduct()->getPrice(),
                'discount' => $categorySubcategoryProduct->getProduct()->getDiscount(),
                'isProductOfTheMonth' => boolval($categorySubcategoryProduct->getProduct()->getIsProductOfTheMonth()),
                'category' => $categorySubcategoryProduct->getCategory()->getName(),
                'subcategory' => $categorySubcategoryProduct->getSubcategory()->getName(),
                'status' => boolval($categorySubcategoryProduct->getProduct()->getStatus())
            ));
        }

        return json_encode($categoriesSubcategoriesProducts);
    }

    public function selectByProductId($idProduct) {
        $categoriesSubcategoriesProducts = [];

        foreach($this->categorySubcategoryProductDAO->selectByProductId($idProduct) as $categorySubcategoryProduct) {
            array_push($categoriesSubcategoriesProducts, array(
                'id' => $categorySubcategoryProduct->getId(),
                'id_category' => $categorySubcategoryProduct->getCategory()->getId(),
                'id_subcategory' => $categorySubcategoryProduct->getSubcategory()->getId(),
                'id_product' => $categorySubcategoryProduct->getProduct()->getId(),
                'name' => $categorySubcategoryProduct->getProduct()->getName(),
                'description' => $categorySubcategoryProduct->getProduct()->getDescription(),
                'price' => $categorySubcategoryProduct->getProduct()->getPrice(),
                'discount' => $categorySubcategoryProduct->getProduct()->getDiscount(),
                'isProductOfTheMonth' => boolval($categorySubcategoryProduct->getProduct()->getIsProductOfTheMonth()),
                'category' => $categorySubcategoryProduct->getCategory()->getName(),
                'subcategory' => $categorySubcategoryProduct->getSubcategory()->getName(),
                'status' => boolval($categorySubcategoryProduct->getProduct()->getStatus())
            ));
        }

        return json_encode($categoriesSubcategoriesProducts);
    }

    public function selectByCategoryId($idCategory) {
        $categoriesSubcategoriesProducts = [];

        foreach($this->categorySubcategoryProductDAO->selectByCategoryId($idCategory) as $categorySubcategoryProduct) {
            array_push($categoriesSubcategoriesProducts, array(
                'id' => $categorySubcategoryProduct->getId(),
                'id_category' => $categorySubcategoryProduct->getCategory()->getId(),
                'id_subcategory' => $categorySubcategoryProduct->getSubcategory()->getId(),
                'id_product' => $categorySubcategoryProduct->getProduct()->getId(),
                'name' => $categorySubcategoryProduct->getProduct()->getName(),
                'description' => $categorySubcategoryProduct->getProduct()->getDescription(),
                'price' => $categorySubcategoryProduct->getProduct()->getPrice(),
                'discount' => $categorySubcategoryProduct->getProduct()->getDiscount(),
                'isProductOfTheMonth' => boolval($categorySubcategoryProduct->getProduct()->getIsProductOfTheMonth()),
                'category' => $categorySubcategoryProduct->getCategory()->getName(),
                'subcategory' => $categorySubcategoryProduct->getSubcategory()->getName(),
                'status' => boolval($categorySubcategoryProduct->getProduct()->getStatus())
            ));
        }

        return json_encode($categoriesSubcategoriesProducts);
    }
    
    public function selectBySubcategoryId($idSubcategory) {
        $categoriesSubcategoriesProducts = [];

        foreach($this->categorySubcategoryProductDAO->selectBySubcategoryId($idSubcategory) as $categorySubcategoryProduct) {
            array_push($categoriesSubcategoriesProducts, array(
                'id' => $categorySubcategoryProduct->getId(),
                'id_category' => $categorySubcategoryProduct->getCategory()->getId(),
                'id_subcategory' => $categorySubcategoryProduct->getSubcategory()->getId(),
                'id_product' => $categorySubcategoryProduct->getProduct()->getId(),
                'name' => $categorySubcategoryProduct->getProduct()->getName(),
                'description' => $categorySubcategoryProduct->getProduct()->getDescription(),
                'price' => $categorySubcategoryProduct->getProduct()->getPrice(),
                'discount' => $categorySubcategoryProduct->getProduct()->getDiscount(),
                'isProductOfTheMonth' => boolval($categorySubcategoryProduct->getProduct()->getIsProductOfTheMonth()),
                'category' => $categorySubcategoryProduct->getCategory()->getName(),
                'subcategory' => $categorySubcategoryProduct->getSubcategory()->getName(),
                'status' => boolval($categorySubcategoryProduct->getProduct()->getStatus())
            ));
        }

        return json_encode($categoriesSubcategoriesProducts);
    }
}
?>