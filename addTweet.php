<?php
session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();

if(!isset($_POST['tweet'])) {
    header('Location: ./home.php');
} else {
    require_once './src/classes/autoload.php';
    $post = $_POST['tweet'];
    $conn = DataBase::connect();
    $tweet = new Tweet();
  
//    $post = mysqli_real_escape_string($conn, $post);
    
    if($tweet->addText($conn, $_SESSION['id_user'], $post)) {
        header('Location: ./home.php');
    }
}
