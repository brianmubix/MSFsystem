-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2019 at 10:41 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msfsystem`
--

DROP DATABASE IF EXISTS `msfsystem`;
CREATE DATABASE IF NOT EXISTS `msfsystem` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `msfsystem`;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `service_id`, `name`, `price`) VALUES
(1, 9, 'vehicles', 100000),
(2, 8, 'puncher', 500),
(3, 8, 'tire change', 200);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `service_id`, `score`) VALUES
(1, 8, 3),
(2, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category` enum('Fuel Station','Car Wash','Car Park','Garage Station','Car Dealer','Recovery Station') NOT NULL,
  `description` text NOT NULL,
  `location` varchar(200) NOT NULL,
  `latitude` decimal(10,5) NOT NULL,
  `longtude` decimal(10,5) NOT NULL,
  `servicestatus` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `createdat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `ownerid`, `name`, `category`, `description`, `location`, `latitude`, `longtude`, `servicestatus`, `createdat`) VALUES
(1, 7, 'Total Petrol Station', 'Fuel Station', 'this is a petrol station', ' Opposite barden porwel', '0.00000', '36.00000', 'pending', '2019-09-20 05:54:50'),
(3, 6, 'lake Car Dealers', 'Car Dealer', 'sells premium petrol', 'Opposite Naivas', '-0.06592', '37.02197', 'pending', '2019-09-21 08:56:40'),
(4, 7, 'naivas car Wash', 'Car Wash', 'secure  spacious place', 'near neaivas market', '0.00000', '37.00000', 'pending', '2019-09-21 09:01:12'),
(8, 6, 'Rest Garage', 'Garage Station', 'relax as we repair your car', 'Near chania bridge', '-0.52952', '37.35638', 'pending', '2019-09-21 13:17:25'),
(9, 6, 'motorhub Kiambuu', 'Car Dealer', 'desagu will get you a new car', 'kiambu RD', '-0.39769', '36.96087', 'pending', '2019-09-21 13:18:54'),
(10, 7, 'name', 'Car Park', 'Here is the description', 'location', '-0.39769', '36.96087', 'pending', '2019-09-25 02:18:53'),
(11, 7, 'Central Garage', 'Garage Station', 'We repair all type of problems that your vehicle may have.', 'Next to nyeri County', '-0.39769', '36.96087', 'pending', '2019-09-25 07:48:44'),
(12, 7, 'Oilcom', 'Fuel Station', 'Fuel', 'gatitu', '-0.39769', '36.96087', 'pending', '2019-09-25 09:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `profile_image` varchar(200) DEFAULT NULL,
  `role` enum('owner','admin') DEFAULT 'owner',
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `lastseen` datetime DEFAULT current_timestamp(),
  `createdate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `gender`, `username`, `password`, `email`, `phone`, `profile_image`, `role`, `status`, `lastseen`, `createdate`) VALUES
(4, 'admin', 'admin', 'Male', 'admin', 'admin', 'admin@gmail.com', '0700866545', 'ed 20190919112810.jpg', 'admin', 'pending', '2019-09-13 08:51:32', '2019-09-13 08:51:32'),
(6, 'sally', 'mubix', 'Female', 'u', 'u', 'sally@gmail.com', '0700866545', NULL, 'owner', 'approved', '2019-09-13 08:57:29', '2019-09-13 08:57:29'),
(7, 'Brian', 'Mubix', 'Male', 'brian', 'm', 'brianmubix@gmail.com1', '0700866545', NULL, 'owner', 'approved', '2019-09-13 12:29:05', '2019-09-13 12:29:05'),
(8, 'hg', 'hg', 'Male', 'hj', 'h', 'tyg@hjbjh.jk', '67890', NULL, 'owner', 'pending', '2019-09-20 05:05:35', '2019-09-20 05:05:35'),
(9, '1', '2', 'Male', '3', '6', 'brianmubix@gmail.com4', '5', NULL, 'owner', 'approved', '2019-09-20 05:06:54', '2019-09-20 05:06:54'),
(11, 'Paul', 'Kuria', 'Male', 'Gathogo Kuria', 'admin', 'gathogofranc@gmail.com', '0715359119', NULL, 'owner', 'approved', '2019-09-22 12:46:27', '2019-09-22 12:46:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `FK_offers_services` (`service_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `FK_ratings_services` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `FK_services_users` (`ownerid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `FK_offers_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `FK_ratings_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_services_users` FOREIGN KEY (`ownerid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
