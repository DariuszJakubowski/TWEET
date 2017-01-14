<?php
session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();

include './templates/header.php';

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

<!-- tweets -->
<?php
require_once './src/classes/autoload.php';
$conn = DataBase::connect();
$tweet = new Tweet();

$result = $tweet->getAllMyTweets($conn, $_SESSION['id_user']);

if($result->num_rows > 0) {
    echo '<div class=\'container\'>';
    while ($row = $result->fetch_assoc()) {
        
echo <<<END

    <div class='media'>
        <a href='' class='pull-left'>
            <img src="./img/empty_awatar.jpg" class="media-obiect img-responsive" alt="empty awatar" />
        </a>
        <div class='media-body'>
            <h3 class='media-heading'>{$row['user']}</h3>
            <p>{$row['tweet']}</p>
        </div>
    </div>

\n
END;
    }
    echo '</div>';
}


$conn = DataBase::disconnect();
