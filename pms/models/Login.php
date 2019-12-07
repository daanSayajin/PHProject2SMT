<?php
class Login {
    private $name;
    private $email;
    private $password;
    private $id;

    public function __construct($name, $email, $password, $id = '') {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id; 
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId() {
        return $this->id;
    }
}
?>