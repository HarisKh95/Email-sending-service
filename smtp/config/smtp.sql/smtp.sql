-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 01, 2021 at 06:26 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smtp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cron`
--

DROP TABLE IF EXISTS `cron`;
CREATE TABLE IF NOT EXISTS `cron` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cron`
--

INSERT INTO `cron` (`id`, `name`, `time`) VALUES
(1, '7797Haris', '05:46:16'),
(2, '1947Haris', '05:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

DROP TABLE IF EXISTS `merchant`;
CREATE TABLE IF NOT EXISTS `merchant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `credit` float DEFAULT '100',
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`id`, `name`, `email`, `password`, `credit`, `token`) VALUES
(1, 'Merchant Haris', 'hkhurshid95@gmail.com', 'hkkgkh', 9, NULL),
(2, 'Hammad', 'raajpoothk81@gmail.com', 'hkkgkh', 9, NULL),
(3, 'Mashood', 'iamkaithebest@gmail.com', 'hkkgkh', 199.071, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Balance` float DEFAULT '0',
  `merchant_id` int(11) NOT NULL,
  `C_D` tinyint(1) DEFAULT '0',
  `payment_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `merchant_id` (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `Balance`, `merchant_id`, `C_D`, `payment_time`) VALUES
(1, 99.7066, 1, NULL, '2021-10-24 07:48:26'),
(2, 99.6577, 1, NULL, '2021-10-24 08:25:24'),
(3, 99.6088, 1, NULL, '2021-10-24 08:26:25'),
(4, 99.5599, 1, NULL, '2021-10-24 08:27:51'),
(5, 99.511, 1, NULL, '2021-10-24 08:31:21'),
(6, 99.4621, 1, NULL, '2021-10-24 08:31:46'),
(7, 99.4132, 1, NULL, '2021-10-24 08:44:04'),
(8, 99.3643, 1, NULL, '2021-10-24 08:44:50'),
(9, 99.3154, 1, NULL, '2021-10-24 08:45:44'),
(10, 99.2665, 1, NULL, '2021-10-24 08:47:20'),
(11, 99.2176, 1, NULL, '2021-10-24 08:48:23'),
(12, 99.1687, 1, NULL, '2021-10-24 08:49:10'),
(13, 99.1198, 1, NULL, '2021-10-24 08:50:38'),
(14, 99.0709, 1, NULL, '2021-10-24 08:51:08'),
(15, 99.022, 1, NULL, '2021-10-24 08:56:17'),
(16, 98.9731, 1, NULL, '2021-10-24 08:57:10'),
(17, 98.9242, 1, NULL, '2021-10-24 08:57:35'),
(18, 98.8753, 1, NULL, '2021-10-24 08:57:58'),
(19, 98.8264, 1, NULL, '2021-10-24 09:00:18'),
(20, 98.7775, 1, NULL, '2021-10-24 09:01:22'),
(21, 98.7286, 1, NULL, '2021-10-25 05:37:37'),
(22, 98.6797, 1, NULL, '2021-10-25 05:48:03'),
(23, 98.6308, 1, NULL, '2021-10-25 05:56:02'),
(24, 98.5819, 1, NULL, '2021-10-25 06:17:08'),
(25, 98.533, 1, NULL, '2021-10-25 07:28:37'),
(26, 98.4841, 1, NULL, '2021-10-25 07:29:31'),
(27, 98.4352, 1, NULL, '2021-10-25 07:32:58'),
(28, 98.3863, 1, NULL, '2021-10-25 07:35:34'),
(29, 98.3374, 1, NULL, '2021-10-25 07:36:08'),
(30, 98.2885, 1, NULL, '2021-10-25 07:36:35'),
(31, 98.2396, 1, NULL, '2021-10-25 07:37:14'),
(32, 98.1907, 1, NULL, '2021-10-25 07:38:13'),
(33, 98.1418, 1, NULL, '2021-10-25 07:41:15'),
(34, 98.0929, 1, NULL, '2021-10-25 07:50:15'),
(35, 98.044, 1, NULL, '2021-10-25 07:51:28'),
(36, 97.9951, 1, NULL, '2021-10-25 07:52:48'),
(37, 97.9462, 1, NULL, '2021-10-25 07:58:45'),
(38, 97.8973, 1, NULL, '2021-10-26 08:25:59'),
(39, 97.8484, 1, NULL, '2021-10-26 08:26:58'),
(40, 97.7995, 1, NULL, '2021-10-26 08:28:30'),
(41, 97.7506, 1, NULL, '2021-10-26 08:30:17'),
(42, 97.7017, 1, NULL, '2021-10-26 08:31:14'),
(43, 97.6528, 1, NULL, '2021-10-26 08:35:09'),
(44, 100, 1, 0, '2021-10-27 10:35:02'),
(45, 100, 1, 1, '2021-10-27 10:35:43'),
(46, 200, 1, 1, '2021-10-27 10:37:49'),
(47, 99.9511, 3, 0, '2021-10-27 19:08:34'),
(48, 99.9022, 3, 0, '2021-10-27 19:09:15'),
(49, 99.8533, 3, 0, '2021-10-27 19:14:20'),
(50, 99.8044, 3, 0, '2021-10-27 19:16:03'),
(51, 99.7555, 3, 0, '2021-10-27 19:16:54'),
(52, 99.7066, 3, 0, '2021-10-27 19:18:50'),
(53, 99.6577, 3, 0, '2021-10-27 19:19:46'),
(54, 99.6088, 3, 0, '2021-10-27 19:21:01'),
(55, 99.511, 3, 0, '2021-10-27 19:22:15'),
(56, 99.4621, 3, 0, '2021-10-27 19:23:22'),
(57, 99.4132, 3, 0, '2021-10-27 19:25:02'),
(58, 99.3643, 3, 0, '2021-10-27 19:30:33'),
(59, 99.3154, 3, 0, '2021-10-27 19:31:13'),
(60, 99.2665, 3, 0, '2021-10-27 19:32:04'),
(61, 99.2176, 3, 0, '2021-10-27 19:33:16'),
(62, 99.1687, 3, 0, '2021-10-27 19:33:54'),
(63, 99.1198, 3, 0, '2021-10-27 19:36:20'),
(64, 199.12, 3, 1, '2021-10-27 19:52:35'),
(65, 199.071, 3, 0, '2021-10-27 20:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(50) DEFAULT NULL,
  `to_email` varchar(50) DEFAULT NULL,
  `Cc` varchar(50) DEFAULT NULL,
  `Bcc` varchar(50) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `body` varchar(500) DEFAULT NULL,
  `merchant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `merchant_id` (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `from_email`, `to_email`, `Cc`, `Bcc`, `subject`, `body`, `merchant_id`) VALUES
(1, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', NULL, 1),
(2, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', NULL, 1),
(3, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'This is my body', 1),
(4, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', NULL, 1),
(5, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', NULL, 1),
(6, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service', 1),
(7, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service', 1),
(8, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service', 1),
(9, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service', 1),
(10, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'Welcome to mailjet may the delivery force be with you', 1),
(11, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service.Welcome to mailjet may the delivery force be with you', 1),
(12, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service.Welcome to mailjet may the delivery force be with you', 1),
(13, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service.\nWelcome to mailjet may the delivery force be with you', 1),
(14, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service.\nDear passenger 1, welcome to Mailjet!May the delivery force be with you!', 1),
(15, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'This is from secondary users.\nDear passenger 1, welcome to Mailjet!May the delivery force be with you!', 1),
(16, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'This is from secondary users.\nDear passenger 1, welcome to Mailjet!May the delivery force be with you!', 1),
(17, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'This is from secondary users.\nDear passenger 1, welcome to Mailjet!May the delivery force be with you!', 1),
(18, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service.\nDear passenger 1, welcome to Mailjet!May the delivery force be with you!', 3),
(19, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service.\nDear passenger 1, welcome to Mailjet!May the delivery force be with you!', 3),
(20, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'My first own email service.\nDear passenger 1, welcome to Mailjet!May the delivery force be with you!', 3),
(21, 'hkhurshid95@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'raajpoothk81@gmail.com', 'This is a test smtp mailjet', 'This is from secondary users.\nDear passenger 1, welcome to Mailjet!May the delivery force be with you!', 3);

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

DROP TABLE IF EXISTS `response`;
CREATE TABLE IF NOT EXISTS `response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `message` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_user`
--

DROP TABLE IF EXISTS `secondary_user`;
CREATE TABLE IF NOT EXISTS `secondary_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `check_listing` tinyint(1) DEFAULT '0',
  `billing_info` tinyint(1) DEFAULT '0',
  `send_mail` tinyint(1) DEFAULT '0',
  `merchant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `merchant_id` (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secondary_user`
--

INSERT INTO `secondary_user` (`id`, `name`, `email`, `password`, `check_listing`, `billing_info`, `send_mail`, `merchant_id`) VALUES
(2, 'Haris', 'add1@gmail.com', 'hkkgkh', 1, 1, 1, 1),
(3, 'Haris1', 'add2@gmail.com', 'hkkgkh', 1, 0, 1, 3),
(4, 'Haris1', 'add3@gmail.com', 'hkkgkh', 1, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `token`) VALUES
(1, 'Haris', 'pf1@gmail.com', 'hkkgkh', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
