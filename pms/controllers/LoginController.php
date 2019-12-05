<?php
if (!file_exists(include_once('models/Login.php'))) 
    include_once('models/Login.php');

if (!file_exists(include_once('models/DAO/LoginDAO.php'))) 
    include_once('models/DAO/LoginDAO.php');

class LoginController {
    private $loginDAO;

    public function __construct() {
        $this->loginDAO = new LoginDAO();
    }

    public function selectAll() {
        $logins = [];

        foreach($this->loginDAO->selectAll() as $login) {
            array_push($logins, array(
                'id' => $login->getId(),
                'email' => $login->getEmail(),
                'password' => $login->getPassword()
            ));
        }

        return json_encode($logins);
    }
}
?>