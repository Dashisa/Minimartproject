<?php
include 'newconfig.php';
session_start();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$password'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:userProfile.php');
    }else{
        $message[] = 'incorrect username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Form</title>

    <!--Custom CSS File Link-->
    <link rel="stylesheet" href="css/userlogin.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Login Now</h3>
            <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
            ?>
            <input type="email" name="email" placeholder="enter email" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="submit" name="submit" value="Login" class="btn">
            <p>don't have an account? <a href="userreg.php">register now!</a></p>
        </form>
    </div>
</body>
</html>