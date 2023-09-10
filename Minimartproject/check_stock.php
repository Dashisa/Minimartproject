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
    <title>dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/adminStyle.css">
    <link rel="stylesheet" href="css/userstyle.css">

</head>

<body>

    <?php @include 'admin_header.php'; ?>

    <section class="dashboard">

    <center><a href="product_report.php"><input type="submit" value="Generate Report" name="report_stock" class="option-btn"></a>
</center>

        <div class="box-container">

         

            <section class="show-products">

                <div class="box-container">

                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                            $stock_quantity = $fetch_products['stock_quantity'];
                            $product_id = $fetch_products['id'];
                            ?>
                        
                            <div class="box">
                                <h3><?php echo $stock_quantity; ?></h3>
                                <div class="name"><?php echo $fetch_products['name']; ?></div>
                                <?php
                                // Display the "Send Notification" button for products with stock quantity < 10
                                if ($stock_quantity < 10) {
                                    ?>
                                    <a href="send_notification.php?product_id=<?php echo $product_id; ?>" class="send-notification-btn">Send Notification</a>
                                    <?php
                                }
                                ?>
                            </div>   
                          
                            
                           
                    <?php
                        }
                    } else {
                        echo '<p class="empty">No products added yet!</p>';
                    }
                    ?>
                </div>

            </section>

        </div>

    </section>

    <script src="js/admin_script.js"></script>

</body>

</html>
