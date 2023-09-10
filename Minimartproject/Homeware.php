<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $name = $_POST['name'];
   $price = $_POST['price'];
   $image = $_POST['image'];
   $quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$name', '$price', '$image', '$quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniMart|Homeware</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/categoryStyle.css">
    <link rel="stylesheet" href="css/adminStyle.css">
    <link rel="stylesheet" href="css/userstyle.css">


</head>
<body>

<!-- header section starts  -->

<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">MiniMart<span>.</span></a>

    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="category.php">Item Category</a>
        
		
        
    </nav>

    <div class="icons">
        <a href="#" class="fas fa-heart"></a>
        <a href="#" class="fas fa-shopping-cart"></a>
        <a href="#" class="fas fa-user"></a>
		<a href="login.php"><i style='font-size:24px' class='fas'>&#xf2f6;</i></a>
    </div>

</header>

<!-- header section ends -->





<!-- category section starts-->
	

<br>
<section class="category" id="category">

    <h1 class="heading">Homeware </h1>

    <section id="prodetails" class ="section-p1">
        <div class="single-pro-image">
            <img src="" alt="">
        </div>
        <div></div>
    </section>

</section>

<!-- category section ends -->
	
<section class="show-products">

<div class="box-container">

   <?php

     
     
        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category = 'Homeware'&& SubCategory ='Homeware'") or die('query failed');
        if(mysqli_num_rows($select_products) > 0){
           while($fetch_products = mysqli_fetch_assoc($select_products)){

      

     
   ?>
   

   <form action="" method="post">

   <div class="box">
      <div class="price">LKR <?php echo $fetch_products['price']; ?>/-</div>
      <img class="image" src="upload_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="category"><?php echo $fetch_products['category']; ?></div>
      <input type="submit" class="btn" value="add to cart" name="add_to_cart">

      <div class="details"><?php echo $fetch_products['details']; ?></div>
      
   </div>
           </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
</div>


</section>




<!-- footer section starts  -->

<section class="footer">

    

<div class="credit"> Design by <span> Tech Nerds </span> | All Rights Reserved </div>

</section>

<!-- footer section ends -->


















    
</body>
</html>