-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2020 at 05:45 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evistech_depot`
--

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `sale_details_id` bigint(20) NOT NULL,
  `fk_sale_id` bigint(20) NOT NULL,
  `fk_product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_quantity` bigint(20) NOT NULL,
  `product_weight` varchar(100) NOT NULL,
  `box_unit` int(8) NOT NULL,
  `sale_price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activities`
--

CREATE TABLE `tbl_activities` (
  `pk_activity_id` bigint(20) NOT NULL,
  `activity_type` enum('success','error','warning') NOT NULL,
  `fk_user_id` bigint(20) DEFAULT NULL,
  `activity_name` varchar(200) DEFAULT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_activities`
--

INSERT INTO `tbl_activities` (`pk_activity_id`, `activity_type`, `fk_user_id`, `activity_name`, `create_time`, `create_date`, `created_by`) VALUES
(1, 'success', 1, 'admin login success', '14:32:24', '2020-01-13', 1),
(2, 'warning', NULL, '103.139.179.23', '23:10:15', '2020-01-15', NULL),
(3, 'success', 1, 'admin login success', '23:10:22', '2020-01-15', 1),
(4, 'success', 1, 'admin login success', '12:14:59', '2020-01-17', 1),
(5, 'success', 1, 'admin add a product. Which ID -1', '12:16:24', '2020-01-17', 1),
(6, 'success', 1, 'admin add a branch. Which ID -1', '12:18:00', '2020-01-17', 1),
(7, 'success', 1, 'admin add a stock. Which ID -1', '12:20:05', '2020-01-17', 1),
(8, 'success', 1, 'admin add some stock and the amount of stock is 51048.56 Cashbook ID -1', '12:20:05', '2020-01-17', 1),
(9, 'success', 1, 'admin add a stock. Which ID -2', '12:22:47', '2020-01-17', 1),
(10, 'success', 1, 'admin add some stock and the amount of stock is 2444.88 Cashbook ID -2', '12:22:47', '2020-01-17', 1),
(11, 'warning', NULL, '103.139.179.23', '14:30:18', '2020-01-19', NULL),
(12, 'warning', NULL, '103.139.179.23', '20:10:09', '2020-01-19', NULL),
(13, 'success', 1, 'admin login success', '20:10:15', '2020-01-19', 1),
(14, 'success', 1, 'admin add a product. Which ID -2', '20:39:41', '2020-01-19', 1),
(15, 'success', 1, 'admin add a stock. Which ID -3', '20:43:09', '2020-01-19', 1),
(16, 'success', 1, 'admin add some stock and the amount of stock is 375 Cashbook ID -3', '20:43:09', '2020-01-19', 1),
(17, 'success', 1, 'admin add a stock. Which ID -4', '20:44:38', '2020-01-19', 1),
(18, 'success', 1, 'admin add some stock and the amount of stock is 450 Cashbook ID -4', '20:44:38', '2020-01-19', 1),
(19, 'error', 1, 'admin logout due to inactivity', '21:35:35', '2020-01-19', 1),
(20, 'success', 1, 'admin login success', '21:35:52', '2020-01-19', 1),
(21, 'success', 1, 'admin login success', '21:36:12', '2020-01-20', 1),
(22, 'error', 1, 'admin logout due to inactivity', '22:30:23', '2020-01-20', 1),
(23, 'success', 1, 'admin login success', '22:30:36', '2020-01-20', 1),
(24, 'error', 1, 'admin logout due to inactivity', '22:57:40', '2020-01-20', 1),
(25, 'success', 1, 'admin login success', '22:57:48', '2020-01-20', 1),
(26, 'success', 1, 'admin add a dealer. Which ID -0', '23:16:05', '2020-01-20', 1),
(27, 'success', 1, 'admin add a dealer. Which ID -2', '23:19:45', '2020-01-20', 1),
(28, 'warning', 1, 'admin updated a dealer. Which ID -2', '23:22:07', '2020-01-20', 1),
(29, 'success', 1, 'admin login success', '01:40:00', '2020-02-12', 1),
(30, 'warning', NULL, '103.139.178.12', '12:59:20', '2020-03-03', NULL),
(31, 'warning', NULL, '123.108.244.127', '07:04:59', '2020-03-08', NULL),
(32, 'warning', NULL, '103.139.179.12', '12:59:19', '2020-04-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cashbook`
--

CREATE TABLE `tbl_cashbook` (
  `pk_cashbook_id` bigint(20) NOT NULL,
  `fk_branch_id` bigint(20) NOT NULL,
  `fk_product_id` bigint(20) DEFAULT NULL,
  `fk_stock_id` bigint(20) DEFAULT NULL,
  `fk_inventory_id` bigint(20) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `cashbook_description` text NOT NULL,
  `cash_in` double DEFAULT NULL,
  `cash_out` double DEFAULT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cashbook`
--

INSERT INTO `tbl_cashbook` (`pk_cashbook_id`, `fk_branch_id`, `fk_product_id`, `fk_stock_id`, `fk_inventory_id`, `transaction_date`, `cashbook_description`, `cash_in`, `cash_out`, `create_time`, `create_date`, `created_by`, `update_time`, `update_date`, `updated_by`) VALUES
(1, 1, 1, 1, NULL, '2020-01-17', 'Stock In', 51048.56, NULL, '12:20:05', '2020-01-17', 1, NULL, NULL, NULL),
(2, 1, 1, 2, NULL, '2020-01-17', 'Stock In', 2444.88, NULL, '12:22:47', '2020-01-17', 1, NULL, NULL, NULL),
(3, 1, 2, 3, NULL, '2020-01-19', 'Stock In', 375, NULL, '20:43:09', '2020-01-19', 1, NULL, NULL, NULL),
(4, 1, 2, 4, NULL, '2020-01-20', 'Stock In', 450, NULL, '20:44:38', '2020-01-19', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE `tbl_clients` (
  `pk_client_id` bigint(20) NOT NULL,
  `client_type` enum('client','branch','dealer') NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_mobile` varchar(20) NOT NULL,
  `client_address` text NOT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_clients`
--

INSERT INTO `tbl_clients` (`pk_client_id`, `client_type`, `first_name`, `last_name`, `client_email`, `client_mobile`, `client_address`, `create_time`, `create_date`, `created_by`, `update_time`, `update_date`, `updated_by`) VALUES
(1, 'branch', 'Dhaka', '', 'fancyenterprise079@gmail.com', '01617888471', 'Sarkar Super Market, Kalibari, Baunia.', '12:18:00', '2020-01-17', 1, NULL, NULL, NULL),
(2, 'dealer', 'First Name', 'Last Name', '', '01978702638', 'ADASD978', '23:19:45', '2020-01-20', 1, '23:22:07', '2020-01-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_configurations`
--

CREATE TABLE `tbl_configurations` (
  `pk_configuration_id` bigint(20) NOT NULL,
  `configuration_name` varchar(50) NOT NULL,
  `configuration_setting` varchar(100) NOT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventories`
--

CREATE TABLE `tbl_inventories` (
  `pk_inventory_id` bigint(20) NOT NULL,
  `fk_product_id` bigint(20) NOT NULL,
  `fk_stock_id` bigint(20) NOT NULL,
  `fk_branch_id` bigint(20) DEFAULT NULL,
  `regular_quantity` bigint(20) DEFAULT '0',
  `damage_quantity` bigint(20) DEFAULT '0',
  `free_quantity` bigint(20) DEFAULT '0',
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_inventories`
--

INSERT INTO `tbl_inventories` (`pk_inventory_id`, `fk_product_id`, `fk_stock_id`, `fk_branch_id`, `regular_quantity`, `damage_quantity`, `free_quantity`, `buying_price`, `selling_price`, `create_time`, `create_date`, `created_by`, `update_time`, `update_date`, `updated_by`) VALUES
(1, 1, 1, 1, 15284, 732, 0, 3.34, 3.54, '12:20:05', '2020-01-17', 1, '12:22:47', '2020-01-17', 1),
(2, 2, 3, 1, 15, 0, 0, 25, 30, '20:43:09', '2020-01-19', 1, NULL, NULL, NULL),
(3, 2, 4, 1, 15, 0, 0, 30, 35, '20:44:38', '2020-01-19', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `pk_product_id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_weight` varchar(100) DEFAULT NULL,
  `product_unit` int(8) DEFAULT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`pk_product_id`, `product_name`, `product_weight`, `product_unit`, `create_time`, `create_date`, `created_by`, `update_time`, `update_date`, `updated_by`) VALUES
(1, 'Cup Cake Vanilla', '60gm', 72, '12:16:24', '2020-01-17', 1, NULL, NULL, NULL),
(2, 'Pepsi', '500 ML', 10, '20:39:41', '2020-01-19', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `pk_sale_id` bigint(20) NOT NULL,
  `sale_subtotal` double DEFAULT NULL,
  `sale_discount` double DEFAULT NULL,
  `ground_total` double DEFAULT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`pk_sale_id`, `sale_subtotal`, `sale_discount`, `ground_total`, `create_time`, `create_date`, `created_by`, `update_time`, `update_date`, `updated_by`) VALUES
(1, 500, 0, 5002, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stocks`
--

CREATE TABLE `tbl_stocks` (
  `pk_stock_id` bigint(20) NOT NULL,
  `fk_branch_id` bigint(20) NOT NULL,
  `stock_type` enum('regular','damage','free') NOT NULL,
  `fk_product_id` bigint(20) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `stock_quantity` int(8) NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stocks`
--

INSERT INTO `tbl_stocks` (`pk_stock_id`, `fk_branch_id`, `stock_type`, `fk_product_id`, `buying_price`, `selling_price`, `stock_quantity`, `transaction_date`, `create_time`, `create_date`, `created_by`, `update_time`, `update_date`, `updated_by`) VALUES
(1, 1, 'regular', 1, 3.34, 3.54, 15284, '2020-01-17', '12:20:05', '2020-01-17', 1, NULL, NULL, NULL),
(2, 1, 'damage', 1, 3.34, 3.54, 732, '2020-01-17', '12:22:47', '2020-01-17', 1, NULL, NULL, NULL),
(3, 1, 'regular', 2, 25, 30, 15, '2020-01-19', '20:43:09', '2020-01-19', 1, NULL, NULL, NULL),
(4, 1, 'regular', 2, 30, 35, 15, '2020-01-20', '20:44:38', '2020-01-19', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `pk_user_id` bigint(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_picture` varchar(100) DEFAULT NULL,
  `user_type` enum('superadmin','admin') DEFAULT NULL,
  `user_status` enum('active','inactive') DEFAULT NULL,
  `create_time` time DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `create_year` year(4) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_time` time DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_year` year(4) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`pk_user_id`, `user_name`, `first_name`, `last_name`, `user_email`, `user_password`, `user_picture`, `user_type`, `user_status`, `create_time`, `create_date`, `create_year`, `created_by`, `update_time`, `update_date`, `update_year`, `updated_by`) VALUES
(1, 'admin', '', '', NULL, '111111', NULL, '', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`sale_details_id`);

--
-- Indexes for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  ADD PRIMARY KEY (`pk_activity_id`);

--
-- Indexes for table `tbl_cashbook`
--
ALTER TABLE `tbl_cashbook`
  ADD PRIMARY KEY (`pk_cashbook_id`);

--
-- Indexes for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  ADD PRIMARY KEY (`pk_client_id`);

--
-- Indexes for table `tbl_configurations`
--
ALTER TABLE `tbl_configurations`
  ADD PRIMARY KEY (`pk_configuration_id`);

--
-- Indexes for table `tbl_inventories`
--
ALTER TABLE `tbl_inventories`
  ADD PRIMARY KEY (`pk_inventory_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`pk_product_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`pk_sale_id`);

--
-- Indexes for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  ADD PRIMARY KEY (`pk_stock_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`pk_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `sale_details_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  MODIFY `pk_activity_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_cashbook`
--
ALTER TABLE `tbl_cashbook`
  MODIFY `pk_cashbook_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  MODIFY `pk_client_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_configurations`
--
ALTER TABLE `tbl_configurations`
  MODIFY `pk_configuration_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inventories`
--
ALTER TABLE `tbl_inventories`
  MODIFY `pk_inventory_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `pk_product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `pk_sale_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  MODIFY `pk_stock_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `pk_user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
