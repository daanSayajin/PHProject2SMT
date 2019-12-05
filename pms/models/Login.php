    <?php
class Login {
    private $email;
    private $password;
    private $id;

    public function __construct($email, $password, $id = '') {
        $this->email = $email;
        $this->password = $password;
        $this->id = $id; 
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