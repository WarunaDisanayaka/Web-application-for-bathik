-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2023 at 03:29 PM
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
(7, 'Sri Lankan Batik Shirt – A852', 1600.00, 'medium', 1, 1.00, 5, 2, 'Processing'),
(11, 'Batik Floral Detail Silk Dress', 27500.00, '', 1, 1.00, 6, 2, 'Pending');

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

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `size` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `shop` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `incoming_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `shop_id`, `user_id`, `username`, `message`, `incoming_id`) VALUES
(1, 7, 4, 'waruna', 'Hello', 0),
(2, 7, 4, 'Buddhi', 'Hi', 1),
(4, 7, 4, 'waruna', 'Hello', 0);

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
  `fabric` varchar(255) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_quantity`
--

CREATE TABLE `product_quantity` (
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(11) NOT NULL,
  `storename` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `ownername` varchar(255) DEFAULT NULL,
  `customization` varchar(10) NOT NULL,
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

INSERT INTO `stores` (`store_id`, `storename`, `phonenumber`, `ownername`, `customization`, `location`, `address`, `email`, `password`, `document`, `thumb_img`, `banner_img`, `active`) VALUES
(9, 'Akira', '0777123654', 'Akira', 'yes', 'Colombo', 'Colombo 8', 'akira@gmail.com', '$2y$10$X42PJN8ijupc/xnuxz/HsuHNN.GpUggJTVGn3aLfiD5o0DSR7Ztty', 0x363435346165363131653438635f52616d7a616e20446f63756d656e742e646f6378, NULL, 'uploads/6454aed2d6d05_Akira.png', 0),
(10, 'Alponso Batiks', '0777456432', 'Alponso Batiks', 'no', 'Colombo', 'Colombo 4', 'alponso@gmail.com', '$2y$10$PCS.Rle7vLUdnajlipjdWe3kdWPyg5r3AAUryBt.DvuxjQ7D2Hb5u', 0x363435346166386635643934305f52616d7a616e20446f63756d656e742e646f6378, NULL, 'uploads/6454b015ab21b_Alponso Batiks.png', 0),
(11, 'Batiks By Maithree', '0777654321', 'Maithree', 'yes', 'Colombo', 'Colombo 10', 'maithree@gmail.com', '$2y$10$J.bWotDfphlRPF/iAOT18.DOJwzh7yFHy/Uyr74w4hxEIptp8dRda', 0x363435346230373064653733385f52616d7a616e20446f63756d656e742e646f6378, NULL, 'uploads/6454b098d3014_Batiks By Maithree.png', 0),
(12, 'Buddhi Batiks', '0777890678', 'Buddhi', 'yes', 'Matara', 'Matara', 'buddhi@gmail.com', '$2y$10$dJBD02yBldtFtbDQhA2uges9SbxUHNcNoUKtClQIGs.yqPkQPukEC', 0x363435346266313762396137385f52616d7a616e20446f63756d656e742e646f6378, NULL, 'uploads/6454bf4c6586f_Buddhi Batiks.png', 0);

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
(4, 'waruna', 'waruna@gmail.com', '0777123456', '$2y$10$m8y0oEeLfUBq1kD1KWj3gOhzJKEYy/3PEQWoicHzqY8UjXea/rIAe', 'user');

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
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
