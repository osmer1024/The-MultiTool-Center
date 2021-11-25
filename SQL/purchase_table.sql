-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 05:05 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_multitool_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `purchase_table`
--

CREATE TABLE `purchase_table` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` float NOT NULL,
  `date_of_purchase` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_address` varchar(25) NOT NULL,
  `add_district` varchar(15) NOT NULL,
  `method` varchar(11) NOT NULL,
  `name_on_card` varchar(50) NOT NULL,
  `card_number` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_table`
--

INSERT INTO `purchase_table` (`id`, `uid`, `item_name`, `quantity`, `total`, `date_of_purchase`, `add_address`, `add_district`, `method`, `name_on_card`, `card_number`) VALUES
(1, 1, 'Supertool', 2, 84, '2021-11-25 04:00:55', 'San Jose Village', 'ow', 'credit', 'Osmer A Escarraga', 235668),
(2, 1, 'Skeletool', 1, 38, '2021-11-25 04:00:55', 'San Jose Village', 'ow', 'credit', 'Osmer A Escarraga', 235668),
(3, 2, 'Surge', 3, 105, '2021-11-25 04:03:14', '12 Mango Av', 'bz', 'debit', 'Mary J Robinson', 215478);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchase_table`
--
ALTER TABLE `purchase_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_table`
--
ALTER TABLE `purchase_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
