-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2016 at 04:00 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chinamotorpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_part_request`
--

CREATE TABLE `car_part_request` (
  `car_part_request_id` int(11) NOT NULL,
  `item_request` varchar(255) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_amount` decimal(11,2) NOT NULL,
  `car` varchar(255) NOT NULL,
  `driver` varchar(255) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_part_request`
--
ALTER TABLE `car_part_request`
  ADD PRIMARY KEY (`car_part_request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_part_request`
--
ALTER TABLE `car_part_request`
  MODIFY `car_part_request_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
