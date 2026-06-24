-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 04:36 AM
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
-- Database: `im102_lab3`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Electronics'),
(2, 'Office Supplies'),
(3, 'Food'),
(4, 'Furniture'),
(5, 'Clothing');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `supplier_id`, `created_at`) VALUES
(1, 'Laptop', '15-inch business laptop', 45000.00, 10, 1, 1, '2026-06-24 01:09:33'),
(2, 'Mouse', 'Wireless mouse', 500.00, 50, 1, 1, '2026-06-24 01:09:33'),
(3, 'Keyboard', 'Mechanical keyboard', 1500.00, 30, 1, 1, '2026-06-24 01:09:33'),
(4, 'Printer Paper', 'A4 size bond paper', 250.00, 100, 2, 2, '2026-06-24 01:09:33'),
(5, 'Ballpen', 'Blue ink ballpen', 15.00, 500, 2, 2, '2026-06-24 01:09:33'),
(6, 'Notebook', '200-page notebook', 50.00, 200, 2, 2, '2026-06-24 01:09:33'),
(7, 'Bread', 'Whole wheat bread', 50.00, 40, 3, 3, '2026-06-24 01:09:33'),
(8, 'Milk', '1-liter fresh milk', 90.00, 60, 3, 3, '2026-06-24 01:09:33'),
(9, 'Office Chair', 'Ergonomic chair', 3500.00, 15, 4, 2, '2026-06-24 01:09:33'),
(10, 'Table', 'Wooden office table', 7000.00, 8, 4, 2, '2026-06-24 01:09:33'),
(11, 'T-Shirt', 'Cotton T-shirt', 300.00, 100, 5, 3, '2026-06-24 01:09:33'),
(12, 'Jacket', 'Waterproof jacket', 1200.00, 25, 5, 3, '2026-06-24 01:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`) VALUES
(1, 'TechCorp', 'John Reyes', '0912-345-6789'),
(2, 'Metro Supplies', 'Anna Cruz', '0918-765-4321'),
(3, 'Global Traders', 'Mark Santos', '0922-111-2233');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-06-22 00:58:52'),
(2, 'angelo', 'alindayo@gmail.com', '$2y$10$bQj276DAM1ZBWG0xmf1OSeCDAcsKz0FFnRBy0rNLIsQC1seVSllsi', 'admin', '2026-06-22 01:09:54'),
(3, 'oskar', 'justincarlcanalita07@gmail.com', '$2y$10$kou4qKVymqoe6jL7aC21EOQFhHUFFYld.SlHsQvZR6z2u2rclKQKm', 'staff', '2026-06-22 01:51:58'),
(4, 'angelica', 'angelica@gmail.com', '$2y$10$eETXWgU0fDkd0y5WSzbSIu6CJXg7m31jKShm6QF87iByMQLn/HVM2', 'staff', '2026-06-22 02:10:49'),
(5, 'Shiruken8', 'untuwa@gmail.com', '$2y$10$eRO/BHB9psTUGmW2LY0IHeb8YDRTX6sFiGVa2LGI4REciQ4B.EQUi', 'admin', '2026-06-23 01:23:53'),
(6, 'admin2', 'admin2@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-06-23 01:43:27'),
(7, 'admin3', 'admin3@example.com', '$2y$10$e0NRoB3JqgGgbU1HixSeKOVu9u8CbnMD4HzyBbs6k8ZZrPmSu2V0W', 'admin', '2026-06-23 01:45:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
