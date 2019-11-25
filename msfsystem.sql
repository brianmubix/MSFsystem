-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 09:47 AM
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
(3, 8, 'tire change', 200),
(12, 9, 'Vitz', 200);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `requestid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL DEFAULT 1,
  `score` decimal(10,1) NOT NULL DEFAULT 0.0,
  `reason` text DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `service_id`, `requestid`, `userid`, `score`, `reason`, `datetime`) VALUES
(1, 8, 1, 7, '3.0', 'i was not happy', '2019-11-07 12:02:23'),
(2, 8, 2, 7, '5.0', 'very happy', '2019-11-07 12:02:23'),
(3, 3, 6, 7, '3.0', 'Was happy ', '2019-11-07 12:02:23'),
(4, 8, 5, 7, '5.0', 'Great experience ', '2019-11-07 12:02:23'),
(5, 3, 6, 7, '4.0', 'Am happy', '2019-11-07 12:02:23'),
(6, 9, 4, 7, '5.0', 'Will be back again ', '2019-11-07 12:02:23'),
(7, 13, 1, 7, '4.0', 'Good work', '2019-11-07 12:02:23'),
(8, 8, 8, 12, '5.0', 'I loved their service.. ', '2019-11-07 12:56:26'),
(9, 8, 8, 12, '3.5', 'Average Service', '2019-11-07 12:59:04'),
(10, 8, 9, 13, '5.0', 'Excellent services', '2019-11-12 18:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `status` enum('Inprogress','Complete') NOT NULL DEFAULT 'Inprogress',
  `rated` enum('Yes','No') NOT NULL DEFAULT 'No',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `serviceid`, `customerid`, `owner_id`, `description`, `price`, `status`, `rated`, `create_at`) VALUES
(1, 13, 12, NULL, '0', 6788, 'Complete', 'Yes', '2019-11-06 17:43:35'),
(2, 9, 8, NULL, 'Gfff', 467, 'Inprogress', 'No', '2019-11-06 04:17:21'),
(3, 3, 12, 6, 'Yytt\nVyuuj', 688, 'Complete', 'No', '2019-11-06 17:37:30'),
(4, 9, 8, 6, 'Ffff rrr', 123, 'Complete', 'No', '2019-11-07 07:54:41'),
(5, 8, 8, 6, 'Wheel alignment 200/=\nChange air filter 500/=', 700, 'Inprogress', 'No', '2019-11-07 08:04:42'),
(6, 3, 8, 6, 'Hdjdjr 200\nFhfrh 500', 700, 'Inprogress', 'No', '2019-11-07 07:54:46'),
(7, 13, 12, 9, 'Frrr\nRrrttr ttttt trrr rr4', 299, 'Inprogress', 'No', '2019-11-06 19:43:01'),
(8, 8, 12, 6, 'Diagnosis 300\nPressure 50', 350, 'Complete', 'Yes', '2019-11-07 09:59:03'),
(9, 8, 13, 6, 'Puncher repiar 200', 200, 'Complete', 'Yes', '2019-11-12 15:11:38');

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
  `license` varchar(200) DEFAULT NULL,
  `servicestatus` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `createdat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `ownerid`, `name`, `category`, `description`, `location`, `latitude`, `longtude`, `license`, `servicestatus`, `createdat`) VALUES
(1, 7, 'Total Petrol Station', 'Fuel Station', 'this is a petrol station', ' Opposite barden porwel', '0.00000', '36.00000', NULL, 'Approved', '2019-09-20 05:54:50'),
(3, 6, 'lake Car Dealers', 'Car Dealer', 'sells premium petrol', 'Opposite Naivas', '-0.06592', '37.02197', NULL, 'Approved', '2019-09-21 08:56:40'),
(4, 7, 'naivas car Wash', 'Car Wash', 'secure  spacious place', 'near neaivas market', '0.00000', '37.00000', NULL, 'Approved', '2019-09-21 09:01:12'),
(8, 6, 'Rest Garage', 'Garage Station', 'relax as we repair your car', 'Near chania bridge', '-0.52952', '37.35638', NULL, 'Approved', '2019-09-21 13:17:25'),
(9, 6, 'motorhub Kiambuu', 'Car Dealer', 'desagu will get you a new car', 'kiambu RD', '-0.39769', '36.96087', NULL, 'Approved', '2019-09-21 13:18:54'),
(10, 7, 'name', 'Car Park', 'Here is the description', 'location', '-0.39769', '36.96087', NULL, 'Approved', '2019-09-25 02:18:53'),
(11, 7, 'Central Garage', 'Garage Station', 'We repair all type of problems that your vehicle may have.', 'Next to nyeri County', '-0.39769', '36.96087', NULL, 'Approved', '2019-09-25 07:48:44'),
(12, 7, 'Oilcom', 'Fuel Station', 'Fuel', 'gatitu', '-0.39769', '36.96087', NULL, 'Approved', '2019-09-25 09:03:53'),
(13, 9, 'new', 'Car Wash', 'All wash', 'near shell', '-0.42160', '36.95407', NULL, 'Approved', '2019-11-05 18:20:49'),
(14, 6, 'silver lark', 'Car Park', 'Derived Derived from the research', 'eie', '-0.42030', '36.95234', NULL, 'Approved', '2019-11-05 18:27:22'),
(15, 6, 'hh', 'Car Park', 'Jjjj', 'hhh', '-0.41920', '36.95204', 'hh.jpg', 'Approved', '2019-11-23 09:42:28'),
(16, 6, 'gh', 'Car Wash', 'ggg', 'fhh', '-0.42028', '36.95231', 'gh.jpg', 'Approved', '2019-11-23 11:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `update_id` int(11) NOT NULL,
  `requestid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`update_id`, `requestid`, `userid`, `message`, `datetime`) VALUES
(1, 5, 8, 'Are you done? ', '2019-11-07 07:52:44'),
(2, 5, 8, 'I need an update', '2019-11-07 07:53:41'),
(3, 5, 6, 'We are almost come after two hours', '2019-11-07 08:01:36'),
(4, 8, 6, 'We are woking on you car', '2019-11-07 09:54:01'),
(5, 8, 12, 'Okay', '2019-11-07 09:54:50'),
(6, 7, 12, 'hello\n', '2019-11-07 13:23:26'),
(7, 9, 6, 'We are almost done', '2019-11-12 15:09:31'),
(8, 9, 6, 'Be ready we will done', '2019-11-12 15:10:03'),
(9, 9, 13, 'when do I expect delivery', '2019-11-12 15:10:38');

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
  `role` enum('owner','customer','admin') DEFAULT 'owner',
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
(8, 'hg', 'hg', 'Male', 'hj', 'h', 'tyg@hjbjh.jk', '67890', NULL, 'customer', 'approved', '2019-09-20 05:05:35', '2019-09-20 05:05:35'),
(9, '1', '2', 'Male', '3', '6', 'brianmubix@gmail.com4', '5', NULL, 'owner', 'approved', '2019-09-20 05:06:54', '2019-09-20 05:06:54'),
(11, 'Paul', 'Kuria', 'Male', 'Gathogo Kuria', 'admin', 'gathogofranc@gmail.com', '0715359119', NULL, 'owner', 'approved', '2019-09-22 12:46:27', '2019-09-22 12:46:27'),
(12, 'briia', 'hhu', 'Male', 'c', 'c', 'brianmubix@gmail.com', '0700866545', NULL, 'customer', 'approved', '2019-11-05 12:55:54', '2019-11-05 12:55:54'),
(13, 'bb', 'bb', 'Male', 'bb', 'bb', 'bb@gmail.com', '0712345678', NULL, 'customer', 'approved', '2019-11-12 18:06:09', '2019-11-12 18:06:09');

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
  ADD KEY `FK_ratings_services` (`service_id`),
  ADD KEY `FK_ratings_request` (`requestid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `FK_request_services` (`serviceid`),
  ADD KEY `FK_request_users` (`customerid`),
  ADD KEY `FK_request_users_2` (`owner_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `FK_services_users` (`ownerid`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`update_id`),
  ADD KEY `FK_updates_request` (`requestid`),
  ADD KEY `FK_updates_users` (`userid`);

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
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `update_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  ADD CONSTRAINT `FK_ratings_request` FOREIGN KEY (`requestid`) REFERENCES `request` (`request_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ratings_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `FK_request_services` FOREIGN KEY (`serviceid`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_request_users` FOREIGN KEY (`customerid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_request_users_2` FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_services_users` FOREIGN KEY (`ownerid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `updates`
--
ALTER TABLE `updates`
  ADD CONSTRAINT `FK_updates_request` FOREIGN KEY (`requestid`) REFERENCES `request` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_updates_users` FOREIGN KEY (`userid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
