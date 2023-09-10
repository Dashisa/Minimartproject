
<?php

@include 'config.php';


if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'product added to wishlist';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart';
   }

}


if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'message sent already!';
    }else{
        mysqli_query($conn, "INSERT INTO 'message'(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'message sent successfully!';
    }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniMart |Webstore</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->

<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">MiniMart<span>.</span></a>

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#category">Categories</a>
        <a href="#newarrivals">Deals</a>
		<a href="#latest">What's New</a>
        <a href="#contact">Contact</a>
        
		
    </nav>

    <div class="icons">
        <a href="search_page.php" class="fa fa-search"></a>
        <a href="#" class="fas fa-heart"></a>
        <a href="#" class="fas fa-shopping-cart"></a>
        <a href="newlogin.php" class="fas fa-user"></a>
		<a href="adminlogin.php"><i style='font-size:24px' class='fas'>&#xf2f6;</i></a>
    </div>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <h3>MiniMart</h3>
        <span>Stock up your pantry with us </span>
        <p>Providing you the best grocery shopping experience</p>
        <a href="AboutUs.php" class="btn">About Us</a>
    </div>
    
</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span> about </span> us </h1>

    <div class="row">

        <div class="video-container">
            <video src="images/aboutvid-a.mp4" loop autoplay muted></video>
            <h3>Simply Better Shopping</h3>
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>We bring the convenience of online shopping to your fingertips. Our web-based platform is designed to provide a seamless and user-friendly experience for all your grocery needs. </p>
            <p>Whether you're a busy professional, a parent with a hectic schedule, or simply prefer the ease of shopping from the comfort of your home, we've got you covered.</p>
            <a href="AboutUs.php" class="btn">learn more</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- icons section starts  -->

<section class="icons-container">

    <div class="icons">
        <img src="images/icon-1.png" alt="">
        <div class="info">
            <h3>free delivery</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="images/icon-2.png" alt="">
        <div class="info">
            <h3>10 days returns</h3>
            <span>moneyback guarantee</span>
        </div>
    </div>

    <div class="icons">
        <img src="images/icon-3.png" alt="">
        <div class="info">
            <h3>offer & gifts</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="images/icon-4.png" alt="">
        <div class="info">
            <h3>secure paymens</h3>
            <span>protected by paypal</span>
        </div>
    </div>
   
</section>

<!-- icons section ends -->

<!-- category section starts-->
	


<section class="category" id="category">

    <h1 class="heading"><a href="category.php">Item <span>Category</span> </a></h1>

    <div class="box-container">

       <div class="box">
          
            <div class="image">
                 
            </div>
			   
            <div class="content">
                <a href="Grocery.php"><h3>Grocery</h3></a>
                
            </div>
        </div>

         <div class="box">
           
            <div class="image">
                <img src="" alt="">
                
            </div>
            <div class="content">
                <a href="stationary.php"><h3>Stationary</h3></a>
               
            </div>
        </div>

       <div class="box">
           
            <div class="image">
                <img src="" alt="">
              
            </div>
            <div class="content">
                <a href="Homeware.php"><h3>Homeware</h3></a>
               
            </div>
        </div>

       
        


        

    </div>

</section>

<!-- category section ends -->



<!-- Top deals section starts  -->

<section class="newarrivals" id="newarrivals">

    <h1 class="heading"> Top <span>Deals</span> </h1>

    <div class="box-container">

        <div class="box">
            <span class="discount">-10%</span>
            <div class="image">
                <img src="images/Items/top deals/top1.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Ratthi Milk 400g</h3>
                <div class="price"> Rs 12.99 <span>Rs 990</span> </div>
            </div>
        </div>

        <div class="box">
            <span class="discount">-15%</span>
            <div class="image">
                <img src="images/Items/top deals/top3.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 2</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            <span class="discount">-5%</span>
            <div class="image">
                <img src="images/Items/top deals/top5.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 3</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            <span class="discount">-20%</span>
            <div class="image">
                <img src="images/Items/top deals/top10.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 4</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            <span class="discount">-17%</span>
            <div class="image">
                <img src="images/Items/top deals/top11.png" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 5</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            <span class="discount">-3%</span>
            <div class="image">
                <img src="images/Items/top deals/top14.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 6</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            <span class="discount">-18%</span>
            <div class="image">
                <img src="images/Items/top deals/top16.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 7</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            <span class="discount">-10%</span>
            <div class="image">
                <img src="images/Items/top deals/top15.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 8</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        

    </div>

</section>

<!-- Top deals section ends -->







<!-- Latest section starts  -->

<section class="latest" id="latest">

    <h1 class="heading">Latest <span>Items</span> </h1>

    <div class="box-container">

        <div class="box">
           
            <div class="image">
                <img src="images/Items/new items/new1.jpg" alt="">
                <div class="icons">
                    <a href="#" value="add to wishlist" name="add_to_wishlist" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 1</h3>
                <div class="price">Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            
            <div class="image">
                <img src="images/Items/new items/new3.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 2</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
           
            <div class="image">
                <img src="images/Items/new items/new2.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 3</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            
            <div class="image">
                <img src="images/Items/new items/new4.png" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 4</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
           
            <div class="image">
                <img src="images/Items/new items/new5.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 5</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            
            <div class="image">
                <img src="images/Items/new items/new6.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 6</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
            
            <div class="image">
                <img src="images/Items/new items/new7.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 7</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        <div class="box">
           
            <div class="image">
                <img src="images/Items/new items/new9.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Item 8</h3>
                <div class="price"> Rs 12.99 <span>Rs 15.99</span> </div>
            </div>
        </div>

        

    </div>

</section>

<!-- Latest section ends -->

	
		
<!-- review section starts  -->

<section class="review" id="review">

<h1 class="heading"> customer's <span>review</span> </h1>

<div class="box-container">

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Best Grocery Grocery Stores is a leading grocery store in the area. When visiting them you will find a wide selection of items and fantastic prices. The staff there are very helpful, friendly and knowledgeable. I highly recommend this location for anyone looking for their next shopping experience!</p>
        <div class="user">
            <img src="images/user1.jpg" alt="">
            <div class="user-info">
                <h3>Sandali Silva</h3>
                <span>happy customer</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Excellent service, very well packed and good quality food. I’ll definitely order again.
            Searched numerous sites for my goods and whilst there was some sites that offered different
             brands and in some case cheaper prices I’m so glad I went with Best Grocery. 
             I will certainly be ordering again
        </p>
        <div class="user">
            <img src="images/user2.jpg" alt="">
            <div class="user-info">
                <h3>Shania Perera</h3>
                <span>happy customer</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Searched numerous sites for my goods and whilst there was some sites that offered 
            different brands and in some case cheaper prices I’m so glad I went with Best Grocery. 
            I will certainly be ordering again</p>
        <div class="user">
            <img src="images/user3.jpg" alt="">
            <div class="user-info">
                <h3>Rashmi Tharika</h3>
                <span>happy customer</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>

</div>
    
</section>

<!-- review section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading"> <span> contact </span> us </h1>

    <div class="row">

        <form action="" method="POST">
            <input type="text" name="name" placeholder="name" class="box">
            <input type="email" name="email" placeholder="email" class="box">
            <input type="number" name="number" placeholder="number" class="box">
            <textarea name="message" class="box" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>

        

        <div class="image">
            <img src="images/contact.jpg" alt="">
        </div>

    </div>

</section>

<!-- contact section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="#">home</a>
            <a href="#">about</a>
            <a href="#">Category</a>
            <a href="#">review</a>
            <a href="#">contact</a>
        </div>

        <div class="box">
            <h3>extra links</h3>
            <a href="#">my account</a>
            <a href="#">my order</a>
            <a href="#">my favorite</a>
        </div>

        <div class="box">
            <h3>locations</h3>
            <a href="#">Sri-Lanka</a>
            
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#">+123-456-7890</a>
            <a href="#">minimart@gmail.com</a>
            <a href="#">Colombo-Sri Lanka</a>
            <img src="images/payment.png" alt="">
        </div>

    </div>

    <div class="credit"> Design by <span> Tech Nerds </span> | All Rights Reserved </div>

</section>

<!-- footer section ends -->


















    
</body>
</html>