<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};


if(isset($_POST['update_agent_name'])){
   $order_id = $_POST['order_id'];
   $update_agent = $_POST['update_agent'];
   mysqli_query($conn, "UPDATE `orders` SET agent_name = '$update_agent' WHERE id = '$order_id'") or die('query failed');
   $message[] = 'Agent details has been updated!';
}
 
 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
 }
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Delivery</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/adminStyle.css">
   <link rel="stylesheet" href="css/userstyle.css">
   

</head>
<body>
   
<?php @include 'admin_header.php'; ?>


<section class="placed-orders">


<center><a href="delivery_status.php"><input type="submit" value="Add Delivery Info" name="check_stock" class="option-btn"></a>


&nbsp; &nbsp;

<a href="deliveri_report.php"><input type="submit" value="Generate Report" name="report_delivery" class="option-btn"></a>
</center>
<br>

   <h1 class="title">Items to Deliver</h1>

   <div class="box-container">

      <?php

      
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`WHERE payment_status = 'completed'") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> order id : <span><?php echo $fetch_orders['id']; ?></span> </p>
         <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> product name : <span><?php echo $fetch_orders['productname']; ?></span> </p>
         <p> total products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> payment status : <span><?php echo $fetch_orders['payment_status']; ?></span> </p>

         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_agent">
               <option disabled selected><?php echo $fetch_orders['agent_name']; ?></option>
               <option value="Agent1">Agent1</option>
               <option value="Agent2">Agent2</option>
               <option value="Agent3">Agent3</option>
               
            </select>
            <input type="submit" name="update_agent_name" value="update" class="option-btn">
            <a href="admin_delivery.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
           
         
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders to deliver!</p>';
      }
      ?>

   </div>




</section>








<script src="js/admin_script.js"></script>

</body>
</html>