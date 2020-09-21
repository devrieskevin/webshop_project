-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 21 sep 2020 om 12:06
-- Serverversie: 8.0.18
-- PHP-versie: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kevin_webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`) VALUES
(00000000001, 00000000001, '2020-04-22 09:21:37'),
(00000000009, 00000000002, '2020-04-22 11:28:35'),
(00000000015, 00000000002, '2020-04-22 13:47:21'),
(00000000016, 00000000002, '2020-04-22 14:32:04'),
(00000000017, 00000000002, '2020-04-22 14:34:18'),
(00000000018, 00000000001, '2020-04-22 16:28:11'),
(00000000019, 00000000001, '2020-04-22 16:40:52'),
(00000000020, 00000000001, '2020-04-22 16:42:22'),
(00000000021, 00000000001, '2020-04-22 16:44:09'),
(00000000022, 00000000001, '2020-04-22 16:45:23'),
(00000000023, 00000000001, '2020-04-22 16:47:23'),
(00000000024, 00000000001, '2020-04-22 16:55:59'),
(00000000025, 00000000002, '2020-04-22 16:56:57'),
(00000000026, 00000000002, '2020-04-22 16:59:21'),
(00000000027, 00000000002, '2020-04-22 17:00:53'),
(00000000028, 00000000002, '2020-04-22 17:02:06'),
(00000000029, 00000000002, '2020-04-22 17:03:35'),
(00000000030, 00000000002, '2020-04-22 17:04:22'),
(00000000031, 00000000002, '2020-04-22 17:07:43'),
(00000000032, 00000000002, '2020-04-22 17:15:44'),
(00000000033, 00000000002, '2020-04-22 17:18:17'),
(00000000034, 00000000002, '2020-04-22 17:37:44'),
(00000000036, 00000000001, '2020-04-22 23:21:30'),
(00000000037, 00000000001, '2020-04-23 14:58:02'),
(00000000038, 00000000002, '2020-04-23 15:15:47'),
(00000000039, 00000000002, '2020-04-23 15:45:41'),
(00000000040, 00000000001, '2020-04-24 00:35:48'),
(00000000041, 00000000001, '2020-04-24 12:38:20'),
(00000000042, 00000000001, '2020-04-24 12:38:33'),
(00000000043, 00000000001, '2020-04-24 13:01:57'),
(00000000044, 00000000001, '2020-04-27 17:18:49'),
(00000000045, 00000000002, '2020-04-27 23:06:25'),
(00000000046, 00000000002, '2020-04-27 23:13:30'),
(00000000047, 00000000002, '2020-04-28 00:07:26'),
(00000000048, 00000000002, '2020-04-28 00:08:31'),
(00000000049, 00000000003, '2020-04-28 09:56:39'),
(00000000050, 00000000003, '2020-05-05 22:50:32'),
(00000000051, 00000000003, '2020-05-08 11:25:59'),
(00000000052, 00000000003, '2020-05-08 11:26:14'),
(00000000053, 00000000003, '2020-05-08 11:41:55'),
(00000000054, 00000000003, '2020-05-12 12:03:13'),
(00000000055, 00000000003, '2020-05-12 12:07:42'),
(00000000056, 00000000003, '2020-05-12 12:18:04'),
(00000000057, 00000000003, '2020-05-12 15:16:36'),
(00000000058, 00000000003, '2020-05-14 14:52:04'),
(00000000059, 00000000002, '2020-05-14 15:14:39'),
(00000000060, 00000000003, '2020-05-15 00:21:05'),
(00000000061, 00000000002, '2020-05-15 01:53:38'),
(00000000062, 00000000003, '2020-09-14 11:21:49'),
(00000000063, 00000000003, '2020-09-21 12:12:11');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `product_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `order_products`
--

INSERT INTO `order_products` (`order_id`, `product_id`, `price`, `quantity`) VALUES
(00000000001, 00000000001, 20, 1),
(00000000001, 00000000002, 10, 1),
(00000000009, 00000000001, 20, 1),
(00000000009, 00000000002, 10, 1),
(00000000015, 00000000001, 20, 1),
(00000000015, 00000000002, 10, 1),
(00000000016, 00000000001, 20, 1),
(00000000017, 00000000002, 10, 1),
(00000000018, 00000000001, 20, 1),
(00000000018, 00000000002, 10, 1),
(00000000019, 00000000001, 20, 1),
(00000000019, 00000000002, 10, 1),
(00000000020, 00000000001, 20, 1),
(00000000020, 00000000002, 10, 1),
(00000000021, 00000000001, 20, 1),
(00000000022, 00000000001, 20, 1),
(00000000023, 00000000001, 20, 1),
(00000000024, 00000000001, 20, 1),
(00000000025, 00000000001, 20, 1),
(00000000026, 00000000001, 20, 1),
(00000000026, 00000000002, 10, 1),
(00000000027, 00000000001, 20, 1),
(00000000028, 00000000001, 20, 1),
(00000000029, 00000000001, 20, 1),
(00000000030, 00000000001, 20, 1),
(00000000031, 00000000001, 20, 4),
(00000000032, 00000000001, 20, 5),
(00000000033, 00000000001, 20, 10),
(00000000034, 00000000001, 20, 30),
(00000000034, 00000000002, 10, 200),
(00000000036, 00000000001, 20, 200),
(00000000037, 00000000001, 20, 5),
(00000000038, 00000000001, 20, 5),
(00000000039, 00000000001, 20, 4),
(00000000040, 00000000002, 10, 5),
(00000000041, 00000000002, 10, 1),
(00000000042, 00000000002, 10, 1),
(00000000043, 00000000001, 20, 1),
(00000000043, 00000000002, 10, 1),
(00000000044, 00000000001, 20, 9),
(00000000045, 00000000002, 10, 4),
(00000000046, 00000000002, 10, 4),
(00000000047, 00000000002, 10, 1),
(00000000048, 00000000002, 10, 5),
(00000000049, 00000000004, 10, 100),
(00000000049, 00000000005, 500, 3),
(00000000050, 00000000001, 20, 1),
(00000000050, 00000000002, 10, 2),
(00000000050, 00000000004, 10, 3),
(00000000050, 00000000006, 10, 4),
(00000000051, 00000000001, 20, 1),
(00000000051, 00000000002, 10, 1),
(00000000052, 00000000002, 10, 1),
(00000000053, 00000000001, 20, 8),
(00000000054, 00000000001, 1999, 4),
(00000000054, 00000000002, 999, 4),
(00000000055, 00000000007, 9999, 5),
(00000000056, 00000000001, 1999, 5),
(00000000057, 00000000002, 999, 5),
(00000000057, 00000000005, 50000, 1),
(00000000057, 00000000007, 9999, 1),
(00000000058, 00000000001, 1999, 2),
(00000000059, 00000000001, 1999, 6),
(00000000059, 00000000005, 50000, 1),
(00000000059, 00000000006, 1000, 4),
(00000000059, 00000000007, 9999, 2),
(00000000060, 00000000001, 1999, 4),
(00000000061, 00000000007, 9999, 2),
(00000000062, 00000000001, 1999, 105),
(00000000063, 00000000001, 1999, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `description` varchar(280) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `row_index` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `description`, `image_path`, `row_index`) VALUES
(00000000001, 'Delicious Egg', 1999, 'Wat is er beter dan dit verrukkelijke ei?', 'images/products/delicious_egg.jpg', 1),
(00000000002, 'Banaan voor schaal', 999, 'Een banaan speciaal gekweekt om de grootte van andere voorwerpen te kunnen laten inschatten.', 'images/products/banana_for_scale.jpg', 3),
(00000000003, 'Dummy', 10000, 'Een echte real life dummy voor jou en de hele familie!', 'images/products/dummy.jpg', 2),
(00000000004, 'Replica 5 euro biljet', 1000, 'Een levensechte replica van een 5 euro biljet... leuk om te bewonderen!', 'images/products/vijf_euro.jpg', 1),
(00000000005, 'Kunstwerk', 50000, 'Dit is een... het past echt goed bij...... heel mooi!', 'images/products/raar_ding.jpg', 1),
(00000000006, 'Steen', 1000, 'Extreem luxe steen. Een geweldige aankoop waar niemand spijt van kan krijgen!!!', 'images/products/steen.jpg', 8),
(00000000007, 'Pestmasker', 9999, 'Een masker dat vroeger gebruikt werd in tijden van ziekte. Een product van zeer hoge esthetische waarde!!!', 'images/products/plague_mask.jpg', 2),
(00000000008, 'Luxe steen', 4999, 'Een zeer luxe steen. Deze steen roept jaloezie op bij iedereen die het aanschouwt!!!', 'images/products/luxe_steen.jpg', 0),
(00000000009, 'Gladde steen', 9999, 'Een super gladde steen. Deze steen is vele malen mooier dan de andere stenen in deze waardeloze webshop.', 'images/products/gladde_steen.jpg', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_changes`
--

CREATE TABLE `product_changes` (
  `user_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `product_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `change_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `product_changes`
--

INSERT INTO `product_changes` (`user_id`, `product_id`, `change_date`) VALUES
(00000000002, 00000000006, '2020-05-01 09:18:41'),
(00000000002, 00000000006, '2020-05-01 09:32:41'),
(00000000002, 00000000001, '2020-05-01 09:33:27'),
(00000000002, 00000000001, '2020-05-01 09:35:06'),
(00000000002, 00000000004, '2020-05-01 09:35:40'),
(00000000002, 00000000006, '2020-05-08 14:33:06'),
(00000000002, 00000000007, '2020-05-08 14:45:07'),
(00000000002, 00000000006, '2020-05-11 15:21:23'),
(00000000002, 00000000006, '2020-05-11 15:26:32'),
(00000000002, 00000000006, '2020-05-11 15:27:24'),
(00000000002, 00000000006, '2020-05-11 15:52:17'),
(00000000002, 00000000006, '2020-05-11 15:56:21'),
(00000000002, 00000000006, '2020-05-11 15:56:30'),
(00000000002, 00000000006, '2020-05-11 16:03:12'),
(00000000002, 00000000001, '2020-05-12 10:20:05'),
(00000000002, 00000000002, '2020-05-12 10:20:15'),
(00000000002, 00000000003, '2020-05-12 10:20:25'),
(00000000002, 00000000004, '2020-05-12 10:20:43'),
(00000000002, 00000000005, '2020-05-12 10:20:54'),
(00000000002, 00000000006, '2020-05-12 10:21:07'),
(00000000002, 00000000007, '2020-05-12 10:21:19'),
(00000000002, 00000000007, '2020-05-12 12:12:51'),
(00000000002, 00000000003, '2020-05-12 14:37:02'),
(00000000002, 00000000002, '2020-05-12 15:03:31'),
(00000000002, 00000000002, '2020-05-12 15:04:43'),
(00000000002, 00000000001, '2020-05-14 15:13:45'),
(00000000002, 00000000001, '2020-05-14 15:13:54'),
(00000000002, 00000000005, '2020-05-14 15:15:19'),
(00000000002, 00000000007, '2020-05-15 01:52:27'),
(00000000002, 00000000008, '2020-05-15 11:20:55');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `email`, `name`, `password`, `is_admin`) VALUES
(00000000001, 'coach@man-kind.nl', 'Geert Weggemans', '$2y$10$dW9hiAoyjIyx7xQ0vIhFZOL30jroS38lwiomUIhVFVnbgnjCsS.Ry', 0),
(00000000002, 'example@example.com', 'example', '$2y$10$z3BxE6vibM6BuUJaDC7bM.7icCcBxgQOD7ahla193oQemThruMwti', 0),
(00000000003, 'lol@lol.lol', 'lol', '$2y$10$wdNZpu.tOab3BcMgs1NykOrESoh9v9tLI4llIgnYZJOKPpFF4D4oe', 0),
(00000000004, 'goo@goo.goo', 'goo', '$2y$10$hqzF6Ppkw53Qa6BO8MTmnOFhEgjuYixmR7quZ70vlNqDGX4oj8j5G', 0),
(00000000005, 'foo@foo.foo', 'foo', '$2y$10$NWncCOVmnyJjvxujrXvmQOOukMbjwDslc/rFfkXTUuSF7Ee1o7GRa', 0),
(00000000006, 'bar@bar.bar', 'bar', '$2y$10$L3RXuYyjHLbgxW9sLkhOFuBjM.eKAnTKKYFvtR/Sh6./liArlo1hO', 0),
(00000000009, 'baz@baz.baz', 'baz', '$2y$10$3KaFo7jgAnvep8wWUSkFieMz4MVoAEj5aRdC9ZXDmhUy.DX7QLSt2', 0),
(00000000010, 'admin@gmail.com', 'Admin', '$2y$10$4vaBZxMIGh96gOYzGhSPx.LbZGcLJYu4pSPUukFkNVSuvmvuKXkIe', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `order_id` (`order_id`) USING BTREE,
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `product_changes`
--
ALTER TABLE `product_changes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Beperkingen voor tabel `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Beperkingen voor tabel `product_changes`
--
ALTER TABLE `product_changes`
  ADD CONSTRAINT `product_changes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_changes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
