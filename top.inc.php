<?php

$conn = new mysqli('localhost', 'root', '', 'tweet');

include_once './classes/user_class.php';

$user = new User();
$user->autoLogin();
