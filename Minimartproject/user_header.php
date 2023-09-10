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

      <a href="#" class="logo">My<span>Account</span></a>

      <nav class="navbar">
         <a href="index.php">Home</a>
         <a href="category.php">Category</a>
         <a href="profile.php">Edit Profile</a>
         

      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="newlogin.php">login</a> | <a href="userreg.php">register</a> </div>
      </div>

   </div>

</header>