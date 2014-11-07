-- MySQL dump 10.13  Distrib 5.6.10, for Win64 (x86_64)
--
-- Host: localhost    Database: voting
-- ------------------------------------------------------
-- Server version	5.6.10

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
-- Table structure for table `ADMINISTRADOR`
--

DROP TABLE IF EXISTS `ADMINISTRADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADMINISTRADOR` (
  `ID` int(11) NOT NULL,
  `USUARIO` varchar(45) DEFAULT NULL,
  `SENHA` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ADMINISTRADOR`
--

LOCK TABLES `ADMINISTRADOR` WRITE;
/*!40000 ALTER TABLE `ADMINISTRADOR` DISABLE KEYS */;
/*!40000 ALTER TABLE `ADMINISTRADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OPCAO`
--

DROP TABLE IF EXISTS `OPCAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OPCAO` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` varchar(45) DEFAULT NULL,
  `ID_VOTACAO` int(11) NOT NULL,
  `NUM_VOTOS` int(5) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_VOTACAO_idx` (`ID_VOTACAO`),
  CONSTRAINT `FK_VOTACAO` FOREIGN KEY (`ID_VOTACAO`) REFERENCES `VOTACAO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OPCAO`
--

LOCK TABLES `OPCAO` WRITE;
/*!40000 ALTER TABLE `OPCAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `OPCAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PARTICIPANTE`
--

DROP TABLE IF EXISTS `PARTICIPANTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARTICIPANTE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(50) DEFAULT NULL,
  `SENHA` varchar(45) DEFAULT NULL,
  `INSTITUICAO` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARTICIPANTE`
--

LOCK TABLES `PARTICIPANTE` WRITE;
/*!40000 ALTER TABLE `PARTICIPANTE` DISABLE KEYS */;
/*!40000 ALTER TABLE `PARTICIPANTE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PARTICIPANTE_VOTACAO`
--

DROP TABLE IF EXISTS `PARTICIPANTE_VOTACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARTICIPANTE_VOTACAO` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PARTICIPANTE` varchar(50) NOT NULL,
  `ID_VOTACAO` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARTICIPANTE_VOTACAO`
--

LOCK TABLES `PARTICIPANTE_VOTACAO` WRITE;
/*!40000 ALTER TABLE `PARTICIPANTE_VOTACAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `PARTICIPANTE_VOTACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REUNIAO`
--

DROP TABLE IF EXISTS `REUNIAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REUNIAO` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO` varchar(45) NOT NULL,
  `ATIVA` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REUNIAO`
--

LOCK TABLES `REUNIAO` WRITE;
/*!40000 ALTER TABLE `REUNIAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `REUNIAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTACAO`
--

DROP TABLE IF EXISTS `VOTACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTACAO` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(45) DEFAULT NULL,
  `ID_REUNIAO` int(11) NOT NULL,
  `PERGUNTA` varchar(200) NOT NULL,
  `SUGESTAO` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_REUNIAO_idx` (`ID_REUNIAO`),
  CONSTRAINT `FK_REUNIAO` FOREIGN KEY (`ID_REUNIAO`) REFERENCES `REUNIAO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTACAO`
--

LOCK TABLES `VOTACAO` WRITE;
/*!40000 ALTER TABLE `VOTACAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `VOTACAO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-04 18:54:23
