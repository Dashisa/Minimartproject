<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/adminStyle.css">
   <link rel="stylesheet" href="css/userstyle.css">


</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Delivery Info</h3>
      <input type="number" class="box" required placeholder="enter order_id" name="order_id">
      <input type="text" class="box" required placeholder="enter recipient_name" name="recipient_name">
      <input type="number" class="box" required placeholder="enter recipient_contact" name="recipient_contact">
      <input type="text" class="box" required placeholder="enter recipient_address" name="recipient_address">
      <input type="text" class="box" required placeholder="enter type" name="type">
      <input type="number" class="box" required placeholder="enter Price" name="price">
      <input type="hidden" name="order_id" value="">
            <select name="update_delivery">
               <option disabled selected>Status</option>
               <option value="1">1</option>
               <option value="2">2</option>
            </select>
            <input type="date" class="box" required placeholder="enter Price" name="date_created">    
    

      
      <input type="submit" value="add delivery" name="add_supplier" class="option-btn">
   </form>

</section>



<script src="js/admin_script.js"></script>

</body>
</html>