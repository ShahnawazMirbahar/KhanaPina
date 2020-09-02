<?php
require('includes/dbh.inc.php');
session_start();
$customer_id=$_SESSION['id'];
//echo $id;

$sql="select DISTINCT food_id from orders where customer_id = {$customer_id} ORDER by date desc ";

$results = mysqli_query($conn,$sql);

 $posts = mysqli_fetch_all($results,MYSQLI_ASSOC);
$i=0;
$total=0;
?>



<html>
<head>
<title>Orders|Khanapina</title>
<link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
   <script src="Bootstrap\js\bootstrap.min.js"></script>  
     <link rel="stylesheet" href="common.css">
    
     <style>
    
    .bg
        {
            background-image: url(img/bg_profile3_rotated.jpg);
            background-size: cover;
        }
    
    </style>
</head>

    <body class="bg">
        <div class="container">
		<h1>Your orders</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Serial</th>
                <th scope="col">Food name</th>
                <th scope="col">Number of items</th>
                <th scope="col">Price</th>
                <th scope="col">date</th>
                </tr>
            </thead>
	<?php foreach ($posts as $post) : ?>
			<?php $food_id = $post['food_id'];
            $sql = "select * from orders where customer_id ={$customer_id} and food_id = {$food_id}";
            $results=mysqli_query($conn,$sql);
            $sum=0;
            $items =0;
            foreach($results as $result){
                $sum+=$result['price'];
                $items+=$result['items'];
                $date = $result['date'];
            }
            $sql = "select f_name from foods where food_id = {$food_id};";
            $results=mysqli_query($conn,$sql);
            $result = mysqli_fetch_assoc($results);
            $food_name = $result['f_name'];
            
            //echo $food_id;
            //echo $food_name;
            $i++;
            $total+=$sum;
            ?>

            <tr class="table-primary">
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $food_name ;?></td>
            <td><?php echo $items ;?></td>
            <td><?php echo $sum ;?></td>
            <td><?php echo $date ;?></td>
            </tr>
         
            
            

	<?php endforeach; ?>
            </table>
            
            <div class="alert alert-dismissible alert-success">
            <strong>COST: </strong> Your total ordered items cost <class="alert-link"><?php echo $total;?> Taka</a>.
            </div>
    </div>
    </body>

</html>
