<?php
session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();
//jeśli nie jest ustawiony id w tabl GET wrzuć tam id zalogowanego
$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id_user'];
require_once './src/classes/autoload.php';
require_once './templates/header.php';
$conn = DataBase::connect();
$tweet = new Tweet();
$user = new User();
$comment = new Comment();
$commentsToTweets = $tweet->loadAllTweets($conn, $id);

if($allTweets = $tweet->loadAllTweets($conn, $id)){ 

echo '<div class=\'container\'>';
echo '<h1>Tweety ' . $allTweets[0]['email'] . '</h1><hr>';
foreach ($allTweets as $row) {
?>

    <div class='media'>
         <div class="avatar-circle pull-left">
            <span class="initials media-obiect img-responsive"><?=$row['email'][0] ?> </span>
        </div>   
        <div class='media-body'>
            <h3 class='media-heading'><?=$row['email'] ?></h3>
            <p>
                <a href='./showTweet.php?id_user=<?php echo $row['id_user'] . '&id_tweet=' . $row['id_tweet']; ?>'>
                    <?=$row['tweet'] ?>
                </a>
            </p>
            <?php
            if(isset($commentsToTweets["{$row['id_tweet']}"])) {
                foreach ($commentsToTweets["{$row['id_tweet']}"] as $row_comment) {
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

<?php
    }
echo '</div>';


}
$conn = DataBase::disconnect();
require './templates/footer.php';
