-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2017 at 10:09 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chinamotorpool`
--
CREATE DATABASE IF NOT EXISTS `chinamotorpool` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chinamotorpool`;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` varchar(36) NOT NULL,
  `reservation_no` varchar(36) NOT NULL,
  `car_id` varchar(36) NOT NULL,
  `driver_id` varchar(36) NOT NULL,
  `reservation_date_start` datetime NOT NULL,
  `reservation_date_end` datetime NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `dropoff_location` varchar(255) NOT NULL,
  `no_passengers` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_saved` datetime NOT NULL,
  `date_edited` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `saved_by` varchar(36) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
