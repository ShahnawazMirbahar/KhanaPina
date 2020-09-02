<?php

    require('includes/dbh.inc.php');
    session_start();
		/*if(isset($_POST['delete'])){
		$delete_id =mysqli_real_escape_string($conn,$_POST['delete_id']);

		$query = "delete from users where id = {$delete_id}";

		if(mysqli_query($conn,$query)){
			header('Location: index.php');
		}

	}*/
	
	$id =$_SESSION['id'];
	//echo $id;

	$query = "SELECT * FROM users WHERE user_id='".$id."'";
	$results = mysqli_query($conn,$query);
	$result = mysqli_fetch_assoc($results);
    $fname = $result['fname'];
    $lname = $result['lname'];
    $email = $result['email'];
    $phone = $result['phone_no'];
    $balance = $result['balance'];
    $area = $result['area'];
    $block = $result['block'];


?>


<html>
<head>
<title><?php echo $lname;?>|profile</title>
<link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" href="common.css">
     <link rel="stylesheet" href="common.css">
   <script src="Bootstrap\js\bootstrap.min.js"></script>  
    
    <style>
    
    .btncustom
        {
            font-family: Comic Sans MS;
            font-style: oblique;
            font-size: 20px;
        }
        
        .btngrp
        {
            padding-left: 220px;
            padding-top: 30px;
        }
        
        .btn
        {
            background-color: dimgrey !important;
            
        }
        
        .btn:hover
        {
            color: aliceblue !important;
            background-color: aqua !impportant;
        }
        
        .btn:focus
        {
             color: aliceblue !important;
        }
        
           #bg
    {
       background-image: url(img/bg_profile4.jpg);
        background-size: cover;
        
    }
  
    
    </style>
</head>
<body id="bg">
    <div class="btngrp">
    <a class = "btncustom btn btn-primary" href="home.php"><b>Home</b><br></a>
    <a class = "btncustom btn btn-primary" href="includes/edituserprofile.php">Edit Profile<br></a>
    <a class = "btncustom btn btn-primary" href="includes/chnpwd.inc.php">Change Password<br></a>
    <a class = "btncustom btn btn-primary" href="ufoods.php">Uploaded Foods<br></a>
    <a class = "btncustom btn btn-primary" href="yourorders.php">Your Orders<br></a>
    <a class = "btncustom btn btn-primary" href="yoursales.php">Your Sales<br></a>
    </div>

   <table class="table table-hover">
  <thead>
    <tr>
        <th scope="col"><?php echo$lname;?>'s Profile</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-primary">
      <th scope="row">First Name</th>
      <td><?php echo $fname;?></td>
    </tr>
    <tr class="table-primary">
      <th scope="row">Last Name</th>
      <td><?php echo $lname;?></td>
    </tr>
    <tr class="table-primary">
      <th scope="row">Email</th>
      <td><?php echo $email;?></td>
    </tr>
    <tr class="table-primary">
      <th scope="row">Phone No</th>
      <td><?php echo $phone;?></td>
    </tr>
    <tr class="table-primary">
      <th scope="row">Address</th>
      <td><?php echo $area;?>,<?php echo $block;?></td>
    </tr>
    <tr class="table-primary">
      <th scope="row">Balance</th>
      <td><?php echo $balance;?></td>
    </tr>
  </tbody>
</table>



</body>
</html>