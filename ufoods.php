<?php
session_start();
require('includes/dbh.inc.php');
$chef_id=$_SESSION['id'];
$sql =  "SELECT * FROM foods WHERE chef_id = '$chef_id' ORDER BY uploaded_at DESC";

$result = mysqli_query($conn,$sql);

$foods = mysqli_fetch_all($result,MYSQLI_ASSOC);

//var_dump($foods);
//free result

mysqli_free_result($result);

mysqli_close($conn);

?>

<html>
<head>
<title>Your uploaded foods|Khanapina</title>
<link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
     <link rel="stylesheet" href="common.css">
   <script src="Bootstrap\js\bootstrap.min.js"></script>  
    
    <style>
    
    .bg
        {
            background-image: url(img/bg_profile3_rotated.jpg);
            background-size: cover;
        }
    
    </style>
</head>
    <body class="bg">
        <a class = "btn btn-primary" href="home.php">Home<br></a>  
        <div class="container">
		<h1>Foods</h1>
	<?php foreach ($foods as $food) : ?>
		<div class="jumbotron">
			<h3><?php echo $food['f_name']; ?></h3>
			<small>Created at <?php echo $food['uploaded_at'];?></small>
			<p>available at: <?php echo $food['available_at']; ?></p>
            <h4><b>price:</b><?php echo $food['f_price'];?></h4>
			<a class = "btn btn-primary" href="editfood.php?f_id=<?php echo $food['food_id']; ?>">Edit</a>
		</div>
	<?php endforeach ?>
    </body>
    
</html>