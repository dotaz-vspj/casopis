-- Active: 1729363936287@@127.0.0.1@3306@rsp
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- Vytvořeno: Pát 25. říj 2024, 05:19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

--
-- Struktura tabulky `RSP_ARTICLE`
--

CREATE TABLE `RSP_ARTICLE` (
  `ID` int(11) NOT NULL,
  `Edition` int(11) DEFAULT NULL,
  `Title` varchar(64) NOT NULL,
  `Abstract` text DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `ActiveVersion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_ARTICLE_ROLE`
--

CREATE TABLE `RSP_ARTICLE_ROLE` (
  `Article` int(11) NOT NULL,
  `Person` int(11) NOT NULL,
  `Role` int(11) NOT NULL,
  `Active_from` date NOT NULL,
  `Active_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_CC_ARTICLE_Stat`
--

CREATE TABLE `RSP_CC_ARTICLE_Stat` (
  `ID` int(11) NOT NULL,
  `descr` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `RSP_CC_ARTICLE_Stat`
--

INSERT INTO `RSP_CC_ARTICLE_Stat` (`ID`, `descr`) VALUES
(1, 'podáno'),
(2, 'recenzováno'),
(3, 'schváleno'),
(4, 'zamítnuto'),
(5, 'publikováno');

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_CC_EVENT_Type`
--

CREATE TABLE `RSP_CC_EVENT_Type` (
  `ID` int(11) NOT NULL,
  `descr` varchar(32) NOT NULL,
  `rights` int(11) DEFAULT NULL
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
(10, 'Editace uživatele', 12);

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_CC_USER_Func`
--

CREATE TABLE `RSP_CC_USER_Func` (
  `ID` int(11) NOT NULL,
  `descr` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `RSP_CC_USER_Func`
--

INSERT INTO `RSP_CC_USER_Func` (`ID`, `descr`) VALUES
(1, 'admin'),
(11, 'Šefredaktor'),
(12, 'Redaktor'),
(13, 'Člen rady'),
(21, 'Oponent'),
(22, 'Reg. Autor'),
(23, 'Reg. Přispěvatel'),
(24, 'Autor');

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_COMMENT`
--

CREATE TABLE `RSP_COMMENT` (
  `ID` int(11) NOT NULL,
  `Article` int(11) NOT NULL,
  `Author` int(11) NOT NULL,
  `TS` timestamp NOT NULL,
  `Commentary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_EDITION`
--

CREATE TABLE `RSP_EDITION` (
  `ID` int(11) NOT NULL,
  `Title` varchar(32) NOT NULL,
  `Thema` varchar(256) DEFAULT NULL,
  `Published` date DEFAULT NULL,
  `Redactor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_EVENT`
--

CREATE TABLE `RSP_EVENT` (
  `ID` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `Autor` int(11) NOT NULL,
  `Edition` int(11) DEFAULT NULL,
  `Article` int(11) DEFAULT NULL,
  `Type` int(10) NOT NULL,
  `Message` varchar(256) NOT NULL,
  `Data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `Document` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_SESSION`
--

CREATE TABLE `RSP_SESSION` (
  `ID` int(11) NOT NULL,
  `Login` int(11) NOT NULL,
  `TS` timestamp NOT NULL,
  `SessionTag` char(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_USER`
--

CREATE TABLE `RSP_USER` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(64) NOT NULL,
  `TitleF` varchar(16) DEFAULT NULL,
  `TitleP` varchar(16) DEFAULT NULL,
  `Func` int(11) NOT NULL,
  `Phone` varchar(16) DEFAULT NULL,
  `Mail` varchar(64) NOT NULL,
  `Login` varchar(16) DEFAULT NULL,
  `Password` char(64) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `RSP_USER`
--

INSERT INTO `RSP_USER` (`ID`, `FirstName`, `LastName`, `TitleF`, `TitleP`, `Func`, `Phone`, `Mail`, `Login`, `Password`, `Active`) VALUES
(1, 'Admin', '-', NULL, NULL, 1, NULL, 'tregl@student.vspj.cz', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_VERSION`
--

CREATE TABLE `RSP_VERSION` (
  `ID` int(11) NOT NULL,
  `Document` varchar(256) NOT NULL,
  `Created` date NOT NULL,
  `Published` date DEFAULT NULL,
  `Archived` date DEFAULT NULL,
  `Article` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `RSP_ARTICLE`
--
ALTER TABLE `RSP_ARTICLE`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Active` (`ActiveVersion`),
  ADD KEY `Edition` (`Edition`) USING BTREE;

--
-- Indexy pro tabulku `RSP_ARTICLE_ROLE`
--
ALTER TABLE `RSP_ARTICLE_ROLE`
  ADD UNIQUE KEY `Article` (`Article`,`Person`),
  ADD KEY `Role` (`Role`);

--
-- Indexy pro tabulku `RSP_CC_ARTICLE_Stat`
--
ALTER TABLE `RSP_CC_ARTICLE_Stat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexy pro tabulku `RSP_CC_EVENT_Type`
--
ALTER TABLE `RSP_CC_EVENT_Type`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Rights` (`rights`);

--
-- Indexy pro tabulku `RSP_CC_USER_Func`
--
ALTER TABLE `RSP_CC_USER_Func`
  ADD PRIMARY KEY (`ID`);

--
-- Indexy pro tabulku `RSP_COMMENT`
--
ALTER TABLE `RSP_COMMENT`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Article` (`Article`),
  ADD KEY `Author` (`Author`);

--
-- Indexy pro tabulku `RSP_EDITION`
--
ALTER TABLE `RSP_EDITION`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Redactor` (`Redactor`);

--
-- Indexy pro tabulku `RSP_EVENT`
--
ALTER TABLE `RSP_EVENT`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Autor` (`Autor`),
  ADD KEY `Edition` (`Edition`),
  ADD KEY `Article` (`Article`),
  ADD KEY `Datum` (`Datum`) USING BTREE,
  ADD KEY `Type` (`Type`) USING BTREE;

--
-- Indexy pro tabulku `RSP_SESSION`
--
ALTER TABLE `RSP_SESSION`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Login` (`Login`) USING BTREE,
  ADD KEY `TS` (`TS`);

--
-- Indexy pro tabulku `RSP_USER`
--
ALTER TABLE `RSP_USER`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `login` (`Login`),
  ADD KEY `funkce` (`Func`),
  ADD KEY `LastName` (`LastName`);

--
-- Indexy pro tabulku `RSP_VERSION`
--
ALTER TABLE `RSP_VERSION`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Article` (`Article`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Creator` (`Creator`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `RSP_ARTICLE`
--
ALTER TABLE `RSP_ARTICLE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `RSP_CC_ARTICLE_Stat`
--
ALTER TABLE `RSP_CC_ARTICLE_Stat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `RSP_CC_EVENT_Type`
--
ALTER TABLE `RSP_CC_EVENT_Type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `RSP_CC_USER_Func`
--
ALTER TABLE `RSP_CC_USER_Func`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pro tabulku `RSP_COMMENT`
--
ALTER TABLE `RSP_COMMENT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `RSP_EDITION`
--
ALTER TABLE `RSP_EDITION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `RSP_EVENT`
--
ALTER TABLE `RSP_EVENT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `RSP_SESSION`
--
ALTER TABLE `RSP_SESSION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `RSP_USER`
--
ALTER TABLE `RSP_USER`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `RSP_VERSION`
--
ALTER TABLE `RSP_VERSION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `RSP_ARTICLE`
--
ALTER TABLE `RSP_ARTICLE`
  ADD CONSTRAINT `ParentA_table` FOREIGN KEY (`Edition`) REFERENCES `RSP_EDITION` (`ID`),
  ADD CONSTRAINT `TableA_Index` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`),
  ADD CONSTRAINT `TableA_Publish` FOREIGN KEY (`ActiveVersion`) REFERENCES `RSP_VERSION` (`ID`);

--
-- Omezení pro tabulku `RSP_ARTICLE_ROLE`
--
ALTER TABLE `RSP_ARTICLE_ROLE`
  ADD CONSTRAINT `FKeyAR_USER` FOREIGN KEY (`Person`) REFERENCES `RSP_USER` (`ID`),
  ADD CONSTRAINT `FKey_AR_ARTICLE` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  ADD CONSTRAINT `TableAR_Index` FOREIGN KEY (`Role`) REFERENCES `RSP_CC_USER_Func` (`ID`);

--
-- Omezení pro tabulku `RSP_CC_EVENT_Type`
--
ALTER TABLE `RSP_CC_EVENT_Type`
  ADD CONSTRAINT `TableCe_Index` FOREIGN KEY (`rights`) REFERENCES `RSP_CC_USER_Func` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `RSP_COMMENT`
--
ALTER TABLE `RSP_COMMENT`
  ADD CONSTRAINT `ParentC_Table` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  ADD CONSTRAINT `TableC_Creator` FOREIGN KEY (`Author`) REFERENCES `RSP_USER` (`ID`);

--
-- Omezení pro tabulku `RSP_EDITION`
--
ALTER TABLE `RSP_EDITION`
  ADD CONSTRAINT `Table_Member` FOREIGN KEY (`Redactor`) REFERENCES `RSP_USER` (`ID`);

--
-- Omezení pro tabulku `RSP_EVENT`
--
ALTER TABLE `RSP_EVENT`
  ADD CONSTRAINT `FKey_E_ARTICLE` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  ADD CONSTRAINT `FKey_E_EDITION` FOREIGN KEY (`Edition`) REFERENCES `RSP_EDITION` (`ID`),
  ADD CONSTRAINT `Table_E_Index` FOREIGN KEY (`Type`) REFERENCES `RSP_CC_EVENT_Type` (`ID`),
  ADD CONSTRAINT `Table_E_Member` FOREIGN KEY (`Autor`) REFERENCES `RSP_USER` (`ID`);

--
-- Omezení pro tabulku `RSP_SESSION`
--
ALTER TABLE `RSP_SESSION`
  ADD CONSTRAINT `ParentS_Table` FOREIGN KEY (`Login`) REFERENCES `RSP_USER` (`ID`);

--
-- Omezení pro tabulku `RSP_USER`
--
ALTER TABLE `RSP_USER`
  ADD CONSTRAINT `TableU_Index` FOREIGN KEY (`Func`) REFERENCES `RSP_CC_USER_Func` (`ID`);

--
-- Omezení pro tabulku `RSP_VERSION`
--
ALTER TABLE `RSP_VERSION`
  ADD CONSTRAINT `ParentV_Table` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  ADD CONSTRAINT `TableV_Index` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`),
  ADD CONSTRAINT `TableV_Member` FOREIGN KEY (`Creator`) REFERENCES `RSP_USER` (`ID`);
COMMIT;

