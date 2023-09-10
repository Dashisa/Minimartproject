-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2023 at 08:51 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_form`
--

DROP TABLE IF EXISTS `admin_form`;
CREATE TABLE IF NOT EXISTS `admin_form` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_form`
--

INSERT INTO `admin_form` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin'),
(2, 'admin1', 'admin1@gmail.com', 'admin1'),
(3, 'admin2', 'admin2@gmail.com', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `agent_id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1006 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(1, 102, 103, 'milk packet', 250, 3, ''),
(1005, 101, 302, 'cookie', 450, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `order_id` int(100) NOT NULL,
  `agent_name` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `order_id`, `agent_name`, `area`, `payment_status`, `user_email`) VALUES
(1, 0, 'Saman', 'Panadura', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `INVOICE_NO` int(50) NOT NULL,
  `INVOICE_DATE` date NOT NULL,
  `SNAME` varchar(50) NOT NULL,
  `SADDRESS` varchar(150) NOT NULL,
  `SCONTACT` int(11) NOT NULL,
  `GRAND_TOTAL` double(10,2) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

DROP TABLE IF EXISTS `invoice_products`;
CREATE TABLE IF NOT EXISTS `invoice_products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SID` int(11) NOT NULL,
  `PNAME` varchar(100) NOT NULL,
  `PRICE` double(10,2) NOT NULL,
  `QTY` int(11) NOT NULL,
  `TOTAL` double(10,2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 101, 'Tom', 'tom@gmail.com', '0777666556', 'hiiiiiiiiiiiiiiiiiiiiiiiiiiii');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `number` varchar(12) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `method` varchar(50) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `productname` varchar(100) NOT NULL,
  `total_products` varchar(1000) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `payment_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `agent_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123458 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `productname`, `total_products`, `total_price`, `placed_on`, `payment_status`, `agent_name`) VALUES
(123457, 102, 'Ann', '0777666556', 'ann@gmail.com', 'credit card', 'colombo', 'Milk packet', '2', 240, '27/11/2022', 'completed', 'Agent1'),
(2001, 876543, 'kuku man', '0712456774', 'kuku@kukumangmail.com', 'cash', 'balla mawatha galle', 'Orange', '2', 300, '24/11/2022', 'completed', 'Agent1');

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

DROP TABLE IF EXISTS `parcels`;
CREATE TABLE IF NOT EXISTS `parcels` (
  `id` int(30) NOT NULL,
  `order_id` int(100) NOT NULL,
  `recipient_name` text NOT NULL,
  `recipient_address` text NOT NULL,
  `recipient_contact` text NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 = Deliver, 2=Pickup',
  `price` double NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parcel_tracks`
--

DROP TABLE IF EXISTS `parcel_tracks`;
CREATE TABLE IF NOT EXISTS `parcel_tracks` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `parcel_id` int(100) NOT NULL,
  `status` int(100) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `details` varchar(500) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `price` int(100) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `SubCategory` varchar(100) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `stock_quantity` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `category`, `SubCategory`, `image`, `stock_quantity`) VALUES
(1, 'Milk Packet', 'Kotmale vanilla flavoured milk', 120, 'Grocery', 'Beverages', 'Pic93259.jpg', 8),
(32, 'Watermelon', 'Fresh Watermelon', 300, 'Grocery', 'Fruits', 'Pic923063.jpg', 11),
(35, 'Banana', 'Fresh banana 1kg', 250, 'Grocery', 'Fruits', 'Pic923003.jpg', 9),
(36, 'Orange', 'Organic Organge', 150, 'Grocery', 'Fruits', 'Pic924025.jpg', 6),
(39, 'Coca Cola', 'Sugar free Cola', 250, 'Grocery', 'Beverages', 'Pic114723.jpg', 20),
(38, 'Cheese Buttons', 'Biscuits', 4000, 'Grocery', 'Snacks', 'Pic8519.jpg', 45),
(40, 'Carrot', 'Organic carrot 250g', 54, 'Grocery', 'Vegetables', 'Pic915007.jpg', 1000),
(42, 'Milo', 'chocolate drink', 145, 'Grocery', 'Beverages', 'Pic117377.jpg', 25);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `pro_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `contact`, `email`, `category`, `pro_id`, `quantity`) VALUES
(1, 'Peter', 'Kollupitiya', '0774563456', 'p@gmail.com', 'Grocery', 2, 0),
(2, 'Amal', 'moratuwa', '1234', ' j@gmail.com', 'Stationary', 2, 0),
(6, 'Kamal', 'Panadura,Srilanka', '1234567', ' asdfasdf@gmail.com', 'Grocery', 201, 0),
(7, 'Bill', '297,  panadura,sri lanka', '0754893584', ' b@gmail.com', 'Grocery', 32, 0),
(8, 'Saman', 'Nuwara', '0774563336', 'saman@gmail.com', 'Grocery', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `First_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `password` varchar(8) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `user_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1005 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `First_name`, `Last_name`, `number`, `Address`, `email`, `password`, `user_type`) VALUES
(3, 'admin1', 'Stock', '0777666555', '', 'admin1@gmail.com', 'admin1', 'admin'),
(1, 'Tom', 'Poll', '0752564576', 'Panadura, Sri Lanka', 'tom@gmail.com', 'tom123', 'user'),
(2, 'Sam', 'Fernando', '0777666555', 'Moratuwa, Sri Lanka', 'sam@gmail.com', 'sam123', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

DROP TABLE IF EXISTS `user_form`;
CREATE TABLE IF NOT EXISTS `user_form` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `contact`, `address`, `email`, `password`, `image`) VALUES
(1, 'Bill', '0773456897', '234,  panadura,sri lanka', 'bill@gmail.com', 'f343884e04e7b073dd66c72a49f6a923', 'u3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(1, 102, 1, 'Milk Packet', 120, 'Pic1004.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
