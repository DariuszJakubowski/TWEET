<?php
//require_once './autoload.php';

class User {

    private $id;
    private $email;
    private $password;
    
    public function __construct() {
        $this->id = -1;
        $this->email = '';
        $this->password = '';
    }
            
    function getEmail() {
        return $this->email;
    }

    function getPwd() {
        return $this->password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password; 
    }
    
//    public function register($email, $pwd, $pwd2){
//        if ($pwd != $pwd2) return;
//        
//        
//        $pwdHashed = sha1($pwd); //32 znaki!
//    }

    public function addUser(mysqli $conn) {
        
        $hashedPassword = $this->hashPassword($this->password);
        $sql = "INSERT INTO user ( email, password) VALUES( ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $this->email, $hashedPassword);
       
        $stmt->execute();
        
         
    
    }
    
    public function login(mysqli $conn, $email, $password){
        
        $sql = "SELECT * FROM `user` WHERE email='$email'";
        $result = $conn->query($sql);
        if($result->num_rows === 0) {
            return false;
        } else {
            $row = $result->fetch_assoc();
            if($row['email'] === $email && password_verify($password, $row['password'])) {
                $_SESSION['logged'] = TRUE;
                return TRUE;
            }
        }
    
    }
    
    public function autoLogin(){
        session_start();
        
        $this->login($_SESSION['email'], $_SESSION['pwd']);
    }
    
    public function logout(){
        $_SESSION['email'] = null;
        $_SESSION['pwd'] = null;
        
        session_destroy();
    }
    
    public function isLogged(){
        return !is_null($_SESSION['email'])/* + isset */;
    }

    
    public function validateEmail(mysqli $conn, $email) {
      
      $sql = "SELECT * FROM `user` WHERE email = '$email'";
      $result = $conn->query($sql);
        if($result->num_rows === 1) {
            return '*Taki użytkownik już jest zarejestrowany';
        } 
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false || strlen($email) > 100) {
            return '*Nieprawidłowy format e-mail i/lub za długi ciąg znaków';
        } 
        
        return TRUE;
     
    }
    
    public function validatePassword($pass1, $pass2) {
        
	if( (strlen($pass1) < 8) || (strlen($pass1) > 30) ) {
		return  '*Hasło musi posiadać od 8 do 30 znaków';
        }
        
        if ($pass1 != $pass2) {
		return  '*Podałaś/eś inne hasła';
	}
        
        return TRUE;
    }
    
    private function hashPassword($password) {
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
    
   
 
}
