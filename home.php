
<?php
session_start();
require('includes/dbh.inc.php');
$id=$_SESSION['id'];
$name = $_SESSION['lname'];
?>


<head>
<title>HomePage | Khanapina</title>
<link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
   <script src="Bootstrap\js\bootstrap.min.js"></script>  
    
    
    <style>
    
    
    .lg
        {
         padding-left: 1200px;
            padding-top: -150px;
            display: inline-block;
            
        }
        
        .sg
        {
            padding-left: 500px;
            padding-bottom: 20px;
        }
        
         .h1 h1
        {
            font-family: Vivaldi;
            color:floralwhite;
            padding-left: 500px;
            display: inline-block;
            font-size: 56px;
            font-weight: 800;
            
            
        }
        
        .a a
        {
            font-family:  KG Miss Kindergarten Regular;
            color: whitesmoke;
            font-size: 25px;
            text-decoration:none;
            padding-left: 30px;
            padding-top: 500px;
            
        }
         
            
            
    </style>
</head>

<div  class="a" >
    <a href="#"><b>Khanapina.com</b></a>
	
    
</div>

<div  class="h1" >
<h1>Welcome <?php echo $name; ?>!!<br></h1>
</div>

<div class="lg">
<form action="includes/logout.inc.php" method="POST">
    <button class="btn btn-danger" type="submit" name="submit">Logout</button>
</form>
</div>
   
<div class="sg">
<a class = "btn btn-lg btn-primary" href="userprofile.php?"><?php echo "$name 's ";?>Profile<br></a>
<a class = "btn btn-lg btn-success" href="uploadfood.php?">Upload Food<br></a>
    
 </div>





<?php
$product_ids = array();
//check if add to cart button has been submitted
if(filter_input(INPUT_POST,'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        //keep track of how many products in the shopping cart
        $count =count($_SESSION['shopping_cart']);
        //create sequrntial array for matching array keys to product ids
        $product_ids = array_column($_SESSION['shopping_cart'],'id');
        //pre_r($product_ids);
        
        if(!in_array(filter_input(INPUT_GET,'id'),$product_ids)){
            $_SESSION['shopping_cart'][$count]=array(
            'id'=>filter_input(INPUT_GET,'id'),
            'name'=>filter_input(INPUT_POST,'name'),
            'price'=>filter_input(INPUT_POST,'price'),
            'quantity'=>filter_input(INPUT_POST,'quantity') 
        )  ;
            
        }
        else
        {
            for($i=0;$i<count($product_ids);$i++){
                if($product_ids[$i]==filter_input(INPUT_GET,'id')){
                    //add item quantity in the existing product added to the cart
                    $_SESSION['shopping_cart'][$i]['quantity'] += 1;
                }
            }
        }
    }
    else{//if shopping_cart doesn't exist create first product with array key 0
        //create array using submitted form data,start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0]=array(
            'id'=>filter_input(INPUT_GET,'id'),
            'name'=>filter_input(INPUT_POST,'name'),
            'price'=>filter_input(INPUT_POST,'price'),
            'quantity'=>filter_input(INPUT_POST,'quantity') 
        )  ;
    }
}

if(filter_input(INPUT_GET,'action')=='delete'){
    foreach($_SESSION['shopping_cart'] as $key =>$product){
        if($product['id']==filter_input(INPUT_GET, 'id')){
            //remove product from shopping cart
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    //reset session arraky keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}
//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

if(isset($_POST['checkout'])){
    $_SESSION['total']=$total;
    header("Location: includes/checkout.inc.php");
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="scart.css">
        <style>
        .bg
            {
                background-image: url(img/bg.jpg);
                background-size:cover;
            }
            .table
            {
                color:white;
            }
            
             .products{
    border: 1px solid #333;
   
   
    border-radius: 5px;
    padding: 16px;
    margin-bottom: 20px;
    height: 400px;
    width: 250px;
  
     background-color:#fff4ef ; !impportant
   
        
        </style>
        
    </head>
    
    <body class="bg">
        <div class="container">
        <?php
        $query = "select * from foods ORDER by uploaded_at desc";
        $result = mysqli_query($conn,$query);

        if($result):
        if(mysqli_num_rows($result)>0):
        while($product = mysqli_fetch_assoc($result)):
           // print_r($product);
            ?>
            <div class="col-sm-4 col-md-3">
              <form method="post" action="home.php?action=add&id=<?php echo $product['food_id'];?>">
                  <div class="products">
                      <img src = "img/<?php echo $product['image'];?>" height= "250px" width="250px" class="img-responsive image-resize"/>
                      <h4 class="text-info"><?php echo $product['f_name'];?></h4>
                      <small class="text-info">Available at: <?php echo $product['available_at'];?></small>
                      <h4 class="text-info">Price:<?php echo $product['f_price'];?> Tk</h4>
                      <input type="text" name="quantity" class="form-control" value="1" />
                      <input type="hidden" name="name" value="<?php echo $product['f_name'];?>">
                      <input type="hidden" name="price" value="<?php echo $product['f_price'];?>">
                      <?php if($product['chef_id']==$_SESSION['id']){
                                echo "<br><br>";
                                echo "</div>";
                                echo "</form>";
                                echo "</div>";
                                //echo "<input type="submit" name="add_to_cart" class="btn btn-info" style="margin-top:5px" value="Add to Cart" />";
    
                               continue;
                            }
                      ?>
                      <input type="submit" name="add_to_cart" class="btn btn-info" style="margin-top:5px" value="Add to Cart" />
                      
                  </div>
                </form>
            </div>
            <?php
            endwhile;
        endif;
        endif;
        ?>
        <?php
            if($_GET['status']='balance'){
               // echo "You don't have enough balance<br>";
            }
            ?>
        <div style="clear:both"></div>  
        <br />  
        <div class="table-responsive">  
        <table class="table">  
            <tr><th colspan="5"><h3>Order Details</h3></th></tr>   
        <tr>  
             <th width="40%">Product Name</th>  
             <th width="10%">Quantity</th>  
             <th width="20%">Price</th>  
             <th width="15%">Total</th>  
             <th width="5%">Action</th>  
        </tr>  
        <?php   
        if(!empty($_SESSION['shopping_cart'])):  
            
             $total = 0;  
        
             foreach($_SESSION['shopping_cart'] as $key => $product): 
        ?>  
        <tr>  
           <td><?php echo $product['name']; ?></td>  
           <td><?php echo $product['quantity']; ?></td>  
           <td>$ <?php echo $product['price']; ?></td>  
           <td>$ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td>
               <a href="home.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn-danger">Remove</div>
               </a>
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);  
             endforeach;  
        ?>  
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td align="right">$ <?php echo number_format($total, 2); ?></td>  
             <td></td>  
        </tr>  
        <tr>
            <!-- Show checkout button only if the shopping cart is not empty -->
            <td colspan="5">
             <?php 
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
             ?>
                <form method="POST" action="home.php">
                <button  type="submit" name="checkout" class="btn btn-primary">checkout</button>
                </form>
                <?php
                if(isset($_POST['checkout'])){
                    $_SESSION['total']=$total;
                    header("Location: includes/checkout.inc.php");
                }
                ?>
             <?php endif; endif; ?>
            </td>
        </tr>
        <?php  
        endif;
        ?>  
        </table>  
         </div>
        </div>
    </body>
</html>
