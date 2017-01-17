<?php
//wyświetla użytowników z możliowścią podglądu ich tweetów
//możliwość komentowania 
session_start();
require_once './src/functions/functions.php';

redirectIfNotLogged();


require_once './src/classes/autoload.php';

$conn = DataBase::connect();
$user = new User();
$allUsers = $user->getAllUsers($conn);
require_once './templates/header.php';
foreach ($allUsers as $oneUser) {
echo <<<END
<div>
    <a href="./showUser.php?id={$oneUser->getId()}">{$oneUser->getEmail()}</a>
</div>
END;
}

$conn = DataBase::disconnect();

