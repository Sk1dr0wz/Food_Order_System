-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 08:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_featured` varchar(10) NOT NULL,
  `category_active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_image`, `category_name`, `category_featured`, `category_active`) VALUES
(8, 'Food_Category_719.jpg', 'Sandwich', 'Yes', 'Yes'),
(9, 'Food_Category_164.jpg', 'Snacks', 'No', 'Yes'),
(11, 'Food_Category_921.jpg', 'Aneka Mee Goreng', 'Yes', 'Yes'),
(12, 'Food_Category_96.jpg', 'Aneka Nasi Goreng', 'Yes', 'Yes'),
(13, 'Food_Category_282.jpg', 'Aneka Minuman', 'Yes', 'Yes'),
(14, 'Food_Category_207.jpg', 'Dessert', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `delivery_status` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `delivery_total` decimal(10,2) DEFAULT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `delivery_status`, `date`, `time`, `delivery_total`, `res_id`) VALUES
(53, 'Delivered', '2024-04-06', '20:09:12', 71.53, 2),
(54, 'Pending', '2024-04-07', '16:39:09', 29.97, 2),
(55, 'Pending', '2024-04-07', '16:42:28', 0.00, 2),
(56, 'Pending', '2024-04-07', '16:42:30', 0.00, 2),
(57, 'Pending', '2024-04-07', '16:43:38', 0.00, 2),
(58, 'Pending', '2024-04-07', '16:44:00', 0.00, 2),
(59, 'Pending', '2024-04-07', '16:44:15', 17.67, 2),
(60, 'Pending', '2024-04-07', '16:44:39', 5.54, 2),
(61, 'Pending', '2024-04-07', '16:49:54', 0.00, 2),
(62, 'Pending', '2024-04-07', '16:50:04', 0.00, 2),
(63, 'Pending', '2024-04-07', '16:50:22', 0.00, 2),
(64, 'Pending', '2024-04-07', '17:07:09', 0.00, 2),
(65, 'Delivered', '2024-04-20', '20:42:37', 34.00, 2),
(66, 'Pending', '2024-04-20', '20:46:38', 7.00, 2),
(67, 'Pending', '2024-04-20', '22:14:39', 10.00, 2),
(68, 'In delivery', '2024-04-20', '22:15:59', 21.00, 2),
(69, 'Pending', '2024-04-29', '14:41:25', 24.00, 2),
(70, 'Pending', '2024-04-29', '14:55:47', 7.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_desc` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `item_featured` varchar(10) NOT NULL,
  `item_active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_price`, `item_image`, `item_desc`, `category_id`, `item_featured`, `item_active`) VALUES
(15, 'Tomato&Cheese Sw', 10.00, 'Food-Name-2607.jpg', 'Fresh tomatoes, mozarella cheese, toasttt', 8, 'Yes', 'Yes'),
(16, 'Cucumber Sw', 0.15, 'Food-Name-9993.jpg', 'Cucumberssss', 8, 'No', 'Yes'),
(17, 'Fries', 5.39, 'Food-Name-6993.jpg', 'Fries.Fries', 9, 'Yes', 'Yes'),
(18, 'OnionRing', 5.89, 'Food-Name-3409.jpg', 'OnionRing OnionRing', 9, 'No', 'Yes'),
(20, 'Nasi Goreng Ayam', 7.00, 'Food-Name-4402.jpg', 'Nasi Goreng Ayam yang hadir dengan dengan jumlah ayam yang banyak dan berbaloi untuk pelanggan. ', 12, 'Yes', 'Yes'),
(22, 'Mee Goreng Ayam', 7.00, 'Food-Name-3892.jpg', 'Mee Goreng yang hadir dengan ayam segar dimasak panas-panas di dapur', 11, 'Yes', 'Yes'),
(23, 'Cromboloni', 10.00, 'Food-Name-5667.jpg', 'Cromboloni original ', 14, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `item_id` int(11) NOT NULL,
  `delivery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `order_status`, `order_quantity`, `date`, `time`, `item_id`, `delivery_id`) VALUES
(58, 10, 'Complete', 13, '2024-04-06', '20:09:01', 17, 53),
(59, 10, 'Complete', 9, '2024-04-06', '20:09:06', 16, 53),
(60, 10, 'Complete', 7, '2024-04-06', '20:58:14', 15, NULL),
(61, 2, 'Complete', 1, '2024-04-07', '16:38:47', 15, 54),
(62, 2, 'Complete', 2, '2024-04-07', '16:38:58', 15, 54),
(63, 2, 'Complete', 3, '2024-04-07', '16:44:10', 18, 59),
(64, 2, 'Complete', 1, '2024-04-07', '16:44:27', 16, 60),
(65, 2, 'Complete', 1, '2024-04-07', '16:44:35', 17, 60),
(66, 2, 'Complete', 1, '2024-04-07', '16:49:01', 15, 61),
(67, 2, 'Complete', 1, '2024-04-07', '16:49:05', 17, 61),
(68, 2, 'Complete', 1, '2024-04-07', '16:49:58', 17, 62),
(69, 2, 'Complete', 1, '2024-04-07', '16:50:01', 15, 62),
(70, 2, 'Complete', 1, '2024-04-07', '16:50:10', 15, 63),
(71, 2, 'Complete', 11, '2024-04-07', '16:50:16', 16, 63),
(72, 2, 'Complete', 1, '2024-04-07', '16:54:44', 16, 64),
(73, 2, 'Complete', 2, '2024-04-20', '20:42:14', 23, 65),
(74, 2, 'Complete', 2, '2024-04-20', '20:42:27', 20, 65),
(75, 2, 'Complete', 1, '2024-04-20', '20:46:29', 20, 66),
(76, 2, 'Ordered', 1, '2024-04-20', '20:51:16', 22, NULL),
(77, 15, 'Complete', 1, '2024-04-20', '22:14:27', 23, 67),
(78, 15, 'Ordered', 2, '2024-04-20', '22:15:45', 20, 68),
(79, 15, 'Ordered', 1, '2024-04-20', '22:15:52', 22, 68),
(87, 15, 'Ordered', 1, '2024-04-29', '14:40:55', 20, 69),
(88, 15, 'Ordered', 1, '2024-04-29', '14:40:58', 22, 69),
(89, 15, 'Ordered', 1, '2024-04-29', '14:41:09', 15, 69),
(90, 15, 'Ordered', 1, '2024-04-29', '14:42:06', 22, 70);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `res_id` int(11) NOT NULL,
  `res_name` varchar(255) NOT NULL,
  `building` varchar(255) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `res_active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`res_id`, `res_name`, `building`, `street`, `city`, `state`, `res_active`) VALUES
(1, 'Burger Ramly kl', 'bazaarr', 'Taman Tun Dr Ismail', 'Kuala Lumpur', 'Kuala Lumpur', 'Yes'),
(2, 'Ramly KK', 'Imago', 'coastal highway', 'Kota Kinabalu', 'Sabah', 'Yes'),
(3, 'Nasi Kandar Pelita', 'Jalan SS 15/4c', 'Ss 15', 'Subang Jaya', 'Selangor', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_role` tinyint(1) NOT NULL DEFAULT 0,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` bigint(15) NOT NULL,
  `house` varchar(255) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_role`, `user_name`, `user_pass`, `user_fullname`, `user_email`, `user_phone`, `house`, `street`, `city`, `state`) VALUES
(1, 1, 'man', 'd1e6b917e2b99d7e4a94d0390b84e304', 'manskrra', 'test@gmail.com', 123456789, '0', '0', '0', 'Kuala Lumpur'),
(2, 0, 'customer', '668816e02d4658da91aa4526d8c61972', 'customer1', 'customer@gmail.com', 1254879957, 'ok', '1', '1', 'Sabah'),
(10, 1, 'aaa', '47bce5c74f589f4867dbd57e9ca9f808', 'aaa', 'aaa@gmail.com', 1111111111, '', 'aaa', 'aaa', 'Sabah'),
(11, 0, 'bbb', '08f8e0260c64418510cefb2b06eee5cd', 'Bbb', 'bbb@gmail.com', 2222222222, '1', '1', '1', 'Kuala Lumpur'),
(14, 0, 'cus2', 'c3c6a4665538e7d6008b6dd34228385d', 'Customer Hensem', 'cus2@gmail.com', 176592210, 'Jalan Pasir Mas', 'Teluk 3', 'Subang Jaya', 'Se'),
(15, 0, 'manja', 'fc91f842bb241cdf6112c3c0b747ba8e', 'Customer Hehe', 'customer@proton.com', 178993040, 'Jalan Alor Jaya', 'Lorong Delima', 'Penampang', 'Sabah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_item_category` (`category_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `fk_order_delivery` (`delivery_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurant` (`res_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_delivery` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`delivery_id`),
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
