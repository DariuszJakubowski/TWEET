<?php

class DataBase {

    static private $conn = null;
    
    static public function connect() {
        if(self::$conn === null){
            self::$conn = new mysqli('localhost', 'root', 'qwerty', 'tweet');
            mysqli_set_charset(self::$conn, 'UTF8');
            if (self::$conn->connect_error) {
                die("Error: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
    static public function disconnect() {
        self::$conn->close();
        return null;
    }
}