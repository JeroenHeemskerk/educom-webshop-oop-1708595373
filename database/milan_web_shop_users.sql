-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 mrt 2024 om 11:11
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milan_web_shop_users`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `milan_webshop`
--

CREATE TABLE `milan_webshop` (
  `email` varchar(50) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `milan_webshop`
--

INSERT INTO `milan_webshop` (`email`, `user`, `password`) VALUES
('again@email.nl', 'Again', '$2y$14$wZaqqM6mGuYiGabHjNLW4Oj'),
('e@mail.test', 'test', '$2y$14$8/QPCkQ6TOFXHA7SEEhmcuk/S25JtYIYJyE/YUtErjl1tG9SZkrem'),
('email@emailer.nl', 'test', '$2y$14$EDBxtFhwHpwLJVf6iJN7Le6MfeG5ZhXxiwgTr9iUCJK20MeGL9bYa'),
('email@test.nl', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'test'),
('t@est.nl', 'test', '$2y$14$1Mhns8K1EcqvAJZ.pAelDufw2z9eNovqhniOTlcZuX6GUqdVeReCO'),
('test2@electricboogaloo.nl', '123456789012345678901234567890', 'test'),
('test@email.nl', 'test', '$2y$14$jBZwlppXEZcCgevgBntcJuqlEMXBfhnoWddpKh5kZTx2wddWAUGIG'),
('test@test.nl', 'Name', 'test'),
('test@tester.nl', 'Dickens', 'PutMeInCoach'),
('tester@tester.nl', 'tester', '$2y$14$9sxutKwo7p4hM5CDVu1iruUMMuGlyvdLRx9e4mwW5t4/fQSoUmdo.'),
('testtest@email.com', 'test', '$2y$14$Sr77D6TpUYe0WRDbVBO0QOP'),
('twist@twister.nl', 'test', '$2y$14$Dor5TIjexAKdKuOFhvbi4e8KrRtpyeBwdgkR3z.jP0AuOLw8vAmi6');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`) VALUES
(8, 3, '2024-02-20'),
(9, 3, '2024-02-20'),
(32, 1, '2024-02-21'),
(33, 1, '2024-02-21'),
(34, 1, '2024-02-21'),
(35, 1, '2024-02-22'),
(36, 1, '2024-02-22'),
(37, 1, '2024-02-22'),
(38, 1, '2024-02-22'),
(39, 1, '2024-02-27'),
(40, 1, '2024-02-27'),
(41, 1, '2024-02-27'),
(42, 1, '2024-02-27'),
(43, 1, '2024-02-27'),
(44, 1, '2024-02-27'),
(45, 9, '2024-03-05'),
(46, 9, '2024-03-05'),
(47, 9, '2024-03-05'),
(48, 9, '2024-03-05'),
(49, 22, '2024-03-07'),
(50, 22, '2024-03-07'),
(51, 22, '2024-03-07'),
(52, 22, '2024-03-07'),
(53, 22, '2024-03-07'),
(54, 22, '2024-03-07'),
(55, 22, '2024-03-07'),
(56, 22, '2024-03-07'),
(57, 22, '2024-03-07'),
(58, 22, '2024-03-07'),
(59, 22, '2024-03-07'),
(60, 22, '2024-03-07'),
(61, 22, '2024-03-07'),
(62, 22, '2024-03-07'),
(63, 22, '2024-03-07'),
(64, 22, '2024-03-07');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders_content`
--

CREATE TABLE `orders_content` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders_content`
--

INSERT INTO `orders_content` (`id`, `order_id`, `product_id`, `product_count`) VALUES
(1, 8, 1, 1),
(2, 8, 2, 2),
(3, 8, 3, 1),
(4, 9, 1, 1),
(5, 9, 2, 2),
(6, 9, 3, 1),
(7, 32, 2, 2),
(8, 32, 1, 7),
(9, 32, 3, 1),
(10, 32, 5, 1),
(11, 34, 4, 1),
(12, 35, 2, 3),
(13, 35, 3, 1),
(14, 36, 3, 1),
(15, 36, 4, 1),
(16, 37, 4, 1),
(17, 38, 4, 6),
(18, 39, 2, 2),
(19, 39, 1, 1),
(20, 39, 5, 1),
(21, 42, 2, 1),
(22, 47, 1, 3),
(23, 47, 3, 1),
(24, 48, 1, 3),
(25, 48, 3, 1),
(26, 62, 1, 1),
(27, 62, 3, 2),
(28, 63, 1, 1),
(29, 63, 3, 2),
(30, 64, 1, 1),
(31, 64, 3, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Ijsvogel', 'Haal een herinnering aan de wonderen van de natuur in huis of naar kantoor met dit gedetailleerde en kleurrijke displaymodel.', 49.99, 'lego_bird.png'),
(2, 'De insecten collectie', 'Breng buitengewone wezens tot leven met deze realistische, levensechte blikvangers van drie prachtige insecten.', 79.99, 'lego_bug.png'),
(3, 'Kersenbloemsels', 'Bouwbare bloesems – zaai de zaadjes van creativiteit met de Kersenbloesems, een leuk cadeau voor kinderen vanaf 8 jaar en volwassenen die van bloemen houden', 14.99, 'lego_cherryblossom.png'),
(4, 'Geluksdraak', 'Vier het jaar van de Draak!', 79.99, 'lego_dragon.png'),
(5, 'Dune Ornithopter', 'Bouw een gedetailleerd 1369-delig model van het legendarische Huis Atreides vliegtuig uit de film Dune: Part One uit 2021.', 164.99, 'lego_ornithoper.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `user`, `password`) VALUES
(1, 'test@email.com', 'test', 'test'),
(2, '', '', '$2y$14$6yg2fepE2GL8OfCABrxX2uYI9mH.Qk.s47vd.3IoMmJAmNXjgD9ia'),
(3, 'tester@email.nl', 'test', '$2y$14$kv4fh5VxWK4YetjBb/VyUOnSf6rz7SU6RveB5gm/wW74S9iAaLpua'),
(4, 'test@test.nl', 'test', '$2y$14$dvqBe6bNzuKiIO2z06R8ZO7X7fcGeMqbmo672i5RuuQYAXzkyXz1C'),
(5, 'tester@testerer.nl', '', '$2y$14$rsjdbEQTfLgmhIa0ycP3k.m7Kyu3Cf.pcku.YU905LajbNgBrvskG'),
(9, 'tester@tester.nl', 'test', '$2y$14$6APAr2ckhn1B.gWhlGjJfOyyQ6l6AzKoDlOQmj60f31fjixhhhbuK'),
(11, 'theFirstOfMany', 'theFirstOfMany', 'theFirstOfMany'),
(17, 'testificate@gmail.com', 'john', 'ThisIsAnUpdatedPassword'),
(18, 'testificate21313@gmail.com', 'john', 'theFirstOfMany'),
(20, 'testificate213424213@gmail.com', 'john', 'theFirstOfMany'),
(22, 'test1@email.com', 'test', '$2y$14$aSBQDNbe1dJ9idmDdkfi3etOA6XtTF069g32mdEFI/udsRVl1asn6');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `milan_webshop`
--
ALTER TABLE `milan_webshop`
  ADD PRIMARY KEY (`email`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `orders_content`
--
ALTER TABLE `orders_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT voor een tabel `orders_content`
--
ALTER TABLE `orders_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `orders_content`
--
ALTER TABLE `orders_content`
  ADD CONSTRAINT `orders_content_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_content_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
