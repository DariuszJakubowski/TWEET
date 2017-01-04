<?php

session_start(); 
require_once '../src/classes/autoload.php';

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
    }
    
    if(isset($_POST['reg_pass1']) && isset($_POST['reg_pass2'])) {
        $pass1 = $_POST['reg_pass1'];
	$pass2 = $_POST['reg_pass2'];
    }
    
    //validation pass
    $passwordValidation = $user->validatePassword($pass1, $pass2);
  
    //sign up
    if($passwordValidation === TRUE && $emailValidation === TRUE) {
        $user->setPassword($pass1);
        $user->addUser($conn);   
    } 
    
    if(is_string($passwordValidation)) {
        $_SESSION['error_password'] = $validationIsDone;
    }
    
    $conn = DataBase::disconnect();
    
}

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Tweet rejestracja</title>
	
	<link href="style.css" rel="stylesheet">
	
</head>

<body>
<div id='container'>
	<form method="post">
		<fieldset><legend>Rejestracja</legend>
			
                    E-mail: <br> <input type="text" name="email" required> <br>
			<?php
				if(isset($_SESSION['error_email'])){
				echo '<div class="error">' . $_SESSION['error_email'] . '</div>';
				unset($_SESSION['error_email']);
			}
			?>
			Hasło: <br> <input type="password" name="reg_pass1" required><br>
				<?php
				if(isset($_SESSION['error_password'])){
				echo '<div class="error">' . $_SESSION['error_password'] . '</div>';
				unset($_SESSION['error_password']);
			}
			?>
			Powtórz hasło: <br> <input type="password" name="reg_pass2" required> <br>
		
			<br> <input type="submit" value="Sign up">

		</fieldset>
	</form>
</div>
</body>
</html>


