-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2019 at 06:11 PM
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
-- Database: `project_inv1`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `bid` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `s_contactno` varchar(11) NOT NULL,
  `address` varchar(225) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`bid`, `brand_name`, `s_contactno`, `address`, `status`) VALUES
(13, 'Perera & Sons', '0712236154', 'colombo7,srilanka.', '1'),
(23, 'Thinesh Bakehouse', '', '', '1'),
(24, 'Maliban', '', '', '1'),
(25, 'Manchee', '', '', '1'),
(26, 'Thurukka Bakery', '0256432156', '123, jaffna', '1'),
(27, 'Elephant House', '', '', '1'),
(28, 'Cargils', '', '', '1'),
(29, 'Coca-Cola', '', '', '1'),
(30, 'Rio Ice Cream', '', '', '1'),
(31, 'Rajah Juice Bar', '', '', '1'),
(32, 'Herbal Tea', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `parent_cat`, `category_name`, `status`) VALUES
(20, 0, 'Short Eats', '1'),
(21, 0, 'Tea & Coffee', '1'),
(22, 0, 'Fresh Juice', '1'),
(23, 0, 'Juice', '1'),
(24, 0, 'Green Products & Herbal Tea', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `customer_name` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `discount` double NOT NULL,
  `paid` double NOT NULL,
  `payment_type` tinytext NOT NULL,
  `cashier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `customer_name`, `order_date`, `sub_total`, `discount`, `paid`, `payment_type`, `cashier`) VALUES
(103, 13, '2019-01-07', 432, 0, 500, 'Cash', 0),
(106, 23, '2019-01-08', 490, 0, 500, 'Cash', 0),
(107, 25, '2019-01-09', 30, 0, 50, 'Cash', 0),
(108, 24, '2019-01-13', 15, 0, 15, 'Cash', 0),
(109, 23, '2019-02-15', 15, 0, 15, 'Cash', 0),
(110, 24, '2019-02-15', 15, 0, 15, 'Cash', 0),
(111, 24, '2019-02-15', 15, 0, 15, 'Cash', 0),
(112, 23, '2019-02-21', 25, 0, 30, 'Cash', 0),
(113, 13, '2019-04-29', 25, 0, 25, 'Cash', 14),
(114, 24, '2019-04-29', 24, 0, 25, 'Cash', 14),
(115, 31, '2019-04-29', 65, 0, 65, 'Cash', 14),
(116, 28, '2019-04-29', 45, 0, 45, 'Cash', 14),
(117, 28, '2019-04-29', 45, 0, 45, 'Cash', 14),
(118, 28, '2019-04-29', 45, 0, 45, 'Cash', 14),
(119, 26, '2019-06-08', 510, 0, 600, 'Cash', 14),
(120, 24, '2019-06-13', 20, 0, 20, 'Cash', 14);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` int(11) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(102, 106, 35, 16, 10),
(103, 106, 31, 12, 20),
(105, 107, 33, 30, 1),
(106, 108, 35, 15, 1),
(107, 109, 73, 15, 1),
(108, 110, 73, 15, 1),
(109, 111, 73, 15, 1),
(110, 112, 32, 25, 1),
(111, 113, 33, 25, 1),
(112, 114, 42, 12, 2),
(113, 115, 55, 65, 1),
(114, 116, 72, 45, 1),
(115, 117, 72, 45, 1),
(116, 118, 72, 45, 1),
(117, 119, 35, 45, 10),
(118, 119, 37, 12, 5),
(119, 120, 40, 10, 1),
(120, 120, 40, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double NOT NULL,
  `product_stock` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `p_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES
(31, 20, 23, 'Tea Bun', 14, 29, '2019-01-08', '1'),
(32, 20, 26, 'Curry Bun', 27, 4, '2019-01-08', '1'),
(33, 20, 13, 'Cake', 23, 10, '2019-01-08', '1'),
(34, 20, 23, 'Cream Bun', 28, 1, '2019-01-08', '1'),
(35, 20, 26, 'Bakery Roll', 18, 31, '2019-01-08', '1'),
(36, 20, 13, 'Pastry', 27, 0, '2019-01-08', '1'),
(37, 20, 26, 'Patis', 10, 14, '2019-01-08', '1'),
(38, 20, 26, 'Vadai-Kadalai', 13, 9, '2019-01-08', '1'),
(39, 20, 23, 'Mothakam', 23, 5, '2019-01-08', '1'),
(40, 20, 24, 'Peanut Biscuit-1', 9, 11, '2019-01-08', '1'),
(41, 20, 25, 'Chocolate Biscuit', 5, 10, '2019-01-08', '1'),
(42, 20, 24, 'Cream Cracker Biscuits-3', 10, 12, '2019-01-08', '1'),
(43, 20, 25, 'Mari Biscuit-1', 2, 10, '2019-01-08', '1'),
(44, 20, 24, 'Peanut Biscuits-10', 90, 10, '2019-01-08', '1'),
(45, 20, 25, 'Peanut Biscuits-24', 200, 10, '2019-01-08', '1'),
(46, 20, 24, 'Peanut Alva', 100, 10, '2019-01-08', '1'),
(47, 20, 25, 'Ginger Biscuits', 80, 6, '2019-01-08', '1'),
(48, 20, 23, 'Allu Udundal', 90, 10, '2019-01-08', '1'),
(49, 21, 13, 'Plain Tea', 12, 10, '2019-01-08', '1'),
(50, 21, 13, 'Plain Tea without Sugar', 9, 10, '2019-01-08', '1'),
(51, 21, 13, 'Milk Tea', 23, 9, '2019-01-08', '1'),
(52, 21, 13, 'Plain Coffee', 15, 10, '2019-01-08', '1'),
(53, 21, 13, 'Milk Coffee', 35, 10, '2019-01-08', '1'),
(54, 22, 31, 'Apple Juice', 71, 10, '2019-01-14', '1'),
(55, 22, 31, 'Orange Juice', 70, 11, '2019-01-08', '1'),
(56, 22, 31, 'Lemon Juice', 30, 10, '2019-01-08', '1'),
(57, 22, 31, 'Passion Fruit Juice ', 40, 10, '2019-01-08', '1'),
(58, 23, 31, 'Sunquick', 40, 10, '2019-01-08', '1'),
(59, 23, 31, 'Nelli', 30, 10, '2019-01-08', '1'),
(60, 23, 31, 'Soda', 35, 10, '2019-01-08', '1'),
(61, 23, 30, 'Ice Cream', 50, 10, '2019-04-04', '1'),
(62, 24, 31, 'OATS cup', 30, 10, '2019-01-08', '1'),
(63, 24, 32, 'Green Tea', 12, 10, '2019-01-08', '1'),
(64, 24, 32, 'SLIM Green Tea', 17, 10, '2019-01-08', '1'),
(65, 24, 32, 'Herbal Tea(Iramusu)', 22, 10, '2019-01-08', '1'),
(66, 24, 32, 'Herbal Tea(Ranawara)', 22, 10, '2019-01-08', '1'),
(67, 24, 32, 'Curry-leave Tea', 12, 10, '2019-01-08', '1'),
(68, 24, 32, 'Lemon Tea', 12, 10, '2019-01-08', '1'),
(69, 24, 32, 'Garlic Tea', 12, 10, '2019-01-08', '1'),
(70, 24, 32, 'Cinnamon Tea', 12, 10, '2019-01-08', '1'),
(71, 24, 28, 'Apple', 50, 5, '2019-01-08', '1'),
(72, 24, 28, 'Orange ', 50, 13, '2019-01-08', '1'),
(73, 20, 23, 'wq', 132, 19, '2019-02-15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` int(11) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(3, 3, 34, 28, 2),
(4, 3, 36, 27, 1),
(5, 3, 71, 50, 5),
(6, 4, 36, 27, 5),
(7, 5, 36, 27, 1),
(8, 6, 32, 27, 5),
(10, 8, 33, 23, 1),
(11, 9, 36, 27, 3),
(13, 10, 32, 27, 1),
(14, 10, 34, 28, 3),
(15, 11, 33, 23, 1),
(16, 13, 34, 28, 1),
(17, 14, 73, 132, 1),
(19, 17, 32, 27, 1),
(20, 18, 38, 13, 1),
(21, 19, 31, 14, 1),
(22, 20, 47, 80, 4),
(23, 21, 39, 23, 5),
(24, 21, 51, 23, 1),
(25, 21, 34, 28, 2),
(26, 22, 34, 28, 1),
(27, 22, 37, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice`
--

CREATE TABLE `sale_invoice` (
  `invoice_no` int(11) NOT NULL,
  `customer_name` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `discount` double NOT NULL,
  `paid` double NOT NULL,
  `payment_type` tinytext NOT NULL,
  `cashier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_invoice`
--

INSERT INTO `sale_invoice` (`invoice_no`, `customer_name`, `order_date`, `sub_total`, `discount`, `paid`, `payment_type`, `cashier`) VALUES
(3, 13, '2019-01-08', 333, 0, 500, 'Cash', 0),
(4, 13, '2019-01-09', 135, 0, 200, 'Cash', 0),
(5, 14, '2019-01-13', 27, 0, 30, 'Cash', 0),
(6, 15, '2019-02-06', 135, 0, 500, 'Cash', 0),
(7, 13, '2019-02-10', 0, 0, 50, 'Cash', 0),
(8, 14, '2019-02-10', 23, 0, 23, 'Cash', 0),
(9, 13, '2019-02-11', 81, 12, 1000, 'Cash', 0),
(10, 16, '2019-02-11', 111, 12, 134, 'Cash', 0),
(11, 13, '2019-02-11', 23, 0, 50, 'Cash', 0),
(13, 15, '2019-02-14', 28, 0, 30, 'Cash', 0),
(14, 15, '2019-02-15', 132, 0, 200, 'Cash', 0),
(16, 14, '2019-02-21', 0, 0, 50, 'Cash', 0),
(17, 14, '2019-02-21', 27, 0, 50, 'Cash', 0),
(18, 15, '2019-02-21', 13, 0, 50, 'Cash', 14),
(19, 14, '2019-02-21', 14, 0, 20, 'Cash', 14),
(20, 15, '2019-02-23', 320, 0, 500, 'Cash', 14),
(21, 24, '2019-04-04', 194, 0, 250, 'Cash', 14),
(22, 14, '2019-06-06', 38, 0, 50, 'Cash', 14);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `employeeid` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactno` text NOT NULL,
  `password` varchar(300) NOT NULL,
  `usertype` enum('SCR Member','Canteen Staff','admin') NOT NULL,
  `register_date` date NOT NULL,
  `last_login` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `employeeid`, `email`, `contactno`, `password`, `usertype`, `register_date`, `last_login`, `status`, `notes`) VALUES
(13, 'Chanuka Samila', '2016/CSC/004', 'chanukasam@gmail.com', '0711234567', '$2y$08$/KnocslUgAdvcz5gw.bhBeSUN79DxrJrtNao3E1t7hKa/SJX0XosC', 'Canteen Staff', '2019-02-01', '2019-01-08 00:00:00', 0, ''),
(14, 'Nayananga Muhandiram', '2016/CSC/036', 'nayanangamuhandiram@gmail.com', '713669541', '$2y$08$sjnhCAmvih62D50VM9fQmOa/12nYmDZaB.Lr/B2x24h7E5wtJ7KSe', 'admin', '2019-04-04', '2019-06-18 06:06:32', 1, ''),
(15, 'Nipuna Dodanwala', '2016/CSC/047', 'nipuna@gmail.com', '0714396506', '$2y$08$wNkrK9JmBoTtJgiYmtrX.uQq6sVwZljldHfTeGr171IfXuMK35Exe', 'Canteen Staff', '2019-02-23', '2019-06-06 12:06:49', 1, ''),
(16, 'Ijas Mohamed', '2016sp311', 'mhijasmohamed619@gmail.com', '0766664426', '$2y$08$mkJZPXOmlUagxfXFzbsmtOPTcLZCLvJP6jBkO4q6Cvc550VBSvRXS', 'admin', '2019-02-12', '2019-04-04 10:04:46', 1, ''),
(17, 'Danananjaya Silva', '1234567', 'silva.dn@gmail.com', '+94254581275', '$2y$08$.nkdgSJ.aQm5GzX.F7ipGeuAs1Txc4vFsqHYmYbsJU6F17v1r8xOi', 'SCR Member', '2019-02-21', '2019-02-11 04:02:43', 0, ''),
(18, 'Dr.AnukaSanjaya', '2016/CSC/021', 'anuka@gmail.com', '07723456789', '$2y$08$0i/Gkp/iPm8Xasv4cLb8iOgMGdlYwHyArgyhd4bkg.q89itP1EaSy', 'SCR Member', '2019-02-15', '2019-02-23 10:02:03', 0, ''),
(19, 'Mr.hello world', '2016/csc/45', 'nayanangamuhandiram1@gmail.com', '94716369541', '$2y$08$OgWvbi7OnLh8CWTS0AfSeOHzdVn2LAKnq6Jct10oLezWCIvFnnbxu', 'SCR Member', '2019-04-04', '2019-04-04 08:04:41', 0, ''),
(20, 'Mrs.hell no', '2016/csc/49', 'nayanangamuhandiram3@gmail.com', '94716369541', '$2y$08$M98GhP2jPcPlzQa5.nHTOue.rrqZ96iVtGqkGC3clIni5oCMn0Y3O', 'SCR Member', '2019-04-04', '2019-04-04 08:04:43', 0, ''),
(21, 'Miss.test test', '2016/csc/50', 'nayanangamuhandiram4@gmail.com', '94716369541', '$2y$08$SFNb3QWPax1PBW5dESUlO.j07YKPeZ/2V8KrqeneW/6AQwwR4qQ.6', 'SCR Member', '2019-04-04', '2019-04-04 08:04:45', 0, ''),
(22, 'Mrs.test2 test2', '2016/csc/51', 'nayanangamuhandiram5@gmail.com', '94716369541', '$2y$08$3iWGnL5tBVh.KBaqBId/SOEwmpELK38T3pyYJ1s57eYlyWa5V13wm', 'SCR Member', '2019-04-04', '2019-04-04 08:04:37', 1, ''),
(24, 'Mr.testting testing', '2016/csc/57', 'nayanangamuhandiram7@gmail.com', '94716369541', '$2y$08$GKyptWdLq25HCged6/5/yuxInakiC9yOku2TqHG0baOyZSS3AfJKO', 'SCR Member', '2019-06-06', '2019-06-06 12:06:33', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`),
  ADD KEY `invoice_ibfk_1` (`customer_name`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`),
  ADD KEY `invoice_details_ibfk_2` (`product_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `cid` (`cid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`),
  ADD KEY `sale_details_ibfk_2` (`product_name`);

--
-- Indexes for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  ADD PRIMARY KEY (`invoice_no`),
  ADD KEY `customer_name` (`customer_name`),
  ADD KEY `cashier` (`cashier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employeeid` (`employeeid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customer_name`) REFERENCES `brands` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_details_ibfk_2` FOREIGN KEY (`product_name`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `categories` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `brands` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `sale_invoice` (`invoice_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_details_ibfk_2` FOREIGN KEY (`product_name`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  ADD CONSTRAINT `sale_invoice_ibfk_1` FOREIGN KEY (`customer_name`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
