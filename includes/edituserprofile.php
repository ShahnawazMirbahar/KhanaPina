<?php
	
    require('dbh.inc.php');
    session_start();

	//Check for submit

	if(isset($_POST['submit'])){
		//echo 'Submitted ';
		//$fname =mysqli_real_escape_string($conn,$_POST['fname']);
		//$lname = mysqli_real_escape_string($conn,$_POST['lname']);
		$update_id =mysqli_real_escape_string($conn,$_POST['update_id']);
		$phone = mysqli_real_escape_string($conn,$_POST['phone']);
		$area = mysqli_real_escape_string($conn,$_POST['area']);
		$block=  mysqli_real_escape_string($conn,$_POST['block']);
		$balance = mysqli_real_escape_string($conn,$_POST['balance']);
        
        /*echo $update_id.'<br>';
        echo $phone.'<br>';
        echo $area.'<br>';
        echo $block.'<br>';
        echo $balance.'<br>';
        */
        
		$query = "update users set 
		phone_no='$phone',
		area='$area',
		block = '$block',
		balance={$balance} where user_id = {$update_id}";

		if(mysqli_query($conn,$query)){
			header("Location: ../userprofile.php?status=updated");
		}
        
	}

	//$id = mysqli_real_escape_string($conn,$_GET['id']);
	$id =$_SESSION['id'];
	//echo $id;

	$query = "SELECT * FROM users WHERE user_id = {$id}";
	$results = mysqli_query($conn,$query);
	$result = mysqli_fetch_assoc($results);

?>
<html>

<head>
<title>Edit|profile</title>
<link rel="stylesheet" href="..\Bootstrap\css\bootstrap.min.css">
   <script src="..\Bootstrap\js\bootstrap.min.js"></script>  
   <style>
    
     #bg
    {
       background-image: url(../img/edited/bg_profile2.jpg);
        background-size: cover;
        background-position: center;
    }
       
    </style> 
   
</head>

<body id="bg">

	<div class="container">
		<h1>Edit profile</h1>
		<form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
			<div class="form-group">
				<label>update phone No</label>
				<input type="text" name="phone" class="form-control" value="<?php echo $result['phone_no']; ?>">	
			</div>
			<div class="form-group">
				<label>update Area</label>
				<input type="text" name="area" class="form-control" value="<?php echo $result['area']; ?>">	
			</div>
			<div class="form-group">
				<label>update Block</label>
				<input type="text" name="block" class="form-control" value="<?php echo $result['block']; ?>">	
			</div>

			<div class="form-group">
				<label>update balance</label>
				<input type="number" name="balance" class="form-control" value="<?php echo $result['balance']; ?>">	
			</div>

			<input type="hidden" name="update_id" value="<?php echo $_SESSION['id'];?>">
			<input type="submit" name="submit" value="submit" class="btn btn-primary">
            
            <a class = "btn btn-primary" href="../userprofile.php">Cancel<br></a>
		</form>
	
</div>
</body>
</html>