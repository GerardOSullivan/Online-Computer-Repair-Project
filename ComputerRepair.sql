-- MariaDB dump 10.18  Distrib 10.5.7-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: computerfixproject
-- ------------------------------------------------------
-- Server version	10.5.7-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `CustomerID` smallint(6) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Eircode` varchar(8) DEFAULT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (4,'Gerard','sa','Moulavanig,','','+353830087013','gerardosullivan.work@email.com'),(8,'Gerard','a','Moulavanig,','','+353830087013','gerardosullivan.work@email.com'),(9,'Gerard','asd','Moulavanig,','','+353830087013','gerardosullivan.work@email.com'),(10,'Gerard','OSullivan','Moulavanig,','','+353830087013','gerardosullivan.work@email.com'),(11,'Gerard','OSullivan','Moulavanig','','+353830087013','gerardosullivan.work@email.com'),(12,'Gerard','O Sullivan','Moulavanig,','','+353830087013','gerardosullivan.work@email.com'),(13,'Gerard','O Sullivan','Moulavanig','','+353830087013','gerardosullivan.work@email.com');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts` (
  `PartID` smallint(6) NOT NULL AUTO_INCREMENT,
  `PartType` varchar(20) NOT NULL,
  `Description` varchar(30) NOT NULL,
  `Cost` decimal(6,2) NOT NULL DEFAULT 0.00,
  `Status` char(1) NOT NULL,
  `QtyInStock` int(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`PartID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts`
--

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (1,'Ram','16GB Kingston',50.00,'A',87),(2,'CPU','Intel Core i7-1160',70.00,'A',6),(3,'Motherboard','ROG STRIX X570',30.00,'A',30),(4,'Mouse','Razer DeathAdder V2 Pro',60.00,'A',0),(5,'Monitor','BenQ GW2480',100.00,'D',0);
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repairitems`
--

DROP TABLE IF EXISTS `repairitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repairitems` (
  `RepairTicketID` smallint(6) NOT NULL,
  `PartID` smallint(6) NOT NULL,
  `QtyInRepair` smallint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`RepairTicketID`,`PartID`),
  KEY `PartID` (`PartID`),
  CONSTRAINT `repairitems_ibfk_1` FOREIGN KEY (`RepairTicketID`) REFERENCES `repairs` (`RepairTicketID`),
  CONSTRAINT `repairitems_ibfk_2` FOREIGN KEY (`PartID`) REFERENCES `parts` (`PartID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repairitems`
--

LOCK TABLES `repairitems` WRITE;
/*!40000 ALTER TABLE `repairitems` DISABLE KEYS */;
INSERT INTO `repairitems` VALUES (2,1,26),(4,1,1),(4,2,1),(5,1,1),(6,1,1);
/*!40000 ALTER TABLE `repairitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repairs`
--

DROP TABLE IF EXISTS `repairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repairs` (
  `RepairTicketID` smallint(6) NOT NULL AUTO_INCREMENT,
  `CustomerID` smallint(6) NOT NULL,
  `DateRepairLogged` date NOT NULL,
  `RepairDescription` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'L',
  `totalcost` decimal(6,2) NOT NULL DEFAULT 30.00,
  `DatePaid` date DEFAULT NULL,
  PRIMARY KEY (`RepairTicketID`),
  KEY `CustomerID` (`CustomerID`),
  CONSTRAINT `repairs_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repairs`
--

LOCK TABLES `repairs` WRITE;
/*!40000 ALTER TABLE `repairs` DISABLE KEYS */;
INSERT INTO `repairs` VALUES (2,4,'2020-12-08','Hello','C',0.00,'2020-12-15'),(4,4,'2020-12-08','asdssdasddsaasddas','C',0.00,'2020-12-15'),(5,4,'2020-12-08','asdssdasddsaasddas','L',80.00,NULL),(6,4,'2020-12-08','asdsadasddasdasdasdasdasdada','L',80.00,NULL),(10,4,'2020-12-08','asdsad','L',30.00,NULL),(11,9,'2020-12-08','asddassdsd','L',30.00,NULL),(12,9,'2020-12-14','dfsfds','L',30.00,NULL),(13,9,'2020-12-15','\\\\zxcz\\x','L',30.00,NULL);
/*!40000 ALTER TABLE `repairs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-16  0:25:53
