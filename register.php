<?php

session_start(); 
require_once './src/classes/autoload.php';

if(isset($_POST['email'])) {

    $conn = DataBase::connect();
    $user = new User();
    $email = $_POST['email'];
    
    //validation email
    //return true if is ok, else return string with error info
    $emailValidation = $user->validateEmail($conn, $email);
    
    if($emailValidation === TRUE) {
        $user->setEmail($email);
    } else {
        $_SESSION['error_email'] = $emailValidation;
        unset($email);
    }
    
    if(isset($_POST['reg_pass1']) && isset($_POST['reg_pass2'])) {
        $pass1 = $_POST['reg_pass1'];
	$pass2 = $_POST['reg_pass2'];
    }
    
    //validation pass
    $passwordValidation = $user->validatePassword($pass1, $pass2);
  
    //if validation is done -> save user in database
    if($passwordValidation === TRUE && $emailValidation === TRUE) {
        $user->setPassword($pass1);
        $user->addUser($conn);   
        $_SESSION['register_done'] = TRUE;
        header('Location: ./login.php');
    } 
    
    if(is_string($passwordValidation)) {
        $_SESSION['error_password'] = $passwordValidation;
    }
    
    
    
}
require_once './templates/header.php';
?>


    
<div class="container col-sm-4 col-sm-offset-4 col-md-3 col-md-offset-6">
    <form method="post" class="form">
        <fieldset>
            <label><h3>Rejestracja</h3></label>
            
            <div class="form-group">
                <input type="email" name="email" class="form-control input-lg" id="email" placeholder="E-mail"
                       <?php if(isset($email)) echo "value=\"$email\""; ?> required>

                <?php
		if(isset($_SESSION['error_email'])){
                    echo '<div class="error">' . $_SESSION['error_email'] . '</div>';
                    unset($_SESSION['error_email']);
		}
		?>
            </div>
            <div class="form-group">
                <input type="password" name="reg_pass1" class="form-control input-lg" placeholder="Hasło" required>
		<?php
		if(isset($_SESSION['error_password'])){
                    echo '<h5 class="error">' . $_SESSION['error_password'] . '</h5>';
                    unset($_SESSION['error_password']);
		}
		?>
            </div>
            <div class="form-group">
                <input type="password" name="reg_pass2" class="form-control input-lg" placeholder="Powtórz hasło" required>
            </div>
            <div class="form-group">
                <input type="submit" value="zarejestruj" class="btn btn-success btn-block btn-lg">
            </div>
        </fieldset>
        <p><a href="./login.php">Zaloguj się!</a></p>
    </form>
    <?php
                require './templates/footer.php';
                ?>
</div>
</body>
</html>