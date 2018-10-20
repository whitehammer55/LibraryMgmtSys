-- MySQL dump 10.16  Distrib 10.1.35-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: wdl
-- ------------------------------------------------------
-- Server version	10.1.35-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asdf`
--

DROP TABLE IF EXISTS `asdf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asdf` (
  `num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asdf`
--

LOCK TABLES `asdf` WRITE;
/*!40000 ALTER TABLE `asdf` DISABLE KEYS */;
/*!40000 ALTER TABLE `asdf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_author`
--

DROP TABLE IF EXISTS `b_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_author` (
  `BookID` int(11) DEFAULT NULL,
  `AuthorName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_author`
--

LOCK TABLES `b_author` WRITE;
/*!40000 ALTER TABLE `b_author` DISABLE KEYS */;
INSERT INTO `b_author` VALUES (1,'Philip Anderson'),(2,'Elizabeth S. Allman'),(2,'John A. Rhodes'),(3,'Paul Davidovits'),(4,'Jamie Davies'),(5,'Garrett R.H.'),(5,'Grisham C.M.'),(6,'Jaap A. Kaandorp'),(6,'P. Prusinkiewicz'),(7,'James D. Murray'),(8,'Steven Pinker'),(9,'Dr P Revest'),(9,'Alan Longstaff'),(10,'Mikhail J. Atallah'),(11,'Thomas H. Cormen'),(11,'Charles E. Leiserson'),(11,'Ronald L. Rivest'),(11,'Clifford Stein'),(12,'Daniel H Greene'),(13,'Donald L. Kreher'),(13,'Douglas R. Stinson'),(14,'Richard H. Enns'),(15,'Maurice Mignotte'),(15,'C. Mignotte'),(16,'Bernd Jahne'),(17,'Rolf Klein (auth.)'),(18,'Stephen Mann'),(19,'Luiz Velho'),(19,'Jonas Gomes'),(19,'Luiz H. de Figueiredo'),(20,'John Vince'),(21,'Richard W. Hamming'),(22,'Michael F. Cohen'),(22,'John R. Wallace'),(23,'Keinosuke Fukunaga'),(24,'David Vandevoorde'),(24,'Bjarne Stroustrup');
/*!40000 ALTER TABLE `b_author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonny`
--

DROP TABLE IF EXISTS `bonny`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonny` (
  `user_id` int(11) NOT NULL,
  `answer1` text,
  `answer2` text,
  `answer3` text,
  `answer4` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonny`
--

LOCK TABLES `bonny` WRITE;
/*!40000 ALTER TABLE `bonny` DISABLE KEYS */;
INSERT INTO `bonny` VALUES (101,'The website is good , quite impressed with the functionality the Library Mgmt site gives me to handle my books ',' I heard about this site from our college library notice board',' Well, i have most of the functionality i would need ,so i dont think there is anything missing from the site',' Quite likely!!'),(102,'The GUI is pretty good , updated with options i would want to handle the library services ',' The librarian made me notice of this site','As of for now ,no!. There is nothing i would need ,i would be excited for future updates',' Very much likely');
/*!40000 ALTER TABLE `bonny` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `BookID` int(11) NOT NULL,
  `ISBN` varchar(30) DEFAULT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Edition` int(11) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `DOI` date DEFAULT NULL,
  `DOR` date DEFAULT NULL,
  `reissue_count` int(11) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`BookID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'0071363629','Handbook of Clinical Drug Data',1,101,'2018-10-20','2018-10-27',0,201),(2,'0521525861','Mathematical models in biology: solution manual',1,102,'2018-10-20','2018-10-27',0,202),(3,'0123694116','Physics in Biology and Medicine',3,101,'2018-10-20','2018-10-27',0,201),(4,'0387256156','Branching morphogenesis',1,102,'2018-10-20','2018-10-27',0,202),(5,'0030973694','Biochemistry',2,NULL,NULL,NULL,NULL,201),(6,'3540566856','Fractal modelling: growth and form in biology',1,NULL,NULL,NULL,NULL,202),(7,'0387952233','Mathematical Biology 1: An Introduction',3,NULL,NULL,NULL,NULL,201),(8,'0670031518','The blank slate: the modern denial of human nature',1,NULL,NULL,NULL,NULL,202),(9,'1859962505','Molecular neuroscience',1,NULL,NULL,NULL,NULL,201),(10,'0849326494','Algorithms and theory of computation handbook',1,NULL,NULL,NULL,NULL,202),(11,'0070131511','Introduction to algorithms',2,NULL,NULL,NULL,NULL,201),(12,'376433102X','Mathematics for the analysis of algorithms',2,NULL,NULL,NULL,NULL,202),(13,'084933988X','Combinatorial algorithms: generation, enumeration, and search',1,NULL,NULL,NULL,NULL,201),(14,'0817632239','Computer Algebra Recipes for Mathematical Physics',1,NULL,NULL,NULL,NULL,202),(15,'0387976752','Mathematics for computer algebra',1,NULL,NULL,NULL,NULL,201),(16,'0123797772','Computer vision and applications',1,NULL,NULL,NULL,NULL,202),(17,'0387520554','Concrete and Abstract Voronoi Diagrams',1,NULL,NULL,NULL,NULL,201),(18,'1598291165','A blossoming development of splines',1,NULL,NULL,NULL,NULL,202),(19,'0387984240','Implicit objects in computer graphics',1,NULL,NULL,NULL,NULL,201),(20,'1852333804','Essential Mathematics for Computer Graphics Fast',1,NULL,NULL,NULL,NULL,202),(21,'0131390724','Coding and information theory',2,NULL,NULL,NULL,NULL,201),(22,'0121782700','Radiosity and Realistic Image Synthesis ',1,NULL,NULL,NULL,NULL,202),(23,'0122698517','Introduction to Statistical Pattern Recognition',2,NULL,NULL,NULL,NULL,201),(24,'0201309653','C++ Solutions: companion to C++ programming language',3,NULL,NULL,NULL,NULL,202);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `Post` varchar(30) DEFAULT NULL,
  `FirstName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (201,'Head Librarian','Hermione','Granger','emp1@gmail.com','1970-01-01','e1_pass'),(202,'Assistant Librarian','Fleur','Delacour','emp2@gmail.com','1974-02-04','e2_pass');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `u_contact`
--

DROP TABLE IF EXISTS `u_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u_contact` (
  `Contact` varchar(30) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `u_contact`
--

LOCK TABLES `u_contact` WRITE;
/*!40000 ALTER TABLE `u_contact` DISABLE KEYS */;
INSERT INTO `u_contact` VALUES ('1010500500',101),('1010400400',101),('1020500500',102),('1020400400',102);
/*!40000 ALTER TABLE `u_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Password` varchar(30) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `FirstName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (101,'password','user1@gmail.com','1990-10-01','Jacob','Black'),(102,'password','user2@gmail.com','1990-10-02','Sirius','Black');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-20 13:05:04
