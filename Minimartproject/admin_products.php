<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $stock_quantity = mysqli_real_escape_string($conn, $_POST['stock_quantity']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $category = mysqli_real_escape_string($conn, $_POST['category']);
   $SubCategory = mysqli_real_escape_string($conn, $_POST['SubCategory']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'upload_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, details, price, category,SubCategory, image,stock_quantity) VALUES('$name', '$details', '$price', '$category','$SubCategory', '$image','$stock_quantity')") or die('query failed');

      if($insert_product){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'product added successfully!';
         }
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('upload_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_products.php');

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

   
</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<br><br>

<center><a href="check_stock.php"><input type="submit" value="Check Stock Status" name="check_stock" class="option-btn"></a>
&nbsp; &nbsp;

<a href="product_report.php"><input type="submit" value="Generate Report" name="report_stock" class="option-btn"></a>
</center>

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add new product</h3>
      <input type="text" class="box" required placeholder="enter product name" name="name">
      <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
      <input type="number" min="0" class="box" required placeholder="enter product quantity" name="stock_quantity">
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      
      <select name="category" class="box" id="category"  required>
       <option value="Grocery">Grocery</option>
       <option value="Stationary">Stationary</option>
       <option value="Homeware">Homeware</option>
      
      </select>
      <h2>Sub category*</h2>
      <select name="SubCategory" class="box" id="SubCcategory"  required>
       <option value="Grocery">Grocery</option>
       <option value="Snacks">Snacks</option>
       <option value="Vegetables">Vegetables</option>
       <option value="Fruits">Fruits</option>
       <option value="Beverages">Beverages</option>
       <option value="Homeware">Homeware</option>
       <option value="Stationary">Stationary</option>
       
      </select>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>

<br>
<br>

<br>



<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <div class="price">LKR <?php echo $fetch_products['price']; ?>/-</div>
         <img class="image" src="upload_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="category"><?php echo $fetch_products['category']; ?></div>
         <div class="SubCategory"><?php echo $fetch_products['SubCategory']; ?></div>
         <div class="details"><?php echo $fetch_products['details']; ?></div>
         <div class="stock-quantity">Stock Quantity: <?php echo $fetch_products['stock_quantity']; ?></div>
         <a href="admin_update_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
   

</section>












<script src="js/admin_script.js"></script>

</body>
</html>