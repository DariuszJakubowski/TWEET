<?php
session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();
$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id_user'];
require_once './src/classes/autoload.php';
require_once './templates/header.php';
$conn = DataBase::connect();
$tweet = new Tweet();
if($allTweets = $tweet->loadAllTweets($conn, $id)){ 

echo '<div class=\'container\'>';
echo '<h1>Tweety ' . $allTweets[0]['email'] . '</h1><hr>';
foreach ($allTweets as $row) {
        
echo <<<END

    <div class='media'>
        <a href='' class='pull-left'>
            <img src="./img/empty_awatar.jpg" class="media-obiect img-responsive" alt="empty awatar" />
        </a>
        <div class='media-body'>
            <h3 class='media-heading'>{$row['email']}</h3>
            <p><a href='./showTweet.php?id_user={$row['id_user']}&id_tweet={$row['id_tweet']}'>{$row['tweet']}</a></p>          
        </div>
    </div>

END;
    }
echo '</div>';


}
$conn = DataBase::disconnect();
require './templates/footer.php';
