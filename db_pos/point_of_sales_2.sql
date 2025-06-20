-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2025 pada 10.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `point_of_sales_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pasta', '2025-06-16 02:56:23', '2025-06-19 01:58:49'),
(2, 'Tea', '2025-06-16 02:57:23', NULL),
(3, 'Coffee', '2025-06-16 02:57:30', NULL),
(4, 'Snack', '2025-06-16 02:57:41', '2025-06-19 01:58:35'),
(5, 'Beverage', '2025-06-16 02:57:51', '2025-06-19 01:58:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(5) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `urutan` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `icon`, `url`, `urutan`, `created_at`, `updated_at`) VALUES
(3, 0, 'Master Data', 'bi bi-menu-button-wide', '', 2, '2025-06-11 04:38:24', NULL),
(4, 3, 'Instructor', 'bi bi-menu-button-wide', 'instructor', 1, '2025-06-11 05:35:33', NULL),
(5, 3, 'Major', 'bi bi-book', 'major', 2, '2025-06-11 07:02:43', NULL),
(6, 3, 'Menu', 'bi bi-book', 'menu', 3, '2025-06-11 07:03:10', NULL),
(8, 3, 'Role', 'bi bi-book', 'role', 5, '2025-06-11 07:03:51', NULL),
(9, 0, 'Dashboard', 'bi bi-menu-button-wide', 'home.php', 1, '2025-06-12 02:05:19', NULL),
(10, 3, 'User', 'bi bi-circle', 'user', 4, '2025-06-12 02:27:17', NULL),
(11, 0, 'Moduls', 'bi bi-book', '?page=moduls', 3, '2025-06-12 02:38:30', NULL),
(12, 11, 'POS', 'bi bi-circle', 'pos', 1, '2025-06-18 02:12:13', NULL),
(13, 3, 'Product', 'bi bi-circle', 'products', 1, '2025-06-19 01:56:09', NULL),
(14, 3, 'Category', 'bi bi-circle', 'categories', 1, '2025-06-19 01:57:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_roles`
--

CREATE TABLE `menu_roles` (
  `id` int(11) NOT NULL,
  `id_roles` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu_roles`
--

INSERT INTO `menu_roles` (`id`, `id_roles`, `id_menu`, `created_at`, `updated_at`) VALUES
(1, 5, 9, '2025-06-12 07:41:13', NULL),
(2, 5, 3, '2025-06-12 07:41:13', NULL),
(3, 5, 4, '2025-06-12 07:41:13', NULL),
(4, 5, 5, '2025-06-12 07:41:13', NULL),
(5, 5, 6, '2025-06-12 07:41:13', NULL),
(6, 5, 10, '2025-06-12 07:41:13', NULL),
(7, 5, 8, '2025-06-12 07:41:13', NULL),
(8, 5, 11, '2025-06-12 07:41:13', NULL),
(15, 7, 9, '2025-06-12 07:41:42', NULL),
(16, 7, 11, '2025-06-12 07:41:42', NULL),
(44, 3, 9, '2025-06-16 02:42:40', NULL),
(45, 3, 3, '2025-06-16 02:42:40', NULL),
(46, 3, 11, '2025-06-16 02:42:40', NULL),
(87, 1, 9, '2025-06-19 01:57:52', NULL),
(88, 1, 3, '2025-06-19 01:57:52', NULL),
(89, 1, 4, '2025-06-19 01:57:52', NULL),
(90, 1, 13, '2025-06-19 01:57:52', NULL),
(91, 1, 14, '2025-06-19 01:57:52', NULL),
(92, 1, 5, '2025-06-19 01:57:52', NULL),
(93, 1, 6, '2025-06-19 01:57:52', NULL),
(94, 1, 10, '2025-06-19 01:57:52', NULL),
(95, 1, 8, '2025-06-19 01:57:52', NULL),
(96, 1, 11, '2025-06-19 01:57:52', NULL),
(97, 1, 12, '2025-06-19 01:57:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` double(10,2) NOT NULL,
  `qty` int(5) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `id_category`, `name`, `price`, `qty`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'asdsssssssasdasda', 12000.00, 5, 'asdasdadasda', '2025-06-16 05:03:21', '2025-06-16 05:19:26'),
(2, 1, 'Carbonara', 50000.00, 2, 'add cheese', '2025-06-19 01:59:48', NULL),
(3, 2, 'Lemon Tea', 10000.00, 1, 'sweet sour', '2025-06-19 02:20:13', NULL),
(4, 3, 'Americano', 20000.00, 1, 'Gayo beans', '2025-06-19 02:20:40', NULL),
(5, 4, 'Cireng', 30000.00, 1, 'Deep fried cassava flour with touch Nusantara spices', '2025-06-19 02:22:23', NULL),
(6, 5, 'Cola', 15000.00, 1, 'Coca cola', '2025-06-19 02:22:58', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-06-16 01:46:54', NULL),
(2, 'Cashier', '2025-06-16 01:47:22', NULL),
(3, 'Leader', '2025-06-16 02:34:06', '2025-06-16 02:40:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_transaction` varchar(30) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `id_user`, `no_transaction`, `sub_total`, `created_at`, `updated_at`) VALUES
(6, 1, 'TR-190625-001', 30000.00, '2025-06-19 07:42:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `id_transaction`, `id_product`, `qty`, `total`, `created_at`, `updated_at`) VALUES
(5, 6, 5, 0, 30000.00, '2025-06-19 07:42:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-06-16 01:46:03', NULL),
(2, 'Alpha', 'alpha@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-06-16 01:46:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_roles`
--

INSERT INTO `user_roles` (`id`, `id_user`, `id_role`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-06-16 01:49:37', NULL),
(2, 2, 2, '2025-06-16 01:49:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaction` (`id_transaction`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `menu_roles`
--
ALTER TABLE `menu_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`id_transaction`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
