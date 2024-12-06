SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `RSP_ARTICLE` (
  `ID` int NOT NULL,
  `Edition` int DEFAULT NULL,
  `Title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Abstract` text COLLATE utf8mb4_general_ci,
  `Status` int NOT NULL,
  `ActiveVersion` int DEFAULT NULL,
  `Creator` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `RSP_ARTICLE` (`ID`, `Edition`, `Title`, `Abstract`, `Status`, `ActiveVersion`, `Creator`) VALUES
(3, 1, 'Bezpečnostní kontinuum umělé inteligence: Koncepce a výzvy\r\n', 'Navrhujeme konceptuální rámec nazvaný „AI Security Continuum“, který se skládá z dimenzí pro trvalé a systematické řešení výzev souvisejících s rozsahem bezpečnostních rizik umělé inteligence v nově vznikajícím kontextu počítačového kontinua a kontinuálního inženýrství. Identifikovanými dimenzemi jsou kontinuum ve výpočetním prostředí AI, kontinuum v technických činnostech pro AI, kontinuum ve vrstvách celkové architektury včetně AI, úroveň automatizace AI a úroveň bezpečnostních opatření AI. Vyhlížíme také inženýrský základ, který může účinně a efektivně zvýšit každou dimenzi.\r\n', 5, NULL, 1),
(4, 1, 'Taxonomie generativních aplikací umělé inteligence pro posuzování rizik\r\n', 'Vynikající funkčnost a všestrannost generativní umělé inteligence vyvolala očekávání ohledně zlepšení lidské společnosti a obavy ohledně etických a sociálních rizik spojených s používáním generativní umělé inteligence. Mnoho předchozích studií představilo otázky rizik jako obavy spojené s používáním generativní UI, ale protože většina těchto obav vychází z pohledu uživatele, je obtížné z nich vyvodit konkrétní protiopatření. V této studii byly rizikové problémy představené v předchozích studiích rozděleny na podrobnější prvky a byly identifikovány rizikové faktory a dopady. Tímto způsobem jsme představili informace, které vedou k návrhům protiopatření pro rizika generativní umělé inteligence. pojmy CCS- obecné a referenční→ hodnocení; průzkumy a přehledy, - výpočetní technika zaměřená na člověka→ teorie, koncepty a modely HCI; - sociální a odborná témata→ výpočetní / technologická politika.\r\n', 5, NULL, 1),
(5, 1, 'Vlastní vývojář GPT pro etická řešení AI\r\n', 'Hlavním cílem tohoto projektu je vytvořit nový softwarový artefakt: vlastní generativní předtrénovaný transformátor (GPT) pro vývojáře, který umožní diskutovat a řešit etické otázky prostřednictvím inženýrství umělé inteligence. Tento konverzační agent poskytne vývojářům praktickou aplikaci týkající se (1) toho, jak dodržovat právní rámce, které se týkají systémů UI (jako je zákon EU o UI [8] a GDPR [11]), a (2) představí alternativní etické perspektivy, aby vývojáři mohli pochopit a začlenit alternativní morální postoje. V tomto článku uvádíme motivaci pro potřebu takového agenta, podrobně popisujeme naši myšlenku a demonstrujeme případ použití. Použití takového nástroje může umožnit odborníkům z praxe navrhovat řešení umělé inteligence, která splňují právní požadavky a vyhovují různým etickým perspektivám.\r\n', 5, NULL, 1),
(6, 1, 'Stručný přehled vodoznaků v generativní umělé inteligenci\r\n', 'Technologie generativní umělé inteligence je nyní schopna vytvářet obrázky a texty na úrovni srovnatelné s lidmi, což ukazuje její pozoruhodnou užitečnost. Tento pokrok však s sebou nese i řadu problémů, jako je zneužití, což vyvolává diskuse o účinných strategiích reakce. V důsledku toho se v jednotlivých zemích projednávají doporučení a předpisy, včetně přijetí technologie vodoznaku. Mnoho společností také začleňuje technologii vodoznaků do svých služeb jako prostředek řešení tohoto problému. Tento dokument představuje analýzu současného stavu zavádění vodoznaků v různých zemích a společnostech. Dále se zabývá dalšími tématy výzkumu, která by měla být při zavádění technologie vodoznaků zohledněna. Cílem této analýzy je poskytnout cenné poznatky těm, kteří uvažují o implementaci vodoznaků do svých budoucích generativních služeb umělé inteligence.\r\n', 5, NULL, 1),
(7, 1, 'Zajišťují generativní nástroje AI ekologický kód? Vyšetřovací studie\r\n', 'Udržitelnost softwaru se stává prvořadým zájmem, jehož cílem je optimalizovat využívání zdrojů, minimalizovat dopad na životní prostředí a podporovat ekologičtější a odolnější digitální ekosystém. Udržitelnost nebo „ekologičnost“ softwaru se obvykle určuje přijetím udržitelných kódovacích postupů. S dozrávajícím ekosystémem kolem generativní umělé inteligence se nyní mnoho vývojářů softwaru spoléhá na tyto nástroje pro generování kódu pomocí pokynů v přirozeném jazyce. Navzdory jejich potenciálním výhodám existuje značný nedostatek studií o aspektech udržitelnosti kódu generovaného umělou inteligencí. Konkrétně, nakolik je kód generovaný umělou inteligencí šetrný k životnímu prostředí na základě přijetí udržitelných kódovacích postupů? V tomto článku představujeme výsledky počátečního šetření aspektů udržitelnosti kódu generovaného umělou inteligencí ve třech populárních nástrojích generativní umělé inteligence - ChatGPT, BARD a Copilot. Výsledky poukazují na výchozí neekologické chování nástrojů pro generování kódu, a to napříč různými pravidly a scénáři. It underscores the need for further in-depth investigations and effective remediation strategies. 2. KONCEPCE CCS- Sociální a odborná témata → Udržitelnost; - Výpočetní metodologie → Generování v přirozeném jazyce.\r\n', 5, NULL, 1);

CREATE TABLE `RSP_ARTICLE_ROLE` (
  `Article` int NOT NULL,
  `Person` int NOT NULL,
  `Role` int NOT NULL,
  `Active_from` date NOT NULL,
  `Active_to` date DEFAULT NULL,
  `active` int GENERATED ALWAYS AS ((case when (`Active_to` is null) then 1 else NULL end)) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `RSP_ARTICLE_ROLE` (`Article`, `Person`, `Role`, `Active_from`, `Active_to`) VALUES
(3, 102, 24, '2024-10-30', NULL),
(3, 103, 24, '2024-10-30', NULL),
(4, 103, 24, '2024-10-30', NULL),
(4, 104, 24, '2024-10-30', NULL),
(4, 105, 24, '2024-10-30', NULL),
(4, 106, 24, '2024-10-30', NULL),
(4, 107, 24, '2024-10-30', NULL),
(4, 108, 24, '2024-10-30', NULL),
(5, 109, 24, '2024-10-30', NULL),
(6, 110, 24, '2024-10-30', NULL),
(6, 111, 24, '2024-10-30', NULL),
(7, 112, 24, '2024-10-30', NULL);

CREATE TABLE `RSP_CC_ARTICLE_Stat` (
  `ID` int NOT NULL,
  `descr` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(16) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `RSP_CC_ARTICLE_Stat` (`ID`, `descr`, `color`) VALUES
(5, 'Publikováno', 'darkgreen'),
(10, 'K rozhodnutí', 'lightsalmon'),
(11, 'Zamítnuto', 'red'),
(12, 'Přijato', 'lightgreen'),
(20, 'Oprava autorem', 'blue'),
(30, 'K recenzi', 'yellow'),
(31, 'Probíhá recenze', 'khaki'),
(40, 'Schváleno', 'green');

CREATE TABLE `RSP_CC_EVENT_Type` (
  `ID` int NOT NULL,
  `descr` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `rights` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `RSP_CC_EVENT_Type` (`ID`, `descr`, `rights`) VALUES
(1, 'Editace uživatele', 12),
(2, 'Editace vydání', 12),
(9, 'Zpráva redakci', 24),
(11, 'Článek zamítnut', 12),
(12, 'Článek odsouhlasen', 12),
(13, 'Článek postoupen k recenzi', 12),
(14, 'Článek postoupen k publikaci', 12),
(15, 'Publikováno', 11),
(16, 'Článek k úpravě autorem', 12),
(17, 'Článek odebrán redaktorem', 12),
(18, 'Recenzent přidán', 12),
(19, 'Recenzent odebrán', 12),
(20, 'Podání článku', 22),
(21, 'Oprava článku', 22),
(30, 'Recenze odmítnuta', 21),
(31, 'Negativní recenze', 21),
(32, 'Přijato k recenzi', 21),
(34, 'Pozitivní recenze', 21),
(35, 'Recenze s výhradami', 21);

CREATE TABLE `RSP_CC_USER_Func` (
  `ID` int NOT NULL,
  `descr` varchar(16) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `RSP_CC_USER_Func` (`ID`, `descr`) VALUES
(1, 'admin'),
(11, 'Šefredaktor'),
(12, 'Redaktor'),
(13, 'Člen rady'),
(21, 'Oponent'),
(22, 'Reg. Autor'),
(23, 'Reg. Přispěvatel'),
(24, 'Autor');

CREATE TABLE `RSP_COMMENT` (
  `ID` int NOT NULL,
  `Article` int NOT NULL,
  `Author` int NOT NULL,
  `TS` timestamp NOT NULL,
  `Commentary` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `RSP_COMMENT` (`ID`, `Article`, `Author`, `TS`, `Commentary`) VALUES
(1, 6, 111, '2024-10-30 05:57:09', 'This article is essential. Keep it in mind!');

CREATE TABLE `RSP_EDITION` (
  `ID` int NOT NULL,
  `Title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Thema` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Published` date DEFAULT NULL,
  `Redactor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `RSP_EDITION` (`ID`, `Title`, `Thema`, `Published`, `Redactor`) VALUES
(1, 'Softwarové inženýrství pro umělou inteligenci', 'International Conference on AI Engineering – Software Engineering for AI (CAIN)', '2024-10-30', 1),
(2, 'Připravované vydání - pracovně: Hardwarová esence přirozené blbosti', 'International Conference on NS (Natural Stupidity)', NULL, 1);

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

CREATE TABLE `RSP_SESSION` (
  `ID` int NOT NULL,
  `Login` int NOT NULL,
  `TS` timestamp NOT NULL,
  `SessionTag` char(24) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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

INSERT INTO `RSP_USER` (`ID`, `FirstName`, `LastName`, `TitleF`, `TitleP`, `Func`, `Phone`, `Mail`, `Login`, `Password`, `Active`) VALUES
(1, 'Admin', 'Správce', NULL, NULL, 1, NULL, 'tregl@student.vspj.cz', 'admin', '$2y$10$OJVyav934Jcg9vc5iufkAelcjkUiUPG6HNTtNohe9/oMosD/fjP0u', 1),
(11, 'Jan', 'Novák', 'RNDr.', 'Ph.D', 11, '+420 123 456 789', 'jan.novak@example.com', 'novakj', '$2y$10$k50FuutP9Ek32f1CTz3Xl.2EAaOHlLEto0rv8RcIMSfArSACSBKkS', 1),
(12, 'Petra', 'Kovářová', 'Mgr.', NULL, 12, '+420 234 567 890', 'petra.kovarova@example.com', 'kovarovap', '$2y$10$jMyuMc8rqgsUy.aViKdiU.Plf8F/MXNmteaPAzeD77Ep7JetDaDOC', 1),
(13, 'Aleš', 'Dvořák', 'Ing.', NULL, 13, '+420 345 678 901', 'ales.dvorak@example.com', 'dvoraka', '$2y$10$jMyuMc8rqgsUy.aViKdiU.Plf8F/MXNmteaPAzeD77Ep7JetDaDOC', 1),
(14, 'Lenka', 'Králová', 'Bc.', NULL, 13, '+420 456 789 012', 'lenka.kralova@example.com', 'kraloval', '$2y$10$jMyuMc8rqgsUy.aViKdiU.Plf8F/MXNmteaPAzeD77Ep7JetDaDOC', 1),
(15, 'Karel1', 'Bláha1', NULL, NULL, 13, '+420 567 890 123', 'marek.blaha@example.com', NULL, '', 0),
(16, 'Eva', 'Pospíšilová', NULL, 'Ph.D.', 13, '+420 678 901 234', 'eva.pospisilova@example.com', 'pospisilovae', '$2y$10$IuH/YwRgai5708oDZ/lOCunFm4CfHS0YAA1SkTFseqQCy/r/mbxBO', 1),
(17, 'Tomáš', 'Jelínek', 'Bc at Ing.', 'DiS.', 13, '+420 789 012 345', 'tomas.jelinek@example.com', 'jelinekt', '$2y$10$jMyuMc8rqgsUy.aViKdiU.Plf8F/MXNmteaPAzeD77Ep7JetDaDOC', 1),
(102, 'Hironori', 'Washizaki', NULL, NULL, 24, NULL, 'Hironori@autor.vspj.cz', NULL, NULL, 1),
(103, 'Nobukazu', 'Yoshioka', NULL, NULL, 24, NULL, 'Nobukazu@autor.vspj.cz', NULL, NULL, 1),
(104, 'Hiroshi', 'Tanaka', NULL, NULL, 24, NULL, 'Hiroshi@autor.vspj.cz', NULL, NULL, 1),
(105, 'Masaru', 'Ide', NULL, NULL, 24, NULL, 'Masaru@autor.vspj.cz', NULL, NULL, 1),
(106, 'Jun', 'Yajima', NULL, NULL, 24, NULL, 'Jun@autor.vspj.cz', NULL, NULL, 1),
(107, 'Sachiko', 'Ondera', NULL, NULL, 24, NULL, 'Ondera@autor.vspj.cz', NULL, NULL, 1),
(108, 'Kazuki', 'Munakata', NULL, NULL, 24, NULL, 'Kazuki@autor.vspj.cz', NULL, NULL, 1),
(109, 'Lauren', 'Olson', NULL, NULL, 24, NULL, 'Lauren.Olson@autor.vspj.cz', NULL, NULL, 1),
(110, 'Hwang', 'JaeYoung', NULL, NULL, 24, NULL, 'Hwang@autor.vspj.cz', NULL, NULL, 1),
(111, 'Oh', 'SangHoon', NULL, NULL, 22, NULL, 'SangHoon@autor.vspj.cz', 'SangHong', '$2y$10$Jj8GnHDVVdSnmVEcMcuymeea2Tbw34Sv2wdDrEaQFA/jixVWH/C2O', 1),
(112, 'Samarth', 'Sikand', NULL, NULL, 22, NULL, 'Samarth.Sikand@autor.vspj.cz', 'SaSik', '$2y$10$Jj8GnHDVVdSnmVEcMcuymeea2Tbw34Sv2wdDrEaQFA/jixVWH/C2O', 1),
(117, 'Jan', 'Voráček', 'doc. Dr. Ing.', 'CSc.', 13, NULL, 'jan.voracek@gmail.com', 'voracek', '$2y$10$fjCHEI28hebm7lhQp1sGvOD3n3K562qLqWAfl6Rgt.Ph6CppD.b9i', 1),
(187, 'Testovací', 'Autor', 'Bc.', '1', 22, NULL, 'testA@example.com', 'testAdotaz', '$2y$10$eZojmHJMqmihX9T/RYBrBeu2x4NuSxy74o147NRGGL7eZnKp0hNgy', 1),
(188, 'Testovací', 'Oponent', NULL, NULL, 21, NULL, 'testO@example.com', 'testO', '$2y$10$dHxDXDSH1kDUoDZSO0CLNOw7cZruHKbxmVRFkLxkKLhWcCnWxCvN6', 1),
(189, 'Testovací', 'Redaktor', 'Ing', 'PhD.', 12, NULL, 'testR@example.com', 'testR', '$2y$10$zNrip0hKZcU93tJm6YnQXuKhOVxvESV1beyGzokc5FBMT2/mpJeZW', 1);

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

ALTER TABLE `RSP_ARTICLE`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Active` (`ActiveVersion`),
  ADD KEY `Edition` (`Edition`) USING BTREE,
  ADD KEY `Creator` (`Creator`);

ALTER TABLE `RSP_ARTICLE_ROLE`
  ADD UNIQUE KEY `Article` (`Article`,`Person`,`active`) USING BTREE,
  ADD KEY `Role` (`Role`),
  ADD KEY `FKeyAR_USER` (`Person`);

ALTER TABLE `RSP_CC_ARTICLE_Stat`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `RSP_CC_EVENT_Type`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Rights` (`rights`);

ALTER TABLE `RSP_CC_USER_Func`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `RSP_COMMENT`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Article` (`Article`),
  ADD KEY `Author` (`Author`);

ALTER TABLE `RSP_EDITION`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Redactor` (`Redactor`);

ALTER TABLE `RSP_EVENT`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Autor` (`Autor`),
  ADD KEY `Edition` (`Edition`),
  ADD KEY `Article` (`Article`),
  ADD KEY `Datum` (`Datum`) USING BTREE,
  ADD KEY `Type` (`Type`) USING BTREE;

ALTER TABLE `RSP_SESSION`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TS` (`TS`),
  ADD KEY `Login` (`Login`) USING BTREE;

ALTER TABLE `RSP_USER`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `login` (`Login`),
  ADD KEY `funkce` (`Func`),
  ADD KEY `LastName` (`LastName`);

ALTER TABLE `RSP_VERSION`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Article` (`Article`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Creator` (`Creator`);

ALTER TABLE `RSP_ARTICLE`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `RSP_CC_ARTICLE_Stat`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

ALTER TABLE `RSP_CC_EVENT_Type`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

ALTER TABLE `RSP_CC_USER_Func`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

ALTER TABLE `RSP_COMMENT`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `RSP_EDITION`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `RSP_EVENT`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `RSP_SESSION`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `RSP_USER`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

ALTER TABLE `RSP_VERSION`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `RSP_ARTICLE`
  ADD CONSTRAINT `ParentA_table` FOREIGN KEY (`Edition`) REFERENCES `RSP_EDITION` (`ID`),
  ADD CONSTRAINT `Table_A_Creator` FOREIGN KEY (`Creator`) REFERENCES `RSP_USER` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `TableA_Index` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`),
  ADD CONSTRAINT `TableA_Publish` FOREIGN KEY (`ActiveVersion`) REFERENCES `RSP_VERSION` (`ID`);

ALTER TABLE `RSP_ARTICLE_ROLE`
  ADD CONSTRAINT `FKeyAR_USER` FOREIGN KEY (`Person`) REFERENCES `RSP_USER` (`ID`),
  ADD CONSTRAINT `TableAR_Article` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `TableAR_Index` FOREIGN KEY (`Role`) REFERENCES `RSP_CC_USER_Func` (`ID`);

ALTER TABLE `RSP_CC_EVENT_Type`
  ADD CONSTRAINT `TableCe_Index` FOREIGN KEY (`rights`) REFERENCES `RSP_CC_USER_Func` (`ID`);

ALTER TABLE `RSP_COMMENT`
  ADD CONSTRAINT `ParentC_FKey` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `TableC_Creator` FOREIGN KEY (`Author`) REFERENCES `RSP_USER` (`ID`);

ALTER TABLE `RSP_EDITION`
  ADD CONSTRAINT `Table_Member` FOREIGN KEY (`Redactor`) REFERENCES `RSP_USER` (`ID`);

ALTER TABLE `RSP_EVENT`
  ADD CONSTRAINT `FKey_E_ARTICLE` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  ADD CONSTRAINT `FKey_E_EDITION` FOREIGN KEY (`Edition`) REFERENCES `RSP_EDITION` (`ID`),
  ADD CONSTRAINT `Table_E_Index` FOREIGN KEY (`Type`) REFERENCES `RSP_CC_EVENT_Type` (`ID`),
  ADD CONSTRAINT `Table_E_Member` FOREIGN KEY (`Autor`) REFERENCES `RSP_USER` (`ID`);

ALTER TABLE `RSP_SESSION`
  ADD CONSTRAINT `ParentS_Table` FOREIGN KEY (`Login`) REFERENCES `RSP_USER` (`ID`);

ALTER TABLE `RSP_USER`
  ADD CONSTRAINT `TableU_Index` FOREIGN KEY (`Func`) REFERENCES `RSP_CC_USER_Func` (`ID`);

ALTER TABLE `RSP_VERSION`
  ADD CONSTRAINT `ParentV_Table` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  ADD CONSTRAINT `TableV_Index` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`),
  ADD CONSTRAINT `TableV_Member` FOREIGN KEY (`Creator`) REFERENCES `RSP_USER` (`ID`);
COMMIT;

CREATE TABLE `RSP_DBVERSION` (`version` VARCHAR(10) NOT NULL , `TS` TIMESTAMP NOT NULL , `Autor` VARCHAR(16) NOT NULL ) ENGINE = InnoDB;
INSERT INTO `RSP_DBVERSION` (`version`, `TS`, `Autor`) VALUES ('1.1.0', "2024-12-05 10:00:00", 'TT'), ('1.1.1', "2024-12-05 12:50:13", 'TT');
ALTER TABLE `RSP_DBVERSION` ADD INDEX `TS` (`TS`) USING BTREE;

DELIMITER $$
CREATE DEFINER=`admin_dotaz`@`localhost` FUNCTION `hasAccess`(`userNO` INT, `articleNO` INT) RETURNS tinyint(1)
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
