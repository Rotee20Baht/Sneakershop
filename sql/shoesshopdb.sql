-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 08:04 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoesshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `shoes_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `shoes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `shoes_id`) VALUES
(43, 1),
(43, 10),
(44, 14),
(45, 9),
(45, 14),
(46, 1),
(47, 1),
(47, 9),
(48, 9),
(48, 10),
(48, 15),
(49, 15),
(49, 14);

-- --------------------------------------------------------

--
-- Table structure for table `order_record`
--

CREATE TABLE `order_record` (
  `order_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` text NOT NULL,
  `send_date` date NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `total_price` int(11) NOT NULL,
  `image_slip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_record`
--

INSERT INTO `order_record` (`order_id`, `user_id`, `customer_name`, `customer_address`, `send_date`, `order_status`, `total_price`, `image_slip`) VALUES
(43, 101, 'Rotee FiftyBaht', 'ถ.เจิมปัญญา ต.ทับเที่ยง อ.เมือง จ.ตรัง 92000', '2022-05-07', 'suc', 9100, 'IMG-62765e97d185b8.93413540.jpg'),
(44, 36, 'Choco Rotee', 'หมู่ 1 ต.บ่อหิน อ.สิเกา จ.ตรัง 92150', '2022-05-07', 'suc', 7400, 'IMG-62765f92bf6f09.56402485.jpg'),
(45, 37, 'Rotee Banana', 'หมู่ 2 ต.นาโยงเหนือ อ.นาโยง จ.ตรัง 92170', '2022-05-07', 'suc', 11700, 'IMG-62765ff08f4147.38158727.jpg'),
(46, 36, 'Thipop Payarang', 'asdasdasasasdas', '2022-05-08', 'pre', 4600, 'IMG-6277d809e6bdf8.38456670.jpg'),
(47, 102, 'Khai Rotee', 'qweqewqq', '2022-05-09', 'send2', 8900, 'IMG-6279166b5dcc11.16529117.jpg'),
(48, 36, 'testFirstname testLastname', 'test', '2022-05-10', 'send1', 12350, 'IMG-6279fa3a6b7348.75997359.jpg'),
(49, 36, 'testFirstname testLastname', 'Trang, Thailand', '2022-05-10', 'pre', 10950, 'IMG-627a75bd0189a3.66327502.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `shoes_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `released` date NOT NULL,
  `size` varchar(10) NOT NULL,
  `rating` int(5) NOT NULL,
  `image_url` text NOT NULL,
  `instockAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`shoes_id`, `brand`, `model`, `color`, `price`, `released`, `size`, `rating`, `image_url`, `instockAt`) VALUES
(1, 'Onitsuka Tiger', 'MEXICO 66 SD', 'BIRCH/GREEN', 4600, '2022-03-20', '8.5', 0, 'IMG-6238394c2d2da1.30832348.jpeg', '2022-03-20 15:31:34'),
(9, 'Onitsuka Tiger', 'MEXICO 66', 'WHITE/WHITE', 4300, '2022-03-21', '7', 0, 'IMG-62383ce2f20066.77237732.jpeg', '2022-03-21 15:52:50'),
(10, 'Onitsuka Tiger', 'MEXICO 66', 'VERMILION TOMATO/WHITE', 4500, '2022-03-01', '8.5', 0, 'IMG-62383f8b339473.47665347.jpeg', '2022-03-21 16:04:11'),
(14, 'Nike', 'Jordan 6 Retro', 'Mint Foam/Pure Platinum', 7400, '2022-03-20', '8.5', 0, 'IMG-6239a945d01fe3.36118292.jpeg', '2022-03-22 17:47:33'),
(15, 'Nike', 'Air Force 1', 'Next Nature', 3550, '2022-05-09', '5', 0, 'IMG-62791778a73c18.51882814.png', '2022-05-09 20:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` varchar(1) NOT NULL,
  `registerAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `phone`, `email`, `level`, `registerAt`) VALUES
(26, 'Admin', '7815696ecbf1c96e6894b779456d330e', 'Khai', 'Rotee', '0648754861', 'Khai.ro@mail.wu.ac.th', 'm', '2022-03-03 20:52:40'),
(27, 'Test', '81dc9bdb52d04dc20036dbd8313ed055', 'Thipop', 'Payarang', '0635487849', 'thipop.pa@mail.wu.ac.th', 'm', '2022-03-03 21:09:15'),
(28, 'Rotee20', '7815696ecbf1c96e6894b779456d330e', 'asd', 'asd', 'asd', 'Choco.ro@mail.wu.ac.th', 'm', '2022-03-03 21:23:09'),
(29, 'admin2', '7815696ecbf1c96e6894b779456d330e', 'asd', 'asdasd', 'asd', 'Choco.ro@mail.wu.ac.th', 'm', '2022-03-03 21:23:58'),
(30, '63119416', '7815696ecbf1c96e6894b779456d330e', 'asd', 'asd', 'asd', 'Choco.ro@mail.wu.ac.th', 'm', '2022-03-03 21:25:34'),
(31, 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'qwe', 'qwe', 'qwe', 'Khai.ro@mail.wu.ac.th', 'm', '2022-03-03 21:27:55'),
(32, 'xcv', '146b65fd2004858b1c615bc8cf8b8a5b', 'xcv', 'cxv', 'xcv', 'Khai.ro@mail.wu.ac.th', 'm', '2022-03-03 21:31:40'),
(33, 'cvb', '116fa690d8dd9c3bd7465b59158f995c', 'cvb', 'cvb', 'cvb', 'Khai.ro@mail.wu.ac.th', 'm', '2022-03-03 21:52:39'),
(34, 'Root', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin', 'Root', 'Root', 'Root@mail.com', 'a', '2022-03-03 22:30:43'),
(36, 'test2', '81dc9bdb52d04dc20036dbd8313ed055', 'testFirstname', 'testLastname', '0812345678', 'thipop.pa@mail.wu.ac.th', 'm', '2022-03-04 09:38:08'),
(37, 'test3', '81dc9bdb52d04dc20036dbd8313ed055', 'aasdas', 'asdasd', 'asdasd', 'Khai.ro@mail.wu.ac.th', 'm', '2022-03-04 10:11:56'),
(99, 'test1', '81dc9bdb52d04dc20036dbd8313ed055', 'test', 'test', 'test', 'Banana.ro@mail.wu.ac.th', 'a', '2022-03-03 22:37:25'),
(101, 'test9', '81dc9bdb52d04dc20036dbd8313ed055', 'Rotee', 'FiftyBaht', '0895741596', 'Rotee15Baht@gmail.com', 'm', '2022-05-07 18:21:15'),
(102, 'test4', '81dc9bdb52d04dc20036dbd8313ed055', 'Khai', 'Rotee', '0648754861', 'Khai.ro@mail.wu.ac.th', 'm', '2022-05-09 20:25:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserID` (`user_id`),
  ADD KEY `ShoesID` (`shoes_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `shoes_id` (`shoes_id`),
  ADD KEY `OrderID` (`order_id`);

--
-- Indexes for table `order_record`
--
ALTER TABLE `order_record`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `User Id` (`user_id`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`shoes_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `order_record`
--
ALTER TABLE `order_record`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `shoes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `ShoesID` FOREIGN KEY (`shoes_id`) REFERENCES `shoes` (`shoes_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserID` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `OrderID` FOREIGN KEY (`order_id`) REFERENCES `order_record` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ShoesID_Order` FOREIGN KEY (`shoes_id`) REFERENCES `shoes` (`shoes_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_record`
--
ALTER TABLE `order_record`
  ADD CONSTRAINT `User Id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
