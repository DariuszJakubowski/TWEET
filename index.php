<?php

include_once './top.inc.php';

if (!$user->isLogged()){
    header('Location: login.php');
}

include_once './foot.inc.php';
