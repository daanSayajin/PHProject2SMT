<?php
if (!file_exists(include_once('models/Subcategory.php'))) 
    include_once('models/Subcategory.php');

if (!file_exists(include_once('models/DAO/SubcategoryDAO.php'))) 
    include_once('models/DAO/SubcategoryDAO.php');
        
class SubcategoryController {
    private $subcategoryDAO;
    private $subcategory;

    public function __construct() {
        $this->subcategoryDAO = new SubcategoryDAO();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->subcategory = new Subcategory($_POST['name']);
    }

    public function insert() {
        if ($this->subcategoryDAO->insert($this->subcategory)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function update($id) {
        $this->subcategory->setId($id);

        if ($this->subcategoryDAO->update($this->subcategory)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function updateStatus($id, $status) {
        if ($this->subcategoryDAO->updateStatus($id, $status === 'true' ? 1 : 0)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');
        
        return json_encode($json);
    }

    public function delete($id) {
        if ($this->subcategoryDAO->delete($id)) 
            $json = array('status' => 'ok');
        else
            $json = array('status' => 'error');

        return json_encode($json);
    }

    public function selectAll() {
        $subcategories = [];

        foreach($this->subcategoryDAO->selectAll() as $subcategory) {
            array_push($subcategories, array(
                'id' => $subcategory->getId(),
                'name' => $subcategory->getName(),
                'status' => boolval($subcategory->getStatus())
            ));
        }
        
        return json_encode($subcategories);
    }

    public function selectById($id) {
        if ($subcategory = $this->subcategoryDAO->selectById($id)) {
            $subcategory = array(
                'id' => $subcategory->getId(),
                'name' => $subcategory->getName(),
                'status' => boolval($subcategory->getStatus())
            );
        }

        return json_encode($subcategory);
    }
}
?>