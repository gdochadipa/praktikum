-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2020 pada 15.42
-- Versi server: 10.4.10-MariaDB-log
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paktikum_prognet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `name`, `profile_image`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', '$2y$10$vhTtiVXX7SMke4sBDUNwhOAknM2C8hqeaiMoQLYJi38KN7xsdf1y2', 'Admin Marketplace', 'ada', '08539545781', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0894b150-1384-4400-bb13-749b6398a547', 'App\\Notifications\\admin_notification', 'App\\admin', 2, '{\"order\":\"Review\",\"body\":\"User has review our Product!\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/product\\/6\\/edit\"}', NULL, '2020-05-29 03:24:32', '2020-05-29 03:24:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('checkedout','notyet','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `qty`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 6, 3, '2020-05-14 05:59:21', '2020-05-23 21:00:04', 'checkedout'),
(2, 1, 7, 2, '2020-05-23 20:44:22', '2020-05-23 21:00:12', 'checkedout'),
(3, 1, 8, 2, '2020-05-23 23:14:04', '2020-05-27 23:10:58', 'checkedout'),
(4, 1, 6, 1, '2020-05-27 23:08:57', '2020-05-27 23:10:59', 'checkedout');

-- --------------------------------------------------------

--
-- Struktur dari tabel `couriers`
--

CREATE TABLE `couriers` (
  `id` int(10) UNSIGNED NOT NULL,
  `courier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `couriers`
--

INSERT INTO `couriers` (`id`, `courier`, `created_at`, `updated_at`) VALUES
(1, 'JNE', '2020-04-01 20:05:09', '2020-04-01 21:05:30'),
(2, 'TIKI', '2020-04-01 20:07:59', '2020-04-01 20:07:59'),
(6, 'POS', '2020-05-20 16:00:00', '2020-05-20 16:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `discounts`
--

CREATE TABLE `discounts` (
  `id` int(10) NOT NULL,
  `id_product` int(10) UNSIGNED DEFAULT NULL,
  `percentage` int(3) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `discounts`
--

INSERT INTO `discounts` (`id`, `id_product`, `percentage`, `start`, `end`, `created_at`, `updated_at`) VALUES
(1, 6, 5, '2020-05-07', '2020-05-09', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_15_123603_create_admins_table', 1),
(4, '2019_02_15_123744_create_sellers_table', 1),
(5, '2019_02_15_125445_create_products_table', 1),
(6, '2019_02_15_130341_create_product_images_table', 1),
(7, '2019_02_15_131114_create_transactions_table', 1),
(8, '2019_02_15_131132_create_transaction_details_table', 1),
(9, '2019_02_15_132352_create_product_categories_table', 1),
(10, '2019_02_15_132701_create_carts_table', 1),
(11, '2019_02_15_134220_create_wishlists_table', 1),
(12, '2019_02_16_044815_create_rates_table', 1),
(13, '2019_02_16_045411_create_product_reviews_table', 1),
(14, '2019_02_16_062504_create_qna_products_table', 1),
(15, '2019_02_16_063238_create_shopping_voucers_table', 1),
(16, '2019_02_16_064643_create_couriers_table', 1),
(17, '2019_02_16_102028_create_notifications_table', 1),
(18, '2019_02_16_103007_create_seller_notifications_table', 1),
(19, '2019_02_16_103024_create_user_notifications_table', 1),
(20, '2020_05_28_124325_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('gdochadipa@gmail.com', 'mGqroRqKllsC', '2020-04-10 22:17:32'),
('gdochadipa@gmail.com', 'OSbhcxM62mRg', '2020-04-10 22:19:46'),
('gdochadipa@gmail.com', '2AaruqcubG8k', '2020-04-10 22:24:56'),
('gdochadipa@gmail.com', '1omtG52F8kzD', '2020-04-10 22:42:16'),
('gdochadipa@gmail.com', 'uazcuVFcaO4q', '2020-04-10 22:54:37'),
('gdochadipa@gmail.com', 'Xq8SoCV4SJjL', '2020-04-10 23:03:41'),
('gdochadipa@gmail.com', 'lirjyDeYTuwP', '2020-04-10 23:47:51'),
('gdochadipa@gmail.com', 'ypx10WyyUD7p', '2020-04-10 23:50:09'),
('gdochadipa@gmail.com', '1W8UFO09ZLt4', '2020-04-11 00:07:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_rate` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `weight` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `description`, `product_rate`, `created_at`, `updated_at`, `stock`, `weight`) VALUES
(6, 'Gucci Bag', 10000000, 'Tas ukuran sedang', 3, '2020-04-15 05:22:39', '2020-05-29 03:24:30', 5, 5),
(7, 'Gucci Bag II', 1000000, 'Tas ukuran sedang', 3, '2020-04-15 07:08:10', '2020-04-15 07:08:10', 10, 4),
(8, 'Gucci Bag IV', 20000000, 'Tas ukuran sedang', 3, '2020-05-06 09:05:31', '2020-05-27 23:17:18', 10, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Sweeter', '2020-04-14 06:04:30', '2020-04-14 06:04:30'),
(2, 'Jeans', '2020-04-14 06:04:41', '2020-04-14 06:04:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_category_details`
--

CREATE TABLE `product_category_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_category_details`
--

INSERT INTO `product_category_details` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2020-04-22 06:02:40', '2020-04-22 06:02:40'),
(2, 8, 1, '2020-05-06 09:06:34', '2020-05-06 09:06:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`, `created_at`, `updated_at`) VALUES
(2, 6, '1586956960_95f6edfb66ef42d774a5a34581f19052.jpg', '2020-04-15 05:22:40', '2020-04-15 05:22:40'),
(3, 6, '1586956960_20161014_58006bff8b1de.png', '2020-04-15 05:22:40', '2020-04-15 05:22:40'),
(4, 7, '1586963290.png', '2020-04-15 07:08:10', '2020-04-15 07:08:10'),
(5, 7, '1586963290.png', '2020-04-15 07:08:10', '2020-04-15 07:08:10'),
(6, 6, '1587562213_.jpeg', '2020-04-22 05:30:13', '2020-04-22 05:30:13'),
(9, 8, '1588784732_.png', '2020-05-06 09:05:32', '2020-05-06 09:05:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `rate` int(1) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `rate`, `content`, `created_at`, `updated_at`) VALUES
(2, 8, 15, 4, 'review bang', NULL, NULL),
(3, 7, 1, 3, 'Mahal beute', '2020-05-26 22:46:25', '2020-05-26 22:46:25'),
(14, 8, 1, 2, 'Mahal beute', '2020-05-27 23:17:18', '2020-05-27 23:17:18'),
(15, 6, 1, 3, 'Jelek barangnya', '2020-05-29 03:24:30', '2020-05-29 03:24:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `responses`
--

CREATE TABLE `responses` (
  `id` int(10) UNSIGNED NOT NULL,
  `review_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `timeout` datetime NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double(12,2) NOT NULL,
  `shipping_cost` double(12,2) NOT NULL,
  `sub_total` double(12,2) NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL,
  `courier_id` int(10) UNSIGNED NOT NULL,
  `proof_of_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('unverified','verified','delivered','success','expired','canceled') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `timeout`, `address`, `regency`, `province`, `total`, `shipping_cost`, `sub_total`, `user_id`, `courier_id`, `proof_of_payment`, `created_at`, `updated_at`, `status`) VALUES
(1, '2020-05-29 00:00:00', 'Jln. Rumah sendii', 'Badung', 'Bali', 2000000.00, 100000.00, 2100000.00, 1, 1, '', '2020-05-01 16:00:00', '2020-05-27 22:21:10', 'expired'),
(2, '2020-05-25 05:08:27', 'Link. Padang Udayana', 'Denpasar', 'Bali', 32015000.00, 15000.00, 32000000.00, 1, 6, '1590303208_.jpeg', '2020-05-23 21:08:27', '2020-05-23 22:53:28', 'unverified'),
(3, '2020-05-29 07:10:57', 'Link. Padang Udayana', 'Denpasar', 'Bali', 50008000.00, 8000.00, 0.00, 1, 1, '1590650063_.jpeg', '2020-05-27 23:10:58', '2020-05-27 23:14:24', 'unverified');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(3) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `qty`, `discount`, `selling_price`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 0, 200000, NULL, NULL),
(2, 2, 6, 3, 0, 10000000, '2020-05-23 21:08:28', '2020-05-23 21:08:28'),
(3, 2, 7, 2, 0, 1000000, '2020-05-23 21:08:28', '2020-05-23 21:08:28'),
(4, 3, 8, 2, 0, 20000000, '2020-05-27 23:10:58', '2020-05-27 23:10:58'),
(5, 3, 6, 1, 0, 10000000, '2020-05-27 23:10:59', '2020-05-27 23:10:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_image`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gede Ocha Dipa', 'gdochadipa@gmail.com', 'user.png', '1', NULL, '$2y$10$KNIhgbdgZGcutxEwtTYhPu98EBWfIssQ2mkYEKy5VGoUS4qozr9Iy', NULL, '2020-03-17 14:39:19', '2020-04-11 00:08:13'),
(14, 'Gede Ocha Dipa', 'ochadipa@gmail.com', 'ada', '1', '2020-05-06 07:37:40', '$2y$10$ovoR9dljTZJw8gxZZ4RtBeX8Bb28UgSBb2lWTs0z4ljyrxK5RCIEC', NULL, '2020-05-06 07:29:45', '2020-05-06 07:37:40'),
(15, 'Gede Dipa', 'itesega2019@gmail.com', 'user.png', '1', '2020-05-06 08:42:44', '$2y$10$YX8gXRZUAW8cAPqRIe/PgOaROgDeXT1FDF3GO/cZ58LfGfs.VW8a.', NULL, '2020-05-06 08:42:25', '2020-05-06 08:42:44'),
(16, 'Gede Dipa', 'ada@gmail.com', 'user.png', '0', '2020-05-06 08:57:39', '$2y$10$LzZcmfSNqWSQjgSwdWITCO4JW.AJlipnpq5rTaR0t6IPP2bTUkXT2', NULL, '2020-05-06 08:57:25', '2020-05-06 09:04:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('1d40575e-58f0-4fc3-a409-3d095051a7f0', 'App\\Notifications\\user_notification', 'App\\user', 1, '{\"data\":\"This is our example notification tutorial\"}', NULL, '2020-05-28 21:39:20', '2020-05-28 21:39:20'),
('59f2a8a2-5993-48eb-93c2-bf2eab5d416f', 'App\\Notifications\\user_notification', 'App\\user', 1, '{\"data\":\"This is our example notification tutorial\"}', NULL, '2020-05-28 23:40:04', '2020-05-28 23:40:04'),
('9d99cf72-a50c-4f6c-97d3-c916d4e780d6', 'App\\Notifications\\user_notification', 'App\\user', 1, '{\"data\":\"This is our example notification tutorial\"}', NULL, '2020-05-29 02:28:58', '2020-05-29 02:28:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellers_email_unique` (`phone`);

--
-- Indeks untuk tabel `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  ADD KEY `notifiable_id` (`notifiable_id`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_category_details`
--
ALTER TABLE `product_category_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `rate_id` (`rate`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_id` (`review_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_id` (`courier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaction` (`transaction_id`),
  ADD KEY `id_product` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `product_category_details`
--
ALTER TABLE `product_category_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD CONSTRAINT `admin_notifications_ibfk_1` FOREIGN KEY (`notifiable_id`) REFERENCES `admins` (`id`);

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_category_details`
--
ALTER TABLE `product_category_details`
  ADD CONSTRAINT `product_category_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_category_details_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_reviews_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `product_reviews` (`id`),
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
