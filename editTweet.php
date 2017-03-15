<?php

session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();

require_once './src/classes/autoload.php';
require_once './templates/header.php';

if(isset($_GET['id_tweet']) && is_numeric($_GET['id_tweet'])) {
    $id_tweet = $_GET['id_tweet'];
    $conn = DataBase::connect();
    $tweet = new Tweet();
    $tweet = $tweet->loadTweet($conn, $id_tweet);
    $tweetToUpdate = $tweet->getText();
    if(isset($_POST['update_text'])) {
        $tweet->updateTweet($conn, $_POST['update_text'], $_SESSION['id_user']);
        redirectHome();            
    }
} else {
    redirectHome();
}

?>
<!-- edit tweet  -->
<form class="container col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-1" action="" method="post">
    <h3>Edycja</h3>
    
    <div class="form-group">
        <textarea name="update_text"  class="form-control" rows="6"><?=$tweetToUpdate ?></textarea>
    </div>
    
    <div class="form-group">
        <a href="./home.php" type="submit" class="btn btn-default btn-lg">Powrót</a>
        <button type="submit" class="btn btn-primary btn-lg">Edytuj</button>
    </div>    
</form>