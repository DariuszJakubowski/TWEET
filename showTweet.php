<?php
session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();

include './templates/header.php';
?>
<!-- comment form -->
<form class="container col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-1" action="" method="post">
    <h3>Dodaj komentarz</h3>
    
    <div class="form-group">
        <textarea name="comment_text" placeholder="Skomentuj tweeta..." class="form-control" rows="6"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg">Dodaj komentarz</button>
    </div>    
</form>

<div style="clear: both;"></div>
<hr>
<?php
//tu będzie pojedynczy tweet z możliwością komentowania


require_once './src/classes/autoload.php';
if(!empty($_POST['comment_text']) && isset($_GET['id_tweet'])) {
    $comment = new Comment();
    $comment->setId_user((int)$_SESSION['id_user']);
    $comment->setId_tweet((int)$_GET['id_tweet']);
    $comment->setText($_POST['comment_text']);
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;
    $comment->addComment(DataBase::connect());
    header("Location: ./showUser.php?id={$id_user}");
} 

require './templates/footer.php';