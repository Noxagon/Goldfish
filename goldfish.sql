-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 17, 2020 at 03:37 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goldfish`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

DROP TABLE IF EXISTS `product_info`;
CREATE TABLE IF NOT EXISTS `product_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `product_name`, `product_id`) VALUES
(1, 'Farmhouse Milk - Fresh', 'GR0'),
(2, 'Quaker Instant Oatmeal', 'GR1'),
(3, 'Naturel Organic Brown Rice', 'GR2'),
(4, 'Ah Huat White Coffee - Low Fat', 'GR3'),
(5, 'Marigold Non Fat Yoghurt - Natural', 'GR4'),
(6, 'Meiji Plain Crackers - Original', 'GR5'),
(7, 'BRANDs Essence of Chicken 6s x 68ml', 'HW0'),
(8, 'NH NUTRI GRAINS Instant Multimix Grain 1kg', 'HW1'),
(9, 'CALTRATE Plus Minerals 100 Tablets', 'HW2'),
(10, 'NUTRILIFE Immune C Vitamin C + Resveratrol 60 Caps', 'HW3'),
(11, 'PRINCIPLE NUTRITION PLUS Plus Senior Complete Multi Vitamins 150 Tablets', 'HW4'),
(12, 'VITAREALM Hyper Strength Omega3 Alaska Tuna Fish Oil 100 Capsules', 'HW5'),
(13, 'Dyson Pure Cool™ air purifier tower fan', 'HL0'),
(14, 'OSIM uDivine V Massage Chair', 'HL1'),
(15, 'Russell Taylors 6L Electric Pressure Cooker PC-60, stainless steel pot - Multi Cooker Rice Cooker', 'HL2'),
(16, 'Original Xiaomi Deerma Water Spray Dust Cleaner 360 Rotary Handheld Mop Floor Sweeper', 'HL3'),
(17, 'XIAOMI MIJIA Robot Vacuum Cleaner 1C for Home Wet Mopping Auto Sweeping Dust Sterilize', 'HL4'),
(18, 'Philips Daily Collection Coffee maker- HD7447/00', 'HL5');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_review` varchar(255) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `submit_date` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`review_id`, `product_id`, `user_id`, `user_review`, `user_rating`, `submit_date`) VALUES
(1, 'GR0', 'T0106423H', 'Great product!', 4, '2020-08-16 22:38:32'),
(2, 'GR0', 'G1819651X', 'hi', 2, '2020-08-17 10:23:14'),
(3, 'GR0', 'G1819651X', 'hello', 1, '2020-08-17 10:43:11'),
(4, 'GR0', 'G1819651X', 'test', 4, '2020-08-17 22:40:32'),
(5, 'GR0', 'G1819651X', 'review test', 3, '2020-08-17 23:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `program_members`
--

DROP TABLE IF EXISTS `program_members`;
CREATE TABLE IF NOT EXISTS `program_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_members`
--

INSERT INTO `program_members` (`id`, `program_id`, `user_id`) VALUES
(1, 'CK0', 'G1819651X'),
(2, 'CK0', 'G1819651X'),
(3, 'CK0', 'G1819651X'),
(4, 'CK0', 'G1819651X'),
(5, 'CK0', 'G1819651X'),
(6, 'CK2', 'G1819651X'),
(7, 'CK3', 'G1819651X');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_points` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_password`, `user_points`) VALUES
('G1819651X', '25d55ad283aa400af464c76d713c07ad', 8),
('S1234567N', '25d55ad283aa400af464c76d713c07ad', 0),
('T0106423H', '25d55ad283aa400af464c76d713c07ad', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

DROP TABLE IF EXISTS `user_feedback`;
CREATE TABLE IF NOT EXISTS `user_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(100) NOT NULL,
  `user_feedback` varchar(255) NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`feedback_id`, `user_name`, `user_email`, `user_phone`, `user_feedback`) VALUES
(1, 'Jaron', 'jaron8776@gmail.com', '87487951', 'Hello world!'),
(2, 'Jaron', 'jaron8776@gmail.com', '87487951', 'hi'),
(3, 'Jaron', 'jaron8776@gmail.com', '87487951', 'Hello World!!!'),
(4, 'Jaron', 'test@gmail.com', '12345678', 'Hello!!!');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
