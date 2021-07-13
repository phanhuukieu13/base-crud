-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 10:44 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kieuph`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `is_deleted`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Quấn áo mùa đông', 0, '2021-07-08 01:49:19', '2021-07-07 18:18:14', '2021-07-07 18:38:45'),
(2, 'Quần áo mùa hè', 0, '2021-07-08 01:49:31', '2021-07-07 18:49:31', '2021-07-07 18:49:31'),
(3, 'Quần áo mùa xuân', 0, '2021-07-08 01:49:39', '2021-07-07 18:49:39', '2021-07-07 18:49:39'),
(4, 'Quần áo mùa thu', 0, '2021-07-08 01:49:50', '2021-07-07 18:49:50', '2021-07-07 18:49:50'),
(5, 'Quần áo công sở', 1, '2021-07-13 08:11:10', '2021-07-07 18:49:55', '2021-07-13 01:11:10'),
(6, 'Giày dép', 1, '2021-07-13 08:09:32', '2021-07-07 18:50:10', '2021-07-07 18:50:10'),
(7, 'Mũ', 0, '2021-07-08 01:50:16', '2021-07-07 18:50:16', '2021-07-07 18:50:16'),
(8, 'Phụ Kiện', 0, '2021-07-08 01:50:23', '2021-07-07 18:50:23', '2021-07-07 18:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_create_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id`, `user_id`, `email`, `password`, `status`, `is_deleted`, `token`, `token_create_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 16, 'admin123@gmail.com', '123123', 0, 0, NULL, NULL, '2021-07-07 04:37:41', NULL, NULL),
(2, 17, 'phankieu@gmail.com', '123123123', 0, 0, 'Y2AdLch4RFSeJWbPJwV1tC8uE7cWbH', '2021-07-12 02:18:47', NULL, NULL, '2021-07-12 02:18:47'),
(3, NULL, 'admin@gmail.com', '$2y$10$SvA5ntS7l9dIFAWsxrfRqO7e46hDh1.unr2pH3NZZ185YIj8rphN2', 0, 0, NULL, NULL, NULL, '2021-07-12 00:51:57', '2021-07-12 00:51:57'),
(4, NULL, 'phankieu.finnha@gmail.com', '$2y$10$AJu9HYD.cgc.aK51nUyv/eoZ47G.CS/Si/osA2XYPPZNxA0X/Pjvy', 0, 0, 'v1EwLqW0IiRA8btHhj1IBpwVtYmlBw', '2021-07-12 18:38:44', NULL, '2021-07-12 01:10:24', '2021-07-12 18:38:44'),
(8, 26, 'ad@gmail.com', '$2y$10$DfdxQ5t.146DrJdbbRuJ1OWP.b8MBszQPk8YHEIjjO7IURm.O3E9y', 0, 0, NULL, NULL, NULL, '2021-07-13 00:56:50', '2021-07-13 00:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_07_011228_create_login_user_table', 2),
(5, '2021_07_07_011917_create_category_table', 3),
(6, '2021_07_07_012144_create_products_table', 4),
(7, '2021_07_08_024221_add_image_to_products_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('phankieu.finnha@gmail.com', 'xdredV6FxzMK', '2021-07-12 01:50:51'),
('phankieu.finnha@gmail.com', '6leu5etG6OU7', '2021-07-12 01:51:55'),
('phankieu.finnha@gmail.com', 'pQA5EiRXRLfE', '2021-07-12 01:52:13'),
('phankieu.finnha@gmail.com', 'RAl2NTjAhbqR', '2021-07-12 01:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `color`, `size`, `amount`, `price`, `detail`, `is_deleted`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'Converse Chuck 70s', 'Đen', '39', 20, 1900000, 'Converse Chuck70s', 1, '2021-07-13 08:01:20', '2021-07-07 19:39:45', '2021-07-13 00:59:34'),
(10, 1, 'Bomber', 'Đen', 'XXL', 200, 200000000, '. Each migr determine the order of the migrations.', 0, '2021-07-08 04:01:15', '2021-07-07 20:59:47', '2021-07-07 20:59:47'),
(11, 7, 'Black Cap', 'Đỏ', 's', 200, 200000, 'Black Cap', 0, '2021-07-08 07:03:23', '2021-07-08 00:03:23', '2021-07-08 00:03:23'),
(12, 4, 'jacket', 'Xanh', 'XXl', 100, 20000000, 'Jacket', 0, '2021-07-09 01:22:59', '2021-07-08 18:22:45', '2021-07-08 18:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) DEFAULT 0,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `phone_number`, `image`, `address`, `old`, `status`, `is_deleted`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Phan Kiều', '0495737343', '60e5279077122.png', 'Hà Nội', 20, 0, 0, '2021-07-09 06:34:06', '2021-07-06 19:16:34', '2021-07-08 21:16:49'),
(2, 'Trương Nhàn', '04958347', '60e50ed6bf559.jpg', 'Bắc Giang', 20, 0, 0, '2021-07-09 04:16:36', '2021-07-06 19:17:58', '2021-07-08 21:16:36'),
(3, 'Hoàng Tiến Đạt', '034903294', '60e5285a9cb7e.jpg', 'Hà Nội', 30, 0, 0, '2021-07-13 07:57:35', '2021-07-06 21:06:50', '2021-07-13 00:57:35'),
(5, 'Nguyễn Cao Cường', '0548344893', '60e528d9e7196.jpg', 'Hải Phòng', 30, 0, 0, '2021-07-13 07:57:32', '2021-07-06 21:08:57', '2021-07-13 00:57:32'),
(6, 'Nguyễn Bá Vinh', '3493493844', '60e5291b4fb7a.png', 'Hưng Yên', 30, 0, 0, '2021-07-09 03:55:45', '2021-07-06 21:10:03', '2021-07-08 20:55:25'),
(15, 'Phan Kiều', '034942383', '60e52f7ce9230.png', 'Hải Dương', 20, 0, 0, '2021-07-09 03:55:50', '2021-07-06 21:37:16', '2021-07-08 20:55:23'),
(16, 'Phan Kiều', '034942383', '60e52f951602f.png', 'Hải Dương', 20, 0, 0, '2021-07-09 03:55:53', '2021-07-06 21:37:41', '2021-07-08 20:55:21'),
(17, 'Phan kieu', '0349483', '60e6c28505053.png', 'hai duong', 22, 0, 1, '2021-07-09 06:34:49', '2021-07-08 02:16:53', '2021-07-08 21:07:04'),
(26, 'phan kieu', '028432904', NULL, 'hai duong', 30, 0, 0, '2021-07-13 07:56:50', '2021-07-13 00:56:50', '2021-07-13 00:56:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_user_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
