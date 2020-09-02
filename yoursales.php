<?php
require('includes/dbh.inc.php');

session_start();

$id=$_SESSION['id'];


$sql="SELECT payment.date,payment.customer_id,payment.chef_id,orders.food_id,orders.items,payment.amount FROM payment inner JOIN orders on orders.order_no=payment.order_no where payment.chef_id={$id} order by date desc;";
    
//echo $id;
    
    
$results = mysqli_query($conn,$sql);
$posts = mysqli_fetch_all($results,MYSQLI_ASSOC);
$i=0;
$total=0;
?>

<html>
<head>
<title>Sells|Khanapina</title>
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
        <div class="container">
		<h1>Your orders</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Serial</th>
                <th scope="col">Customer</th>
                <th scope="col">Food name</th>
                <th scope="col">Number of items</th>
                <th scope="col">Price</th>
                <th scope="col">date</th>
                    
                </tr>
            </thead>
	<?php foreach ($posts as $post) : ?>
			<?php $food_id = $post['food_id'];
            $customer_id=$post['customer_id'];
            $sql = "select * from orders where customer_id ={$customer_id} and food_id = {$food_id}";
            $results=mysqli_query($conn,$sql);
            $sum=0;
            $items =0;
            foreach($results as $result){
                $sum+=$result['price'];
                $items+=$result['items'];
            }
            $sql = "select f_name from foods where food_id = {$food_id};";
            $results=mysqli_query($conn,$sql);
            $result = mysqli_fetch_assoc($results);
            $food_name = $result['f_name'];
            
            //echo $food_id;
            //echo $food_name;
            $i++;
            $total+=$sum;
            $date = $post['date'];
            $sql = "select fname,lname from users where user_id = {$customer_id};";
            $results= mysqli_query($conn,$sql);
            $result = mysqli_fetch_assoc($results);
            $fname = $result['fname'];
            $lname = $result['lname'];
            ?>

            <tr class="table-primary">
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $fname ;?> <?php echo $lname ;?></td>
            <td><?php echo $food_name ;?></td>
            <td><?php echo $items ;?></td>
            <td><?php echo $sum ;?></td>
            <td><?php echo $date ;?></td>
            </tr>
         
            
            

	<?php endforeach; ?>
            </table>
            
            <div class="alert alert-dismissible alert-success">
                <strong>COST: </strong> You earned in total <class="alert-link"><b><?php echo $total;?></b> Taka</a>.
            </div>
    </div>
    </body>

</html>
