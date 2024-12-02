CREATE DATABASE  IF NOT EXISTS `lms_veiligheid` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lms_veiligheid`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lms_veiligheid
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `acties`
--

DROP TABLE IF EXISTS `acties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `omschrijving` varchar(255) DEFAULT NULL,
  `melding_nummer` int DEFAULT NULL,
  `gebruiker_e_mail` varchar(255) DEFAULT NULL,
  `datum` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `melding_nummer` (`melding_nummer`),
  KEY `gebruiker_e_mail` (`gebruiker_e_mail`),
  CONSTRAINT `acties_ibfk_1` FOREIGN KEY (`melding_nummer`) REFERENCES `meldingen` (`melding_nummer`) ON DELETE CASCADE,
  CONSTRAINT `acties_ibfk_2` FOREIGN KEY (`gebruiker_e_mail`) REFERENCES `gebruikers` (`e_mail`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categorieën`
--

DROP TABLE IF EXISTS `categorieën`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorieën` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `naam` (`naam`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gebruikers`
--

DROP TABLE IF EXISTS `gebruikers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gebruikers` (
  `e_mail` varchar(255) NOT NULL,
  `voor_naam` varchar(50) NOT NULL,
  `tussenvoegsel` varchar(20) DEFAULT NULL,
  `achter_naam` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `telefoon_nummer` varchar(20) DEFAULT NULL,
  `aangemaakt_op` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`e_mail`),
  CONSTRAINT `gebruikers_chk_1` CHECK (regexp_like(`telefoon_nummer`,_utf8mb4'^[0-9]+$')),
  CONSTRAINT `gebruikers_chk_2` CHECK ((`e_mail` like _utf8mb4'%_@__%.__%'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gebruikers_rollen`
--

DROP TABLE IF EXISTS `gebruikers_rollen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gebruikers_rollen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gebruikers_e_mail` varchar(255) NOT NULL,
  `rol_id` int NOT NULL,
  `toegevoeg_op` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gebruikers_e_mail` (`gebruikers_e_mail`,`rol_id`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `gebruikers_rollen_ibfk_1` FOREIGN KEY (`gebruikers_e_mail`) REFERENCES `gebruikers` (`e_mail`) ON DELETE CASCADE,
  CONSTRAINT `gebruikers_rollen_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rollen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `melding_fotos`
--

DROP TABLE IF EXISTS `melding_fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `melding_fotos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `melding_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `melding_id` (`melding_id`),
  CONSTRAINT `melding_fotos_ibfk_1` FOREIGN KEY (`melding_id`) REFERENCES `meldingen` (`melding_nummer`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meldingen`
--

DROP TABLE IF EXISTS `meldingen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meldingen` (
  `melding_nummer` int NOT NULL AUTO_INCREMENT,
  `gebruikers_email` varchar(255) NOT NULL,
  `melding_onderwerp` varchar(150) DEFAULT NULL,
  `melding_info` text,
  `datum_van_melding` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `afgehandeld` tinyint(1) DEFAULT '0',
  `prioriteit` int NOT NULL,
  `toren` varchar(1) NOT NULL,
  `verdieping` int NOT NULL,
  `klas_ruimte` varchar(64) NOT NULL,
  PRIMARY KEY (`melding_nummer`),
  KEY `gebruikers_email` (`gebruikers_email`),
  CONSTRAINT `meldingen_ibfk_1` FOREIGN KEY (`gebruikers_email`) REFERENCES `gebruikers` (`e_mail`),
  CONSTRAINT `meldingen_chk_1` CHECK ((`prioriteit` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meldingen_categorieën`
--

DROP TABLE IF EXISTS `meldingen_categorieën`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meldingen_categorieën` (
  `melding_nummer` int NOT NULL,
  `categorie_id` int NOT NULL,
  PRIMARY KEY (`melding_nummer`,`categorie_id`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `meldingen_categorieën_ibfk_1` FOREIGN KEY (`melding_nummer`) REFERENCES `meldingen` (`melding_nummer`) ON DELETE CASCADE,
  CONSTRAINT `meldingen_categorieën_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categorieën` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `datum` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rechten`
--

DROP TABLE IF EXISTS `rechten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rechten` (
  `naam` varchar(50) NOT NULL,
  PRIMARY KEY (`naam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rollen`
--

DROP TABLE IF EXISTS `rollen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rollen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `naam` (`naam`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rollen_categorieën`
--

DROP TABLE IF EXISTS `rollen_categorieën`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rollen_categorieën` (
  `rol_id` int NOT NULL,
  `categorie_id` int NOT NULL,
  PRIMARY KEY (`rol_id`,`categorie_id`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `rollen_categorieën_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rollen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rollen_categorieën_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categorieën` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rollen_rechten`
--

DROP TABLE IF EXISTS `rollen_rechten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rollen_rechten` (
  `rol_id` int NOT NULL,
  `recht_naam` varchar(50) NOT NULL,
  PRIMARY KEY (`rol_id`,`recht_naam`),
  KEY `recht_naam` (`recht_naam`),
  CONSTRAINT `rollen_rechten_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rollen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rollen_rechten_ibfk_2` FOREIGN KEY (`recht_naam`) REFERENCES `rechten` (`naam`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'lms_veiligheid'
--

--
-- Dumping routines for database 'lms_veiligheid'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02 10:03:14
