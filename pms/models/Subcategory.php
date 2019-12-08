<?php
class Subcategory {
    private $name;
    private $status;
    private $id;

    public function __construct($name, $status = true, $id = '') {
        $this->name = $name;
        $this->status = $status;
        $this->id = $id; 
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

	public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}
?>