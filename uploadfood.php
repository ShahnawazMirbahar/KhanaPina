<?php
session_start();
if(isset($_POST['submit'])){
     require('includes/dbh.inc.php');
    $chef_id= mysqli_real_escape_string($conn,$_SESSION['id']);
    $f_name = mysqli_real_escape_string($conn,$_POST['name']);
    $available = mysqli_real_escape_string($conn,$_POST['area']);
    $f_price= mysqli_real_escape_string($conn,$_POST['price']);


   $image = $_FILES['image']['name'];
   if(empty($image)){
   	$image="foods.jpg";
   }

    $target = "img/".basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

    $sql = "INSERT INTO foods(chef_id,f_name,available_at,f_price,image)
    VALUES('$chef_id','$f_name','$available',{$f_price},'$image');";
    if(!isset($chef_id)||!isset($f_name)||!isset($available)||!isset($f_price)){
        header("location: uploadfood.php?status=error");
    }
    else if(mysqli_query($conn, $sql)){
        header("location: home.php?status=uploaded");
    }
}
?>




<html>
<head>
<title>upload food|Khanapina</title>
<link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
   <script src="Bootstrap\js\bootstrap.min.js"></script>  
    <style>
    
    .bg
        {
            background-image: url(img/edited/bg_white.jpg);
            background-size: cover;
            background-position: center;
        }
    
    </style>
</head>
    <body class="bg">
    <div class="container">
		<h1>Upload Food</h1>
		 <form method="POST" action="uploadfood.php" enctype="multipart/form-data">
			<div class="form-group">
				<label>Food name</label>
				<input type="text" name="name" class="form-control" placeholder="Food Name">	
			</div>
			<div class="form-group">
				<label>Available at</label>
				<input type="text" name="area" class="form-control" placeholder="Location">	
			</div>
			<div class="form-group">
				<label>price</label>
				<input type="number" name="price" class="form-control" placeholder="price">	
			</div>

			<input type="hidden" name="size" value="1000000">

			<div class="form-group">
				<label>upload image</label>
				<input type="file" name="image">	
			</div>

			<input type="submit" name="submit" value="submit" class="btn btn-primary">
            
            <a class = "btn btn-primary" href="../userprofile.php">Cancel<br></a>
		</form>
	
</div>
</body>
<html>
