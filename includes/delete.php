<?php

include_once 'dbh.inc.php';

$food_id = $_GET['id'];

$query = "select * from orders where food_id={$food_id}";


$results = mysqli_query($conn,$query);

$orders =mysqli_fetch_all($results,MYSQLI_ASSOC);

foreach ($orders as $order) {
	$order_no = $order['order_no'];
	$query = "delete from payment where order_no={$order_no};";
	mysqli_query($conn,$query);
	$query = "delete from orders where order_no={$order_no};";
	mysqli_query($conn,$query);

}

$query = "delete from foods where food_id={$food_id};";
if(mysqli_query($conn,$query)){
header("Location:../home.php?status=deleted");
}



?>