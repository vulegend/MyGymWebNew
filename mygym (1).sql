-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 26, 2018 at 12:11 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mygym`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
CREATE TABLE IF NOT EXISTS `business` (
  `business_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `owner_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pib` varchar(30) NOT NULL,
  `registry_number` varchar(30) NOT NULL,
  `dinarski` varchar(30) NOT NULL,
  `devizni` varchar(30) NOT NULL,
  PRIMARY KEY (`business_id`),
  UNIQUE KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `owner_id`, `name`, `address`, `city`, `pib`, `registry_number`, `dinarski`, `devizni`) VALUES
(3, 3, 'Moja Teretana', 'Pere Kosorica 19', 'Zemun', '123125125', '135253234', '35236246234124', '35246347323523'),
(4, 4, 'Moja Teretana 123', 'Tadeusa Koscuska 62', 'Beograd', '12513251', '135235', '1235235', '2135235');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `contract_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contract_length` int(11) NOT NULL,
  `contract_package` int(11) NOT NULL,
  `business_id` bigint(20) NOT NULL,
  `contract_number` varchar(50) NOT NULL,
  `date_signed` datetime DEFAULT NULL,
  PRIMARY KEY (`contract_id`),
  UNIQUE KEY `business_id` (`business_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contract_id`, `contract_length`, `contract_package`, `business_id`, `contract_number`, `date_signed`) VALUES
(2, 2, 0, 3, '0719201812487', '2018-07-19 14:12:48'),
(3, 2, 0, 4, '0719201840476', '2018-07-19 15:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `img_cnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `gym`
--

DROP TABLE IF EXISTS `gym`;
CREATE TABLE IF NOT EXISTS `gym` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `address` varchar(200) COLLATE utf8_bin NOT NULL,
  `logo` varchar(1024) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `phone` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gym`
--

INSERT INTO `gym` (`id`, `name`, `address`, `logo`, `description`, `phone`) VALUES
(1, 'Prva teretana', 'adresa 1', '', 'opis 1', '0635858744'),
(2, 'druga teretana', 'adresa 2', '', 'opis drugi', '063287455');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `owner_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `google_id` varchar(150) NOT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `name`, `surname`, `email`, `phone`, `google_id`) VALUES
(3, 'Vukasin', 'Vucenovic', 'vvucenovic@gmail.com', '0605704708', 'NOT SET'),
(4, 'Vu', 'khkh', 'bjhvjhv@gmail.com', '687585', 'NOT SET');

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

DROP TABLE IF EXISTS `registered_users`;
CREATE TABLE IF NOT EXISTS `registered_users` (
  `user_id` bigint(20) NOT NULL,
  `google_id` varchar(150) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unconfirmed_pool`
--

DROP TABLE IF EXISTS `unconfirmed_pool`;
CREATE TABLE IF NOT EXISTS `unconfirmed_pool` (
  `entry_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `valid_until` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`entry_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unconfirmed_pool`
--

INSERT INTO `unconfirmed_pool` (`entry_id`, `code`, `mobile`, `valid_until`, `user_id`) VALUES
(1, '486784', '+381605566448', '2018-07-19 15:19:39', 1),
(2, '747674', '+381605704708', '2018-07-19 15:43:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `jmbg` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `picture_url` varchar(150) NOT NULL,
  `id_country_code` varchar(5) NOT NULL,
  `phone_extension` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `address`, `jmbg`, `mobile`, `email`, `gender`, `picture_url`, `id_country_code`, `phone_extension`) VALUES
(1, 'darko', 'viskovic', 'simeona koncarevica 29', '20191208987', '+381605566448', 'darkoviskovic@gmail.com', 1, 'NOT SET', '', ''),
(2, 'Vukasin', 'Vucenovic', 'Pere Kosorica 19', '0308996710259', '+381605704708', 'vvucenovic@gmail.com', 1, 'NOT SET', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`business_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD CONSTRAINT `registered_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unconfirmed_pool`
--
ALTER TABLE `unconfirmed_pool`
  ADD CONSTRAINT `unconfirmed_pool_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
