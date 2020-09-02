<?php
session_start();

$id=$_SESSION['id'];

if(isset($_POST['submit'])){
    include_once 'dbh.inc.php';
    $query = "SELECT * FROM users WHERE user_id = {$id}";
    $results = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($results);
    $oldpwd=$_POST['opwd'];
    $pwd=$result['pwd'];
    $newpwd=$_POST['npwd'];
    $cpwd=$_POST['cpwd'];
    
    if(empty($oldpwd)||empty($newpwd)){
        header("Location: chnpwd.inc.php?status=notupdated");
        exit();
    }
    else if($cpwd!=$newpwd){
        header("Location: chnpwd.inc.php?status=newpwdmismatch");
        exit();
    }
    else {
                //Dehashing password
                $hashedPwdCheck = password_verify($oldpwd, $pwd);
                if($hashedPwdCheck==false){
                    header("Location: chnpwd.inc.php?status=mismatch");
                    exit();
                }
                else if($hashedPwdCheck==true){
                    $hashedPwd = password_hash($newpwd, PASSWORD_DEFAULT);
                    $query = "update users set 
		              pwd='$hashedPwd' where user_id = {$id}";
                    if(mysqli_query($conn,$query)){
			         header("Location: ../userprofile.php?status=updated");
                        exit();
		              
                    }
        
    }
}
}
    

?>


<html>
<head>
<title>Edit|profile</title>
<link rel="stylesheet" href="..\Bootstrap\css\bootstrap.min.css">
   <script src="..\Bootstrap\js\bootstrap.min.js"></script>  
    
    <style>
    
       #bg
    {
       background-image: url(../img/bg_profile2.jpg);
        background-size: cover;
        background-position: center;
    }
    </style>
</head>

<body id="bg">
    <div class="container">
    <h1>Update Password</h1>
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
			<div class="form-group">
				<label>Old Password</label>
				<input type="text" name="opwd" class="form-control" placeholder="old password">	
			</div>
			<div class="form-group">
				<label>New Password</label>
				<input type="text" name="npwd" class="form-control" placeholder="new password">	
			</div>
            <div class="form-group">
				<label>Confirm New Password</label>
				<input type="text" name="cpwd" class="form-control" placeholder="confirm new password">	
			</div>
        
        <input type="submit" name="submit" value="submit" class="btn btn-primary">
        <a class = "btn btn-primary" href="../userprofile.php">Cancel<br></a>
        
    </form>
    </div>
    
</body>
</html>