<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:newlogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Account</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/userstyle.css">
   <link rel="stylesheet" href="css/categoryStyle.css">

</head>
<body>
   
<?php @include 'user_header.php'; ?>

<section class="dashboard">

   <h1 class="title"></h1>
<br>
<br>
<br><br>
   <div class="box-container">

      <div class="box">
            
         
         <h3></h3>
         <p><a href="wishlist.php">Wish List</a></p>
      </div>

      <div class="box">
         
         <h3> </h3>
         <p><a href="cart.php">Shopping Cart</a></p>
      </div>

      <div class="box">
        
         <h3></h3>
         <p><a href="history.php">Purchase History</a></p>
      </div>

      <div class="box">
         
         <h3></h3>
         <p><a href="track.php">Track order</a></p>
      </div>

      

   </div>

</section>




<section class="footer">

    

<div class="credit"> Design by <span> Tech Nerds </span> | All Rights Reserved </div>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>