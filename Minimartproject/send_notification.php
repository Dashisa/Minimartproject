<?php
// send_notification.php

@include 'config.php';

$product_id = $_GET['product_id'];

// Retrieve the product details based on the product_id
$select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die('query failed');
$fetch_product = mysqli_fetch_assoc($select_product);
$product_name = $fetch_product['name'];
$stock_quantity = $fetch_product['stock_quantity'];

// Redirect to the supplier page and pass the product details as URL parameters
header("location: stockNotify.php?product_id=$product_id&product_name=$product_name&stock_quantity=$stock_quantity");
?>
