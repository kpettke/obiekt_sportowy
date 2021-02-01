-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Sty 2018, 21:36
-- Wersja serwera: 5.6.25
-- Wersja PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sport`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(6) NOT NULL,
  `id_card` int(6) NOT NULL,
  `id_customer` int(6) NOT NULL,
  `id_service` int(3) NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `cards`
--

INSERT INTO `cards` (`id`, `id_card`, `id_customer`, `id_service`, `valid_from`, `valid_to`) VALUES
(1, 1, 1, 3, '2017-12-12 00:00:00', '2018-01-11 23:59:59'),
(2, 2, 2, 1, '2017-12-15 00:00:00', '2018-01-14 23:59:59'),
(3, 3, 3, 1, '2017-11-10 00:00:00', '2017-12-10 23:59:59');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(6) NOT NULL,
  `id_card` int(6) DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `sex` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
  `mail` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `who_add` int(4) DEFAULT NULL,
  `when_add` datetime DEFAULT NULL,
  `who_modify` int(4) DEFAULT NULL,
  `when_modify` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`id`, `id_card`, `name`, `lastname`, `sex`, `mail`, `who_add`, `when_add`, `who_modify`, `when_modify`) VALUES
(1, 1, 'Janusz', 'Kwiatkowski', 'Mężczyzna', 'kwiatek@wp.pl', NULL, NULL, NULL, NULL),
(2, 2, 'Adam', 'Adamski', 'Mężczyzna', 'as2dzxc@de.pl', NULL, NULL, NULL, NULL),
(3, 3, 'asd', 'asd', 'Mężczyzna', 'asdasd@wp.pl', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer_inside`
--

CREATE TABLE IF NOT EXISTS `customer_inside` (
  `id` int(3) NOT NULL,
  `id_card` int(6) DEFAULT NULL,
  `deposit` int(3) NOT NULL,
  `zone` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `customer_inside`
--

INSERT INTO `customer_inside` (`id`, `id_card`, `deposit`, `zone`) VALUES
(13, NULL, 15, 'Siłownia'),
(41, 1, 11, 'Siłownia'),
(81, NULL, 52, 'Siłownia'),
(88, NULL, 16, 'Siłownia'),
(92, NULL, 43, 'Siłownia'),
(93, NULL, 89, 'Siłownia'),
(95, NULL, 87, 'Basen'),
(97, 2, 65, 'Siłownia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `history_inside`
--

CREATE TABLE IF NOT EXISTS `history_inside` (
  `id` int(255) NOT NULL,
  `id_card` int(6) NOT NULL,
  `id_customer` int(10) NOT NULL,
  `id_service` int(3) NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `history_inside`
--

INSERT INTO `history_inside` (`id`, `id_card`, `id_customer`, `id_service`, `date_in`) VALUES
(1, 2, 1, 0, '2017-12-17 11:40:07'),
(2, 2, 1, 0, '2017-12-17 11:45:39'),
(3, 999, 0, 0, '2017-12-18 21:45:44'),
(4, 999, 0, 0, '2017-12-18 21:47:04'),
(5, 2, 2, 1, '2017-12-18 21:52:45'),
(6, 2, 2, 1, '2017-12-18 22:00:47'),
(7, 2, 2, 1, '2017-12-19 22:12:43'),
(8, 2, 2, 1, '2017-12-21 19:05:12'),
(9, 0, 0, 0, '2017-12-22 11:31:26'),
(10, 0, 0, 0, '2017-12-22 11:50:51'),
(11, 0, 0, 7, '2017-12-22 11:51:41'),
(12, 0, 0, 6, '2017-12-22 11:51:46'),
(13, 0, 0, 6, '2017-12-22 11:57:58'),
(14, 2, 2, 1, '2017-12-22 13:00:33'),
(15, 0, 0, 6, '2017-12-23 12:54:26'),
(16, 0, 0, 6, '2017-12-23 12:56:18'),
(17, 0, 0, 6, '2017-12-23 12:56:40'),
(18, 0, 0, 6, '2017-12-23 12:56:57'),
(19, 0, 0, 7, '2017-12-23 12:57:53'),
(20, 0, 0, 6, '2017-12-23 13:00:39'),
(21, 0, 0, 6, '2017-12-23 13:01:26'),
(22, 0, 0, 6, '2017-12-23 13:01:50'),
(23, 0, 0, 6, '2017-12-23 13:01:56'),
(24, 0, 0, 6, '2017-12-23 13:08:23'),
(25, 2, 2, 1, '2017-12-23 13:14:35'),
(26, 0, 0, 6, '2017-12-23 13:15:17'),
(27, 2, 2, 1, '2017-12-23 21:12:24'),
(28, 0, 0, 8, '2017-12-23 21:24:29'),
(29, 2, 2, 2, '2017-11-05 04:00:00'),
(30, 3, 0, 0, '2017-11-04 23:00:00'),
(31, 3, 3, 3, '2017-11-04 23:00:00'),
(32, 3, 3, 1, '2017-11-15 21:58:47'),
(33, 2, 2, 1, '2018-01-04 20:35:34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(3) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `tariff` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `price` int(4) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `services`
--

INSERT INTO `services` (`id`, `name`, `tariff`, `price`, `type`) VALUES
(1, 'Siłownia', 'Normalna', 100, 'Miesięczny'),
(3, 'Siłownia', 'Ulgowa', 80, 'Miesięczny'),
(4, 'Basen', 'Normalna', 150, 'Miesięczny'),
(5, 'Basen', 'Ulgowa', 120, 'Miesięczny'),
(6, 'Siłownia', 'Normalna', 15, 'Jednorazowy'),
(7, 'Siłownia', 'Ulgowa', 10, 'Jednorazowy'),
(8, 'Basen', 'Normalna', 20, 'Jednorazowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` int(1) NOT NULL,
  `deposit_number` int(3) NOT NULL,
  `user_info` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `system`
--

INSERT INTO `system` (`id`, `deposit_number`, `user_info`) VALUES
(1, 10, 'Informacje dla pracowników!');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `login` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `mail` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `permission` int(2) NOT NULL,
  `position` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `img` varchar(30) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `login`, `password`, `mail`, `permission`, `position`, `img`) VALUES
(1, 'root', 'root', 'root', 'root', 'root@root.pl', 0, 'root', 'img/avatar1.jpg'),
(13, 'admin', 'admin', 'admin', '$2y$10$TN8g/Snhzxbnal7Ih6yA5eWAAtr1YevNa7hIwnug9PmckiPxcPGO.', 'admin@wsz.pl', 0, 'admin', 'img/avatar1.jpg'),
(14, 'Jan', 'Kwiatkowski', 'Janek123', '$2y$10$NkEg1uGzYnSpkaAUkd8W3OHmxjybRMGX/Ut7QwubYSPaS8p.X2YNO', 'janek456@wp.pl', 0, 'Sprzedawca', 'img/avatar.jpg'),
(37, 'asdasd', 'asdasd', 'tester', '$2y$10$4Cu3TzAG5h.TCOSs7/A5LuK84uJmfaqZxp9fROO61UadOowM9QUwS', 'test@asd.pl', 0, 'asd', 'img/avatar.jpg'),
(38, 'Janusz', 'Kowalski', 'Koks', '$2y$10$H85UFkdAwmZdNW7aBRdIYOiqkQJjfdLbzJSSwdf.cKJlcp15Pf8k.', 'aasa1d@asdasd.de', 1, 'Trener', 'img/avatar.jpg'),
(39, 'tester', 'tester', 'tester345', '$2y$10$Hci2Di.LUCmwqNKt5Wth0O4c4NKrKLP3bT8tS/hjvrTPA84Iu2ewy', 'asdasd@wp.pl', 0, 'tester', 'img/avatar.jpg'),
(40, 'user', 'user', 'user', '$2y$10$RqTbKePT/mTAGfx2FJtwAOjNp1XHwSKCptGHLsMH1ix7MorTGTRE2', 'user@user.pl', 1, 'Pracownik', 'img/avatar.jpg'),
(41, 'asdasda', 'asd', 'test', '$2y$10$VVbmCRQH4362z3k1bvScZuTX6o3HC7nVPobo4A0wuMHizjHopuB7a', 'testaow123y@asd.pl', 0, 'asd', 'img/avatar.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_card_2` (`id_card`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_inside`
--
ALTER TABLE `customer_inside`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_inside`
--
ALTER TABLE `history_inside`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
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
-- AUTO_INCREMENT dla tabeli `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `customer_inside`
--
ALTER TABLE `customer_inside`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT dla tabeli `history_inside`
--
ALTER TABLE `history_inside`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT dla tabeli `services`
--
ALTER TABLE `services`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `system`
--
ALTER TABLE `system`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
