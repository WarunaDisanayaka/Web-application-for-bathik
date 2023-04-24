-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2023 at 06:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bathik`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `size` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `shop` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_order`
--

CREATE TABLE `cart_order` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `size` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `shop` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_order`
--

INSERT INTO `cart_order` (`id`, `product_name`, `product_price`, `size`, `qty`, `total_price`, `shop`, `user_id`, `status`) VALUES
(7, 'Sri Lankan Batik Shirt – A852', 1600.00, 'medium', 1, 1.00, 5, 2, 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` varchar(10) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
('CAT001', 'Category one');

--
-- Triggers `category`
--
DELIMITER $$
CREATE TRIGGER `category_before_insert` BEFORE INSERT ON `category` FOR EACH ROW BEGIN
  DECLARE new_category_id VARCHAR(10);
  SELECT CONCAT('CAT', LPAD(COALESCE(SUBSTRING(MAX(category_id), 2), 0) + 1, 3, '0')) INTO new_category_id FROM category;
  SET NEW.category_id = new_category_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `design_orders`
--

CREATE TABLE `design_orders` (
  `id` int(10) NOT NULL,
  `shop` int(10) NOT NULL,
  `note` text NOT NULL,
  `design` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `design_orders`
--

INSERT INTO `design_orders` (`id`, `shop`, `note`, `design`, `email`, `price`, `user_id`, `status`) VALUES
(1, 5, 'fdsaf', 'uploads/643434fd1234d_screenshot.png', 'warunahello@gmail.com', 18069.00, 2, 'Cutting and sewing'),
(2, 5, 'testing', 'vendordashboard/uploads/643d84700d917_screencapture-127-0-0-1-8000-2023-04-17-22_43_47.png', 'warunahello@gmail.com', 18069.00, 2, 'Cutting and sewing');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `shop` int(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `first_name`, `last_name`, `email`, `phone`, `city`, `state`, `zip`, `address`, `payment_method`, `shop`, `user_id`) VALUES
(1, 'waruna', 'pradeep', 'warunapradeep407@gmail.com', 769610260, 'nikaweratiya', 'northwestern', '60479', 'mahagirilla\r\nmahagirilla', 'credit_card', 6, 2),
(2, 'waruna', 'pradeep', 'warunapradeep407@gmail.com', 769610260, 'nikaweratiya', 'northwestern', '60479', 'mahagirilla\r\nmahagirilla', 'credit_card', 5, 2),
(3, 'waruna', 'pradeep', 'warunapradeep407@gmail.com', 769610260, 'nikaweratiya', 'northwestern', '60479', 'mahagirilla\r\nmahagirilla', 'credit_card', 6, 2),
(4, 'waruna', 'disanayaka', 'warunahello@gmail.com', 769610260, 'Nikaweratiya', 'northwestern', '60479', 'mahagirilla\r\nmahagirilla', 'credit_card', 5, 2),
(5, 'waruna', 'pradeep', 'warunapradeep407@gmail.com', 769610260, 'nikaweratiya', 'northwestern', '60479', 'mahagirilla\r\nmahagirilla', 'credit_card', 5, 2),
(6, 'waruna', 'pradeep', 'warunapradeep407@gmail.com', 769610260, 'nikaweratiya', 'northwestern', '60479', 'mahagirilla\r\nmahagirilla', 'credit_card', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `product_description`, `category`, `product_code`, `image1`, `image2`, `image3`, `vendor_id`, `created_at`) VALUES
(7, 'Sri Lankan Batik Shirt – A852', '1600.00', 'jkljkljkl', 'Clothing', 'P20032', 'uploads/FP_ProductShoot_CeylonaBatiks_Batch2_16jan-136.jpg', 'uploads/FP_ProductShoot_CeylonaBatiks_Batch2_16jan-120.jpg', 'uploads/CBST055.jpg', 5, '2023-03-23 23:04:05'),
(8, 'Sri Lankan Batik Shirt ', '2300.00', 'fsad', 'Clothing', 'P20032', 'uploads/CBST055.jpg', 'uploads/', 'uploads/', 5, '2023-03-26 04:46:19'),
(11, 'Batik Floral Detail Silk Dress', '27500.00', 'Size – 8-18\r\n\r\nOccasion – Casual wear\r\n\r\nWash care – Use mild soap, Do not bleach ,Dry low heat, Do not tumble dry, Do not dry clean Wash dark colours, Separately use mild detergent\"', 'Clothing', 'P20032', 'uploads/DBN22D1348_BLU_3.webp', 'uploads/DBN22D1348_BLU_1.webp', 'uploads/DBN22D1348_BLU_4.webp', 6, '2023-04-09 17:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_quantity`
--

CREATE TABLE `product_quantity` (
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_quantity`
--

INSERT INTO `product_quantity` (`product_id`, `size`, `quantity`) VALUES
(7, 'large', 5),
(7, 'medium', 5),
(7, 'small', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `shop` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `shop`, `rating`, `review`) VALUES
(1, 5, 3, 'Test'),
(2, 5, 4, 'Test'),
(3, 5, 4, 'jkljkh');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(11) NOT NULL,
  `storename` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `ownername` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `document` blob DEFAULT NULL,
  `thumb_img` varchar(255) DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `storename`, `phonenumber`, `ownername`, `location`, `address`, `email`, `password`, `document`, `thumb_img`, `banner_img`, `active`) VALUES
(5, 'Nimal store', '0777123456', 'Nimal perera', 'location1', 'mahagirilla\r\nmahagirilla', 'warunapradeep407@gmail.com', '$2y$10$LAL6T4tqyaqJ1Nxaecq7netHKDelbMQ5YoR5lMywJeODRVvSHr.7u', 0x363431623633333064323538375f323032335f36425549533031384320506f7274666f6c696f312047726f75702043572e706466, 'uploads/64267599b88c0_banner5.jpeg', 'uploads/64343b08f2f7d_shop3.png', 0),
(6, 'Buddhi bathik', '0777123456', 'Buddhi', 'Matara', 'mahagirilla, mahagirilla', 'buddhi@gmail.com', '$2y$10$Q37pQwdOdBty3ILT2LDIm.8ADQPxwTjfSe5lSpkAA3MuS/0A3ZYwS', 0x363433326566626139333439365f7465737420646f632e646f6378, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `role`) VALUES
(1, 'waruna', 'warunapradeep407@gmail.com', '0777123456', '$2y$10$XAdbYUjTSGvFmKsrit2i5eT2KplA4ZzAd/08gpfK8CMT1Xlcn1F2S', 'admin'),
(2, 'waruna', 'waruna@gmail.com', '0769610260', '$2y$10$clb2AwMT17b8hcbVqGPkR.Sj8ZpxxGA6pp/niUbpofIz2Df5vIRnK', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` varchar(10) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `vendor_full_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `br_doc` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `vendor`
--
DELIMITER $$
CREATE TRIGGER `vendor_before_insert` BEFORE INSERT ON `vendor` FOR EACH ROW BEGIN
  DECLARE new_vendor_id VARCHAR(10);
  SELECT CONCAT('CUS', LPAD(COALESCE(SUBSTRING(MAX(vendor_id), 4), 0) + 1, 3, '0')) INTO new_vendor_id FROM vendor;
  SET NEW.vendor_id = new_vendor_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_order`
--
ALTER TABLE `cart_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `design_orders`
--
ALTER TABLE `design_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_vendor` (`vendor_id`);

--
-- Indexes for table `product_quantity`
--
ALTER TABLE `product_quantity`
  ADD PRIMARY KEY (`product_id`,`size`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `design_orders`
--
ALTER TABLE `design_orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `stores` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_quantity`
--
ALTER TABLE `product_quantity`
  ADD CONSTRAINT `product_quantity_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
