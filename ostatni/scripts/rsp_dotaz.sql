-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el9.remi
-- https://www.phpmyadmin.net/
--
-- Vytvořeno: Ned 24. lis 2024, 10:37
-- Verze serveru: 8.0.36
-- Verze PHP: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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
(10, 'K rozhodnutí', 'cyan'),
(11, 'Zamítnuto', 'red'),
(12, 'Přijato', 'lightgreen'),
(20, 'Oprava autorem', 'blue'),
(30, 'K recenzi', 'yellow'),
(31, 'Probíhá recenze', 'khaki'),
(40, 'Schváleno', 'green'),
(05, 'Publikováno', 'darkgreen');

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
(1, 'Editace uživatele', 12),
(2, 'Editace vydání', 12),
(11, 'Článek zamítnut', 12),
(12, 'Článek k úpravě autorem', 12),
(13, 'Článek postoupen k recenzi', 12),
(14, 'Článek postoupen k publikaci', 12),
(15, 'Publikováno', 11),
(20, 'Podání článku', 22),
(21, 'Oprava článku', 22),
(30, 'Recenze odmítnuta', 21),
(31, 'Negativní recenze', 21),
(32, 'Přijato k recenzi', 21),
(34, 'Pozitivní recenze', 21),
(35, 'Recenze s výhradami', 21);

-- --------------------------------------------------------

--
-- Struktura tabulky `RSP_CC_USER_Func`
--

CREATE TABLE `RSP_CC_USER_Func` (
  `ID` int NOT NULL,
  `descr` varchar(16) COLLATE utf8mb4_general_ci NOT NULL
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
-- Struktura tabulky `RSP_USER`
--

CREATE TABLE `RSP_USER` (
  `ID` int NOT NULL,
  `FirstName` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `LastName` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `TitleF` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TitleP` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Func` int NOT NULL,
  `Phone` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Mail` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `Login` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` char(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `RSP_USER`
--

INSERT INTO `RSP_USER` (`ID`, `FirstName`, `LastName`, `TitleF`, `TitleP`, `Func`, `Phone`, `Mail`, `Login`, `Password`, `Active`) VALUES
(1, 'Admin', '-', NULL, NULL, 1, NULL, 'admin@dotaz.example.com', 'admin', '$2y$10$OJVyav934Jcg9vc5iufkAelcjkUiUPG6HNTtNohe9/oMosD/fjP0u', 1);

-- --------------------------------------------------------
--
-- Struktura tabulky `RSP_EDITION`
--

CREATE TABLE `RSP_EDITION` (
  `ID` int NOT NULL,
  `Title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Thema` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Published` date DEFAULT NULL,
  `Redactor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struktura tabulky `RSP_ARTICLE`
--

CREATE TABLE `RSP_ARTICLE` (
  `ID` int NOT NULL,
  `Edition` int DEFAULT NULL,
  `Title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Abstract` text COLLATE utf8mb4_general_ci,
  `Status` int NOT NULL,
  `ActiveVersion` int DEFAULT NULL,
  `Creator` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struktura tabulky `RSP_VERSION`
--

CREATE TABLE `RSP_VERSION` (
  `ID` int NOT NULL,
  `Document` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `Created` date NOT NULL,
  `Published` date DEFAULT NULL,
  `Archived` date DEFAULT NULL,
  `Article` int NOT NULL,
  `Status` int NOT NULL,
  `Creator` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struktura tabulky `RSP_ARTICLE_ROLE`
--

CREATE TABLE `RSP_ARTICLE_ROLE` (
  `Article` int NOT NULL,
  `Person` int NOT NULL,
  `Role` int NOT NULL,
  `Active_from` date NOT NULL,
  `Active_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struktura tabulky `RSP_COMMENT`
--

CREATE TABLE `RSP_COMMENT` (
  `ID` int NOT NULL,
  `Article` int NOT NULL,
  `Author` int NOT NULL,
  `TS` timestamp NOT NULL,
  `Commentary` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struktura tabulky `RSP_EVENT`
--

CREATE TABLE `RSP_EVENT` (
  `ID` int NOT NULL,
  `Datum` date NOT NULL,
  `Autor` int DEFAULT NULL,
  `Edition` int DEFAULT NULL,
  `Article` int DEFAULT NULL,
  `Type` int NOT NULL,
  `Message` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `Data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `Document` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struktura tabulky `RSP_SESSION`
--

CREATE TABLE `RSP_SESSION` (
  `ID` int NOT NULL,
  `Login` int NOT NULL,
  `TS` timestamp NOT NULL,
  `SessionTag` char(24) COLLATE utf8mb4_general_ci NOT NULL
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
  ADD KEY `Edition` (`Edition`) USING BTREE,
  ADD KEY `Creator` (`Creator`);

--
-- Indexy pro tabulku `RSP_ARTICLE_ROLE`
--
ALTER TABLE `RSP_ARTICLE_ROLE`
  ADD UNIQUE KEY `Article` (`Article`,`Person`) USING BTREE,
  ADD KEY `Role` (`Role`),
  ADD KEY `FKeyAR_USER` (`Person`);

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
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pro tabulku `RSP_CC_ARTICLE_Stat`
--
ALTER TABLE `RSP_CC_ARTICLE_Stat`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pro tabulku `RSP_CC_EVENT_Type`
--
ALTER TABLE `RSP_CC_EVENT_Type`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pro tabulku `RSP_CC_USER_Func`
--
ALTER TABLE `RSP_CC_USER_Func`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pro tabulku `RSP_COMMENT`
--
ALTER TABLE `RSP_COMMENT`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `RSP_EDITION`
--
ALTER TABLE `RSP_EDITION`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `RSP_EVENT`
--
ALTER TABLE `RSP_EVENT`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT pro tabulku `RSP_SESSION`
--
ALTER TABLE `RSP_SESSION`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pro tabulku `RSP_USER`
--
ALTER TABLE `RSP_USER`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT pro tabulku `RSP_VERSION`
--
ALTER TABLE `RSP_VERSION`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `RSP_ARTICLE`
--
ALTER TABLE `RSP_ARTICLE`
  ADD CONSTRAINT `ParentA_table` FOREIGN KEY (`Edition`) REFERENCES `RSP_EDITION` (`ID`),
  ADD CONSTRAINT `Table_A_Creator` FOREIGN KEY (`Creator`) REFERENCES `RSP_USER` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `TableA_Index` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`),
  ADD CONSTRAINT `TableA_Publish` FOREIGN KEY (`ActiveVersion`) REFERENCES `RSP_VERSION` (`ID`);

--
-- Omezení pro tabulku `RSP_ARTICLE_ROLE`
--
ALTER TABLE `RSP_ARTICLE_ROLE`
  ADD CONSTRAINT `FKey_AR_ARTICLE` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  ADD CONSTRAINT `FKeyAR_USER` FOREIGN KEY (`Person`) REFERENCES `RSP_USER` (`ID`),
  ADD CONSTRAINT `TableAR_Index` FOREIGN KEY (`Role`) REFERENCES `RSP_CC_USER_Func` (`ID`);

--
-- Omezení pro tabulku `RSP_CC_EVENT_Type`
--
ALTER TABLE `RSP_CC_EVENT_Type`
  ADD CONSTRAINT `TableCe_Index` FOREIGN KEY (`rights`) REFERENCES `RSP_CC_USER_Func` (`ID`);

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

DELIMITER $$
CREATE DEFINER=`admin_dotaz`@`%` FUNCTION `hasAccess`(`userNO` INT, `articleNO` INT) RETURNS tinyint(1)
    READS SQL DATA
    SQL SECURITY INVOKER
BEGIN
  IF userNO<>0 THEN
    SET userNO = (SELECT MAX(ID) FROM (SELECT 0 as ID UNION SELECT ID FROM RSP_USER WHERE ID=userNO) as X);
  END IF;
  SET @userFce = 0;
  IF userNO<>0 THEN
    SET @userFce = (SELECT Func FROM RSP_USER WHERE ID=userNO);
  END IF;
  SET articleNO=(SELECT ID from RSP_ARTICLE where ID=articleNO);
  IF articleNO is null THEN
  	RETURN 0;
  END IF;
  IF (SELECT A.ID from RSP_ARTICLE A left join RSP_EDITION E on A.Edition=E.ID where A.ID=articleNO and A.Status=5 and E.Published is not null and E.Published<=now()) is not null THEN
  	RETURN 1;
  END IF;
  IF @userFce=0 THEN
     RETURN 0;
  ELSEIF @userFce<20 THEN
     RETURN 1;
  ELSE
  	 RETURN (SELECT Article from RSP_ARTICLE_ROLE where article=articleNO and person=userNO and Active_from<=NOW() and (Active_to is null or Active_to>now())) is not null;
  END IF;
END$$
DELIMITER ;
