<?php
session_start();
if(isset($_SESSION['logged']) && ($_SESSION['logged']) === TRUE) {
    unset($_SESSION['logged']);
    $_SESSION['logout'] = TRUE;
}

header("Location: ./login.php");
