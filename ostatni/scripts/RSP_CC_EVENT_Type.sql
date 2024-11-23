-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el9.remi
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Pát 22. lis 2024, 20:20
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
-- Databáze: `frydryn`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_CC_EVENT_Type`
--

CREATE TABLE `RSP_CC_EVENT_Type` (
  `ID` int NOT NULL,
  `descr` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `rights` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `RSP_CC_EVENT_Type`
--

INSERT INTO `RSP_CC_EVENT_Type` (`ID`, `descr`, `rights`) VALUES
(1, 'Rozhodnutí rady', 11),
(2, 'Rozhodnutí šéfredaktora', 11),
(3, 'Podání', 22),
(4, 'Přidělení k recenzi', 12),
(5, 'Recenzováno', 21),
(6, 'Schválení', 12),
(7, 'Zamítnutí', 12),
(8, 'Archivace', 12),
(9, 'Publikace', 11),
(10, 'Editace uživatele', 12),
(11, 'Odvolání recenzenta', 12),
(12, 'Přijetí k recenzi', 21),
(13, 'Odmítnutí recenze', 21);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `RSP_CC_EVENT_Type`
--
ALTER TABLE `RSP_CC_EVENT_Type`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Rights` (`rights`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `RSP_CC_EVENT_Type`
--
ALTER TABLE `RSP_CC_EVENT_Type`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `RSP_CC_EVENT_Type`
--
ALTER TABLE `RSP_CC_EVENT_Type`
  ADD CONSTRAINT `TableCe_Index` FOREIGN KEY (`rights`) REFERENCES `RSP_CC_USER_Func` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
