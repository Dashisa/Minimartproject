<?php
include 'newconfig.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    $select = mysqli_query($conn, "SELECT * FROM `admin_form` WHERE email = '$email' AND password = '$password'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $message[] = 'user already exist!';
    }else{
        if($password != $cpassword){
            $message[] = 'confirm password not matched!';
        }else{
            $insert = mysqli_query($conn, "INSERT INTO `admin_form`(name, email, password) 
            VALUES('$name', '$email', '$password')") or die('query failed');

            if($insert){
                $message[] = 'registered successfully!';
                header('location:adminlogin.php');
            }else{
                $message[] = 'registration failed!';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register Form</title>

    <!--Custom CSS File Link-->
    <link rel="stylesheet" href="css/userlogin.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Register Now</h3>
            <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
            ?>
            <input type="text" name="name" placeholder="enter username" class="box" required>
            <input type="email" name="email" placeholder="enter email" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
            <input type="submit" name="submit" value="Register" class="btn">
            <a href="index.php" class="btn">Back to Home</a>
            <p>already have an account? <a href="adminlogin.php">login now!</a></p>
        </form>
    </div>
</body>
</html>