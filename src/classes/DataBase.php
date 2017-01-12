<?php
//include_once '../config.php';

class DataBase {

    static private $conn;
    
    static public function connect() {
        self::$conn = new mysqli('localhost', 'root', 'adorno', 'tweet');
        mysqli_set_charset(self::$conn, 'UTF8');
        if (self::$conn->connect_error) {
            die("Error: " . self::$conn->connect_errno);
        }
        return self::$conn;
    }
    static public function disconnect() {
        self::$conn->close();
        self::$conn = null;
        return null;
    }
}