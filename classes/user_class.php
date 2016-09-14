<?php

class User {
    private $email;
    private $pwd;
    
    function getEmail() {
        return $this->email;
    }

    function getPwd() {
        return $this->pwd;
    }

    function setEmail($email) {
        //Logika sprawdzania czy już istnieje
        $this->email = $email;
    }

    function setPwd($pwd, $pwd2) {
        if ($pwd == $pwd2){
            $this->pwd = sha1($pwd);
        }
    }
    
    public function register($email, $pwd, $pwd2){
        if ($pwd != $pwd2) return;
        
        //Dzięki linijce niżej mamy w $pwdHashed bezpiecznie hasło
        $pwdHashed = sha1($pwd); //32 znaki!
    }
    
    public function login($email, $sha1Pwd){
        //W bazie szukamy osoby z tym loginem i z hasłem sha1($pwd)
        //Jeżeli znajdzie 1 osobę to zalogowany. Jak 0 to zły login lub hasło.
        
        //W sesji przechowuj informacje!
        
        $_SESSION['email'] = $email;
        $_SESSION['pwd'] = $sha1Pwd;
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
    
    public function getMyMsgs(){
        
    }
    
    public function getMyEntries(){
        
    }
    
    
    private function loadDataFromDb(){
        
    }
}
