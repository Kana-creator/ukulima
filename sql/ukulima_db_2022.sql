-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2023 at 05:50 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukulima_db_2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `administrator_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `second_phone_number` varchar(50) DEFAULT NULL,
  `physical_address` varchar(255) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `marital_status` enum('single','married','divorced') DEFAULT NULL,
  `profile_picture` varchar(50) DEFAULT NULL,
  `identity_type` enum('national ID','driver lisence','passport') DEFAULT NULL,
  `identity_number` varchar(40) NOT NULL,
  `date_of_birth` date NOT NULL,
  `staff_category` enum('admin','data entrant') DEFAULT NULL,
  PRIMARY KEY (`administrator_id`),
  KEY `user_id` (`user_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `branch_name` varchar(225) NOT NULL,
  `branch_address` varchar(225) NOT NULL,
  `branch_number` varchar(100) NOT NULL,
  `agency_number` varchar(25) DEFAULT NULL,
  `contact_number` varchar(25) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `branch_location` enum('rural','urban') DEFAULT NULL,
  PRIMARY KEY (`branch_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `user_id`, `branch_name`, `branch_address`, `branch_number`, `agency_number`, `contact_number`, `contact_name`, `email_address`, `branch_location`) VALUES
(1, 47, 'OhOk', 'OhOkIA==', 'OhOk', 'OhOkIA==', 'OhOkIHU=', 'OhOkIA==', 'OhOkIA==', 'urban'),
(2, 48, 'KAG2Mg==', 'KAG2Mg==', 'KAG2', 'KAG2Mg==', 'KAG2Mg==', 'KAG2Mg==', 'KAG2Mg==', 'urban'),
(3, 48, 'ORCnI3Y=', 'ORCnI3Y=', 'ORCnI3Y=', 'ORCnI3Y=', 'ORCnI3Y=', 'ORCnI3Y=', 'ORCnI3Y=', 'rural');

-- --------------------------------------------------------

--
-- Table structure for table `consumer`
--

DROP TABLE IF EXISTS `consumer`;
CREATE TABLE IF NOT EXISTS `consumer` (
  `consumer_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `group_id` int NOT NULL DEFAULT '0',
  `consumer_type` enum('admin','director','member') DEFAULT NULL,
  `occupation` varchar(25) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `identity_type` enum('national ID','driver lisence','passprot') DEFAULT NULL,
  `identity_number` varchar(40) DEFAULT NULL,
  `estimated_acreage` int DEFAULT NULL,
  `major_economic_activity` varchar(40) DEFAULT NULL,
  `estimated_monthly_income` int DEFAULT NULL,
  `consumer_location` varchar(255) DEFAULT NULL,
  `disability` varchar(50) DEFAULT NULL,
  `nationality` varchar(25) DEFAULT NULL,
  `marital_status` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`consumer_id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `consumer`
--

INSERT INTO `consumer` (`consumer_id`, `user_id`, `group_id`, `consumer_type`, `occupation`, `date_of_birth`, `identity_type`, `identity_number`, `estimated_acreage`, `major_economic_activity`, `estimated_monthly_income`, `consumer_location`, `disability`, `nationality`, `marital_status`) VALUES
(1, 30, 1, 'member', 'KhihMH4M9ZU=', '2022-12-08', 'national ID', 'KhihMH4M9ZU=', 8, 'LQSwN2Ad8g==', 88, 'LQezNGIc', 'LwSwNWId8Inb', 'LQawN2Ee8Io=', 'Ggm5NGof'),
(2, 31, 3, 'member', 'KhihMH4M9ZU=', '2022-12-08', 'national ID', 'KhihMH4M9ZU=', 8, 'LQSwN2Ad8g==', 88, 'LQezNGIc', 'LwSwNWId8Inb', 'LQawN2Ee8Io=', 'Ggm5NGof'),
(3, 32, 2, 'member', 'IQSxO24d8IU=', '2022-12-24', 'national ID', 'LwazNGIc8YvY', 65, 'LwSwN2Ad8Inb', 65, 'LROxIGAJ8g==', 'LQezNWEe', 'LQazNWI=', 'Ggm5NGof'),
(4, 33, 1, 'director', 'KAG2Mmcb94zd', '2022-12-14', 'national ID', 'KAG2Mmcb94zd/w==', 45, 'KAG2Mmc=', 88, 'KAG2Mmcb94zd/w==', 'KAG2Mmc=', 'KAG2Mmcb94zd/w==', 'Ggm5NGof'),
(5, 37, 6, 'member', 'LQawNWId', '2022-11-28', 'national ID', 'LQawNWId8ovb+mRB', 45, 'LQexN2Ec8g==', 700000, 'KBOzMnUe954=', 'Jw+5Ng==', 'LROxN3Uc5Q==', 'Ggm5NGof'),
(12, 45, 6, 'member', 'KAG2Mmcb94zd/2NHIw==', '2022-11-28', '', 'KAG2Mmcb94zd/2NHIw==', 4, 'KAG2Mmcb9w==', 4, 'KAG2Mmcb94zd/w==', 'KAG2Mmcb94zd/w==', 'KAG2Mmcb94zd', 'BAGlIW8f8g=='),
(13, 46, 6, 'member', 'LxOxN2A=', '2022-11-28', 'national ID', '', 4, 'DCaSFUM8', 4, 'LROzIGIe5Q==', 'LAayNmAf', 'OhOkN3Ue', 'BAGlIW8f8g==');

-- --------------------------------------------------------

--
-- Table structure for table `consumer_group`
--

DROP TABLE IF EXISTS `consumer_group`;
CREATE TABLE IF NOT EXISTS `consumer_group` (
  `group_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `registration_type` enum('Company','NGO','CBO') DEFAULT NULL,
  `registration_number` varchar(30) DEFAULT NULL,
  `group_type` enum('VSLA','ASCA','ROSCA','FM Grp') DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `consumer_group`
--

INSERT INTO `consumer_group` (`group_id`, `user_id`, `group_name`, `registration_type`, `registration_number`, `group_type`) VALUES
(1, 3, 'DFGFG', 'CBO', 'DFGFDG', 'ROSCA'),
(3, 28, 'fdgdfg', 'Company', 'sfsfsd', 'ASCA'),
(4, 2, 'gro', 'Company', '1211212', 'VSLA'),
(5, 1, 'ttrtrr', 'NGO', 'hjhjh', 'VSLA'),
(6, 30, 'sdfsfsd', 'NGO', 'fsdfsdfds', 'VSLA');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
CREATE TABLE IF NOT EXISTS `loan` (
  `loan_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `savings_date` date NOT NULL,
  `savings_amount` int NOT NULL,
  `brought_by_name` varchar(50) NOT NULL,
  `brought_by_phone` varchar(50) NOT NULL,
  PRIMARY KEY (`loan_id`),
  KEY `consumer_id` (`consumer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `consumer_id`, `savings_date`, `savings_amount`, `brought_by_name`, `brought_by_phone`) VALUES
(1, 1, '2022-12-05', 25000, 'OgSkN3U=', 'OgSkN3Ue'),
(2, 1, '2022-12-22', 33000, 'LRO2N3Ub', 'OgSkMmI='),
(3, 3, '2022-12-06', 250000, 'LwSkNXUe8A==', 'LgawNWId8os='),
(4, 3, '2022-12-06', 250000, 'LwSkNXUe8A==', 'LgawNWId8os='),
(5, 4, '2022-12-15', 300000, 'LQSkN2AJ', 'LROxN3Uc'),
(6, 5, '2023-02-15', 500000, 'GQWjNnRa3Yzb6WM=', 'eVfnZjRDo9SPrA==');

-- --------------------------------------------------------

--
-- Table structure for table `next_of_kin`
--

DROP TABLE IF EXISTS `next_of_kin`;
CREATE TABLE IF NOT EXISTS `next_of_kin` (
  `next_of_kin_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  PRIMARY KEY (`next_of_kin_id`),
  KEY `consumer_id` (`consumer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `next_of_kin`
--

INSERT INTO `next_of_kin` (`next_of_kin_id`, `consumer_id`, `full_name`, `phone_number`) VALUES
(1, 1, 'PRKuKnII75nO53ZU', 'IQexO2Ad8YvU+WQ='),
(2, 2, 'JhC4I2kK', 'JQu7OGo='),
(5, 3, 'LgSxNGIc8Q==', 'LwezNWEe8Ira'),
(6, 4, 'KAG2Mmcb', 'KAG2Mmcb9w=='),
(7, 5, 'AhWjNmMJ9837+3RHMQ==', 'eVfgajVIpt2Lqw=='),
(8, 6, 'OgSxIGAJ8g==', 'LROxN2Ae5Ys='),
(14, 12, 'KAG2Mmcb94zd/2NH', 'KAG2Mmcb94zd/2M='),
(15, 13, 'LAWxNmM=', 'LAWlJGMI8w==');

-- --------------------------------------------------------

--
-- Table structure for table `producer`
--

DROP TABLE IF EXISTS `producer`;
CREATE TABLE IF NOT EXISTS `producer` (
  `producer_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `user_type` enum('super admin','admin','data entrant') DEFAULT NULL,
  `user_address` varchar(225) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `marital_status` enum('single','married','divorced') DEFAULT NULL,
  `identity_type` enum('national ID','driver lisence','passport') DEFAULT NULL,
  `identity_number` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`producer_id`),
  KEY `user_id` (`user_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `producer`
--

INSERT INTO `producer` (`producer_id`, `user_id`, `branch_id`, `user_type`, `user_address`, `nationality`, `marital_status`, `identity_type`, `identity_number`, `date_of_birth`) VALUES
(1, 48, 2, 'super admin', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 69, 2, 'data entrant', 'BRW5NHMQ/Iw=', 'HAe2PWIb+A==', 'single', 'national ID', 'eFnuYg==', '2023-01-30'),
(4, 70, 2, 'data entrant', 'OgSxN2AJ8os=', 'OgSxN3Uc8os=', 'married', 'national ID', 'LQakN2Ae5YvP+mQ=', '2021-05-05'),
(5, 71, 3, 'data entrant', 'Lwe/O2Ba8c3U+WpBKg==', 'IQawO2ES8Ys=', 'single', 'national ID', 'LQexNGEc8oo=', '2023-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `product_manufacturer` varchar(100) NOT NULL,
  `product_supplier` varchar(100) DEFAULT NULL,
  `point_of_origin` varchar(255) NOT NULL,
  `date_of_manufacture` date NOT NULL,
  `product_expiry_date` date NOT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  `unit_of_measure` varchar(30) NOT NULL,
  `batch_number` varchar(50) DEFAULT NULL,
  `serial_number` varchar(100) NOT NULL,
  `product_category` varchar(50) DEFAULT NULL,
  `unit_cost` varchar(30) NOT NULL,
  `user_guid` varchar(10000) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `serial_number` (`serial_number`),
  UNIQUE KEY `serial_number_2` (`serial_number`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `user_id`, `brand_name`, `product_manufacturer`, `product_supplier`, `point_of_origin`, `date_of_manufacture`, `product_expiry_date`, `product_image`, `unit_of_measure`, `batch_number`, `serial_number`, `product_category`, `unit_cost`, `user_guid`, `registration_date`) VALUES
(4, 1, 'e0zjfkI=', 'OgGzIGce5Q==', 'CxW8PGkW980=', 'OgGzIGIJ94k=', '2022-09-26', '2022-11-06', 'e0z3Zys+uIfM+Q==', 'fAyjIQ==', 'eiSSATJJ', 'DliTFT9D0av7pzsScf0=', NULL, 'e1XnYzY=', 'LwSkNWIJ8A==', '0000-00-00 00:00:00'),
(2, 2, 'HgWyNyYX957I+3A=', 'CxW8PGkW9w==', 'CCv3N28J4p/V/HdSLckg6asySs/BAMRPMwY=', 'CwW+PWwT8c3/9mtII5s=', '2022-10-03', '2022-11-06', 'PgWyNyYX957I+3AIKMs0', 'eE7iP3II', 'elPjGzUo09WFyQ==', 'e1jkBj8podWEp0AUF4Jh8Q==', NULL, 'eFXnYzY=', 'e1DnHkpa/4OcrDIGLtInu5t1QcTXE41gBiz3', '0000-00-00 00:00:00'),
(9, 1, 'OgGzIGce', 'OgGzIGce5YzY', 'OgGzIGce5Yw=', 'OgGzIGIJ94k=', '2022-10-31', '2022-12-11', 'PgWyNyYX957I+3AGMtQkrZsnBcvVBg==', 'OgGzIGce5Q==', 'OgGzIGce5YzY', 'OgGzIGce5YzY', NULL, 'fVXjYzY=', 'OgGzIGce5YzY', '0000-00-00 00:00:00'),
(8, 3, 'Ggi+PWM=', 'OgakN2A=', 'OgakN2A=', 'OgSxIGIc', '2022-10-31', '2022-12-11', 'elDkfnQf+4LK+2BBb8shrIg8TtaLAJJqAQ==', 'eguw', 'GlXkZ0A8otmP', 'GiSTZzJPpd+OqzZjBOgV/Q==', 'KhK4IyYS457e/2xCMMI=', 'fVXnYzY=', 'GjqPEFwi1bfk', '0000-00-00 00:00:00'),
(7, 3, 'HQGxJmEb', 'LxOzNWIJ', 'LQakNXUe', 'LQazIGAJ8g==', '2022-10-31', '2023-11-11', 'PQGxJmEbuIfM+Q==', 'fFDnNA==', 'elSOFkJIpQ==', 'e1SAZzVJpL+IrVAfDQ==', 'KhK4IyYS457e/2xCMMI=', 'flDnYw==', 'OgS2IGIJ94k=', '0000-00-00 00:00:00'),
(10, 3, 'KBOz', 'KBOzIGc=', 'OgGzIGce', 'KBOzMnUe', '2022-10-31', '2022-12-11', 'PgWyNyYX957I+3AGMtQkrZsnBcvVBg==', 'OgGzMnUe', 'OgGzIGce', 'KASkN2c=', 'KBGiMnRa9YzQ6ndUJ5s=', 'f1PnYw==', 'OgGzIGce5Yw=', '0000-00-00 00:00:00'),
(11, 4, 'IQ69PWwU', 'JAv3cyY=', 'JEC6c2s=', 'Iw69PWw=', '2022-11-09', '2022-12-11', 'PgWyNyYX957I+3AIKMs0', 'Ig+8PA==', 'Igu+Og==', 'ZQv7OCo=', NULL, 'cVDnYw==', 'IRm/Km4D', '0000-00-00 00:00:00'),
(17, 3, 'KAG2Mmc=', 'KAG2Mmcb', 'KAG2Mmcb94zd/w==', 'KAG2Mmc=', '2022-12-26', '2023-02-05', 'PgWyNyYX957I+3AIKMs0', 'fFC8NA==', 'KAG2Mmcb9w==', 'KAG2Mg==', 'KA6+PmcWtoXJ7WBHLN8hsA==', 'fFPnYzY=', 'KAG2Mmc=', '2023-01-09 03:12:25'),
(18, 3, 'PRSjJw==', 'PRSjJw==', 'PRSjJ3I=', 'PRSjJw==', '2022-12-26', '2023-02-05', 'PQGxJmEbuIfM+Q==', 'fFDnPmo=', 'LgiwO2ES/orU', 'IQe/NG4=', 'KBGiMnRa9YzQ6ndUJ5s=', 'fFLnYzY=', 'LwSzNWIc', '2023-01-13 17:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_report`
--

DROP TABLE IF EXISTS `product_report`;
CREATE TABLE IF NOT EXISTS `product_report` (
  `record_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `report_type` varchar(50) NOT NULL,
  `serial_number` varchar(50) NOT NULL,
  `batch_number` varchar(50) DEFAULT NULL,
  `producer` varchar(50) DEFAULT NULL,
  `supplier` varchar(50) DEFAULT NULL,
  `report_details` varchar(255) DEFAULT NULL,
  `record_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`record_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_report`
--

INSERT INTO `product_report` (`record_id`, `user_id`, `report_type`, `serial_number`, `batch_number`, `producer`, `supplier`, `report_details`, `record_date`) VALUES
(1, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', NULL),
(2, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:09:00'),
(3, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:09:41'),
(4, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:10:58'),
(5, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:11:51'),
(6, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:15:08'),
(7, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:21:24'),
(8, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:21:29'),
(9, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:28:13'),
(10, 30, 'ORK4N3MZ4s3S8XYGJNQm', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Q==', 'OgSkN3Ue', 'OgSkN3Ue5Yk=', 'OgSkN3Ue5Yk=', '2023-01-19 07:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

DROP TABLE IF EXISTS `savings`;
CREATE TABLE IF NOT EXISTS `savings` (
  `savings_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `savings_date` date NOT NULL,
  `savings_amount` int NOT NULL,
  `brought_by_name` varchar(50) NOT NULL,
  `brought_by_phone` varchar(50) NOT NULL,
  PRIMARY KEY (`savings_id`),
  KEY `consumer_id` (`consumer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`savings_id`, `consumer_id`, `savings_date`, `savings_amount`, `brought_by_name`, `brought_by_phone`) VALUES
(1, 3, '2022-12-10', 0, 'LQWyIWMI', 'OxeyIWMN5A=='),
(2, 3, '2022-12-10', 2, 'LQWyIWMI', 'OxeyIWMN5A=='),
(3, 3, '2022-12-29', 75000, 'KASkMmI=', 'KBOzIGce'),
(4, 4, '2022-12-01', 35000, 'KwK1MWQY', 'KwK1MWQY'),
(5, 1, '2022-12-29', 560000, 'OgSkNHUd', 'OgSxIGIc5Yk='),
(6, 2, '2022-12-16', 560000, 'OgSkNHUd', 'OgSxIGIc5Yk='),
(7, 1, '2022-12-06', 450000, 'Iwq8O20Q/g==', 'LwexNG4c'),
(8, 1, '2022-12-07', 100000, 'LgiwO2E=', 'LgiwO2ES'),
(9, 1, '2022-12-02', 100000, 'LgiwO2E=', 'LgiwO2ES'),
(10, 5, '2022-12-20', 560000, 'IQi/O24S/oXU9mpOKtM7', 'IQi/O24S/oXU9mpOKg==');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `user_type` enum('super admin','admin','data entrant') DEFAULT NULL,
  `user_address` varchar(225) DEFAULT NULL,
  `nationality` varchar(25) DEFAULT NULL,
  `marital_status` enum('single','married','divorced') DEFAULT NULL,
  `identity_type` enum('national ID','driver lisence','passport') DEFAULT NULL,
  `identity_number` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`supplier_id`),
  KEY `user_id` (`user_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `user_id`, `branch_id`, `user_type`, `user_address`, `nationality`, `marital_status`, `identity_type`, `identity_number`, `date_of_birth`) VALUES
(1, 47, 1, 'super admin', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 66, 2, 'data entrant', 'LxOzNWIJ8InP+GQ=', 'LwSkNXUe8InP', 'married', 'national ID', 'LROxN3Uc8p7a+nFA', '2023-01-30'),
(5, 65, 2, 'admin', 'OgSxIGIc5Yk=', 'LROxIGIc5Q==', 'single', 'passport', 'LROxIGIc5Yna', '2023-01-30'),
(4, 64, 1, 'admin', 'LgazNGAe', 'LgSxNGIc8g==', 'married', 'national ID', 'LwSwN2Ad8os=', '2023-01-30'),
(7, 67, 2, 'data entrant', 'MxqtKXwA7Jc=', 'MxqtKXwA7JfG5Hg=', 'married', 'national ID', 'MxqtKXwA7JfG', '2023-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_telephone` varchar(50) NOT NULL,
  `user_category` varchar(25) DEFAULT NULL,
  `user_gender` enum('Male','Female','Others') DEFAULT NULL,
  `user_password` varchar(100) NOT NULL,
  `login_status` int NOT NULL DEFAULT '0',
  `profile_image` varchar(100) DEFAULT NULL,
  `profile_status` int DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_telephone` (`user_telephone`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `user_email`, `user_telephone`, `user_category`, `user_gender`, `user_password`, `login_status`, `profile_image`, `profile_status`) VALUES
(1, 'KAE=', 'KAE=', 'KAGXMmc=', 'KAE=', 'dev', 'Male', '$2y$10$x4RqeHCd4O2J4.EcBDV9zObGE9yuHaWNSSWQiX8w8qhH6ZBK2Ri1O', 0, NULL, 0),
(2, 'KwI=', 'aQK1', 'KwKXMWQ=', 'KwI=', 'admin', 'Male', '$2y$10$KdVg9YaSg/rl14VtCi3dT.5DQGqNzLxz9QtFHTNPzMzQZGwWPT/Xa', 0, NULL, 0),
(3, 'KgM=', 'KgM=', 'KgOXMGU=', 'KgM=', 'producer', 'Female', '$2y$10$Jp1fzWZ9yZmSfVbntSawAOu23TDgH7khlNNP7nJwV9Lke8G30x/2y', 0, NULL, 0),
(4, 'LQQ=', 'LQQ=', 'LQSXN2I=', 'LQQ=', 'consumer', 'Male', '$2y$10$7a524EwP4vwk/aaJjztiRepShbTvvyGi9Cf4SZTQCb8y1AP0xiNf.', 0, NULL, 0),
(30, 'LwY=', 'LwY=', 'LwaXNWA=', 'LwY=', 'consumer', 'Male', '$2y$10$CjQaABG4aKMXcO5Ui76yyuBXf2WEZrdpyqIrJcZGBKD5OHRm3ANhW', 1, NULL, 0),
(27, 'MBSiKnIP', 'PBmjJnID45k=', 'PBSuJnID463O53tSK84qoA==', 'Igy8P20W/YHX8mk=', 'consumer', 'Female', '$2y$10$72w05w7wT2rLJ.E4V90mbe7So03SlNoRXE4Dsv8/4KKxoiAEuaIS6', 0, NULL, 0),
(31, 'Kha1JWUY', 'KgK0JWQM9Y8=', 'Kha1MHAY9Zv8+mRBJN80', 'KgK0JWQZ4I8=', 'consumer', 'Female', '$2y$10$y/DVub2fjzxgZ3zyhS.O7eKCY2joMDlApkFGR6dCDcxf2epnTOfvu', 0, NULL, 0),
(34, 'Mxo=', 'Mxo=', 'Mxo=', 'Mxo=', 'dev', 'Male', '$2y$10$ClxhKcoPxrKB8FumnaNzduXrFrLBfDDveIx.iI2kGDAWooJu5V94O', 0, NULL, 0),
(32, 'CA62J2kW/w==', 'AhWgNmQN9w==', 'KAuiJGMY4Yz8+W9HK9d9qpE4', 'eVfgajVIpt2Lqw==', 'consumer', 'Male', '$2y$10$6DNyhcjWbJHgaBGtcNi/4.Y4wPSUmpHhqqOmKnY9CCQGkaM9eR6Pi', 0, NULL, 0),
(33, 'KAG2Mmcb94w=', 'KAG2Mmcb94zd', 'KAG2Mmcb94zd/0JHI9oyqJ80', 'KAG2Mmcb94zd', 'consumer', 'Male', '$2y$10$jpD3YXWTQpjRsY5M7xG5ZOhuVlGWU0MylOtvHSrmT3JDlqtFFpy7W', 0, NULL, 0),
(35, 'MBk=', 'MBk=', 'MBk=', 'MBk=', 'admin', 'Male', '$2y$10$F5rAKgC0x5Knr4cUp0Gyv./r61pnIFaROuHPRoJdeYlYN9ng159Tu', 0, NULL, 0),
(26, 'PQWlJ3Qf4p/Z', 'OwWjIWMO85/I+w==', 'OxSlNnII85n86nZDMM82uw==', 'OxKyJ3QI75TI7HtU', 'consumer', 'Male', '$2y$10$oXZqkxZ1YYWLMfpujRat0.OC7uXsdm2H8cYehN5oEaXthY22nylNq', 0, NULL, 0),
(36, 'MRg=', 'MRg=', 'MRg=', 'MRg=', 'admin', 'Male', '$2y$10$ZeZXtop/0I24LmG7L1vz..GJMzY.ndNkeszGq6WCh82ygYcHgFq5C', 0, NULL, 0),
(37, 'CA62J2kW/80=', 'AhWgNmQN9w==', 'KA62J2kW/8PX63VDIMwyiZk4SsjJT4dsCg==', 'eVfnZTRDo9SPrA==', 'consumer', 'Male', '$2y$10$dk1uF.9MQWQCronrmPsdC.JzaRLbFfhqhFMt6SWFdMiIS0KmlGY/q', 0, NULL, 0),
(38, 'LROxIGIc', 'OgaxIA==', 'LwSxIGA68ovb+mRB', 'LgSwN2Ad', 'consumer', 'Female', '$2y$10$iG03wV0G8Ah5OaxdVkkoCuVDceRhdJsWejlsXqbCCMvrKeZhCnEeW', 0, NULL, 0),
(45, 'KAG2Mmcb', 'KAG2Mmcb9w==', 'KAG2MkYb94zd/2NHIw==', 'KAG2Mmc=', 'consumer', 'Male', '$2y$10$By3Y3Z8A5owtLCvNUoG.aukc7dx8FagqJ.wasxhCBItochFsh/Hd6', 0, NULL, 0),
(46, 'LBeyJGM=', 'PgWgNnEf', 'LAWgJGM68p7Y7Q==', 'LROzIGI=', 'consumer', 'Male', '$2y$10$3BXICMTjOU/AZSAC7y1So.vQETgORkNv0gmxndDylgFdfh9n9oVAy', 0, 'back.PNG', 0),
(47, 'OhM=', 'OhM=', 'OhOXIHU=', 'OhM=', 'SupPlier', 'Male', '$2y$10$Gan3LmRXrH5VnpBNPXFaN..sQ1SGEVExDlZfp.8aS8xlFASmSPzDe', 0, NULL, 0),
(48, 'ORA=', 'ORA=', 'ORA=', 'ORA=', 'producer', 'Male', '$2y$10$5Kz31k31JNjJ5ABEuVW0r.tMTPAwA5Jowhw5LerAXl.xO4or/nche', 0, NULL, 0),
(49, 'Iwo=', 'Iwo=', 'Iwo=', 'Iwo=', 'SupPlier', 'Male', '$2y$10$YwiISQEmdVD.dvZ0awN6FORJ5lgRR4/L49cEgwFGnm8FH6CPX.MCO', 1, NULL, 0),
(50, '', '', '', '', NULL, 'Male', '', 0, NULL, 0),
(51, 'first_name', 'Kuwebwa', 'akuwebwa@gmail.com', '0779320075', 'producer', 'Male', 'anny1991', 0, 'aa.jpg', 0),
(52, 'Anatoli', 'Kuwebwa', 'akuwebwa@gmail1.com', '07793200751', 'producer', 'Male', 'anny1991', 0, 'aa.jpg', 0),
(53, 'CA62J2kW/w==', 'AhWgNmQN9w==', 'KAuiJGMY4Yz8+W9HK9dh5506Rg==', 'eVfgajVIpt2LqzA=', 'producer', '', '$2y$10$gRn9IKnhVRmfGcaU4oVRF.7YJStW/KrLKZcM8JEBcMP6yOh8GXBkm', 0, 'aa.jpg', 0),
(54, 'CA62J2kW/w==', 'AhWgNmQN9w==', 'KAuiJGMY4Yz8+W9HK9dg5506Rg==', 'eVfgajVIpt2LqzE=', 'producer', 'Male', '$2y$10$MjuUcPf41t6CZtCtyDykyutAgTV9LWsUdEWGvOtym9nPB4ovegPA6', 0, 'aa.jpg', 0),
(55, 'CA62J2kW/w==', 'AhWgNmQN9w==', 'KAuiJGMY4Yz8+W9HK9dn5506Rg==', 'eVfgajVIpt2LqzY=', 'producer', 'Male', '$2y$10$scxRDZ.87GYue.NUMgU0i.qAsroR1Hj6flS9tW3hz8b0ceI4EY48W', 0, '', 0),
(56, 'CA62J2kW/w==', 'AhWgNmQN9w==', 'KAuiJGMY4Yz8+W9HK9dm5506Rg==', 'eVfgajVIpt2Lqzc=', 'producer', 'Male', '$2y$10$y0/b1IO2i0N.spmPPWhmIOfHnKjHOegFFlVhUtlD0D2/mtfun1C4i', 0, '', 0),
(57, 'zz', 'zz', 'zz@zz', '0706295932', 'Supplier', 'Female', '$2y$10$5nOtDPlkCgvmA0C20IU74uR/lwFcyvLA.HH3noMK/YV.xCVDsNGiy', 0, 'zz.jpeg', 0),
(58, 'zz', 'zz', 'zz@zz99', '070629593299', 'Supplier', 'Female', '$2y$10$KoTK26CvgpvGRturGnNlgO2CHlxfXb3mdNY8IJJeSXvAwvSWIRWCW', 0, 'zz.jpeg', 0),
(59, 'zz', 'zz', 'zz@zz9', '07062959329', 'Supplier', 'Female', '$2y$10$3GN6t.HZTUUMA4G.hKUCgOYD2JBUCHkL9ewpX1AvBrIAXZVZfiMrW', 0, 'zz.jpeg', 0),
(60, 'Jw65PWgU', 'Jw65PWgU', 'Jw65E2gU+A==', 'Jw65PQ==', 'consumer', 'Male', '$2y$10$vlp/64phZF.qvUJFD9SGzOoDJJAIHw52RBUalLzq56WvRpeNtCfde', 0, '', 0),
(61, 'Jw65PWg=', 'Jw65PWgU', 'Jw65PUYU+IPS8A==', 'Jw65PWgU+A==', 'consumer', 'Male', '$2y$10$3A3N9DKulqo01WwUO2m1oOl4BBOtP3bEVlARJFjCBmPz/G1seUaCi', 0, '', 0),
(65, 'KBO2N3Ub8g==', 'KAS2IGIJ94k=', 'LQGzMnUe5YzY3nFCI8g3qA==', 'KASkN3Ub8ozP+g==', 'producer', 'Female', 'LQSzN2Ie8onY', 0, '', 0),
(64, 'OgakN2Ae5Q==', 'LxOzNWIJ8A==', 'OgSxN3Uc8p787WZAMd0=', 'OgSxN3Uc8p4=', 'SupPlier', 'Male', 'LQSzN2Ie8g==', 0, '', 0),
(66, 'OgazIGAe8J7Y', 'LROxIGIc8p7a', 'LROxN3Uc8p7a3mRCMd03ug==', 'OgSxIGAJ8os=', 'producer', 'Male', 'LwaxNWAc8Iva+GRAJA==', 0, '', 0),
(67, 'MxqtKXwA7JfG5Hg=', 'MxqtKXwA7Jc=', 'MxqtKUYA7JfG5Hg=', 'MxqtKXw=', 'producer', 'Male', 'MxqtKXwA7A==', 0, '', 0),
(69, 'CA62J2kW/w==', 'AhWgNmQN9w==', 'KA62J2kW/8PX63VDIMwyiYc0Q87KT4dsCg==', 'YlLiZTFNr96OrjIRdw==', 'producer', 'Male', '', 0, 'A LEVEL.jpg', 0),
(70, 'OgazIGAJ8os=', 'OgSxN3Uc8o7K/XRQ', 'OgazO2Ed/q3Y+GVOJQ==', 'eVfgajVIpt2L', 'producer', '', '$2y$10$dNLGwYTliRYz7XW8iVO4CewI5Jj.PIu9NH7HYwOBVkP2S5r4qagGC', 0, '', 0),
(71, 'LgexN2Ee8A==', 'LQexN2Ic8Yna', 'LgSwNWId8ov8+WVCJNw=', 'eVfnZjRDo9SPrA==', 'producer', 'Male', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

DROP TABLE IF EXISTS `user_order`;
CREATE TABLE IF NOT EXISTS `user_order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `number_of_items` int DEFAULT NULL,
  `order_date` date NOT NULL,
  `check_out_status` int NOT NULL DEFAULT '0',
  `clearence_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`order_id`, `product_id`, `user_id`, `number_of_items`, `order_date`, `check_out_status`, `clearence_status`) VALUES
(1, 9, 3, 15, '2022-11-17', 0, 0),
(3, 4, 1, 45, '2022-12-08', 0, 0),
(4, 4, 30, 5, '2022-12-14', 0, 0),
(5, 7, 30, 2, '2022-12-21', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
