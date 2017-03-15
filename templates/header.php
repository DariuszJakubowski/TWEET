<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Tweet</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="./js/functions.js"></script>
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    
<!-- navigation -->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="./index.php">SQUEK-TWEET</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="./home.php">Mój SquekTweet<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./home.php">Moje wpisy</a></li>
            <li><a href="./editPass.php">Zmiana hasła</a></li>
          </ul>
        <li><a href="./showAllUsers.php">Użytkownicy</a></li>
        <li><a href="./logout.php">Wyloguj</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Logowanie</a></li>
        <li><a href="./register.php"><span class="glyphicon glyphicon-user"></span> Rejestracja</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- end navigation -->    

<div id="content" class="container-fluid">
