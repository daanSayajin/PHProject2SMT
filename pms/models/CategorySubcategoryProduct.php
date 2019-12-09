<?php
class CategorySubcategoryProduct {
    private $category;
    private $subcategory;
    private $product;
    private $id;

    public function __construct(Category $category, Subcategory $subcategory, Product $product, $id = '') {
        $this->category = $category;
        $this->subcategory = $subcategory;
        $this->product = $product;
        $this->id = $id; 
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
    }
    
    public function getSubcategory() {
        return $this->subcategory;
    }

    public function setSubcategory(Subcategory $subcategory) {
        $this->subcategory = $subcategory;
    }
    
    public function getProduct() {
        return $this->product;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}
?>