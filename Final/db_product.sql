-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2026 at 04:48 PM
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
-- Database: `db_product`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit`
--

CREATE TABLE `tbl_audit` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `action_date` date NOT NULL,
  `action_time` time NOT NULL,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit`
--

INSERT INTO `tbl_audit` (`id`, `seller_id`, `action_date`, `action_time`, `action`) VALUES
(1, 1, '2026-07-18', '02:58:50', 'Add Product'),
(2, 1, '2026-07-18', '14:02:38', 'Modify Product'),
(3, 1, '2026-07-18', '14:03:13', 'Modify Product'),
(4, 1, '2026-07-18', '14:31:09', 'Modify Product'),
(5, 1, '2026-07-18', '15:10:36', 'Add Product'),
(6, 1, '2026-07-18', '15:26:08', 'Add Product'),
(7, 1, '2026-07-18', '15:26:35', 'Remove Product'),
(8, 1, '2026-07-18', '15:26:59', 'Add Product'),
(9, 1, '2026-07-18', '15:30:29', 'Add Product Metadata'),
(10, 1, '2026-07-18', '15:32:06', 'Add Product Metadata'),
(11, 1, '2026-07-18', '15:34:50', 'Add Product Metadata'),
(12, 1, '2026-07-18', '15:38:08', 'Add Product'),
(13, 1, '2026-07-18', '15:39:21', 'Add Product'),
(14, 1, '2026-07-18', '15:39:42', 'Add Product'),
(15, 1, '2026-07-18', '15:44:46', 'Add Product Metadata'),
(16, 1, '2026-07-18', '15:51:47', 'Add Product Metadata'),
(17, 1, '2026-07-18', '15:56:00', 'Add Product Metadata'),
(18, 1, '2026-07-18', '15:56:28', 'Remove Product'),
(19, 1, '2026-07-18', '15:56:31', 'Remove Product'),
(20, 1, '2026-07-18', '15:59:25', 'Add Product'),
(21, 1, '2026-07-18', '15:59:37', 'Modify Product'),
(22, 1, '2026-07-18', '15:59:48', 'Modify Product'),
(23, 1, '2026-07-18', '16:00:10', 'Modify Product'),
(24, 1, '2026-07-18', '16:01:15', 'Modify Product'),
(25, 1, '2026-07-18', '16:02:01', 'Add Product'),
(26, 1, '2026-07-18', '16:02:53', 'Add Product'),
(27, 1, '2026-07-18', '16:03:09', 'Modify Product'),
(28, 1, '2026-07-18', '16:05:13', 'Add Product'),
(29, 1, '2026-07-18', '16:06:39', 'Add Product'),
(30, 1, '2026-07-18', '16:07:34', 'Add Product'),
(31, 1, '2026-07-18', '16:08:11', 'Modify Product'),
(32, 1, '2026-07-18', '16:09:13', 'Add Product');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`id`, `name`) VALUES
(4, 'Doz'),
(12, 'Keystrokes'),
(7, 'Looney'),
(11, 'Minun'),
(10, 'Tooney'),
(1, 'Unos');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`) VALUES
(3, 'Accessories'),
(1, 'Amplifier'),
(4, 'Drums and Percussion'),
(2, 'Effect and Pedals'),
(0, 'Guitar'),
(5, 'Keyboard');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `image` varchar(20) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `specification` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `brand_id`, `name`, `quantity`, `price`, `category_id`, `subcategory_id`, `image`, `description`, `specification`) VALUES
(1, 1, 'Amber 9000', 5, 5500, 0, 0, '1.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Ut tempus neque at consequat accumsan. Mauris et consectetur mi. Suspendisse luctus ipsum libero, ac tristique lacus elementum nec. Nullam enim risus, volutpat sit amet malesuada bibendum, interdum quis lorem. Phasellus ligula justo, tempor non pelle'),
(2, 4, 'Ocean Night', 10, 7000, 0, 0, '2.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Ut tempus neque at consequat accumsan. Mauris et consectetur mi. Suspendisse luctus ipsum libero, ac tristique lacus elementum nec. Nullam enim risus, volutpat sit amet malesuada bibendum, interdum quis lorem. Phasellus ligula justo, tempor non pelle'),
(3, 1, 'Unos Spike Amber 2400', 20, 8000, 0, 1, '3.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Ut tempus neque at consequat accumsan. Mauris et consectetur mi. Suspendisse luctus ipsum libero, ac tristique lacus elementum nec. Nullam enim risus, volutpat sit amet malesuada bibendum, interdum quis lorem. Phasellus ligula justo, tempor non pelle'),
(5, 4, 'Doz Ocean Night', 20, 8200, 0, 1, '5.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos'),
(6, 7, 'Looney Brown Horn', 10, 7100, 1, 3, '6.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos'),
(9, 10, 'Tooney Bubblegum Amplifier', 10, 8000, 1, 3, '9.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos'),
(10, 7, 'Looney Mini Brown Horn', 5, 8000, 1, 2, '10.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos'),
(11, 10, 'Tooney Mini Bubblegum Amplifier', 9, 6000, 1, 2, '11.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos'),
(12, 1, 'Unos Robo 4000 Pedal', 10, 5000, 2, 4, '12.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos'),
(13, 4, 'Doz Navy Blue Bluetooth Earphones', 50, 1500, 3, 5, '13.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos'),
(14, 11, 'Minun Goldbeat Drums', 10, 4000, 4, 6, '14.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos'),
(15, 12, 'Keystrokes Redfire Digital Piano', 4, 12000, 5, 7, '15.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor, nulla eget accumsan bibendum, turpis mauris facilisis metus, non mollis nisi metus a lacus. Ut euismod accumsan ligula, non vulputate turpis lacinia id. Vestibulum vulputate pos');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`id`, `name`) VALUES
(3, 'Bass Guitar Amplifier'),
(0, 'Classic Guitar'),
(7, 'Digital Pianos'),
(6, 'Drums'),
(5, 'Earphones'),
(2, 'Electric Amplifier'),
(1, 'Electric Guitar'),
(4, 'Pedals');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand` (`brand_id`),
  ADD KEY `category` (`category_id`,`subcategory_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `tbl_brand` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_product_ibfk_3` FOREIGN KEY (`subcategory_id`) REFERENCES `tbl_subcategory` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
