<?php

function redirectIfNotLogged() {
    if (!isset($_SESSION['logged'])) {
    header('Location: ./login.php');    
    }
}

function redirectIfLoggedIn(){
    if(isset($_SESSION['logged'])){
        header('Location: ./home.php');
    }
}

function redirectHome() {
    header('Location: ./home.php');
}