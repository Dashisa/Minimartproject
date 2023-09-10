
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
    <div class="container">
        <h1>Delivery Report</h1>

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
$query = "SELECT * FROM parcels";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Step 3: Create an HTML table
$html = '<table>';
$html .= '<tr></tr><tr><th> ID</th><th>Order ID</th><th>Name</th><th>Address</th><th>Contact</th><th>Date Created</th></tr>';
foreach ($products as $product) {
    $html .= '<tr>';
    $html .= '<td>' . $product['id'] . '</td>';
    $html .= '<td>' . $product['order_id'] . '</td>';
    $html .= '<td>' . $product['recipient_name'] . '</td>';
    $html .= '<td>' . $product['recipient_address'] . '</td>';
    $html .= '<td>' . $product['recipient_contact'] . '</td>';
    $html .= '<td>' . $product['date_created'] . '</td>';
    
    $html .= '</tr>';
}
$html .= '</table>';

// Step 4: Output the webpage
echo $html;
?>

</div>




</body>
</html>