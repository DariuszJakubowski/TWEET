<?php

session_start();
require_once './src/functions/functions.php';

redirectIfNotLogged();

require_once './src/classes/autoload.php';
if(isset($_POST['my_new_pass'])) {
    $user = new User();
    $conn = DataBase::connect();
//    $loggedUser = $user->loadFromDB($conn, $_SESSION['id_user']);
    
    $newPass = !empty($_POST['my_new_pass']) ? $_POST['my_new_pass'] : NULL;
    
    if($newPass != null) {
        $passwordValidation = $user->validatePassword($newPass, $newPass);
        if($passwordValidation === TRUE){
            $user->changePassword($conn, $newPass, $_SESSION['id_user']);
            $_SESSION['info_pass'] = 'Hasło zostało zmienione';
    
        } else {
            $_SESSION['info_pass'] = $passwordValidation;
        }
    }
    $conn = DataBase::disconnect();  
}
require_once './templates/header.php';
?>


<div class="container col-sm-4 col-sm-offset-4 col-md-3 col-md-offset-6">
    <form method="post" class="form">
        <fieldset>
            <h1>Edycja hasła:</h1>
          
            <div class="form-group">
                <input type="password" name="my_new_pass" class="form-control input-lg" placeholder="tu wpisz nowe hasło" id="newPass">
            </div>
            <div class="form-group">
                <input type="submit" value="zmień dane" class="btn btn-success btn-block btn-lg">
            </div>
       
           

        </fieldset>
    </form>
    <button class="btn btn-info btn-block btn-lg" id="showPass">pokaż hasło</button>
<?php 
if(isset($_SESSION['info_pass'])) {
    echo '<h3>' . $_SESSION['info_pass'] . '</h3>';
    unset($_SESSION['info_pass']);
}
?>
</div>

