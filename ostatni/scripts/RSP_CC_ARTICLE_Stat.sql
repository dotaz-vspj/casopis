-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el9.remi
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Pát 15. lis 2024, 04:53
-- Verze serveru: 8.0.36
-- Verze PHP: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

--

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_CC_ARTICLE_Stat`
--

CREATE TABLE `RSP_CC_ARTICLE_Stat` (
  `ID` int NOT NULL,
  `descr` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(16) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `RSP_CC_ARTICLE_Stat`
--

INSERT INTO `RSP_CC_ARTICLE_Stat` (`ID`, `descr`, `color`) VALUES
(1, 'podáno', 'lightblue'),
(2, 'přijato', 'lightgreen'),
(3, 'zamítnuto', 'red'),
(4, 'k recenzi', 'yellow'),
(5, 'recenzováno', 'darkgreen'),
(6, 'schváleno', 'green'),
(7, 'publikováno', 'darkgreen');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `RSP_CC_ARTICLE_Stat`
--
ALTER TABLE `RSP_CC_ARTICLE_Stat`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `RSP_CC_ARTICLE_Stat`
--
ALTER TABLE `RSP_CC_ARTICLE_Stat`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
