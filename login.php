<?php
session_start();
require_once './src/classes/autoload.php';
require_once './src/function/function.php';

//próba zalog tak-> red

$conn = DataBase::connect();

//include_once './top.inc.php';
//
//if ($user->isLogged()){
//    header('Location: index.php');
//}
//
//
////Tutaj już odbieramy dane:
//if(isset($_POST['email'])) {
//    $email = $_POST['email'];
//    $pwd = sha1($_POST['pwd']);
//    $user->login($email, $pwd);
//
//   
//}
include './templates/header.php';

// 
if(isset($_SESSION['register_done'])) {
    echo '<h3>' . $_SESSION['register_done'] . '</h3>';
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
				<input type="text" name="password" class="form-control input-lg"  id="password" placeholder="tu wpisz hasło">
                            </div>
                        
                    
                        <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg">zaloguj</button>
                        </div>
			</fieldset>
                    <p><a href="./register.php">Nie masz konta. Zarejestruj się!</a></p>
		</form>


</div>

