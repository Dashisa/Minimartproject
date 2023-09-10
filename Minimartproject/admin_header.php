<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_products.php">Manage Stock</a>
         <a href="admin_orders.php">Manage Order</a>
         <a href="admin_manageCus.php">Manage Customer</a>
         <a href="admin_manageSup.php">Manage Supplier</a>
         <a href="admin_delivery.php">Manage Delivery</a>


      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="admin_users.php"><div id="account-btn" class="fa fa-address-book"></div></a>
         <a href="admin_msg.php"><div id="msg-btn" class="fa fa-envelope"></div></a>

         <div id="user-btn" class="fas fa-user"></div>
        
         
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a> </div>
      </div>

   </div>

</header>