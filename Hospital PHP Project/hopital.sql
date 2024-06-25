CREATE DATABASE  IF NOT EXISTS `hospital` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `hospital`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hospital
-- ------------------------------------------------------
-- Server version	5.7.43-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `dep_num_doctor` int(11) NOT NULL,
  `dep_num_patient` int(11) NOT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'Bones',0,0),(2,'Brain',1,1),(3,'Subconscious',0,0),(4,'Burns',0,0);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `doctor_n_id` varchar(45) COLLATE utf8_bin NOT NULL,
  `doctor_phone` varchar(11) COLLATE utf8_bin NOT NULL,
  `doctor_time` varchar(45) COLLATE utf8_bin NOT NULL,
  `doctor_img` varchar(45) COLLATE utf8_bin NOT NULL,
  `doctor_dep_id` int(11) NOT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `department_id_idx` (`doctor_dep_id`),
  CONSTRAINT `department_id` FOREIGN KEY (`doctor_dep_id`) REFERENCES `department` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (12,'Elomda sultan','30003072500397','01015570762','08 AM To 12 PM','omda profile.jpg',2);
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `patient_n_id` varchar(45) COLLATE utf8_bin NOT NULL,
  `patient_phone` varchar(45) COLLATE utf8_bin NOT NULL,
  `patient_Diagnosis` varchar(100) COLLATE utf8_bin NOT NULL,
  `patient_img` varchar(45) COLLATE utf8_bin NOT NULL,
  `patient_dep_id` int(11) NOT NULL,
  `patient_doc_id` int(11) NOT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `department_id_idx` (`patient_dep_id`),
  KEY `doctor_id_idx` (`patient_doc_id`),
  CONSTRAINT `dep_id` FOREIGN KEY (`patient_dep_id`) REFERENCES `department` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `doctor_id` FOREIGN KEY (`patient_doc_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (13,'Ali Saad','30003072500396','01093770625','none','FB_IMG_1578068914972.jpg',2,12);
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reply_mass`
--

DROP TABLE IF EXISTS `reply_mass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reply_mass` (
  `reply_mass_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_mass_text` varchar(100) COLLATE utf8_bin NOT NULL,
  `reply_mass_time` varchar(45) COLLATE utf8_bin NOT NULL,
  `reply_mass_send_id` int(11) NOT NULL,
  PRIMARY KEY (`reply_mass_id`),
  KEY `send_id_idx` (`reply_mass_send_id`),
  CONSTRAINT `send_id` FOREIGN KEY (`reply_mass_send_id`) REFERENCES `send_mass` (`send_mass_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reply_mass`
--

LOCK TABLES `reply_mass` WRITE;
/*!40000 ALTER TABLE `reply_mass` DISABLE KEYS */;
INSERT INTO `reply_mass` VALUES (6,'i\'m fine thank you','2024-06-25 02:48:51',5);
/*!40000 ALTER TABLE `reply_mass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `send_mass`
--

DROP TABLE IF EXISTS `send_mass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `send_mass` (
  `send_mass_id` int(11) NOT NULL AUTO_INCREMENT,
  `send_mass_text` varchar(100) COLLATE utf8_bin NOT NULL,
  `send_mass_doc_id` int(11) NOT NULL,
  `send_mass_patient_id` int(11) NOT NULL,
  `send_mass_time` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`send_mass_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `send_mass`
--

LOCK TABLES `send_mass` WRITE;
/*!40000 ALTER TABLE `send_mass` DISABLE KEYS */;
INSERT INTO `send_mass` VALUES (5,'hello dr/omda',12,13,'2024-06-25 02:48:17');
/*!40000 ALTER TABLE `send_mass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `user_password` varchar(45) COLLATE utf8_bin NOT NULL,
  `user_type_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_type_id_idx` (`user_type_id`),
  CONSTRAINT `user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (22,'30003072500397','afdd0b4ad2ec172c586e2150770fbf9e',1),(23,'30003072500396','afdd0b4ad2ec172c586e2150770fbf9e',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Doctor'),(2,'Patient');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-25  2:54:38
