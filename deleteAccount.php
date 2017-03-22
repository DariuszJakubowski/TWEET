<?php

session_start();
require_once './src/functions/functions.php';
redirectIfNotLogged();
require_once './templates/header.php';
?>

<form method="POST" action="" class="container text-danger col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-1">
    <h2 class="">Usuwanie konta</h2>
    <p>Aby usunąc konto musisz wpisać swój email i hasło.</p>
    <div class="form-group">
        <input name="email" type="email" placeholder="tu wpisz swój email" class="form-control input-lg">
    </div>
    <div class="form-group">
        <input name='pwd' type='password' placeholder="tu wpisz swoje hasło" class="form-control input-lg">
    </div>
    <input type="submit" class="btn btn-danger btn-lg" value="potwierdź">       
</form>
<?php

if(isset($_POST['email']) && isset($_POST['pwd'])){
    require_once './src/classes/autoload.php';
    $conn = DataBase::connect();
    $user = new User();
    if($user->delete($conn, $_SESSION['id_user'], $_POST['email'], $_POST['pwd'])){
        echo '<h1>Konto zostało skasowane!</h1>';
        session_destroy();
    } else {
        echo '<h1>Podałeś/aś nie prawidłowe dane</h1>';
    }
} 
require_once './templates/footer.php';
