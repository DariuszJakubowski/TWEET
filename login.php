<?php
session_start();

require_once './src/functions/functions.php';
redirectIfLoggedIn();

require_once './src/classes/autoload.php';
if(isset($_POST['email']) && isset($_POST['password']) ) {
    $conn = DataBase::connect();
    $user = new User;
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if($user->login($conn, $email, $password)) {
        $_SESSION['id_user'] = $user->getId();
        header('Location: ./home.php');
    }
}

include './templates/header.php';

//info: when You have been registered yet
if(isset($_SESSION['register_done'])) {
    echo '<h3>Rejestracja udana. Teraz możesz się zalogować</h3>';
    unset($_SESSION['register_done']);
}
?>
<div class="container col-sm-4 col-sm-offset-4 col-md-3 col-md-offset-6">

    <form class="form" method="post">
			<fieldset>
                            <legend><h3>Logowanie</h3></legend>
                            <div class="form-group">
				<!--<label for="email">Email</label>-->
				<input type="email" name="email" class="form-control input-lg"  placeholder="tu wpisz swój email">
                            </div>
                            <div class="form-group">
				<!--<label for="password">Hasło</label>-->
                                <input type="password" name="password" class="form-control input-lg"  id="password" placeholder="tu wpisz hasło">
                            </div>
                        
                    
                        <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg">zaloguj</button>
                        </div>
			</fieldset>
                    <p><a href="./register.php">Nie masz konta. Zarejestruj się!</a></p>
		</form>


</div>