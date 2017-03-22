<?php
class User {

    private $id;
    private $email;
    private $password;
    
    public function __construct() {
        $this->id = -1;
        $this->email = '';
        $this->password = '';
    }
    
    public function getId() {
        return $this->id;
    }
            
    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
        
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password; 
    }
    
    public function getAllUsers(mysqli $conn) {
        $users = [];
        $result = $conn->query('SELECT id, email FROM `user`');
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $newUser = new User;
                $newUser->id = $row['id'];
                $newUser->email = $row['email'];
                $users[] = $newUser;
            }       
        }
        return $users;
    }

    
    public function loadFromDB(mysqli $conn, $id_user) {
        $userToReturn = null;
        $result = $conn->query("SELECT * FROM `user` WHERE id={$id_user}");
        if($result->num_rows === 1) {            
            $row = $result->fetch_assoc();
            $userToReturn = new User();
            $userToReturn->id = $id_user;
            $userToReturn->email = $row['email'];
            $userToReturn->password = $row['password'];         
        }
        return $userToReturn;
    }
    
    public function getUsersActivityInfo(mysqli $conn) {
        $users = [];
            //why LEFT JOIN? when the user don't have tweets
        $result = $conn->query("SELECT user.id, "
                . "user.email, "
                . "COUNT(id_user) AS number_of_tweets "
                . "FROM user left JOIN  tweet "
                . "ON user.id=tweet.id_user "
                . "GROUP BY id_user "
                . "ORDER BY number_of_tweets DESC");
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
               $users[] = [
                   'id_user' => $row['id'],
                   'email' => $row['email'],
                   'number_of_tweets' => $row['number_of_tweets']
                       ];
            }
        }
        return $users;          
    }
    
    public function showEmail(mysqli $conn, $id) {
        $result = $conn->query("SELECT email FROM `user` WHERE id={$id}");
        if($row = $result->fetch_assoc()){
            return $row['email'];
        }     
    }

    public function addUser(mysqli $conn) { 
        $hashedPassword = $this->hashPassword(trim($this->password));
        $stmt = $conn->prepare("INSERT INTO `user` (email, password) "
                . "VALUES( ?, ?)");
        $stmt->bind_param('ss', $this->email, $hashedPassword);
        $stmt->execute(); 
    }
    
    public function delete(mysqli $conn, $id, $email, $password) {
        $result = $conn->query("SELECT * FROM `user` WHERE id = {$id}");
        if($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if($row['id'] === $id && 
                    $row['email'] === $email && 
                    password_verify($password, $row['password'])) {
                
                return $conn->query("DELETE FROM `user` WHERE id = {$id}");
               }
        }
    }

    public function login(mysqli $conn, $email, $password){
        
        $result = $conn->query("SELECT * FROM `user` WHERE email='{$email}'");
        if($result->num_rows === 0) {
            return false;
        } else {
            $row = $result->fetch_assoc();
            if($row['email'] === $email && 
                    password_verify($password, $row['password'])) {
                $this->id = $row['id'];
                $this->email = $row['email'];
                $this->password = $row['password'];
                $_SESSION['logged'] = true;
                return true;
            } else {
                $_SESSION['error_login'] = true;
                return false;
            }
        }    
    }
    
    public function changePassword(mysqli $conn, $password, $id) {
        $this->password = trim($this->hashPassword($password));
        if($conn->query("UPDATE `user` "
                . "SET password='{$this->password}' "
                . "WHERE id={$id}")) {
            return true;
        } 
    }
    
    public function validateEmail(mysqli $conn, $email) {
        $result = $conn->query("SELECT * FROM `user` WHERE email = '{$email}'");
        if($result->num_rows === 1) {
            return '*Taki użytkownik już jest zarejestrowany';
        } 
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false || 
                strlen($email) > 100) {
            return '*Nieprawidłowy format e-mail i/lub za długi ciąg znaków';
        } 
        
        return true;
     
    }
    
    public function validatePassword($pass1, $pass2) {
        
	if( (strlen($pass1) < 8) || (strlen($pass1) > 30) ) {
		return  '*Hasło musi posiadać od 8 do 30 znaków';
        }
        if ($pass1 != $pass2) {
		return  '*Podałaś/eś inne hasła';
	}       
        return true;
    }
    
    private function hashPassword($password) {
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
}
