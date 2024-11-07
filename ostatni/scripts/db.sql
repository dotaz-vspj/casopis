-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: frydryn
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `RSP_ARTICLE`
--

DROP TABLE IF EXISTS `RSP_ARTICLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_ARTICLE` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Edition` int DEFAULT NULL,
  `Title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Abstract` text COLLATE utf8mb4_general_ci,
  `Status` int NOT NULL,
  `ActiveVersion` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Status` (`Status`),
  KEY `Active` (`ActiveVersion`),
  KEY `Edition` (`Edition`) USING BTREE,
  CONSTRAINT `ParentA_table` FOREIGN KEY (`Edition`) REFERENCES `RSP_EDITION` (`ID`),
  CONSTRAINT `TableA_Index` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`),
  CONSTRAINT `TableA_Publish` FOREIGN KEY (`ActiveVersion`) REFERENCES `RSP_VERSION` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_ARTICLE`
--

LOCK TABLES `RSP_ARTICLE` WRITE;
/*!40000 ALTER TABLE `RSP_ARTICLE` DISABLE KEYS */;
INSERT INTO `RSP_ARTICLE` VALUES (3,1,'Bezpečnostní kontinuum umělé inteligence: Koncepce a výzvy\r\n','Navrhujeme konceptuální rámec nazvaný „AI Security Continuum“, který se skládá z dimenzí pro trvalé a systematické řešení výzev souvisejících s rozsahem bezpečnostních rizik umělé inteligence v nově vznikajícím kontextu počítačového kontinua a kontinuálního inženýrství. Identifikovanými dimenzemi jsou kontinuum ve výpočetním prostředí AI, kontinuum v technických činnostech pro AI, kontinuum ve vrstvách celkové architektury včetně AI, úroveň automatizace AI a úroveň bezpečnostních opatření AI. Vyhlížíme také inženýrský základ, který může účinně a efektivně zvýšit každou dimenzi.\r\n',3,NULL),(4,1,'Taxonomie generativních aplikací umělé inteligence pro posuzování rizik\r\n','Vynikající funkčnost a všestrannost generativní umělé inteligence vyvolala očekávání ohledně zlepšení lidské společnosti a obavy ohledně etických a sociálních rizik spojených s používáním generativní umělé inteligence. Mnoho předchozích studií představilo otázky rizik jako obavy spojené s používáním generativní UI, ale protože většina těchto obav vychází z pohledu uživatele, je obtížné z nich vyvodit konkrétní protiopatření. V této studii byly rizikové problémy představené v předchozích studiích rozděleny na podrobnější prvky a byly identifikovány rizikové faktory a dopady. Tímto způsobem jsme představili informace, které vedou k návrhům protiopatření pro rizika generativní umělé inteligence. pojmy CCS- obecné a referenční→ hodnocení; průzkumy a přehledy, - výpočetní technika zaměřená na člověka→ teorie, koncepty a modely HCI; - sociální a odborná témata→ výpočetní / technologická politika.\r\n',5,NULL),(5,1,'Vlastní vývojář GPT pro etická řešení AI\r\n','Hlavním cílem tohoto projektu je vytvořit nový softwarový artefakt: vlastní generativní předtrénovaný transformátor (GPT) pro vývojáře, který umožní diskutovat a řešit etické otázky prostřednictvím inženýrství umělé inteligence. Tento konverzační agent poskytne vývojářům praktickou aplikaci týkající se (1) toho, jak dodržovat právní rámce, které se týkají systémů UI (jako je zákon EU o UI [8] a GDPR [11]), a (2) představí alternativní etické perspektivy, aby vývojáři mohli pochopit a začlenit alternativní morální postoje. V tomto článku uvádíme motivaci pro potřebu takového agenta, podrobně popisujeme naši myšlenku a demonstrujeme případ použití. Použití takového nástroje může umožnit odborníkům z praxe navrhovat řešení umělé inteligence, která splňují právní požadavky a vyhovují různým etickým perspektivám.\r\n',5,NULL),(6,1,'Stručný přehled vodoznaků v generativní umělé inteligenci\r\n','Technologie generativní umělé inteligence je nyní schopna vytvářet obrázky a texty na úrovni srovnatelné s lidmi, což ukazuje její pozoruhodnou užitečnost. Tento pokrok však s sebou nese i řadu problémů, jako je zneužití, což vyvolává diskuse o účinných strategiích reakce. V důsledku toho se v jednotlivých zemích projednávají doporučení a předpisy, včetně přijetí technologie vodoznaku. Mnoho společností také začleňuje technologii vodoznaků do svých služeb jako prostředek řešení tohoto problému. Tento dokument představuje analýzu současného stavu zavádění vodoznaků v různých zemích a společnostech. Dále se zabývá dalšími tématy výzkumu, která by měla být při zavádění technologie vodoznaků zohledněna. Cílem této analýzy je poskytnout cenné poznatky těm, kteří uvažují o implementaci vodoznaků do svých budoucích generativních služeb umělé inteligence.\r\n',5,NULL),(7,2,'Zajišťují generativní nástroje AI ekologický kód? Vyšetřovací studie\r\n','Udržitelnost softwaru se stává prvořadým zájmem, jehož cílem je optimalizovat využívání zdrojů, minimalizovat dopad na životní prostředí a podporovat ekologičtější a odolnější digitální ekosystém. Udržitelnost nebo „ekologičnost“ softwaru se obvykle určuje přijetím udržitelných kódovacích postupů. S dozrávajícím ekosystémem kolem generativní umělé inteligence se nyní mnoho vývojářů softwaru spoléhá na tyto nástroje pro generování kódu pomocí pokynů v přirozeném jazyce. Navzdory jejich potenciálním výhodám existuje značný nedostatek studií o aspektech udržitelnosti kódu generovaného umělou inteligencí. Konkrétně, nakolik je kód generovaný umělou inteligencí šetrný k životnímu prostředí na základě přijetí udržitelných kódovacích postupů? V tomto článku představujeme výsledky počátečního šetření aspektů udržitelnosti kódu generovaného umělou inteligencí ve třech populárních nástrojích generativní umělé inteligence - ChatGPT, BARD a Copilot. Výsledky poukazují na výchozí neekologické chování nástrojů pro generování kódu, a to napříč různými pravidly a scénáři. It underscores the need for further in-depth investigations and effective remediation strategies. 2. KONCEPCE CCS- Sociální a odborná témata → Udržitelnost; - Výpočetní metodologie → Generování v přirozeném jazyce.\r\n',1,NULL);
/*!40000 ALTER TABLE `RSP_ARTICLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_ARTICLE_ROLE`
--

DROP TABLE IF EXISTS `RSP_ARTICLE_ROLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_ARTICLE_ROLE` (
  `Article` int NOT NULL,
  `Person` int NOT NULL,
  `Role` int NOT NULL,
  `Active_from` date NOT NULL,
  `Active_to` date DEFAULT NULL,
  UNIQUE KEY `Article` (`Article`,`Person`),
  KEY `Role` (`Role`),
  KEY `FKeyAR_USER` (`Person`),
  CONSTRAINT `FKey_AR_ARTICLE` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  CONSTRAINT `FKeyAR_USER` FOREIGN KEY (`Person`) REFERENCES `RSP_USER` (`ID`),
  CONSTRAINT `TableAR_Index` FOREIGN KEY (`Role`) REFERENCES `RSP_CC_USER_Func` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_ARTICLE_ROLE`
--

LOCK TABLES `RSP_ARTICLE_ROLE` WRITE;
/*!40000 ALTER TABLE `RSP_ARTICLE_ROLE` DISABLE KEYS */;
INSERT INTO `RSP_ARTICLE_ROLE` VALUES (3,102,24,'2024-10-30',NULL),(3,103,24,'2024-10-30',NULL),(4,103,24,'2024-10-30',NULL),(4,104,24,'2024-10-30',NULL),(4,105,24,'2024-10-30',NULL),(4,106,24,'2024-10-30',NULL),(4,107,24,'2024-10-30',NULL),(4,108,24,'2024-10-30',NULL),(5,109,24,'2024-10-30',NULL),(6,110,24,'2024-10-30',NULL),(6,111,24,'2024-10-30',NULL),(7,112,24,'2024-10-30',NULL);
/*!40000 ALTER TABLE `RSP_ARTICLE_ROLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_CC_ARTICLE_Stat`
--

DROP TABLE IF EXISTS `RSP_CC_ARTICLE_Stat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_CC_ARTICLE_Stat` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `descr` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_CC_ARTICLE_Stat`
--

LOCK TABLES `RSP_CC_ARTICLE_Stat` WRITE;
/*!40000 ALTER TABLE `RSP_CC_ARTICLE_Stat` DISABLE KEYS */;
INSERT INTO `RSP_CC_ARTICLE_Stat` VALUES (1,'podáno'),(2,'recenzováno'),(3,'schváleno'),(4,'zamítnuto'),(5,'publikováno');
/*!40000 ALTER TABLE `RSP_CC_ARTICLE_Stat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_CC_EVENT_Type`
--

DROP TABLE IF EXISTS `RSP_CC_EVENT_Type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_CC_EVENT_Type` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `descr` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `rights` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Rights` (`rights`),
  CONSTRAINT `TableCe_Index` FOREIGN KEY (`rights`) REFERENCES `RSP_CC_USER_Func` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_CC_EVENT_Type`
--

LOCK TABLES `RSP_CC_EVENT_Type` WRITE;
/*!40000 ALTER TABLE `RSP_CC_EVENT_Type` DISABLE KEYS */;
INSERT INTO `RSP_CC_EVENT_Type` VALUES (1,'Rozhodnutí rady',11),(2,'Rozhodnutí šéfredaktora',11),(3,'Podání',22),(4,'Přidělení k recenzi',12),(5,'Recenzováno',21),(6,'Schválení',12),(7,'Zamítnutí',12),(8,'Archivace',12),(9,'Publikace',11),(10,'Editace uživatele',12);
/*!40000 ALTER TABLE `RSP_CC_EVENT_Type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_CC_USER_Func`
--

DROP TABLE IF EXISTS `RSP_CC_USER_Func`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_CC_USER_Func` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `descr` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_CC_USER_Func`
--

LOCK TABLES `RSP_CC_USER_Func` WRITE;
/*!40000 ALTER TABLE `RSP_CC_USER_Func` DISABLE KEYS */;
INSERT INTO `RSP_CC_USER_Func` VALUES (1,'admin'),(11,'Šefredaktor'),(12,'Redaktor'),(13,'Člen rady'),(21,'Oponent'),(22,'Reg. Autor'),(23,'Reg. Přispěvatel'),(24,'Autor');
/*!40000 ALTER TABLE `RSP_CC_USER_Func` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_COMMENT`
--

DROP TABLE IF EXISTS `RSP_COMMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_COMMENT` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Article` int NOT NULL,
  `Author` int NOT NULL,
  `TS` timestamp NOT NULL,
  `Commentary` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Article` (`Article`),
  KEY `Author` (`Author`),
  CONSTRAINT `ParentC_Table` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  CONSTRAINT `TableC_Creator` FOREIGN KEY (`Author`) REFERENCES `RSP_USER` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_COMMENT`
--

LOCK TABLES `RSP_COMMENT` WRITE;
/*!40000 ALTER TABLE `RSP_COMMENT` DISABLE KEYS */;
INSERT INTO `RSP_COMMENT` VALUES (1,6,111,'2024-10-30 05:57:09','This article is essential. Keep it in mind!');
/*!40000 ALTER TABLE `RSP_COMMENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_EDITION`
--

DROP TABLE IF EXISTS `RSP_EDITION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_EDITION` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Thema` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Published` date DEFAULT NULL,
  `Redactor` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Redactor` (`Redactor`),
  CONSTRAINT `Table_Member` FOREIGN KEY (`Redactor`) REFERENCES `RSP_USER` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_EDITION`
--

LOCK TABLES `RSP_EDITION` WRITE;
/*!40000 ALTER TABLE `RSP_EDITION` DISABLE KEYS */;
INSERT INTO `RSP_EDITION` VALUES (1,'Softwarové inženýrství pro umělou inteligenci','International Conference on AI Engineering – Software Engineering for AI (CAIN)','2024-10-30',3),(2,'Připravované vydání - pracovně: Hardwarová esence přirozené blbosti','International Conference on NS (Natural Stupidity)',NULL,1);
/*!40000 ALTER TABLE `RSP_EDITION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_EVENT`
--

DROP TABLE IF EXISTS `RSP_EVENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_EVENT` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Datum` date NOT NULL,
  `Autor` int NOT NULL,
  `Edition` int DEFAULT NULL,
  `Article` int DEFAULT NULL,
  `Type` int NOT NULL,
  `Message` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `Data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `Document` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Autor` (`Autor`),
  KEY `Edition` (`Edition`),
  KEY `Article` (`Article`),
  KEY `Datum` (`Datum`) USING BTREE,
  KEY `Type` (`Type`) USING BTREE,
  CONSTRAINT `FKey_E_ARTICLE` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  CONSTRAINT `FKey_E_EDITION` FOREIGN KEY (`Edition`) REFERENCES `RSP_EDITION` (`ID`),
  CONSTRAINT `Table_E_Index` FOREIGN KEY (`Type`) REFERENCES `RSP_CC_EVENT_Type` (`ID`),
  CONSTRAINT `Table_E_Member` FOREIGN KEY (`Autor`) REFERENCES `RSP_USER` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_EVENT`
--

LOCK TABLES `RSP_EVENT` WRITE;
/*!40000 ALTER TABLE `RSP_EVENT` DISABLE KEYS */;
/*!40000 ALTER TABLE `RSP_EVENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_SESSION`
--

DROP TABLE IF EXISTS `RSP_SESSION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_SESSION` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Login` int NOT NULL,
  `TS` timestamp NOT NULL,
  `SessionTag` char(24) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Login` (`Login`) USING BTREE,
  KEY `TS` (`TS`),
  CONSTRAINT `ParentS_Table` FOREIGN KEY (`Login`) REFERENCES `RSP_USER` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_SESSION`
--

LOCK TABLES `RSP_SESSION` WRITE;
/*!40000 ALTER TABLE `RSP_SESSION` DISABLE KEYS */;
INSERT INTO `RSP_SESSION` VALUES (1,2,'2024-10-25 20:17:27','7f172abc42ed3d26ee49099e'),(2,3,'2024-10-31 14:39:27','e19f676f77ad09f6e64f4cac'),(3,1,'2024-11-04 21:01:59','88ec23bd7c3c405125f2e530');
/*!40000 ALTER TABLE `RSP_SESSION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_USER`
--

DROP TABLE IF EXISTS `RSP_USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_USER` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `LastName` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `TitleF` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TitleP` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Func` int NOT NULL,
  `Phone` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Mail` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `Login` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` char(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `login` (`Login`),
  KEY `funkce` (`Func`),
  KEY `LastName` (`LastName`),
  CONSTRAINT `TableU_Index` FOREIGN KEY (`Func`) REFERENCES `RSP_CC_USER_Func` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_USER`
--

LOCK TABLES `RSP_USER` WRITE;
/*!40000 ALTER TABLE `RSP_USER` DISABLE KEYS */;
INSERT INTO `RSP_USER` VALUES (1,'Admin','-',NULL,NULL,1,NULL,'tregl@student.vspj.cz','admin','$2y$10$OJVyav934Jcg9vc5iufkAelcjkUiUPG6HNTtNohe9/oMosD/fjP0u',1),(2,'','','','',1,'','user1@example.com','user1','$2y$10$/73lWE5qNM4fxUcBH9.SqeGGDHqgl3Qy0V1ja5N7Vxc1morbIlH7m',1),(3,'Tomáš','Trégl','Puc.','M.U.C.',1,'','ttsoftt@wo.cz','tregl','$2y$10$jMyuMc8rqgsUy.aViKdiU.Plf8F/MXNmteaPAzeD77Ep7JetDaDOC',1),(102,'Hironori','Washizaki',NULL,NULL,24,NULL,'Hironori@autor.vspj.cz',NULL,NULL,2),(103,'Nobukazu','Yoshioka',NULL,NULL,24,NULL,'Nobukazu@autor.vspj.cz',NULL,NULL,2),(104,'Hiroshi','Tanaka',NULL,NULL,24,NULL,'Hiroshi@autor.vspj.cz',NULL,NULL,2),(105,'Masaru','Ide',NULL,NULL,24,NULL,'Masaru@autor.vspj.cz',NULL,NULL,2),(106,'Jun','Yajima',NULL,NULL,24,NULL,'Jun@autor.vspj.cz',NULL,NULL,2),(107,'Sachiko','Ondera',NULL,NULL,24,NULL,'Ondera@autor.vspj.cz',NULL,NULL,2),(108,'Kazuki','Munakata',NULL,NULL,24,NULL,'Kazuki@autor.vspj.cz',NULL,NULL,2),(109,'Lauren','Olson',NULL,NULL,24,NULL,'Lauren.Olson@autor.vspj.cz',NULL,NULL,2),(110,'Hwang','JaeYoung',NULL,NULL,24,NULL,'Hwang@autor.vspj.cz',NULL,NULL,2),(111,'Oh','SangHoon',NULL,NULL,22,NULL,'SangHoon@autor.vspj.cz','SangHong','$2y$10$Jj8GnHDVVdSnmVEcMcuymeea2Tbw34Sv2wdDrEaQFA/jixVWH/C2O',2),(112,'Samarth','Sikand',NULL,NULL,22,NULL,'Samarth.Sikand@autor.vspj.cz','SaSik','$2y$10$Jj8GnHDVVdSnmVEcMcuymeea2Tbw34Sv2wdDrEaQFA/jixVWH/C2O',2);
/*!40000 ALTER TABLE `RSP_USER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RSP_VERSION`
--

DROP TABLE IF EXISTS `RSP_VERSION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_VERSION` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Document` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `Created` date NOT NULL,
  `Published` date DEFAULT NULL,
  `Archived` date DEFAULT NULL,
  `Article` int NOT NULL,
  `Status` int NOT NULL,
  `Creator` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Article` (`Article`),
  KEY `Status` (`Status`),
  KEY `Creator` (`Creator`),
  CONSTRAINT `ParentV_Table` FOREIGN KEY (`Article`) REFERENCES `RSP_ARTICLE` (`ID`),
  CONSTRAINT `TableV_Index` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`),
  CONSTRAINT `TableV_Member` FOREIGN KEY (`Creator`) REFERENCES `RSP_USER` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_VERSION`
--

LOCK TABLES `RSP_VERSION` WRITE;
/*!40000 ALTER TABLE `RSP_VERSION` DISABLE KEYS */;
/*!40000 ALTER TABLE `RSP_VERSION` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-04 22:07:06
