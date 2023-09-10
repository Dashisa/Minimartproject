<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_supplier'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $contact = mysqli_real_escape_string($conn, $_POST['contact']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pro_id = mysqli_real_escape_string($conn, $_POST['pro_id']);
   $category = mysqli_real_escape_string($conn, $_POST['category']);
   

   $select_supplier_name = mysqli_query($conn, "SELECT name FROM `supplier` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_supplier_name) > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_supplier = mysqli_query($conn, "INSERT INTO `supplier`(name, contact, address, email, pro_id,category) VALUES('$name', '$contact', '$address', ' $email', ' $pro_id','$category')") or die('query failed');
     
      
      
   }

}

 


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `supplier` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_manageSup.php');
}



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
   <link rel="stylesheet" href="css/userstyle.css">
   <link rel="stylesheet" href="css/userstyle.css">

  
   


</head>
<body>
   
<?php @include 'admin_header.php'; ?>

 <center><a href="stockNotify.php"><input type="submit" value="Stock Notify" name="check_stock" class="option-btn"></a></center>

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add supplier</h3>
      <input type="text" class="box" required placeholder="enter supplier name" name="name">
      <input type="number" class="box" required placeholder="enter contact" name="contact">
      <input type="text" class="box" required placeholder="enter address" name="address">
      <input type="text" class="box" required placeholder="enter email" name="email">
      <input type="number" class="box" required placeholder="enter Pro_id" name="pro_id">
      
    

      <select name="category" class="box" id="category"  required>
       <option value="Grocery">Grocery</option>
       <option value="Stationary">Stationary</option>
       <option value="Homeware">Homeware</option>
      
      </select>
      <input type="submit" value="add supplier" name="add_supplier" class="option-btn">
   </form>

</section>


<section class="show-products">

   <div class="box-container">

      <?php
         $select_supplier = mysqli_query($conn, "SELECT * FROM `supplier`") or die('query failed');
         if(mysqli_num_rows($select_supplier) > 0){
            while($fetch_supplier = mysqli_fetch_assoc($select_supplier)){
      ?>
      <div class="box">
        
         <div class="name"><?php echo $fetch_supplier['name']; ?></div>
         <div class="id"><?php echo $fetch_supplier['id']; ?></div>
         <div class="address"><?php echo $fetch_supplier['address']; ?></div>
         <div class="contact"><?php echo $fetch_supplier['contact']; ?></div>
         <div class="category"><?php echo $fetch_supplier['category']; ?></div>
         <div class="pro_id">P_id:  <?php echo $fetch_supplier['pro_id']; ?></div>
         


         
         
         <a href="admin_update_supplier.php?update=<?php echo $fetch_supplier['id']; ?>" class="option-btn">update</a>
         <a href="admin_manageSup.php?delete=<?php echo $fetch_supplier['id']; ?>" class="delete-btn" onclick="return confirm('delete this supplier?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no supplier added yet!</p>';
      }
      ?>
   </div>
   

</section>











<script src="js/admin_script.js"></script>

</body>
</html>