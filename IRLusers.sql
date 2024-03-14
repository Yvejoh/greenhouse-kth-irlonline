-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 14 mars 2024 kl 14:41
-- Serverversion: 10.3.39-MariaDB-log-cll-lve
-- PHP-version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `horseand_IRLusers`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `IRLusers`
--

CREATE TABLE `IRLusers` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `psswrd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `IRLusers`
--

INSERT INTO `IRLusers` (`id`, `username`, `psswrd`) VALUES
(1, 'anna.isoz@outlook.com', '$2y$10$CAKmD57Z6EegiQEOhT7DCeDjOLsl7hFvnV/F9ngAxsC5bT4Ee0Ri.'),
(2, 'anna.isoz@outlook.com', '$2y$10$JxKzidQkN4jz1lilS.CziuAn3bEoCb8/Bqr0CHyunKtMqg3yin4Qu'),
(3, 'annaisoz69@gmail.com', '$2y$10$4NbgMd/qRKjaqqADoWq8wONScKyYM17Cfg4M1gfFq1/ZSOGQPaiJa'),
(4, 'lisbac@kth.se', '$2y$10$jJTYarPhFERDSvsS81lE0eV529UXJv6zcVup2/TopuspbOAZpbPae'),
(5, 'testuser@test.com', '$2y$10$jh/848o2..7tPWngtM9ZeuuqlSHa3E6s.b6po.yUL5rsrstODL9B2'),
(6, 'annisoz@kth.se', '$2y$10$DTdF1w19Mej2jr5EMqga4.695bbCI1CoEMc9UqLXSsI1ZhgmThrwu'),
(7, 'annisoz@kth.se', '$2y$10$dT8LpfU8DNQOzyjARSBNW.UpEddsn.ZGZf36Z4RuCSx45zJP/zd5W'),
(8, 'donnie@kth.se', '$2y$10$KCM2qCa5aNeg2cAN0Z/R3ez2wHR3IghJZpdj1YPl2PURaWZ.dh9/m'),
(9, 'h.broecker2@palfinger.com', '$2y$10$jZPN6Q88hBRytF2G82k5X.baHmAeQvXHZFOxbg6NKXzB5pLliAtf.'),
(10, 'h.broecker2@palfinger.com', '$2y$10$Quyvbu7geNvaQcZtnKcwluijV2Y7NUY.jx.BZ0wq349PkASAku4fa'),
(11, 'diakosali@gmail.com', '$2y$10$7kQI6AdSAgTvpmrdj.nBLuzSpAGw.j4FzQIjmH2llOLMB96.xAH3i');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `IRLusers`
--
ALTER TABLE `IRLusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `IRLusers`
--
ALTER TABLE `IRLusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
