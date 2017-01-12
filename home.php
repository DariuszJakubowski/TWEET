<?php
session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();

include './templates/header.php';
echo '<h1>ZALOGOWANY</H1>';
include './templates/footer.php';
