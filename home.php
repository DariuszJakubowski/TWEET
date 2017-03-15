<?php
session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();

require_once './templates/header.php';

?>
<!-- tweet form -->
<form class="container col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-1" action="./addTweet.php" method="post">
    <h3>Dodaj Tweet</h3>
    <div class="form-group">
        <textarea name="tweet" placeholder="Tu wpisz Tweeta..." class="form-control" rows="6"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg">Dodaj wpis</button>
    </div>    
</form>
<div style="clear: both;"></div>
<hr>

<!-- print tweets -->
<?php
require_once './src/classes/autoload.php';
$conn = DataBase::connect();
$tweet = new Tweet();

if($result = $tweet->loadAllTweets($conn, $_SESSION['id_user'])){
    
    echo '<div class=\'container\'>';
    foreach ($result as $row) {
?>        
    <div class='media'>
        <a href='' class='pull-left'>
            <img src="./img/empty_awatar.jpg" class="media-obiect img-responsive" alt="empty awatar" />
        </a>
        <div class='media-body'>
            <h3 class='media-heading'><?=$row['email'] ?></h3>
            <p id='text-tweet'>
                <a href='./editTweet.php?id_tweet=<?=$row['id_tweet'] ?>'><?=$row['tweet']  ?></a>
                <a href="./deleteTweet.php?id_tweet=<?=$row['id_tweet'] ?>" type="button" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-remove-sign"></span> Usuń
                </a>
            </p>
        </div>
    </div>
<?php
    }
    echo '</div>';
}
$conn = DataBase::disconnect();
require_once './templates/footer.php';
