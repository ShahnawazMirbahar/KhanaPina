<?php
	
    require('includes/dbh.inc.php');
    session_start();

	$food_id=$_GET['f_id'];

if(isset($_POST['delete'])){

		header("Location: includes/delete.php?id=$food_id");
	}


	if(isset($_POST['submit'])){
		//echo 'Submitted ';
		//$fname =mysqli_real_escape_string($conn,$_POST['fname']);
		//$lname = mysqli_real_escape_string($conn,$_POST['lname']);
		$area = mysqli_real_escape_string($conn,$_POST['area']);
		$price = mysqli_real_escape_string($conn,$_POST['price']);
        
        /*echo $update_id.'<br>';
        echo $phone.'<br>';
        echo $area.'<br>';
        echo $block.'<br>';
        echo $balance.'<br>';
        */
        
		$query = "update foods set 
		available_at='$area',
		f_price={$price} where food_id = {$food_id}";

		if(mysqli_query($conn,$query)){
			header("Location: ufoods.php?status=updated");
		}
        
	}

	//$id = mysqli_real_escape_string($conn,$_GET['id']);
	//echo $id;

	$query = "SELECT * FROM foods WHERE food_id = {$food_id}";
	$results = mysqli_query($conn,$query);
	$result = mysqli_fetch_assoc($results);

?>

<html>
<head>
<title>Edit Food|profile</title>
<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    
    <style>
    
    
    .bg
        {
            background-image: url(img/edited/bg_profile3_white.jpg);
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg">

	<div class="container">
		<h1><?php echo $result['f_name'];?></h1>
		<form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
			<div class="form-group">
				<label>update location</label>
				<input type="text" name="area" class="form-control" value="<?php echo $result['available_at']; ?>">	
			</div>
			<div class="form-group">
				<label>update price</label>
				<input type="text" name="price" class="form-control" value="<?php echo $result['f_price']; ?>">	
			</div>

			<input type="submit" name="submit" value="submit" class="btn btn-primary">
            
            <a class = "btn btn-primary" href="ufoods.php">Cancel<br></a>
		</form>
        
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
		<input type="submit" name="delete" value="delete" class="btn btn-danger">
		</form>
	
</div>
</body>
</html>
