-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2017 at 12:00 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_timestamp` datetime DEFAULT NULL,
  `modified_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_timestamp`, `modified_timestamp`) VALUES
(1, 'Games', '2017-01-01 17:59:35', NULL),
(2, 'Computers', '2017-01-01 18:00:17', NULL),
(3, 'TVs and Accessories', '2017-01-01 18:01:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_timestamp` datetime DEFAULT NULL,
  `modified_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `sku`, `price`, `quantity`, `created_timestamp`, `modified_timestamp`) VALUES
(1, 1, 'Pong', 'A0001', '70.00', 26, '2017-01-01 18:03:27', '2017-01-01 21:58:53'),
(2, 1, 'GameStation 5', 'A0002', '269.99', 15, '2017-01-01 18:04:30', NULL),
(3, 2, 'AP Oman PC - Aluminum', 'A0003', '1399.99', 10, '2017-01-01 18:05:22', NULL),
(4, 3, 'Fony UHD HDR 55" 4k TV', 'A0004', '1399.99', 5, '2017-01-01 18:06:11', NULL),
(5, 1, 'Donkey Kong', 'A004', '7900.00', 11, '2017-01-01 20:58:59', NULL),
(7, 6, 'contra', 'A300', '77.00', 22, '2017-01-02 17:00:47', NULL),
(8, 7, 'castlevania', 'A999', '80.00', 34, '2017-01-02 17:01:16', NULL),
(9, 8, 'contra', 'A333', '13.00', 24, '2017-01-02 17:02:21', NULL),
(10, 9, 'Contra', 'A888', '87.00', 65, '2017-01-02 17:03:02', NULL),
(11, 10, 'Contra', 'A888', '87.00', 65, '2017-01-02 17:04:23', NULL),
(12, 11, 'Contra 2', 'A888', '87.00', 65, '2017-01-02 17:04:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_timestamp` datetime DEFAULT NULL,
  `modified_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `created_timestamp`, `modified_timestamp`) VALUES
(1, 'Bobby Fischer', 'bobby@foo.com', '2017-01-01 18:07:12', NULL),
(2, 'Betty Rubble', 'betty@foo.com', '2017-01-01 18:08:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
