<?php

if(isset($_POST['submit'])){
    
    include_once 'dbh.inc.php';
    
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $area = mysqli_real_escape_string($conn, $_POST['area']);
    $block = mysqli_real_escape_string($conn, $_POST['block']);
    $balance = mysqli_real_escape_string($conn, $_POST['balance']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $cpwd = mysqli_real_escape_string($conn, $_POST['cpwd']);
    
    /*echo "$first<br>";
    echo "$last<br>";
    echo "$email<br>";
    echo "$phone<br>";
    echo "$area<br>";
    echo "$block<br>";
    echo "$balance<br>";
    echo "$pwd<br>";
    echo "$cpwd<br>";
    */    
    
    //Error handlers
    //Check for empty fields
    if(empty($first)||empty($last)||empty($email)||empty($phone)||empty($area)||empty($block)||empty($balance)||empty($pwd)||empty($cpwd)){
        header("Location: ../signup.php?signup=empty&first=$first&last=$last&email=$email&phone=$phone&area=$area&block=$block&balance=$balance");
        exit();
    }
    else if($pwd!=$cpwd){
        header("Location: ../signup.php?signup=mismatch");
        exit();
    }
    else{
        //Check if input chars are valid
        if(!preg_match("/^[a-zA-z]*$/",$first)||!preg_match("/^[a-zA-z]*$/",$last)){
        header("Location: ../signup.php?signup=invalid&first=$first&last=$last&email=$email&phone=$phone&area=$area&block=$block&balance=$balance");
        exit();
        }else{
            //check email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
               header("Location: ../signup.php?signup=invalid email");
                exit(); 
            }else{
                $sql="SELECT * FROM users where email='$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck>0){
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                }else{
                    //Hashing the password
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //insert the user into database
                    
                    $sql = "INSERT INTO users(fname,lname,email,pwd,phone_no,area,block,balance)VALUES('$first','$last','$email','$hashedPwd','$phone','$area','$block',{$balance});";
                    mysqli_query($conn, $sql);
                    header("Location: ../signup.php?signup=success");
                    exit();
                    
                }
            }
        }
    }
}
else {
    header("Location: ../signup.php");
    exit();
}















