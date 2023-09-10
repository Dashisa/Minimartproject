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
    
    <link rel="stylesheet" type="text/css" href="css/delivery_report.css">

</head>

<body>
    <br><br><br>
    <div class="container">
        <h1>Stock Report</h1>

<?php
// Step 1: Connect to the database
$host = 'localhost';
$dbname = 'grocery_db';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Step 2: Retrieve data from the database
$query = "SELECT * FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Step 3: Create an HTML table
$html = '<table>';
$html .= '<tr></tr><tr><th>Product ID</th><th>Product Name</th><th>Product Details</th><th>Price</th><th>Category</th><th>Sub Category</th><th>Image</th><th>Quantity</th></tr>';
foreach ($products as $product) {
    $html .= '<tr>';
    $html .= '<td>' . $product['id'] . '</td>';
    $html .= '<td>' . $product['name'] . '</td>';
    $html .= '<td>' . $product['details'] . '</td>';
    $html .= '<td>' . $product['price'] . '</td>';
    $html .= '<td>' . $product['category'] . '</td>';
    $html .= '<td>' . $product['SubCategory'] . '</td>';
    $html .= '<td>' . $product['image'] . '</td>';
    $html .= '<td>' . $product['stock_quantity'] . '</td>';
    $html .= '</tr>';
}
$html .= '</table>';

// Step 4: Output the webpage
echo $html;
?>

</div>

</body>
</html>