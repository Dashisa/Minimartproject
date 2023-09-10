<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
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

<section class="show-products">
<div class="box-container">
<?php
// ...

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    $stock_quantity = $_GET['stock_quantity'];

    // Display the product details with low stock
    if ($stock_quantity < 10) {
        ?>
        <div class="box">
            <h3>Low Stock Notification</h3>
            <p>The stock for the product "<?php echo $product_name; ?>" is low. Stock Quantity: <?php echo $stock_quantity; ?></p>
        </div>
        <?php
    }
}
// ...
?>
</div>
</section>




<center><a href="admin_invoice.php"><input type="submit" value="Create Invoice" name="check_stock" class="option-btn"></a></center>
<section class="show-products">
                <div class="box-container">

                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                            $stock_quantity = $fetch_products['stock_quantity'];
                            $product_id = $fetch_products['id'];
                            ?>
                        
                           
                                
                                
                                <?php
                                // Display the "Send Notification" button for products with stock quantity < 10
                                if ($stock_quantity < 10) {
                                    ?>
                                     <div class="box">
                                    <h3>Low stock: <?php echo $stock_quantity; ?></h3>
                                <div class="name"><?php echo $fetch_products['name']; ?></div>
                                  Product ID:  <?php echo $product_id; ?>
                                   </div>  
                                  
                                  <?php
                                }
                                ?>
                           
                          
                            
                           
                    <?php
                        }
                    } else {
                        echo '<p class="empty">No products added yet!</p>';
                    }
                    ?>
                </div>

            </section>



<script src="js/admin_script.js"></script>

</body>
</html>