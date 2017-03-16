<?php
//print all users with numbers of tweets

session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();
require_once './src/classes/autoload.php';

$conn = DataBase::connect();
$user = new User();
$allUsers = $user->getUsersActivityInfo($conn);

require_once './templates/header.php';
echo '<ul class=\'list-group col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 \'>'
    . '<h1>Aktywność Squekersów:</h1>';
foreach ($allUsers as $sinlgeUser) {
    echo   "<li class='list-group-item'>"
        . "<a href='./showUser.php?id={$sinlgeUser['id_user']}'>{$sinlgeUser['email']}</a> "
        . "<span class='badge'>{$sinlgeUser['number_of_tweets']}</span>"
        . "</li>";    
}
echo '</ul>';

$conn = DataBase::disconnect();
require './templates/footer.php';
