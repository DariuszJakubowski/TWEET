<?php
session_start();


if (isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE) {
    header('Location: ./home.php');
} else {
    header("Location: ./login.php");
}


