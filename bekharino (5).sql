-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2025 at 07:13 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bekharino`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `news_id`, `name`, `comment`, `created_at`) VALUES
(1, 7, 'mohammadamin hojaty', 'عالی', '2025-05-08 08:49:38'),
(2, 7, 'reza', 'خدایا مرسی حجت بهم دادی خایه هاش دهنم', '2025-05-08 09:14:22'),
(3, 7, 'asad', '123', '2025-05-08 09:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `Brand` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `Model` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `EnergyConsumption` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `Warranty` int DEFAULT NULL,
  `Price` decimal(15,2) NOT NULL,
  `Dimensions` varchar(100) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `Weight` float DEFAULT NULL,
  `ImageURL` varchar(255) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `ProductName`, `Brand`, `Model`, `EnergyConsumption`, `Warranty`, `Price`, `Dimensions`, `Weight`, `ImageURL`, `CreatedAt`) VALUES
(7, 'لباسشویی سامسونگ', 'سامسونگ', 'gsss', 'A++', 14, 78000000.00, '10.60.45', 49.8, 'images/1745137419_6.png', '2025-04-20 08:23:39'),
(8, 'ماشین لباس شویی2', 'فیلیپس', 'WF45R6100AP', '88', 15, 78000000.00, '2.3.14', 5, 'images/1746334603_Capture44.PNG', '2025-05-04 04:56:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
