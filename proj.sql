-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2014 at 02:45 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `proj`
--
CREATE DATABASE IF NOT EXISTS `proj` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `proj`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `shipping_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(5) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT NULL,
  `comments` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `cmt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `subject`, `comments`, `user_id`, `cmt_date`) VALUES
(20, 'gdfs', 'fds', 4, '2014-08-08 11:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `date`, `user_id`, `product_id`, `quantity`, `price`, `total`, `shipping_id`) VALUES
(21, '2014-08-06 07:42:41', 7, 1, 1, 300, 300, 0),
(22, '2014-08-06 07:42:41', 7, 2, 3, 200, 600, 0),
(23, '2014-08-06 07:44:32', 7, 26, 1, 32000, 32000, 1),
(24, '2014-08-06 10:40:51', 3, 26, 1, 32000, 32000, 6),
(25, '2014-08-06 11:33:08', 3, 28, 1, 25000, 25000, 2),
(26, '2014-08-06 11:35:05', 3, 28, 1, 25000, 25000, 0),
(27, '2014-08-06 11:35:05', 3, 5, 1, 750, 750, 0),
(28, '2014-08-06 12:07:26', 4, 1, 1, 300, 300, 0),
(29, '2014-08-06 12:07:26', 4, 3, 1, 5000, 5000, 0),
(30, '2014-08-06 12:07:26', 4, 15, 1, 50, 50, 0),
(31, '2014-08-06 12:40:22', 3, 5, 1, 750, 750, 10),
(32, '2014-08-06 12:43:16', 3, 2, 1, 200, 200, 11),
(33, '2014-08-06 12:44:54', 3, 1, 1, 300, 300, 12),
(34, '2014-08-07 09:50:31', 1, 2, 1, 200, 200, 5),
(35, '2014-08-07 12:38:33', 4, 30, 2, 27000, 54000, 13),
(36, '2014-08-08 06:58:55', 4, 1, 1, 300, 300, 13),
(37, '2014-08-08 07:00:30', 4, 15, 2, 50, 100, 0),
(38, '2014-08-08 09:03:12', 11, 2, 2, 200, 400, 0),
(39, '2014-08-08 09:04:20', 11, 1, 2, 300, 600, 0),
(40, '2014-08-08 09:07:04', 11, 3, 2, 5000, 10000, 14),
(41, '2014-08-08 09:39:19', 3, 3, 1, 5000, 5000, 0),
(42, '2014-08-08 11:01:44', 4, 1, 2, 300, 600, 0),
(43, '2014-08-08 11:03:13', 4, 15, 1, 50, 50, 15),
(44, '2014-08-08 12:10:43', 4, 1, 1, 300, 300, 0),
(45, '2014-08-08 12:15:35', 4, 15, 1, 50, 50, 0),
(46, '2014-08-11 07:38:36', 3, 30, 1, 27000, 27000, 0),
(47, '2014-08-13 06:36:08', 11, 27, 1, 150, 150, 14),
(48, '2014-08-13 11:37:52', 7, 2, 1, 200, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `type`, `color`, `description`) VALUES
(1, 'keyboard', '.jpg', 'black', 'dell #13215 keyboard'),
(2, 'mouse', '.jpg', 'black', 'Dell optical mouse'),
(3, 'monitor', '.png', 'black', 'Acer V203L LCD Monitor'),
(4, 'mouse pad', '.png', 'white', 'kjfgsalgfahgfvbuobcbwqfchubacrjc'),
(5, 'webcam', '.jpg', 'blue', 'hjfbcsahbfcorue bcnlfuoebhycoubcbjrebcbcirl'),
(6, 'pen drive', '.jpg', 'red', 'uburvbfuicbericbhecuebicubeuibibuhybi'),
(7, 'card reader', '.png', 'green', 'iowbufbvuhbuceycybchjubeyurbtevieycyeuqwfet'),
(8, 'table', '.jpg', '000000', 'dining table for 10 persons'),
(9, 'chair', '.jpg', '575757', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(10, 'wireless keyboard', '.jpg', '66FF00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(11, 'wireless mouse', '.png', 'FF0000', 'qwertyuiopasdfghjklzxcvbnmqwertyuiopasdfghjklzxcvbnm'),
(13, 'bag #0021', '.jpg', 'FFBAA1', 'this is a bag'),
(14, 'bag #0023', '.jpg', '66FF00', 'hjgsadhfgpuiabcibcpubpvujnvjevdveveeve'),
(15, 'tulips', '.jpg', '66B8FF', 'fdsd test product qty'),
(26, 'Laptop', '.jpg', 'FFFFFF', 'some description about the laptop'),
(27, 'flowers', '.jpg', '26C5FF', 'asdasdsadsadsadsa'),
(28, 'LG G3', '.png', '66FF00', 'Smart Phone: 32GB, Quad-Core Processor, HD Image, 6" display'),
(29, 'Xperia Z2', '.jpg', '000000', 'Smart Phone: 32GB, Quad-Core Processor, HD Image, 6" display'),
(30, 'PlayStation 4', '.jpg', '000000', 'Memory: 120GB');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
CREATE TABLE IF NOT EXISTS `product_details` (
  `product_id` int(5) NOT NULL AUTO_INCREMENT,
  `qty` int(4) NOT NULL DEFAULT '100',
  `price` float NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`product_id`, `qty`, `price`) VALUES
(1, 92, 300),
(2, 95, 200),
(3, 11, 5000),
(4, 100, 500),
(5, 23, 750),
(6, 50, 800),
(7, 10, 350),
(8, 25, 17500),
(9, 36, 1700),
(10, 100, 1200),
(11, 98, 1200),
(13, 100, 2500),
(14, 100, 2550),
(15, 95, 50),
(26, 9, 32000),
(27, 89, 150),
(28, 5, 25000),
(29, 5, 23500),
(30, 22, 27000);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ship_address` varchar(255) NOT NULL,
  `ship_states` varchar(255) NOT NULL,
  `ship_country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `user_id`, `ship_address`, `ship_states`, `ship_country`) VALUES
(1, 7, 'address12233, south park', 'venise', 'France'),
(2, 3, 'avenue poivre, route bassin', 'quatre bornes', 'Mauritius'),
(5, 1, 'nexteracom level 2,.ebene', 'rose hill', 'Mauritius'),
(6, 3, 'la tour koenig.ave xxxxx', 'pte aux sables', 'Mauritius'),
(9, 3, 'royal villa', 'flic en flac', 'Mauritius'),
(10, 3, 'lane yyy', 'rose belle', 'Mauritius'),
(11, 3, 'house 16, lane z', 'rose belle', 'Mauritius'),
(12, 3, 'address12233', 'belle rose', 'Mauritius'),
(13, 4, '112, avenue poivre', 'st paul', 'Mauritius'),
(14, 11, 'display, hello', 'world', 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`trans_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_id`, `date`, `user_id`, `amount`) VALUES
(1, '2014-08-11 06:02:41', 3, 500),
(2, '2014-08-11 06:02:41', 4, 1000),
(3, '2014-08-11 07:40:24', 3, 85),
(4, '2014-08-11 07:52:07', 11, 500),
(9, '2014-08-11 12:30:36', 1, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `states` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone_number` int(10) unsigned DEFAULT NULL,
  `mobile_number` int(10) unsigned NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `preferred_language` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `privilege` smallint(1) unsigned DEFAULT '0',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `dob`, `address`, `states`, `country`, `phone_number`, `mobile_number`, `gender`, `preferred_language`, `password`, `email`, `privilege`, `reg_date`, `last_login`) VALUES
(1, 'admin', 'admin', '1984-12-25', 'ebene heights, level14', 'rose hill', 'Mauritius', 4045555, 9084452, 'M', 'English', '2c7b0576873ffcbb4ca61c5a225b94e7', 'admin@accenture.com', 1, '2014-07-22 20:00:00', '2014-08-13 11:51:22'),
(2, 'Alice', 'Something', '1982-08-08', 'Houston, Alice Palace', 'TX', 'Australia', 0, 4294967295, 'F', 'Spanish', '8714bd74bdd83c760184dd89c829f3a2', 'alice@something.com', 0, '2014-07-23 20:00:00', '2014-08-11 07:05:06'),
(3, 'dhashil', 'test', '1991-11-11', 'royal road,14', 'midlands', 'Mauritius', 0, 7049651, 'M', 'English', 'c93ccd78b2076528346216b3b2f701e6', 'dhashil.bhiwoo@accenture.com', 1, '2014-07-22 20:00:00', '2014-08-13 10:42:55'),
(4, 'Ivan', 'Anderson', '1988-06-15', 'Block B-21, Ave Palmiste', 'St Croix', 'Mauritius', 59266658, 59266658, 'M', 'French', '7c6a180b36896a0a8c02787eeafb0e4c', 'ivanander@gmail.com', 1, '2014-08-05 11:16:20', '2014-08-11 07:49:29'),
(5, 'john', 'doe', '1991-11-11', 'lane x, xyz abc', 'LX624', 'USA', 7894561, 12345678, 'M', 'English', '2d68101a5dcf859a31be2494b9aa95dd', 'john.doe@domain.com', 0, '2014-07-22 20:00:00', '2014-08-01 11:45:40'),
(6, 'testlogin', 'testlogin', '2014-07-16', 'gvjhgjkgjkghjg, hjghjghjgjkg', 'hjghjggg', 'Mauritius', 1111111, 1111111, 'M', 'English', '6f12fcfe4c1034d7e265f1bb3a83a324', 'test@login1.com', 0, '2014-07-27 20:00:00', '2014-08-05 06:14:11'),
(7, 'yoyo', 'yoyo', '1975-03-15', 'dsdfsd,fdsfsdfd', 'dgffsdfsd', 'Germany', 12345678, 12345678, 'M', 'French', '16d7a4fca7442dda3ad93c9a726597e4', 'test@test.com', 0, '2014-07-23 20:00:00', '2014-08-13 11:11:38'),
(8, 'vishal', 'test', '1975-03-15', 'test,test', 'test', 'Mauritius', 12345678, 12345678, 'M', 'English', '482c811da5d5b4bc6d497ffa98491e38', 'toto@toto.com', 0, '2014-07-23 20:00:00', '2014-07-23 20:00:00'),
(9, 'user1', 'user1', '1985-07-20', 'user1add, user1add2', 'jkghkjhjhjkh', 'Mauritius', 56156165, 651651651, 'M', 'French', '7a0622e1625233f7667525753b595f7d', 'user1@user.com', 0, '2014-07-24 20:00:00', '2014-07-24 20:00:00'),
(10, 'user', 'user', '1999-05-22', 'user add,user add2', 'hghjff', 'Germany', 451451515, 4294967295, 'M', 'Spanish', 'cbd357125a99321c2a08e0206a97622f', 'user@user.com', 0, '2014-07-24 20:00:00', '2014-08-05 06:22:08'),
(11, 'Jackie', 'Sparrow', '1971-06-11', 'ertyui,ertyuio', 'zzzzzzz', 'Germany', 12345678, 12345678, 'M', 'French', '1eb3691f6a502ca3065f9702b75b6a34', 'jack@sparrow.com', 0, '2014-08-08 07:31:14', '2014-08-13 06:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

DROP TABLE IF EXISTS `users_details`;
CREATE TABLE IF NOT EXISTS `users_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `credits` mediumint(8) unsigned NOT NULL DEFAULT '500',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`user_id`, `credits`) VALUES
(1, 16777215),
(2, 500),
(3, 16745300),
(4, 1100),
(5, 500),
(6, 500),
(7, 300),
(8, 500),
(9, 500),
(10, 500),
(11, 850);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_details`
--
ALTER TABLE `users_details`
  ADD CONSTRAINT `users_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
