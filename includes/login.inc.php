<?php

session_start();

if(isset($_POST['submit'])){
    include_once 'dbh.inc.php';
    
    $email = mysqli_real_escape_string($conn ,$_POST['uemail']);
    $pwd = mysqli_real_escape_string($conn ,$_POST['pwd']);
    
    
    //Error handlers
    //check if inputs are empty
    
    if(empty($email)||empty($pwd)){
        header("Location:../index.php?login=error&id=1");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn ,$sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck <1){
            header("Location:../index.php?login=error&id=2");
            exit();
        }else {
            if($row = mysqli_fetch_assoc($result)){
                //Dehashing password
                $hashedPwdCheck = password_verify($pwd, $row['pwd']);
                if($hashedPwdCheck==false){
                    header("Location:../index.php?login=error&id=3");
                    exit();
                }
                else if($hashedPwdCheck==true){
                    //Log in the user here
                    $_SESSION['id']=$row['user_id'];
                    $_SESSION['fname']=$row['fname'];
                    $_SESSION['lname']=$row['lname'];
                    $_SESSION['email']=$row['email'];
                    header("Location:../home.php?login=success&id=4");
                   // echo $_SESSION['id'];
                    exit();
                }
            }
        }
        
    }
}
else
{
    header("Location:../index.php?login=error&id=5");
    exit();
}

?>