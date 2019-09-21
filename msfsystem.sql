-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2019 at 10:39 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

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
  `createdat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `ownerid`, `name`, `category`, `description`, `location`, `latitude`, `longtude`, `servicestatus`, `createdat`) VALUES
(1, 7, 'Total Petrol Station', 'Fuel Station', 'this is a petrol station', ' Opposite barden porwel', '0.00000', '-12.00000', 'pending', '2019-09-20 05:54:50'),
(3, 6, 'lake Car Dealers', 'Car Dealer', 'sells premium petrol', 'Opposite Naivas', '-0.06592', '37.02197', 'pending', '2019-09-21 08:56:40'),
(4, 7, 'naivas car Wash', 'Car Wash', 'secure  spacious place', 'near neaivas market', '0.00000', '37.00000', 'pending', '2019-09-21 09:01:12'),
(8, 6, 'Rest Garage', 'Garage Station', 'relax as we repair your car', 'Near chania bridge', '-0.52952', '37.35638', 'pending', '2019-09-21 13:17:25'),
(9, 6, 'motorhub Kiambuu', 'Car Dealer', 'desagu will get you a new car', 'kiambu RD', '-0.39769', '36.96087', 'pending', '2019-09-21 13:18:54');

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
  `lastseen` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `gender`, `username`, `password`, `email`, `phone`, `profile_image`, `role`, `status`, `lastseen`, `createdate`) VALUES
(4, 'admin', 'admin', 'Male', 'a', 'a', 'admin@gmail.com', '0700866545', 'ed 20190919112810.jpg', 'admin', 'pending', '2019-09-13 08:51:32', '2019-09-13 08:51:32'),
(6, 'sally', 'mubix', 'Female', 'sally', 'd', 'sally@gmail.com', '0700866545', NULL, 'owner', 'approved', '2019-09-13 08:57:29', '2019-09-13 08:57:29'),
(7, 'Brian', 'Mubix', 'Male', 'brian', 'm', 'brianmubix@gmail.com1', '0700866545', NULL, 'owner', 'approved', '2019-09-13 12:29:05', '2019-09-13 12:29:05'),
(8, 'hg', 'hg', 'Male', 'hj', 'h', 'tyg@hjbjh.jk', '67890', NULL, 'owner', 'pending', '2019-09-20 05:05:35', '2019-09-20 05:05:35'),
(9, '1', '2', 'Male', '3', '6', 'brianmubix@gmail.com4', '5', NULL, 'owner', 'pending', '2019-09-20 05:06:54', '2019-09-20 05:06:54');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_services_users` FOREIGN KEY (`ownerid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
