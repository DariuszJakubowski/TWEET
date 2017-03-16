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

<!-- print tweets & comments -->
<?php
require_once './src/classes/autoload.php';
$conn = DataBase::connect();
$user = new User;
$tweet = new Tweet();
$comment = new Comment();

// zwraca wszystkie komentarze do moich tweetów w formie tabl asocjacyjnej
// z obiektami

$commentsToMyTweets = $comment->loadAllComments($conn, $_SESSION['id_user']);

if($result = $tweet->loadAllTweets($conn, $_SESSION['id_user'])){
    
    echo '<div class=\'container\'>';
    foreach ($result as $row) {
?>        
    <div class='media'>      
        <div class="avatar-circle pull-left">
            <span class="initials media-obiect img-responsive"><?=$row['email'][0] ?> </span>
        </div>        
        <div class='media-body'>
            <h3 class='media-heading'> <?=$row['email'] ?> 
                <a href="./deleteTweet.php?id_tweet=<?=$row['id_tweet'] ?>" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-remove-sign"></span> Usuń
                </a>
            </h3>
            <p id='text-tweet'>
                <a href='./editTweet.php?id_tweet=<?=$row['id_tweet'] ?>'><?=$row['tweet']  ?></a>
            </p>

            <?php
            //print comment if it exist
            if(isset($commentsToMyTweets["{$row['id_tweet']}"])) {
                foreach ($commentsToMyTweets["{$row['id_tweet']}"] as $row_comment) {
                    $currentEmail = $user->showEmail($conn, $row_comment->getId_user());
                    echo "<!-- comment, nested media object -->\n";
                    echo "<div class='media'>\n";
                    echo "    <div class='avatar-circle pull-left'>\n";
                    echo "        <span class='initials media-obiect img-responsive'>{$currentEmail[0]}</span>\n";
                    echo "    </div>";
                    echo "    <div class='media-body'>\n";
                    echo "        <h4 class='media-heading'>{$currentEmail}</h4>\n"; 
                    echo "        <p>{$row_comment->getText()}</p>\n";
                    echo "    </div>\n";
                    echo "</div>\n";
                } 
            }
            ?>
            
        </div>
    </div>
    <br>
<?php
    }
    echo '</div>';
}
$conn = DataBase::disconnect();
require_once './templates/footer.php';
