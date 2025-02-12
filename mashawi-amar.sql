-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 06:56 PM
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
-- Database: `mashawi-amar`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text DEFAULT 'This category doesn\'t have a description',
  `category_image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`, `category_image`, `created_at`) VALUES
(5, 'Burgers', 'Juicy, flavorful patties layered with toppings, sauces, and buns for an ultimate indulgence', 'views/admin/uploads/categories/67994fae63032_cheese-burger.jpg', '2025-01-25 08:25:01'),
(16, 'Salads', 'Fresh, healthy, flavorful salads with crisp veggies, dressings, and toppings.', 'views/admin/uploads/categories/679fd1031c8c8_salads.jpg', '2025-02-02 21:09:39'),
(17, 'Juices', 'Refreshing, natural juices made from fresh fruits, full of vitamins.', 'views/admin/uploads/categories/679fd12deb5e2_mango-juice.jpg', '2025-02-02 21:10:21'),
(18, 'Dishes', 'This is the dishes category', 'views/admin/uploads/categories/67a12d3f8d0f6_pasta.jpg', '2025-02-03 21:55:27'),
(19, 'Desserts', 'This is desserts category', 'views/admin/uploads/categories/67a12eb491aaf_ice-cream.jpg', '2025-02-03 22:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'customer',
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `role`, `email`, `password`, `reg_date`) VALUES
(7, 'Mohamed', 'Talibi', 'admin', 'mohamed@gmail.com', '$2y$10$MXROmNpu43mrZdF4pOSAcOFV8AToT7/a0Cn9vB.m2ff9rePMo01Qu', '2025-01-20 22:45:20'),
(8, 'Achraf', 'Fahim', 'customer', 'achraf@gmail.com', '$2y$10$oZwPgrw0SWB6WVJld1nQ1uulgob.jUsHAuNQWMYaq8aZbxrJNkjCi', '2025-01-21 19:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(500) NOT NULL DEFAULT 'Description not available for the moment',
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_price`, `product_image`, `category_id`, `created_at`, `updated_at`) VALUES
(8, 'Classic Cheeseburger', 'Juicy beef patty, melted cheese, lettuce, tomato, onions, soft bun.', 90.00, 'views/admin/uploads/products/67a12c45731a8_cheese-burger.jpg', 5, '2025-02-03 21:51:17', '2025-02-03 21:59:08'),
(9, 'BBQ Bacon Burger', 'Smoky BBQ sauce, crispy bacon, cheddar cheese, grilled beef patty.', 55.89, 'views/admin/uploads/products/67a12c6cefe4a_bacon Burger.jpg', 5, '2025-02-03 21:51:56', '2025-02-03 21:51:56'),
(11, 'Grilled Chicken Plate', 'Juicy grilled chicken, herbs, rice, fresh vegetables, garlic sauce.', 78.99, 'views/admin/uploads/products/67a12e47cb0f1_grilled-chicken.jpg', 18, '2025-02-03 21:55:48', '2025-02-03 21:59:51'),
(12, 'Beef Stroganoff', 'Tender beef, creamy mushroom sauce, pasta, rich, comforting Russian dish.', 67.96, 'views/admin/uploads/products/67a12d7aa35d4_grilled-chicken.jpg', 18, '2025-02-03 21:56:26', '2025-02-03 21:56:26'),
(13, 'Dessert Name', 'This is the description for a dessert food', 66.93, 'views/admin/uploads/products/67a12ed70a862_lava-cake.jpg', 19, '2025-02-03 22:02:15', '2025-02-03 22:02:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `idx_category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
