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
        $_SESSION['email'] = $user->getEmail();
        header('Location: ./home.php');
    }
}

require './templates/header.php';

//confirmation message: when You have been registered
if(isset($_SESSION['register_done'])) {
    echo '<hr><h3>Rejestracja udana. Teraz możesz się zalogować</h3>';
    unset($_SESSION['register_done']);
}
?>
<div class="container col-sm-4 col-sm-offset-4 col-md-3 col-md-offset-6">

    <form class="form" method="post">
			<fieldset>
                            <legend><h3>Logowanie</h3></legend>
                            <div class="form-group">
				<input type="email" name="email" class="form-control input-lg"  placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control input-lg"  id="password" placeholder="Hasło">
                            </div>
                            
<?php
if(isset($_SESSION['error_login'])) {
echo <<<END
                            <div class="form-group">
                                <p class='error'>*Niepoprawny email lub/i hasło</p>
                            </div>
END;
}
unset($_SESSION['error_login']);
?>
                            
                        <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">zaloguj</button>
                        </div>
                        
			</fieldset>
                    <p><a href="./register.php">Nie masz konta. Zarejestruj się!</a></p>
		</form>


</div>

<?php
require_once './templates/footer.php';
