<?php

session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();

if(isset($_GET['id_tweet']) && is_numeric($_GET['id_tweet'])) {
    require_once './src/classes/autoload.php';
    $tweet = new Tweet();
    $tweet->deleteTweet(DataBase::connect(), $_GET['id_tweet'], $_SESSION['id_user']);
} 
redirectHome();
