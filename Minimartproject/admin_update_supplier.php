<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};
if(isset($_POST['update_supplier'])){

$update_s_id = $_POST['update_s_id'];
$pro_id = mysqli_real_escape_string($conn, $_POST['pro_id']);
$name = mysqli_real_escape_string($conn, $_POST['name']);

$address = mysqli_real_escape_string($conn, $_POST['address']);

mysqli_query($conn, "UPDATE `supplier` SET name = '$name', address = '$address',pro_id ='$pro_id' WHERE id = '$update_s_id'") or die('query failed');





$message[] = 'supplier updated successfully!';

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update supplier</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/adminStyle.css">
   <link rel="stylesheet" href="css/userstyle.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="update-product">

<?php

   $update_id = $_GET['update'];
   $select_supplier = mysqli_query($conn, "SELECT * FROM `supplier` WHERE id = '$update_id'") or die('query failed');
   if(mysqli_num_rows($select_supplier) > 0){
      while($fetch_supplier = mysqli_fetch_assoc($select_supplier)){
?>

<form action="" method="post" enctype="multipart/form-data">
  
  <h3>Supplier_Id: <input type="text" value="<?php echo $fetch_supplier['id']; ?>" name="update_s_id"></h3>
  <input type="number" class="box"value="<?php echo $fetch_supplier['pro_id']; ?>" required placeholder="enter Pro_id" name="pro_id">
   <input type="text" class="box" value="<?php echo $fetch_supplier['name']; ?>" required placeholder="update supplier name" name="name">
   
   <textarea name="address" class="box" required placeholder="update supplier address" cols="30" rows="10"><?php echo $fetch_supplier['address']; ?></textarea>
  
   <input type="submit" value="update supplier" name="update_supplier" class="option-btn">
   <a href="admin_manageSup.php" class="option-btn">go back</a>
</form>

<?php
      }
   }else{
      echo '<p class="empty">no update product select</p>';
   }
?>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>