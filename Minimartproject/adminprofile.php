<?php
include 'newconfig.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:adminlogin.php');
};

if(isset($_GET['logout'])){
    unset($admin_id);
    session_destroy();
    header('location:adminlogin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>

    <!--Custom CSS File Link-->
    <link rel="stylesheet" href="css/userlogin.css">
</head>
<body>
    <div class="container">
        <div class="profile">
            <?php
                $select = mysqli_query($conn, "SELECT * FROM `admin_form` WHERE id = '$admin_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                }
            ?>
            <h3><?php echo $fetch['name']; ?></h3>
            <a href="admin_up_profile.php" class="btn">Update Admin Profile</a>
            <a href="index.php" class="btn">Back to Home</a>
            <a href="admin_page.php" class="btn">Go to Admin Page</a>
            <a href="adminprofile.php?logout=<?php echo $admin_id; ?>" class="delete-btn">Logout</a>
            <p>new <a href="adminlogin.php">login</a> or <a href="adminreg.php">register</a></p>
        </div>
    </div>
</body>
</html>