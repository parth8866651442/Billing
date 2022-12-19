-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 03:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `create_by`, `update_by`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'category 11', 1, 1, 0, '1', '2022-11-17 03:53:33', '2022-11-17 04:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_card_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhaar_card_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone_no`, `address`, `city`, `pan_card_no`, `aadhaar_card_no`, `password`, `create_by`, `update_by`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'client 1', 'client1@test.com', '9632587410', NULL, NULL, 'ABCTY1234D', '1234 12345 12345', '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', 1, 1, 0, '1', NULL, '2022-11-16 23:33:28'),
(2, 'client 2', 'client2@test.com', '9876320145', '9 square B wing ,\r\nnana mava main road, off 150 feet ring road, \r\nrajkot, gujarat 360001', NULL, 'ABCDE1234F', '1234 12345 12345', '$2y$10$bKUFb62kQEcUxiLXS8eVRuaLTb0KVrmxHJ4o4Vqa/HUsXyT0vfAyu', 1, 1, 0, '1', '2022-11-16 23:53:08', '2022-12-13 01:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_16_110506_create_clients_table', 2),
(6, '2022_11_17_062737_create_categorys_table', 3),
(7, '2022_11_17_062913_create_products_table', 4),
(8, '2022_11_17_113240_create_orders_table', 5),
(9, '2022_12_12_125442_create_order_items_table', 6),
(10, '2022_12_13_090725_create_settings_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sip_vehicle_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moblie_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('duplicate','orignal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'duplicate',
  `date` date NOT NULL DEFAULT current_timestamp(),
  `total` double(8,2) NOT NULL DEFAULT 0.00,
  `create_by` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `invoice_no`, `fullname`, `sip_vehicle_no`, `moblie_no`, `type`, `date`, `total`, `create_by`, `update_by`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'BD/H-0001', 'raj sing b', '747125', '9876325410', 'orignal', '2022-12-13', 0.00, 1, 1, 0, '1', '2022-12-08 03:50:13', '2022-12-12 01:43:26'),
(2, 2, 'BD/H-0002', 'client name 1', NULL, NULL, 'orignal', '2022-12-13', 990.00, 1, 1, 0, '1', '2022-12-12 08:04:50', '2022-12-13 01:17:53'),
(3, 2, 'BD/H-0003', 'asssddas', 'asdas', '9876320145', 'orignal', '2022-12-14', 0.00, 1, 1, 1, '1', '2022-12-13 02:08:42', '2022-12-13 06:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `qty`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '100', '1', '100', '2022-12-12 08:04:50', '2022-12-13 06:55:19'),
(2, 2, 2, '200', '1', '200', '2022-12-12 08:04:50', '2022-12-13 06:55:19'),
(3, 2, 3, '120', '2', '240', '2022-12-12 23:40:49', '2022-12-13 06:55:19'),
(4, 2, 4, '150', '3', '450', '2022-12-12 23:57:28', '2022-12-13 06:55:19'),
(5, 3, 1, '100', '3', '300', '2022-12-13 02:08:42', '2022-12-13 02:08:42');

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
('superadmin@admin.com', '$2y$10$zyo4xVhGlYf./0jHkMu.TeP6WVPB05K11SePlt/MDZQBgXe6qGStm', '2022-12-10 05:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `create_by` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `qty`, `create_by`, `update_by`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'product 11', '100', '101', 1, 1, 0, '1', '2022-11-17 05:47:53', '2022-11-17 05:53:15'),
(2, 1, 'product 12', '120', '150', 1, 1, 0, '1', '2022-11-17 05:53:56', '2022-12-10 04:40:13'),
(3, 1, 'product 13', '200', '100', 1, 1, 0, '1', '2022-12-12 23:33:05', '2022-12-12 23:33:14'),
(4, 1, 'products 14', '600', '100', 1, NULL, 0, '1', '2022-12-12 23:33:36', '2022-12-12 23:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `prefix_name_invoice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_holdare_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_ifsc_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_conditions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `prefix_name_invoice`, `bd_holdare_name`, `bd_bank_name`, `bd_ifsc_code`, `bd_account_no`, `address`, `phone_no`, `email_id`, `terms_conditions`, `sign_img`, `logo_img`, `favicon_img`, `create_by`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 'BHARAT DIESEL\'S & HYDRAULIC', 'BD&H', 'Rajbhai k.b', 'Axis Bank (Veraval)', 'UTIB000541', '916020046492747', 'Om Decora 9 Square\r\n150 Feet Ring Rd, \r\nCircle, Nana Mava, \r\nRajkot, Gujarat 360003', '9228218237', 'info@bharatdiesel.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '1670938003_avatar-14.png', '1670938003_logo.png', '1670938003_favicon.png', 1, 1, '2022-12-13 03:54:25', '2022-12-19 05:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('superadmin','admin','employee') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'employee',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `phone_no`, `image`, `password`, `remember_token`, `create_by`, `update_by`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin', 'superadmin@admin.com', NULL, '9876321540', '1670668049_Untitled-3.png', '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, '2022-12-10 04:57:31'),
(3, 'admin', 'admin', 'admin@admin.com', NULL, '9876321565', '1668513776_manav-mandir.png', '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, 1, 0, '1', NULL, '2022-11-15 06:32:56'),
(4, 'employee', 'user', 'user@user.com', NULL, '9876321564', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, 1, 0, '1', NULL, '2022-11-15 05:46:29'),
(5, 'employee', 'user1', 'user1@user.com', NULL, '9876321561', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(6, 'employee', 'user2', 'user2@user.com', NULL, '9876321562', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(7, 'employee', 'user3', 'user3@user.com', NULL, '9876321563', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(8, 'employee', 'user5', 'user5@user.com', NULL, '9876321535', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(9, 'employee', 'user6', 'user6@user.com', NULL, '9876321566', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(10, 'employee', 'user7', 'user7@user.com', NULL, '9876321567', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(11, 'employee', 'user8', 'user8@user.com', NULL, '9876321568', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(12, 'employee', 'user9', 'user9@user.com', NULL, '9876321569', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(13, 'employee', 'user10', 'user10@user.com', NULL, '9876321510', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(14, 'employee', 'user11', 'user11@user.com', NULL, '9876321511', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(15, 'employee', 'user12', 'user12@user.com', NULL, '9876321512', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(16, 'employee', 'user13', 'user13@user.com', NULL, '9876321513', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(17, 'employee', 'user14', 'user14@user.com', NULL, '9876321514', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(18, 'employee', 'user15', 'user15@user.com', NULL, '9876321515', NULL, '$2y$10$OlIBCUeD381gKXyHNW/bDubeYBrSSesQ.wgdXom.tn8eX69Ph2i0a', NULL, 0, NULL, 0, '1', NULL, NULL),
(19, 'admin', 'test', 'test@test.in', NULL, '9638521470', '1670582741_00-Ways-Logo-Final.jpg', '$2y$10$s3w8AGYlt2tqQqRZPf3iTOSxTspGFaDSQuBGkmF/RK4wITCS8ucpy', NULL, 1, NULL, 0, '1', '2022-12-09 05:15:42', '2022-12-09 05:15:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_no_unique` (`phone_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
