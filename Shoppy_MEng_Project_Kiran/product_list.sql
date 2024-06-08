-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2020 at 11:40 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppy`
--

-- --------------------------------------------------------

--
-- Table structure for table `shoppy`
--

CREATE TABLE `product_list` (
  `product` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`product`, `id`, `category`, `amount`, `price`) VALUES
('OatMilk', '864235228', 'Food', '1Litre', '2.25'),
('Laundry_Bag', '864518668', 'HomeDecor', '1Pc', '4.00'),
('Pepsi_Combo', '864448956', 'Beverage', '2in1', '3.50'),
('Cashews', '2513751876', 'Food', '1Pk', '2.0'),
('Dish_Liquid', '1747222234', 'Kitchen', '1Pk', '1.75'),
('Soap_Bar', '863893036', 'Beauty', '1Pc', '1.25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
