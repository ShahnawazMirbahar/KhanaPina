<?php
session_start();
require('dbh.inc.php');

$total=$_SESSION['total'];
date_default_timezone_set("Asia/Dhaka");

$id=$_SESSION['id'];

$query = "SELECT * FROM users WHERE user_id='".$id."'";
$results = mysqli_query($conn,$query);
$result = mysqli_fetch_assoc($results);
$customer_balance=$result['balance'];
/*echo $customer_balance;
echo '<br>';
echo $total;
echo '<br>';
*/
if($total>$customer_balance){
    header("Location: ../home.php?status=balance");
    exit();
}

    $customer_id=$result['user_id'];
    $customer_balance=$result['balance'];

    foreach($_SESSION['shopping_cart'] as $key =>$product){
        $food_id = $product['id'];
        $food_quantity = $product['quantity'];
        
        $query = "SELECT * FROM foods WHERE food_id='".$food_id."'";
        $results = mysqli_query($conn,$query);
        $result = mysqli_fetch_assoc($results);
        
        
        $food_price = $result['f_price'];
        $food_name = $result['f_name'];
        $total = $food_price*$food_quantity;
        
        $chef_id=$result['chef_id'];
        
        $query = "SELECT * FROM users WHERE user_id='".$chef_id."'";
        $results = mysqli_query($conn,$query);
        $result = mysqli_fetch_assoc($results);
        
        $chef_balance = $result['balance'];
        $chef_balance += $total;
        $date=date("Y/m/d");
        /*$sql = "INSERT INTO payment(customer_id,chef_id,amount,date)VALUES({$customer_id},{$chef_id},{$total},'$date');";
        mysqli_query($conn,$sql);*/
        
        $sql="INSERT INTO orders(customer_id,food_id,items,price,date)VALUES({$customer_id},{$food_id},{$food_quantity},{$total},'$date')";
        if(!mysqli_query($conn,$sql)){
            echo 2;
        }
        
        $sql = "select max(order_no) from orders as last_order;";
        $temps = mysqli_query($conn,$sql);
        $temp = mysqli_fetch_assoc($temps);
        $order_no=$temp['max(order_no)'];
        //echo $order_no;
        $sql = "INSERT INTO payment(order_no,customer_id,chef_id,amount,date)VALUES({$order_no},{$customer_id},{$chef_id},{$total},'$date');";
        mysqli_query($conn,$sql);
        
        
        
        
        $sql = "update users set 
		balance={$chef_balance} where user_id = {$chef_id}";
         if(!mysqli_query($conn,$sql)){
            echo 3;
        }
        
        $customer_balance-=$total;
        $sql = "update users set 
		balance={$customer_balance} where user_id = {$customer_id}";
        if(!mysqli_query($conn,$sql)){
            echo 4;
        }
        
        /*echo "$food_name<br>";
        echo "$food_price<br>";
        echo "$food_quantity<br>";
        echo "$total<br>";
        
        echo'<br>';
        echo'<br>';*/
        
        
         unset($_SESSION['shopping_cart'][$key]);
    }

    header("Location: ../home.php?status=successfull");
    exit();

?>