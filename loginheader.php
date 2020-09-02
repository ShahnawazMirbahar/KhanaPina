<?php

session_start();

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="loginstyle.css">
    <link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
   <script src="Bootstrap\js\bootstrap.min.js"></script>  
    <style>
  #bg #gd
        {
            font-family: Vivaldi;
            font-size: 40px;
            font-weight: 800;
           
        }
      #bg
        {
             background-image: url(img/bg4.jpg);
            background-size: cover;
        }
        
        .nav
        {
            background-color: aqua;
        }
        
        .navbar
        {
            background-color:;
        }
  
    </style>
</head>
<body id="bg">


    
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a id="gd" class="navbar-brand" href="index.php">KhanaPina.com</a>
    </div>
  
    <form class="navbar-form navbar-right" action="includes/login.inc.php" method="POST">
      <div class="form-group">
        <input type="text" name="uemail" class="form-control" placeholder="e-mail">
        <input type="password" name="pwd" class="form-control" placeholder="password">
      </div>
      <button type="submit" name="submit" class="btn btn-success">Login</button>
        <a  href="signup.php"><button type="button" class="btn btn-primary">Sign up</button></a>
    </form>
  </div>
</nav>
    
    