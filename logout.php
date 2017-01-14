<?php
session_start();
require_once './templates/header.php';
if(isset($_SESSION['logged']) && ($_SESSION['logged']) === TRUE) {
    echo '<h3> Wylogowałeś/aś się</h3>';
}
session_destroy();
