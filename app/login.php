<?php

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
?>

<div>
    
           <form method="post" >
                <fieldset><legend>Logowanie:</legend>
                    <label>e-mail: </label><br>
                    <input name="email" type="email"><br>
                    <label>password</label><br>
                    <input name="pwd" type="password" /><br>
                    <input type="submit" name="submit" value="log in">
                </fieldset>
           </form>
           <p><a href="./register.php">Nie masz konta. Zarejestruj się!</a></p>
</div>
