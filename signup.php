<!DOCTYPE html>

<?php
    include_once 'loginheader.php'
?>

<head>

<style>
    
    .bg
    {
        background-image: url(img/bg4.jpg);
        background-size:cover;
        
    }
    
    .sign_up
    {
        float: left;
        padding-left: 50px;
        margin-left: 50px;
    }
    
    .signup-form input
    {
        opacity: .8;
        
        color:;
        border-color:black;
        
        
    }
    
    #h2s
    {
        font-family: Vladimir Script Regular;
        font-weight: 800;
        font-size: 59px;
        color: white;
    }
    
    
    </style>

</head>

<body class="bg">
    <section class="main-container">
        <div class="sign_up">
            <h2 id="h2s">Sign Up</h2>
            <form class="signup-form" action="includes/signup.inc.php" method="POST">
                <input type="text" name = "first" placeholder="First Name">
                <input type="text" name = "last" placeholder="Last Name">
                <input type="email" name = "email" placeholder="E-mail">
                <input type="text" name = "phone" placeholder="Phone No">
                <input type="text" name = "area" placeholder="Area">
                <input type="text" name = "block" placeholder="Block">
                <input type="number" name = "balance" placeholder="Balance">
                <input type="password" name = "pwd" placeholder="password">
                <input type="password" name = "cpwd" placeholder="Confirm password">
                <button type="submit" name="submit">Sign up</button>
                
            </form>
        </div>
    </section>
</body>
<?php
        
        
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if(!isset($_GET['signup'])){
        exit();
    }
    else 
    {
    $signup = $_GET['signup'] ;
    if($signup=="empty"){
        echo "<p class='error'> You did not fill in all fields!</p>";
    }
    else if($signup=="mismatch"){
        echo "<p class='error'> Your password didn't match!</p>";
    }
    else if($signup=="invalid"){
        echo "<p class='error'>User name is invalid!</p>";
    }
    else if($signup=="invalid email"){
        echo "<p class='error'> Your email address is invalid!</p>";
    }
    else if($signup=="usertaken"){
        echo "<p class='error'> This email already has an user!</p>";
    }
    else if($signup=="success"){
        echo "<p class='success'>You have been signed up!</p>";
    } 
           
    }

?>

<?php
    include_once 'loginfooter.php';
?>
