<?php
if (!file_exists(include_once('models/Category.php'))) 
    include_once('models/Category.php');

if (!file_exists(include_once('models/DAO/CategoryDAO.php'))) 
    include_once('models/DAO/CategoryDAO.php');

class CategoryController {
    private $categoryDAO;
    private $category;

    public function __construct() {
        $this->categoryDAO = new CategoryDAO();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->category = new Category($_POST['name']);
    }

    public function insert() {
        if ($this->categoryDAO->insert($this->category)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function update($id) {
        $this->category->setId($id);

        if ($this->categoryDAO->update($this->category)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');
        
        return json_encode($json);
    }

    public function updateStatus($id, $status) {
        if ($this->categoryDAO->updateStatus($id, $status === 'true' ? 1 : 0)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');
        
        return json_encode($json);
    }

    public function delete($id) {
        if ($this->categoryDAO->delete($id)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function selectAll() {
        $categories = [];

        foreach($this->categoryDAO->selectAll() as $category) {
            array_push($categories, array(
                'id' => $category->getId(),
                'name' => $category->getName(),
                'status' => boolval($category->getStatus())
            ));
        }

        return json_encode($categories);
    }

    public function selectById($id) {
        if ($category = $this->categoryDAO->selectById($id)) {
            $category = array(
                'id' => $category->getId(),
                'name' => $category->getName(),
                'status' => boolval($category->getStatus())
            );
        }

        return json_encode($category);
    }
}
?>