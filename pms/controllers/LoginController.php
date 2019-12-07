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
        $users = [];

        foreach($this->loginDAO->selectAll() as $user) {
            array_push($users, array(
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ));
        }

        return json_encode($users);
    }

    public function selectById($id) {
        if ($user = $this->loginDAO->selectById($id)) {
            $user = array(
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            );
        }

        return json_encode($user);
    }
}
?>