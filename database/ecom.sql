-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 06:49 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `heading1` varchar(255) NOT NULL,
  `heading2` varchar(255) NOT NULL,
  `btn_txt` varchar(255) DEFAULT NULL,
  `btn_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(16, 'Man', 1),
(17, 'Women', 1),
(18, 'Kids', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(6, 'Muhammad Usman Umer', 'cewad51583@nnacell.com', '03208500106', 'Helo How are you', '2021-07-14 05:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_master`
--

CREATE TABLE `coupon_master` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `coupon_type` varchar(10) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_master`
--

INSERT INTO `coupon_master` (`id`, `coupon_code`, `coupon_value`, `coupon_type`, `cart_min_value`, `status`) VALUES
(5, 'THESTORE', 150, 'Rupee', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int(11) NOT NULL,
  `txnid` varchar(20) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_value` varchar(50) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `txnid`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`) VALUES
(27, 8, 'House No 4 Main Bazaar Raza Town', 'Sargodha', 40100, 'COD', 1800, 'pending', 3, '046364d39edfacff37ac', 0, '', '', '2021-07-14 04:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(25, 27, 16, 2, 900);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(5, 'Complete'),
(4, 'Canceled'),
(3, 'Shipped'),
(2, 'Processing'),
(1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `sub_categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `best_seller`, `status`) VALUES
(16, 16, 8, 'CO.DENIM MEN\'S BROWNSVILLE STRAIGHT FIT DENIM', 1000, 900, 100, 'media/product/9811651205a2.jpeg', 'Fabric: 100% Cotton', 'Straight fit style\r\nTwo front pockets \r\nTwo back pockets\r\nOne coin pocket\r\nhemmed bottom\r\nButton fly\r\nSize chart is provided in the photos', 1, 1),
(17, 16, 8, 'PRT MEN\'S ENERGY EMBROIDERED SHORT SLEEVE  SHIRT', 1500, 1300, 100, 'media/product/29991085703.jpg', ' MEN\'S ENERGY EMBROIDERED SHORT SLEEVE  SHIRT', 'Plain Classic collar\r\nShort sleeve \r\nThree-button placket\r\nEmbroidered left chest\r\nHemmed cuffs & bottom\r\nSide vents bottom\r\nSize chart is provided in the photos', 1, 1),
(18, 16, 9, 'TPM MEN\'S STAMFORD STRAIGHT FIT DENIM', 900, 750, 150, 'media/product/388108385916.jpg', 'TPM MEN\'S STAMFORD STRAIGHT FIT ', 'Straight fit style\r\nTwo front pockets \r\nTwo back pockets\r\nOne coin pocket\r\nhemmed bottom\r\nButton fly\r\nSize chart is provided in the photos', 1, 1),
(19, 17, 10, 'RANG-REZA WOMEN\'S KURTI COLLECTION 21-6746 UNSTITCHED LAWN KURTI', 3000, 2700, 150, 'media/product/579773923821.jpg', 'RANG-REZA WOMEN\'S KURTI', 'Dimension: \r\n\r\nLawn Digital Print Shirt Front: 40 Inches\r\n\r\nLawn Digital Print Shirt Back: 40 Inches\r\n\r\nLawn Digital Print Sleeves: 23 Inches \r\n\r\nWashing Instructions:\r\n\r\nDo not use Bleach \r\nDo not wash colored fabric with white \r\nDo not dry in direct sun light\r\nIron at moderate temperature \r\nNote: Product color may vary slightly due to photographic lighting', 1, 1),
(20, 18, 12, 'KID\'S SCOOBY-DOO PRINTED FLEECE TRACKSUIT', 1800, 1300, 150, 'media/product/679214984014.jpg', 'KID\'S SCOOBY-DOO PRINTED FLEECE TRACKSUIT', 'KID\'S SCOOBY-DOO PRINTED FLEECE TRACKSUIT KID\'S SCOOBY-DOO PRINTED FLEECE TRACKSUIT KID\'S SCOOBY-DOO PRINTED FLEECE TRACKSUIT KID\'S SCOOBY-DOO PRINTED FLEECE TRACKSUIT KID\'S SCOOBY-DOO PRINTED FLEECE TRACKSUIT KID\'S SCOOBY-DOO PRINTED FLEECE TRACKSUIT', 0, 1),
(21, 17, 11, 'MIX&CO. WOMEN\'S CUCAMONGA COMFORTABLE STRETCH ACTIVEWEAR BOOTLEG PANTS WITH PRINTED WAISTBAND', 8500, 7800, 150, 'media/product/534849580120.jpg', 'COMFORTABLE STRETCH ACTIVEWEAR BOOTLEG PANTS WITH PRINTED WAISTBAND', 'MIX&CO. WOMEN\'S CUCAMONGA COMFORTABLE STRETCH ACTIVEWEAR BOOTLEG PANTS WITH PRINTED WAISTBAND. MIX&CO. WOMEN\'S CUCAMONGA COMFORTABLE STRETCH ACTIVEWEAR BOOTLEG PANTS WITH PRINTED WAISTBAND. MIX&CO. WOMEN\'S CUCAMONGA COMFORTABLE STRETCH ACTIVEWEAR BOOTLEG PANTS WITH PRINTED WAISTBAND', 1, 1),
(22, 18, 13, 'C&A MEN\'S MINOR FAULT KATSINA CUT LABEL SLIM FIT STRETCHED DENIM', 7400, 6400, 150, 'media/product/186477419219.jpg', 'C&A MEN\'S KATSINA', 'C&A MEN\'S MINOR FAULT KATSINA CUT LABEL SLIM FIT STRETCHED DENIM. C&A MEN\'S MINOR FAULT KATSINA CUT LABEL SLIM FIT STRETCHED DENIM. C&A MEN\'S MINOR FAULT KATSINA CUT LABEL SLIM FIT STRETCHED DENIM', 1, 1),
(23, 18, 12, 'POLO REPUBLICA CUTE ELEPHANT CHILD PRINTED LONG SLEEVE BABY ROMPER', 1500, 1200, 155, 'media/product/321156304825.jpg', 'POLO REPUBLICA CUTE ELEPHANT CHILD PRINTED ', 'POLO REPUBLICA CUTE ELEPHANT CHILD PRINTED LONG SLEEVE BABY ROMPER. POLO REPUBLICA CUTE ELEPHANT CHILD PRINTED LONG SLEEVE BABY ROMPER', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_images`) VALUES
(5, 16, 'media/product/4700148435a1.jpeg'),
(6, 21, 'media/product/735787012323.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `user_id`, `rating`, `review`, `status`, `added_on`) VALUES
(3, 16, 8, 'Fantastic', 'Good Stuff.', 1, '2021-07-14 05:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `categories_id`, `sub_categories`, `status`) VALUES
(8, 16, 'Shirts', 1),
(9, 16, 'Pants', 1),
(10, 17, 'Shirts', 1),
(11, 17, 'Pants', 1),
(12, 18, 'Shirts', 1),
(13, 18, 'Pants', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(8, 'Usman', 'usman', 'usmanumer1106@gmail.com', '03208500106', '2021-07-14 04:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(23, 8, 17, '2021-07-14 06:13:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_master`
--
ALTER TABLE `coupon_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupon_master`
--
ALTER TABLE `coupon_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
