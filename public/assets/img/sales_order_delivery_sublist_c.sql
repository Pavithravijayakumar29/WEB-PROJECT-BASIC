-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 12:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pps_oil_mill`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_delivery_sublist_c`
--

CREATE TABLE `sales_order_delivery_sublist_c` (
  `id` int(11) NOT NULL,
  `entry_date` date DEFAULT NULL,
  `sales_order_main_id` int(11) DEFAULT NULL,
  `item_creation_id` int(11) DEFAULT NULL,
  `opening_stock` double DEFAULT NULL,
  `total_stock` varchar(125) DEFAULT NULL,
  `return_quantity` double DEFAULT NULL,
  `item_property` int(11) NOT NULL,
  `item_weights` int(11) DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `created_ipaddress` varchar(25) DEFAULT NULL,
  `updated_ipaddress` varchar(25) DEFAULT NULL,
  `created_user_agent` text DEFAULT NULL,
  `updated_user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_order_delivery_sublist_c`
--

INSERT INTO `sales_order_delivery_sublist_c` (`id`, `entry_date`, `sales_order_main_id`, `item_creation_id`, `opening_stock`, `total_stock`, `return_quantity`, `item_property`, `item_weights`, `item_price`, `total_amount`, `delete_status`, `created_at`, `updated_at`, `created_user_id`, `updated_user_id`, `created_ipaddress`, `updated_ipaddress`, `created_user_agent`, `updated_user_agent`) VALUES
(1, '2023-07-21', 1, 1, 40, '50', 20, 6, 7, 2000, 40000, NULL, '2023-08-21 06:51:36', '2023-08-21 06:51:36', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2023-08-22', 1, 1, 50, '40', 20, 6, 7, 2000, 50000, NULL, '2023-08-22 09:39:32', '2023-08-22 09:39:32', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_order_delivery_sublist_c`
--
ALTER TABLE `sales_order_delivery_sublist_c`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_order_delivery_sublist_c`
--
ALTER TABLE `sales_order_delivery_sublist_c`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
