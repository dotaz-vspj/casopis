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
  `Creator` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Status` (`Status`),
  KEY `Active` (`ActiveVersion`),
  KEY `Edition` (`Edition`) USING BTREE,
  KEY `Creator` (`Creator`),
  CONSTRAINT `ParentA_table` FOREIGN KEY (`Edition`) REFERENCES `RSP_EDITION` (`ID`),
  CONSTRAINT `TableA_Creator` FOREIGN KEY (`Creator`) REFERENCES `RSP_USER` (`ID`),
  CONSTRAINT `TableA_Publish` FOREIGN KEY (`ActiveVersion`) REFERENCES `RSP_VERSION` (`ID`),
  CONSTRAINT `TableA_Status` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_ARTICLE`
--
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

--
-- Table structure for table `RSP_CC_ARTICLE_Stat`
--

DROP TABLE IF EXISTS `RSP_CC_ARTICLE_Stat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_CC_ARTICLE_Stat` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `descr` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_CC_ARTICLE_Stat`
--

/*!40000 ALTER TABLE `RSP_CC_ARTICLE_Stat` DISABLE KEYS */;
INSERT INTO `RSP_CC_ARTICLE_Stat` VALUES (1,'podáno','lightblue'),(2,'přijato','lightgreen'),(3,'zamítnuto','red'),(4,'k recenzi','yellow'),(5,'recenzováno','darkgreen'),(6,'schváleno','green'),(7,'publikováno','darkgreen');
/*!40000 ALTER TABLE `RSP_CC_ARTICLE_Stat` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_CC_EVENT_Type`
--

/*!40000 ALTER TABLE `RSP_CC_EVENT_Type` DISABLE KEYS */;
INSERT INTO `RSP_CC_EVENT_Type` VALUES (1,'Rozhodnutí rady',11),(2,'Rozhodnutí šéfredaktora',11),(3,'Podání',22),(4,'Přidělení k recenzi',12),(5,'Recenzováno',21),(6,'Schválení',12),(7,'Zamítnutí',12),(8,'Archivace',12),(9,'Publikace',11),(10,'Editace uživatele',12),(11,'Odvolání recenzenta',12),(12,'Přijetí k recenzi',21),(13,'Odmítnutí recenze',21);
/*!40000 ALTER TABLE `RSP_CC_EVENT_Type` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `RSP_CC_USER_Func` DISABLE KEYS */;
INSERT INTO `RSP_CC_USER_Func` VALUES (1,'admin'),(11,'Šefredaktor'),(12,'Redaktor'),(13,'Člen rady'),(21,'Oponent'),(22,'Reg. Autor'),(23,'Reg. Přispěvatel'),(24,'Autor');
/*!40000 ALTER TABLE `RSP_CC_USER_Func` ENABLE KEYS */;

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

INSERT INTO `RSP_EDITION` VALUES (1,'Softwarové inženýrství pro umělou inteligenci ','International Conference on AI Engineering – Software Engineering for AI (CAIN) ','2024-10-30',1);

--
-- Table structure for table `RSP_EVENT`
--

DROP TABLE IF EXISTS `RSP_EVENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RSP_EVENT` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Datum` date NOT NULL,
  `Autor` int DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


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
  `SessionTag` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Login` (`Login`) USING BTREE,
  KEY `TS` (`TS`),
  CONSTRAINT `ParentS_Table` FOREIGN KEY (`Login`) REFERENCES `RSP_USER` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `TitleP` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Func` int NOT NULL,
  `Phone` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Mail` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `Login` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `login` (`Login`),
  KEY `funkce` (`Func`),
  KEY `LastName` (`LastName`),
  CONSTRAINT `TableU_Index` FOREIGN KEY (`Func`) REFERENCES `RSP_CC_USER_Func` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_USER`
--

/*!40000 ALTER TABLE `RSP_USER` DISABLE KEYS */;
INSERT INTO `RSP_USER` VALUES 
(1, 'admin', 'admin', NULL, NULL, 1, '', 'admin@example.com', 'admin', '$2y$10$E5U/OMh0k7p5CCkRBWVgkOV6eRrr5UO5xuS8O6gK50AbHzyulTjpm', 1);
/*!40000 ALTER TABLE `RSP_USER` ENABLE KEYS */;

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
  CONSTRAINT `TableV_Member` FOREIGN KEY (`Creator`) REFERENCES `RSP_USER` (`ID`),
  CONSTRAINT `TableV_Status` FOREIGN KEY (`Status`) REFERENCES `RSP_CC_ARTICLE_Stat` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RSP_VERSION`
--

DELIMITER $$
CREATE DEFINER=`admin_dotaz`@`localhost` FUNCTION `hasAccess`(`userNO` INT, `articleNO` INT) RETURNS tinyint(1)
    READS SQL DATA
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
  IF (SELECT Status from RSP_ARTICLE where ID=articleNO)=5 THEN
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

