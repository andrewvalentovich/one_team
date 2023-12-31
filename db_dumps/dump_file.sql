-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: oneteam
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

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
-- Table structure for table `citizenship_divs`
--

DROP TABLE IF EXISTS `citizenship_divs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citizenship_divs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citizenship_divs`
--

LOCK TABLES `citizenship_divs` WRITE;
/*!40000 ALTER TABLE `citizenship_divs` DISABLE KEYS */;
/*!40000 ALTER TABLE `citizenship_divs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_selects`
--

DROP TABLE IF EXISTS `company_selects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_selects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` json DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_tr` longtext COLLATE utf8mb4_unicode_ci,
  `status` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_selects`
--

LOCK TABLES `company_selects` WRITE;
/*!40000 ALTER TABLE `company_selects` DISABLE KEYS */;
INSERT INTO `company_selects` VALUES (2,'О проекте','\"<ul>\\r\\n<li dir=\\\"ltr\\\" aria-level=\\\"2\\\">\\r\\n<p dir=\\\"ltr\\\" role=\\\"presentation\\\">О проекте&nbsp;</p>\\r\\n</li>\\r\\n</ul>\\r\\n<p>&nbsp;</p>\"',NULL,NULL,'0','2023-07-06 10:52:40','2023-07-06 11:01:59'),(4,'История','\"<p><strong id=\\\"docs-internal-guid-feb7117b-7fff-9761-e0d4-a616995fe5a8\\\">История</strong></p>\"',NULL,NULL,'0','2023-07-06 11:24:53','2023-07-06 11:24:53'),(5,'Миссия','\"<p><strong id=\\\"docs-internal-guid-dcc66a18-7fff-b3e8-2c15-cd92b8af3b45\\\">Миссия</strong></p>\"',NULL,NULL,'0','2023-07-06 11:25:00','2023-07-06 11:25:00'),(6,'Команда','\"<p><strong id=\\\"docs-internal-guid-706bec3c-7fff-cc19-7d5c-6693233c02b2\\\">Команда</strong></p>\"',NULL,NULL,'0','2023-07-06 11:25:07','2023-07-06 11:25:07'),(7,'Отзывы','\"<p><strong id=\\\"docs-internal-guid-bbed0b42-7fff-e7b6-9b58-df8248f07281\\\">Отзывы</strong></p>\"',NULL,NULL,'0','2023-07-06 11:25:13','2023-07-06 11:25:13'),(8,'Партнерам','\"<p><strong id=\\\"docs-internal-guid-f371b270-7fff-fcff-c387-b1c9a5647406\\\">Партнерам</strong></p>\"',NULL,NULL,'0','2023-07-06 11:25:18','2023-07-06 11:25:18'),(9,'Пресса','\"<p><strong id=\\\"docs-internal-guid-db111ccb-7fff-12f6-553d-c305c9188bd1\\\">Пресса</strong></p>\"',NULL,NULL,'0','2023-07-06 11:25:24','2023-07-06 11:25:24'),(10,'Работа у нас','\"<p>Работа у нас</p>\"','\"<p>en<\\/p>\"','\"<p>tr<\\/p>\"','0','2023-07-06 11:25:45','2023-07-10 14:17:11');
/*!40000 ALTER TABLE `company_selects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` json NOT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_tr` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,NULL,'\"<p>contacts&nbsp;</p>\"','\"<p>en<\\/p>\"','\"<p>tr<\\/p>\\r\\n<p>&nbsp;<\\/p>\"','2023-07-06 08:09:36','2023-07-10 14:08:10');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country_and_cities`
--

DROP TABLE IF EXISTS `country_and_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country_and_cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `metric_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_tr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div` longtext COLLATE utf8mb4_unicode_ci,
  `div_en` longtext COLLATE utf8mb4_unicode_ci,
  `div_tr` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_and_cities_parent_id_foreign` (`parent_id`),
  CONSTRAINT `country_and_cities_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `country_and_cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country_and_cities`
--

LOCK TABLES `country_and_cities` WRITE;
/*!40000 ALTER TABLE `country_and_cities` DISABLE KEYS */;
INSERT INTO `country_and_cities` VALUES (17,'1','Турция','Turkey','Türkiye',NULL,'1687112442.png','39.949097303703354','32.85853053948319','<section class=\"citizenship container\">\r\n			<div class=\"citizenship__title title\">\r\n				Гражданство\r\n			</div>\r\n			<div class=\"citizenship__subtitle\">\r\n				Мы предлагаем готовые стратегии инвестирования в зарубежную недвижимость \r\n			</div>\r\n			<div class=\"citizenship__content\">\r\n				<div class=\"citizenship__content-items\">\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-dollar\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"51px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.93 1.89\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.3,0.63 2.3,1.82 0.07,1.82 0.07,0.63 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.3,0.41 2.53,0.41 2.53,1.52 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.48,0.22 2.71,0.22 2.71,1.34 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.67,0.04 2.9,0.04 2.9,1.15 \"></polyline>\r\n								<g id=\"_2529166579488\">\r\n								<path class=\"fil0 str2\" d=\"M1.01 1.35l0 0.1 0.25 0c0.07,0 0.13,-0.05 0.13,-0.11 0,-0.06 -0.06,-0.11 -0.13,-0.11l-0.14 0c-0.08,0 -0.14,-0.05 -0.14,-0.12 0,-0.06 0.06,-0.11 0.14,-0.11l0.25 0 0 0.1\"></path>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1\" x2=\"1.2\" y2=\"0.82\"></line>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1.63\" x2=\"1.2\" y2=\"1.45\"></line>\r\n								</g>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								400 000$\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Минимальные инвестиции\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-limitation\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"74px\" height=\"58px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.96 2.32\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.48,0.64 2.48,2.24 0.08,2.24 0.08,0.64 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.32,0.4 2.72,0.4 2.72,2 \"></polyline>\r\n								<path class=\"fil0 str1\" d=\"M1.84 0.84l0 -0.84m-1.12 0.84l0 -0.84\"></path>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.19\" x2=\"0.56\" y2=\"1.19\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.43\" x2=\"0.56\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.43\" x2=\"0.88\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.43\" x2=\"1.2\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.43\" x2=\"1.52\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.43\" x2=\"1.84\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.63\" x2=\"0.56\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.63\" x2=\"0.88\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.63\" x2=\"1.2\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.63\" x2=\"1.52\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.63\" x2=\"1.84\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.83\" x2=\"0.56\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.83\" x2=\"0.88\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.83\" x2=\"1.2\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.83\" x2=\"1.52\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.83\" x2=\"1.84\" y2=\"1.83\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.52,0.2 2.92,0.2 2.92,1.8 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3-6 мес.\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок оформления\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-return\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"59px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 4.79 3.61\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<g id=\"_1267802140304\">\r\n								<path class=\"fil0 str0\" d=\"M1.7 2.21l0 0.16 0.41 0c0.12,0 0.22,-0.08 0.22,-0.18 0,-0.1 -0.1,-0.19 -0.22,-0.19l-0.24 0c-0.11,0 -0.21,-0.08 -0.21,-0.18 0,-0.1 0.1,-0.18 0.21,-0.18l0.42 0 0 0.16\"></path>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"1.64\" x2=\"2.02\" y2=\"1.34\"></line>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"2.67\" x2=\"2.02\" y2=\"2.37\"></line>\r\n								</g>\r\n								<line class=\"fil0 str1\" x1=\"0.17\" y1=\"1.03\" x2=\"3.82\" y2=\"1.03\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.72,0.49 0.17,1.03 0.72,1.58 \"></polyline>\r\n								<line class=\"fil0 str1\" x1=\"3.82\" y1=\"2.98\" x2=\"0.17\" y2=\"2.98\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"3.27,3.52 3.82,2.98 3.27,2.43 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.96,0.67 4.12,0.67 4.12,2.49 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.9,0.36 4.42,0.36 4.42,2.19 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"1.08,0.06 4.73,0.06 4.73,1.88 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3 года\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок возврата инвестиций\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>','<section class=\"citizenship container\">\r\n			<div class=\"citizenship__title title\">\r\n				Гражданство en\r\n			</div>\r\n			<div class=\"citizenship__subtitle\">\r\n				Мы предлагаем готовые стратегии инвестирования в зарубежную недвижимость \r\n			</div>\r\n			<div class=\"citizenship__content\">\r\n				<div class=\"citizenship__content-items\">\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-dollar\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"51px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.93 1.89\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.3,0.63 2.3,1.82 0.07,1.82 0.07,0.63 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.3,0.41 2.53,0.41 2.53,1.52 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.48,0.22 2.71,0.22 2.71,1.34 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.67,0.04 2.9,0.04 2.9,1.15 \"></polyline>\r\n								<g id=\"_2529166579488\">\r\n								<path class=\"fil0 str2\" d=\"M1.01 1.35l0 0.1 0.25 0c0.07,0 0.13,-0.05 0.13,-0.11 0,-0.06 -0.06,-0.11 -0.13,-0.11l-0.14 0c-0.08,0 -0.14,-0.05 -0.14,-0.12 0,-0.06 0.06,-0.11 0.14,-0.11l0.25 0 0 0.1\"></path>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1\" x2=\"1.2\" y2=\"0.82\"></line>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1.63\" x2=\"1.2\" y2=\"1.45\"></line>\r\n								</g>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								400 000$\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Минимальные инвестиции\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-limitation\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"74px\" height=\"58px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.96 2.32\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.48,0.64 2.48,2.24 0.08,2.24 0.08,0.64 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.32,0.4 2.72,0.4 2.72,2 \"></polyline>\r\n								<path class=\"fil0 str1\" d=\"M1.84 0.84l0 -0.84m-1.12 0.84l0 -0.84\"></path>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.19\" x2=\"0.56\" y2=\"1.19\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.43\" x2=\"0.56\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.43\" x2=\"0.88\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.43\" x2=\"1.2\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.43\" x2=\"1.52\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.43\" x2=\"1.84\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.63\" x2=\"0.56\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.63\" x2=\"0.88\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.63\" x2=\"1.2\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.63\" x2=\"1.52\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.63\" x2=\"1.84\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.83\" x2=\"0.56\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.83\" x2=\"0.88\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.83\" x2=\"1.2\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.83\" x2=\"1.52\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.83\" x2=\"1.84\" y2=\"1.83\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.52,0.2 2.92,0.2 2.92,1.8 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3-6 мес.\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок оформления\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-return\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"59px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 4.79 3.61\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<g id=\"_1267802140304\">\r\n								<path class=\"fil0 str0\" d=\"M1.7 2.21l0 0.16 0.41 0c0.12,0 0.22,-0.08 0.22,-0.18 0,-0.1 -0.1,-0.19 -0.22,-0.19l-0.24 0c-0.11,0 -0.21,-0.08 -0.21,-0.18 0,-0.1 0.1,-0.18 0.21,-0.18l0.42 0 0 0.16\"></path>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"1.64\" x2=\"2.02\" y2=\"1.34\"></line>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"2.67\" x2=\"2.02\" y2=\"2.37\"></line>\r\n								</g>\r\n								<line class=\"fil0 str1\" x1=\"0.17\" y1=\"1.03\" x2=\"3.82\" y2=\"1.03\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.72,0.49 0.17,1.03 0.72,1.58 \"></polyline>\r\n								<line class=\"fil0 str1\" x1=\"3.82\" y1=\"2.98\" x2=\"0.17\" y2=\"2.98\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"3.27,3.52 3.82,2.98 3.27,2.43 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.96,0.67 4.12,0.67 4.12,2.49 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.9,0.36 4.42,0.36 4.42,2.19 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"1.08,0.06 4.73,0.06 4.73,1.88 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3 года\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок возврата инвестиций\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>','<section class=\"citizenship container\">\r\n			<div class=\"citizenship__title title\">\r\n				Гражданство tr\r\n			</div>\r\n			<div class=\"citizenship__subtitle\">\r\n				Мы предлагаем готовые стратегии инвестирования в зарубежную недвижимость \r\n			</div>\r\n			<div class=\"citizenship__content\">\r\n				<div class=\"citizenship__content-items\">\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-dollar\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"51px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.93 1.89\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.3,0.63 2.3,1.82 0.07,1.82 0.07,0.63 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.3,0.41 2.53,0.41 2.53,1.52 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.48,0.22 2.71,0.22 2.71,1.34 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.67,0.04 2.9,0.04 2.9,1.15 \"></polyline>\r\n								<g id=\"_2529166579488\">\r\n								<path class=\"fil0 str2\" d=\"M1.01 1.35l0 0.1 0.25 0c0.07,0 0.13,-0.05 0.13,-0.11 0,-0.06 -0.06,-0.11 -0.13,-0.11l-0.14 0c-0.08,0 -0.14,-0.05 -0.14,-0.12 0,-0.06 0.06,-0.11 0.14,-0.11l0.25 0 0 0.1\"></path>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1\" x2=\"1.2\" y2=\"0.82\"></line>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1.63\" x2=\"1.2\" y2=\"1.45\"></line>\r\n								</g>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								400 000$\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Минимальные инвестиции\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-limitation\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"74px\" height=\"58px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.96 2.32\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.48,0.64 2.48,2.24 0.08,2.24 0.08,0.64 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.32,0.4 2.72,0.4 2.72,2 \"></polyline>\r\n								<path class=\"fil0 str1\" d=\"M1.84 0.84l0 -0.84m-1.12 0.84l0 -0.84\"></path>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.19\" x2=\"0.56\" y2=\"1.19\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.43\" x2=\"0.56\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.43\" x2=\"0.88\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.43\" x2=\"1.2\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.43\" x2=\"1.52\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.43\" x2=\"1.84\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.63\" x2=\"0.56\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.63\" x2=\"0.88\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.63\" x2=\"1.2\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.63\" x2=\"1.52\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.63\" x2=\"1.84\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.83\" x2=\"0.56\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.83\" x2=\"0.88\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.83\" x2=\"1.2\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.83\" x2=\"1.52\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.83\" x2=\"1.84\" y2=\"1.83\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.52,0.2 2.92,0.2 2.92,1.8 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3-6 мес.\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок оформления\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-return\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"59px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 4.79 3.61\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<g id=\"_1267802140304\">\r\n								<path class=\"fil0 str0\" d=\"M1.7 2.21l0 0.16 0.41 0c0.12,0 0.22,-0.08 0.22,-0.18 0,-0.1 -0.1,-0.19 -0.22,-0.19l-0.24 0c-0.11,0 -0.21,-0.08 -0.21,-0.18 0,-0.1 0.1,-0.18 0.21,-0.18l0.42 0 0 0.16\"></path>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"1.64\" x2=\"2.02\" y2=\"1.34\"></line>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"2.67\" x2=\"2.02\" y2=\"2.37\"></line>\r\n								</g>\r\n								<line class=\"fil0 str1\" x1=\"0.17\" y1=\"1.03\" x2=\"3.82\" y2=\"1.03\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.72,0.49 0.17,1.03 0.72,1.58 \"></polyline>\r\n								<line class=\"fil0 str1\" x1=\"3.82\" y1=\"2.98\" x2=\"0.17\" y2=\"2.98\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"3.27,3.52 3.82,2.98 3.27,2.43 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.96,0.67 4.12,0.67 4.12,2.49 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.9,0.36 4.42,0.36 4.42,2.19 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"1.08,0.06 4.73,0.06 4.73,1.88 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3 года\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок возврата инвестиций\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>',NULL,'2023-06-09 16:05:30','2023-06-18 14:20:42'),(30,NULL,'Анталия','Antalya','Antalya',17,'1687111662.png','36.90812','30.69556',NULL,NULL,NULL,NULL,'2023-06-18 14:07:42','2023-06-18 14:08:35'),(31,NULL,'Мухмутлар','Muhmutlar','Muhmutlar',17,'1687111857.png','41.01384','28.94966',NULL,NULL,NULL,NULL,'2023-06-18 14:10:57','2023-06-18 14:10:57'),(32,NULL,'Фетхие','Fethiye','Fethiye',17,'1687111944.png','36.62167','29.11639',NULL,NULL,NULL,NULL,'2023-06-18 14:12:24','2023-06-18 14:12:24'),(33,NULL,'Алания','Alanya','Alanya',17,'1687112018.png','36.54375','31.99982',NULL,NULL,NULL,NULL,'2023-06-18 14:13:38','2023-06-18 14:13:38'),(34,NULL,'Кемер','Kemer','Kemer',17,'1687112070.png','36.59778','30.56056',NULL,NULL,NULL,NULL,'2023-06-18 14:14:30','2023-06-18 14:14:30'),(35,NULL,'Стамбул','İstanbul','İstanbul',17,'1687112141.png','41.01384','28.94966',NULL,NULL,NULL,NULL,'2023-06-18 14:15:41','2023-06-18 14:15:41'),(36,NULL,'Бодрум','Bodrum','Bodrum',17,'1687112198.png','37.03833','27.42917',NULL,NULL,NULL,NULL,'2023-06-18 14:16:38','2023-06-18 14:16:38'),(38,'1','Греция','Greece','Yunanistan',NULL,'1687112626.png','39.074208','21.824312','<section class=\"citizenship container\">\r\n			<div class=\"citizenship__title title\">\r\n				Гражданство\r\n			</div>\r\n			<div class=\"citizenship__subtitle\">\r\n				Мы предлагаем готовые стратегии инвестирования в зарубежную недвижимость \r\n			</div>\r\n			<div class=\"citizenship__content\">\r\n				<div class=\"citizenship__content-items\">\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-dollar\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"51px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.93 1.89\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.3,0.63 2.3,1.82 0.07,1.82 0.07,0.63 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.3,0.41 2.53,0.41 2.53,1.52 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.48,0.22 2.71,0.22 2.71,1.34 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.67,0.04 2.9,0.04 2.9,1.15 \"></polyline>\r\n								<g id=\"_2529166579488\">\r\n								<path class=\"fil0 str2\" d=\"M1.01 1.35l0 0.1 0.25 0c0.07,0 0.13,-0.05 0.13,-0.11 0,-0.06 -0.06,-0.11 -0.13,-0.11l-0.14 0c-0.08,0 -0.14,-0.05 -0.14,-0.12 0,-0.06 0.06,-0.11 0.14,-0.11l0.25 0 0 0.1\"></path>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1\" x2=\"1.2\" y2=\"0.82\"></line>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1.63\" x2=\"1.2\" y2=\"1.45\"></line>\r\n								</g>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								400 000$\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Минимальные инвестиции\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-limitation\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"74px\" height=\"58px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.96 2.32\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.48,0.64 2.48,2.24 0.08,2.24 0.08,0.64 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.32,0.4 2.72,0.4 2.72,2 \"></polyline>\r\n								<path class=\"fil0 str1\" d=\"M1.84 0.84l0 -0.84m-1.12 0.84l0 -0.84\"></path>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.19\" x2=\"0.56\" y2=\"1.19\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.43\" x2=\"0.56\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.43\" x2=\"0.88\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.43\" x2=\"1.2\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.43\" x2=\"1.52\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.43\" x2=\"1.84\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.63\" x2=\"0.56\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.63\" x2=\"0.88\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.63\" x2=\"1.2\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.63\" x2=\"1.52\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.63\" x2=\"1.84\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.83\" x2=\"0.56\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.83\" x2=\"0.88\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.83\" x2=\"1.2\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.83\" x2=\"1.52\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.83\" x2=\"1.84\" y2=\"1.83\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.52,0.2 2.92,0.2 2.92,1.8 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3-6 мес.\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок оформления\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-return\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"59px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 4.79 3.61\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<g id=\"_1267802140304\">\r\n								<path class=\"fil0 str0\" d=\"M1.7 2.21l0 0.16 0.41 0c0.12,0 0.22,-0.08 0.22,-0.18 0,-0.1 -0.1,-0.19 -0.22,-0.19l-0.24 0c-0.11,0 -0.21,-0.08 -0.21,-0.18 0,-0.1 0.1,-0.18 0.21,-0.18l0.42 0 0 0.16\"></path>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"1.64\" x2=\"2.02\" y2=\"1.34\"></line>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"2.67\" x2=\"2.02\" y2=\"2.37\"></line>\r\n								</g>\r\n								<line class=\"fil0 str1\" x1=\"0.17\" y1=\"1.03\" x2=\"3.82\" y2=\"1.03\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.72,0.49 0.17,1.03 0.72,1.58 \"></polyline>\r\n								<line class=\"fil0 str1\" x1=\"3.82\" y1=\"2.98\" x2=\"0.17\" y2=\"2.98\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"3.27,3.52 3.82,2.98 3.27,2.43 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.96,0.67 4.12,0.67 4.12,2.49 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.9,0.36 4.42,0.36 4.42,2.19 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"1.08,0.06 4.73,0.06 4.73,1.88 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3 года\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок возврата инвестиций\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>',NULL,NULL,NULL,'2023-06-18 14:23:46','2023-06-18 14:23:46'),(39,'1','Черногория','Montenegro','Karadağ',NULL,'1687112803.png','42.708678','19.37439','<section class=\"citizenship container\">\r\n			<div class=\"citizenship__title title\">\r\n				Гражданство\r\n			</div>\r\n			<div class=\"citizenship__subtitle\">\r\n				Мы предлагаем готовые стратегии инвестирования в зарубежную недвижимость \r\n			</div>\r\n			<div class=\"citizenship__content\">\r\n				<div class=\"citizenship__content-items\">\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-dollar\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"51px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.93 1.89\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.3,0.63 2.3,1.82 0.07,1.82 0.07,0.63 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.3,0.41 2.53,0.41 2.53,1.52 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.48,0.22 2.71,0.22 2.71,1.34 \"></polyline>\r\n								<polyline class=\"fil0 str1\" points=\"0.67,0.04 2.9,0.04 2.9,1.15 \"></polyline>\r\n								<g id=\"_2529166579488\">\r\n								<path class=\"fil0 str2\" d=\"M1.01 1.35l0 0.1 0.25 0c0.07,0 0.13,-0.05 0.13,-0.11 0,-0.06 -0.06,-0.11 -0.13,-0.11l-0.14 0c-0.08,0 -0.14,-0.05 -0.14,-0.12 0,-0.06 0.06,-0.11 0.14,-0.11l0.25 0 0 0.1\"></path>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1\" x2=\"1.2\" y2=\"0.82\"></line>\r\n								<line class=\"fil0 str2\" x1=\"1.2\" y1=\"1.63\" x2=\"1.2\" y2=\"1.45\"></line>\r\n								</g>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								400 000$\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Минимальные инвестиции\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-limitation\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"74px\" height=\"58px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 2.96 2.32\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<polygon class=\"fil0 str0\" points=\"2.48,0.64 2.48,2.24 0.08,2.24 0.08,0.64 \"></polygon>\r\n								<polyline class=\"fil0 str1\" points=\"0.32,0.4 2.72,0.4 2.72,2 \"></polyline>\r\n								<path class=\"fil0 str1\" d=\"M1.84 0.84l0 -0.84m-1.12 0.84l0 -0.84\"></path>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.19\" x2=\"0.56\" y2=\"1.19\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.43\" x2=\"0.56\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.43\" x2=\"0.88\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.43\" x2=\"1.2\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.43\" x2=\"1.52\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.43\" x2=\"1.84\" y2=\"1.43\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.63\" x2=\"0.56\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.63\" x2=\"0.88\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.63\" x2=\"1.2\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.63\" x2=\"1.52\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.63\" x2=\"1.84\" y2=\"1.63\"></line>\r\n								<line class=\"fil0 str1\" x1=\"0.72\" y1=\"1.83\" x2=\"0.56\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.04\" y1=\"1.83\" x2=\"0.88\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.36\" y1=\"1.83\" x2=\"1.2\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"1.68\" y1=\"1.83\" x2=\"1.52\" y2=\"1.83\"></line>\r\n								<line class=\"fil0 str1\" x1=\"2\" y1=\"1.83\" x2=\"1.84\" y2=\"1.83\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.52,0.2 2.92,0.2 2.92,1.8 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3-6 мес.\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок оформления\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"citizenship__content-item\">\r\n						<div class=\"citizenship__item-img citizenship__item-return\">\r\n							<svg xmlns=\"http://www.w3.org/2000/svg\" xml:space=\"preserve\" width=\"79px\" height=\"59px\" version=\"1.1\" style=\"shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd\" viewBox=\"0 0 4.79 3.61\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\r\n								<g id=\"Слой_x0020_1\">\r\n								<metadata id=\"CorelCorpID_0Corel-Layer\"></metadata>\r\n								<g id=\"_1267802140304\">\r\n								<path class=\"fil0 str0\" d=\"M1.7 2.21l0 0.16 0.41 0c0.12,0 0.22,-0.08 0.22,-0.18 0,-0.1 -0.1,-0.19 -0.22,-0.19l-0.24 0c-0.11,0 -0.21,-0.08 -0.21,-0.18 0,-0.1 0.1,-0.18 0.21,-0.18l0.42 0 0 0.16\"></path>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"1.64\" x2=\"2.02\" y2=\"1.34\"></line>\r\n								<line class=\"fil0 str0\" x1=\"2.02\" y1=\"2.67\" x2=\"2.02\" y2=\"2.37\"></line>\r\n								</g>\r\n								<line class=\"fil0 str1\" x1=\"0.17\" y1=\"1.03\" x2=\"3.82\" y2=\"1.03\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"0.72,0.49 0.17,1.03 0.72,1.58 \"></polyline>\r\n								<line class=\"fil0 str1\" x1=\"3.82\" y1=\"2.98\" x2=\"0.17\" y2=\"2.98\"></line>\r\n								<polyline class=\"fil0 str1\" points=\"3.27,3.52 3.82,2.98 3.27,2.43 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.96,0.67 4.12,0.67 4.12,2.49 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"0.9,0.36 4.42,0.36 4.42,2.19 \"></polyline>\r\n								<polyline class=\"fil0 str2\" points=\"1.08,0.06 4.73,0.06 4.73,1.88 \"></polyline>\r\n								</g>\r\n							</svg>\r\n						</div>\r\n						<div class=\"citizenship__item-text\">\r\n							<div class=\"citizenship__item-title\">\r\n								3 года\r\n							</div>\r\n							<div class=\"citizenship__item-subtitle\">\r\n								Срок возврата инвестиций\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>',NULL,NULL,NULL,'2023-06-18 14:26:43','2023-06-18 14:27:12');
/*!40000 ALTER TABLE `country_and_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_product_id_foreign` (`product_id`),
  CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (107,1689604499,12,'2023-07-19 08:02:00','2023-07-19 08:02:00'),(108,1689604499,11,'2023-07-19 08:02:01','2023-07-19 08:02:01'),(109,1689604499,13,'2023-07-19 08:02:02','2023-07-19 08:02:02');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invest_pages`
--

DROP TABLE IF EXISTS `invest_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invest_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_header` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_tr` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `invest_pages_chk_1` CHECK (json_valid(`content`))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invest_pages`
--

LOCK TABLES `invest_pages` WRITE;
/*!40000 ALTER TABLE `invest_pages` DISABLE KEYS */;
INSERT INTO `invest_pages` VALUES (1,NULL,'\"<p>hello<\\/p>\"',NULL,NULL,'2023-07-04 04:49:12','2023-07-04 08:40:47');
/*!40000 ALTER TABLE `invest_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kurs`
--

DROP TABLE IF EXISTS `kurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kurs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rub` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lira` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kurs`
--

LOCK TABLES `kurs` WRITE;
/*!40000 ALTER TABLE `kurs` DISABLE KEYS */;
INSERT INTO `kurs` VALUES (1,'0.011','25.71',NULL,'2023-06-13 01:58:37');
/*!40000 ALTER TABLE `kurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metrics`
--

DROP TABLE IF EXISTS `metrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metrics`
--

LOCK TABLES `metrics` WRITE;
/*!40000 ALTER TABLE `metrics` DISABLE KEYS */;
INSERT INTO `metrics` VALUES (1,'Европа','2023-06-12 02:37:08','2023-06-12 02:37:08'),(2,'Азия','2023-06-12 02:37:08','2023-06-12 02:37:08'),(3,'Африка','2023-06-12 02:37:08','2023-06-12 02:37:08'),(4,'Северная Америка','2023-06-12 02:37:08','2023-06-12 02:37:08'),(5,'Южная Америка','2023-06-12 02:37:08','2023-06-12 02:37:08'),(6,'Австралия','2023-06-12 02:37:08','2023-06-12 02:37:08'),(7,'Антарктида','2023-06-12 02:37:08','2023-06-12 02:37:08');
/*!40000 ALTER TABLE `metrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_06_06_144019_create_country_and_cities_table',2),(6,'2023_06_07_124641_create_peculiarities_table',3),(7,'2023_06_08_061340_create_products_table',4),(8,'2023_06_08_061351_create_product_categories_table',4),(9,'2023_06_08_061433_create_photo_tables_table',4),(10,'2023_06_12_063320_create_metrics_table',5),(11,'2023_06_12_102934_create_kurs_table',6),(12,'2023_06_15_135907_create_citizenship_divs_table',7),(13,'2023_07_03_052448_create_invest_pages_table',8),(14,'2023_07_04_115840_create_vng_and_grjs_table',9),(15,'2023_07_06_063054_create_rasrochkas_table',10),(16,'2023_07_06_070327_create_contacts_table',11),(17,'2023_07_06_083824_create_company_selects_table',12),(18,'2023_07_06_113732_create_policy_and_privices_table',13),(20,'2023_07_12_102615_create_requests_table',14),(21,'2023_07_17_103843_create_favorites_table',15),(22,'2023_07_27_134018_create_product_drawings_table',16);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peculiarities`
--

DROP TABLE IF EXISTS `peculiarities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peculiarities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peculiarities`
--

LOCK TABLES `peculiarities` WRITE;
/*!40000 ALTER TABLE `peculiarities` DISABLE KEYS */;
INSERT INTO `peculiarities` VALUES (2,'Квартиры, апартаменты','Типы',NULL,'2023-06-07 10:53:20','2023-06-07 10:53:20'),(4,'Новостройки','Типы',NULL,'2023-06-07 10:25:17','2023-06-07 10:25:17'),(5,'Пентхаусы','Типы',NULL,'2023-06-07 10:25:24','2023-06-07 10:25:24'),(6,'Дома. виллы, коттеджи','Типы',NULL,'2023-06-07 10:25:28','2023-06-07 10:25:28'),(7,'Замки','Типы',NULL,'2023-06-07 10:25:58','2023-06-07 10:25:58'),(8,'Шале','Типы',NULL,'2023-06-07 10:26:04','2023-06-07 10:26:04'),(9,'Таунхаусы','Типы',NULL,'2023-06-07 10:26:08','2023-06-07 10:26:08'),(10,'1+','Спальни',NULL,'2023-06-07 10:26:23','2023-06-07 10:26:23'),(11,'2+','Спальни',NULL,'2023-06-07 10:26:31','2023-06-07 10:26:31'),(12,'3+','Спальни',NULL,'2023-06-07 10:26:34','2023-06-07 10:26:34'),(13,'4+','Спальни',NULL,'2023-06-07 10:26:37','2023-06-07 10:26:37'),(14,'Неважно','Спальни',NULL,'2023-06-07 10:26:48','2023-06-07 10:26:48'),(15,'1+','Ванные',NULL,'2023-06-07 10:27:01','2023-06-07 10:27:01'),(16,'2+','Ванные',NULL,'2023-06-07 10:27:03','2023-06-07 10:27:03'),(17,'3+','Ванные',NULL,'2023-06-07 10:27:06','2023-06-07 10:27:06'),(18,'4+','Ванные',NULL,'2023-06-07 10:27:08','2023-06-07 10:27:08'),(19,'Неважно','Ванные',NULL,'2023-06-07 10:27:14','2023-06-07 10:27:14'),(20,'ТВ','Особенности',NULL,'2023-06-07 10:27:27','2023-06-07 10:27:27'),(21,'Терраса','Особенности',NULL,'2023-06-07 10:27:32','2023-06-07 10:27:32'),(22,'Бассейн','Особенности',NULL,'2023-06-07 10:27:37','2023-06-07 10:27:37'),(23,'Балкон','Особенности',NULL,'2023-06-07 10:27:42','2023-06-07 10:27:42'),(24,'Интернет','Особенности',NULL,'2023-06-07 10:27:48','2023-06-07 10:27:48'),(25,'Пляж','Особенности',NULL,'2023-06-07 10:27:58','2023-06-07 10:27:58'),(26,'Мебель','Особенности',NULL,'2023-06-07 10:28:03','2023-06-07 10:28:03'),(27,'Парковка','Особенности',NULL,'2023-06-07 10:28:08','2023-06-07 10:28:08'),(28,'Сад','Особенности',NULL,'2023-06-07 10:28:13','2023-06-07 10:28:13'),(29,'Горы','Вид',NULL,'2023-06-07 10:28:24','2023-06-07 10:28:24'),(30,'Озеро','Вид',NULL,'2023-06-07 10:28:30','2023-06-07 10:28:30'),(31,'Горы','Вид',NULL,'2023-06-07 10:28:39','2023-06-07 10:28:39'),(32,'Лес','Вид',NULL,'2023-06-07 10:28:44','2023-06-07 10:28:44'),(33,'Первая линия','До моря',NULL,'2023-06-07 10:28:55','2023-06-07 10:28:55'),(34,'До 500 м','До моря',NULL,'2023-06-07 10:29:03','2023-06-07 10:29:03'),(35,'До 1 км','До моря',NULL,'2023-06-07 10:29:09','2023-06-07 10:29:09'),(36,'До 2 км','До моря',NULL,'2023-06-07 10:29:14','2023-06-07 10:29:14'),(348,'3+','Гостиные',NULL,'2023-06-08 07:40:11','2023-06-08 07:40:11'),(349,'1+','Гостиные',NULL,'2023-06-08 08:25:48','2023-06-08 08:25:48'),(350,'2+','Гостиные',NULL,'2023-06-08 08:25:51','2023-06-08 08:25:51');
/*!40000 ALTER TABLE `peculiarities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo_tables`
--

DROP TABLE IF EXISTS `photo_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photo_tables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo_tables`
--

LOCK TABLES `photo_tables` WRITE;
/*!40000 ALTER TABLE `photo_tables` DISABLE KEYS */;
INSERT INTO `photo_tables` VALUES (9,'\\App\\Models\\Product','6','1686297564.png','2023-06-09 03:59:24','2023-06-09 03:59:24'),(11,'\\App\\Models\\Product','6','1686297564.png','2023-06-09 03:59:24','2023-06-09 03:59:24'),(12,'\\App\\Models\\Product','6','1686297564.png','2023-06-09 03:59:24','2023-06-09 03:59:24'),(22,'\\App\\Models\\Product','7','1686315312.png','2023-06-09 08:55:12','2023-06-09 08:55:12'),(23,'\\App\\Models\\Product','7','1686315313.png','2023-06-09 08:55:12','2023-06-09 08:55:12'),(24,'\\App\\Models\\Product','7','1686315314.png','2023-06-09 08:55:12','2023-06-09 08:55:12'),(25,'\\App\\Models\\Product','8','1686317439.png','2023-06-09 09:30:39','2023-06-09 09:30:39'),(26,'\\App\\Models\\Product','8','1686317440.png','2023-06-09 09:30:39','2023-06-09 09:30:39'),(27,'\\App\\Models\\Product','8','1686317441.png','2023-06-09 09:30:39','2023-06-09 09:30:39'),(28,'\\App\\Models\\Product','9','1686317633.png','2023-06-09 09:33:53','2023-06-09 09:33:53'),(29,'\\App\\Models\\Product','9','1686317634.png','2023-06-09 09:33:53','2023-06-09 09:33:53'),(30,'\\App\\Models\\Product','9','1686317635.png','2023-06-09 09:33:53','2023-06-09 09:33:53'),(31,'\\App\\Models\\Product','10','1686317883.png','2023-06-09 09:38:03','2023-06-09 09:38:03'),(32,'\\App\\Models\\Product','11','1686318614.png','2023-06-09 09:50:14','2023-06-09 09:50:14'),(33,'\\App\\Models\\Product','11','1686318615.png','2023-06-09 09:50:14','2023-06-09 09:50:14'),(34,'\\App\\Models\\Product','11','1686318616.png','2023-06-09 09:50:14','2023-06-09 09:50:14'),(35,'\\App\\Models\\Product','11','1686318617.png','2023-06-09 09:50:14','2023-06-09 09:50:14'),(36,'\\App\\Models\\Product','12','1687113072.png','2023-06-18 14:31:12','2023-06-18 14:31:12'),(37,'\\App\\Models\\Product','12','1687113073.png','2023-06-18 14:31:12','2023-06-18 14:31:12'),(38,'\\App\\Models\\Product','12','1687113074.png','2023-06-18 14:31:12','2023-06-18 14:31:12'),(39,'\\App\\Models\\Product','12','1687113075.png','2023-06-18 14:31:12','2023-06-18 14:31:12'),(40,'\\App\\Models\\Product','12','1687113076.png','2023-06-18 14:31:12','2023-06-18 14:31:12'),(41,'\\App\\Models\\Product','13','1687113522.jpeg','2023-06-18 14:38:42','2023-06-18 14:38:42'),(42,'\\App\\Models\\Product','13','1687113523.jpeg','2023-06-18 14:38:42','2023-06-18 14:38:42'),(43,'\\App\\Models\\Product','13','1687113524.jpeg','2023-06-18 14:38:42','2023-06-18 14:38:42'),(44,'\\App\\Models\\Product','13','1687113525.jpeg','2023-06-18 14:38:42','2023-06-18 14:38:42'),(45,'\\App\\Models\\Product','13','1687113526.jpeg','2023-06-18 14:38:42','2023-06-18 14:38:42'),(46,'\\App\\Models\\Product','14','1690465743.jpg','2023-07-27 13:49:03','2023-07-27 13:49:03'),(47,'\\App\\Models\\Product','14','1690465744.jpg','2023-07-27 13:49:03','2023-07-27 13:49:03');
/*!40000 ALTER TABLE `photo_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policy_and_privices`
--

DROP TABLE IF EXISTS `policy_and_privices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `policy_and_privices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `police_content` json DEFAULT NULL,
  `police_content_en` longtext COLLATE utf8mb4_unicode_ci,
  `police_content_tr` longtext COLLATE utf8mb4_unicode_ci,
  `privice_content` json DEFAULT NULL,
  `privice_content_en` longtext COLLATE utf8mb4_unicode_ci,
  `privice_content_tr` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policy_and_privices`
--

LOCK TABLES `policy_and_privices` WRITE;
/*!40000 ALTER TABLE `policy_and_privices` DISABLE KEYS */;
INSERT INTO `policy_and_privices` VALUES (1,'\"<p><a class=\\\"footer__subtitle\\\" href=\\\"../company_page/page_id=6\\\">Пользовательское соглашение при использовании сайта</a></p>\"','\"<p>en<\\/p>\"','\"<p>tr<\\/p>\"','\"<h4 class=\\\"card-title\\\">Политика Обработки Персональных Данных</h4>\\r\\n<form class=\\\"forms-sample\\\" action=\\\"https://dev.one-team.pro/admin/privice_create\\\" enctype=\\\"multipart/form-data\\\" method=\\\"post\\\">\\r\\n<div class=\\\"tox tox-tinymce\\\" role=\\\"application\\\" aria-disabled=\\\"false\\\">\\r\\n<div class=\\\"tox-editor-container\\\">\\r\\n<div class=\\\"tox-editor-header\\\" data-alloy-vertical-dir=\\\"toptobottom\\\">\\r\\n<div class=\\\"tox-promotion\\\">&nbsp;</div>\\r\\n</div>\\r\\n</div>\\r\\n</div>\\r\\n</form>\"','\"<p>en<\\/p>\"','\"<p>tr<\\/p>\"','2023-07-07 05:15:14','2023-07-10 14:05:43');
/*!40000 ALTER TABLE `policy_and_privices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `peculiarities_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_categories_product_id_foreign` (`product_id`),
  KEY `product_categories_peculiarities_id_foreign` (`peculiarities_id`),
  CONSTRAINT `product_categories_peculiarities_id_foreign` FOREIGN KEY (`peculiarities_id`) REFERENCES `peculiarities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=617 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (151,7,21,'2023-06-09 08:56:14','2023-06-09 08:56:14','Особенности'),(152,7,20,'2023-06-09 08:56:14','2023-06-09 08:56:14','Особенности'),(153,7,22,'2023-06-09 08:56:14','2023-06-09 08:56:14','Особенности'),(154,7,23,'2023-06-09 08:56:14','2023-06-09 08:56:14','Особенности'),(155,7,25,'2023-06-09 08:56:14','2023-06-09 08:56:14','Особенности'),(156,7,31,'2023-06-09 08:56:14','2023-06-09 08:56:14','Вид'),(157,7,34,'2023-06-09 08:56:14','2023-06-09 08:56:14','До моря'),(158,7,13,'2023-06-09 08:56:14','2023-06-09 08:56:14','Спальни'),(159,7,15,'2023-06-09 08:56:14','2023-06-09 08:56:14','Ванные'),(160,7,349,'2023-06-09 08:56:14','2023-06-09 08:56:14','Гостиные'),(169,8,21,'2023-06-09 09:30:46','2023-06-09 09:30:46','Особенности'),(170,8,22,'2023-06-09 09:30:46','2023-06-09 09:30:46','Особенности'),(171,8,29,'2023-06-09 09:30:46','2023-06-09 09:30:46','Вид'),(172,8,33,'2023-06-09 09:30:46','2023-06-09 09:30:46','До моря'),(173,8,10,'2023-06-09 09:30:46','2023-06-09 09:30:46','Спальни'),(174,8,15,'2023-06-09 09:30:46','2023-06-09 09:30:46','Ванные'),(175,8,348,'2023-06-09 09:30:46','2023-06-09 09:30:46','Гостиные'),(192,9,22,'2023-06-09 09:35:22','2023-06-09 09:35:22','Особенности'),(193,9,23,'2023-06-09 09:35:22','2023-06-09 09:35:22','Особенности'),(194,9,29,'2023-06-09 09:35:22','2023-06-09 09:35:22','Вид'),(195,9,33,'2023-06-09 09:35:22','2023-06-09 09:35:22','До моря'),(196,9,10,'2023-06-09 09:35:22','2023-06-09 09:35:22','Спальни'),(197,9,15,'2023-06-09 09:35:22','2023-06-09 09:35:22','Ванные'),(198,9,348,'2023-06-09 09:35:22','2023-06-09 09:35:22','Гостиные'),(419,12,22,'2023-06-19 06:24:30','2023-06-19 06:24:30','Особенности'),(420,12,30,'2023-06-19 06:24:30','2023-06-19 06:24:30','Вид'),(421,12,35,'2023-06-19 06:24:30','2023-06-19 06:24:30','До моря'),(422,12,12,'2023-06-19 06:24:30','2023-06-19 06:24:30','Спальни'),(423,12,16,'2023-06-19 06:24:30','2023-06-19 06:24:30','Ванные'),(424,12,349,'2023-06-19 06:24:30','2023-06-19 06:24:30','Гостиные'),(425,12,6,'2023-06-19 06:24:30','2023-06-19 06:24:30','Типы'),(468,13,22,'2023-06-26 09:58:04','2023-06-26 09:58:04','Особенности'),(469,13,31,'2023-06-26 09:58:04','2023-06-26 09:58:04','Вид'),(470,13,35,'2023-06-26 09:58:04','2023-06-26 09:58:04','До моря'),(471,13,12,'2023-06-26 09:58:04','2023-06-26 09:58:04','Спальни'),(472,13,15,'2023-06-26 09:58:04','2023-06-26 09:58:04','Ванные'),(473,13,349,'2023-06-26 09:58:04','2023-06-26 09:58:04','Гостиные'),(474,13,6,'2023-06-26 09:58:04','2023-06-26 09:58:04','Типы'),(508,11,20,'2023-06-28 04:56:53','2023-06-28 04:56:53','Особенности'),(509,11,21,'2023-06-28 04:56:53','2023-06-28 04:56:53','Особенности'),(510,11,22,'2023-06-28 04:56:53','2023-06-28 04:56:53','Особенности'),(511,11,26,'2023-06-28 04:56:53','2023-06-28 04:56:53','Особенности'),(512,11,27,'2023-06-28 04:56:53','2023-06-28 04:56:53','Особенности'),(513,11,30,'2023-06-28 04:56:53','2023-06-28 04:56:53','Вид'),(514,11,35,'2023-06-28 04:56:53','2023-06-28 04:56:53','До моря'),(515,11,12,'2023-06-28 04:56:53','2023-06-28 04:56:53','Спальни'),(516,11,16,'2023-06-28 04:56:53','2023-06-28 04:56:53','Ванные'),(517,11,349,'2023-06-28 04:56:53','2023-06-28 04:56:53','Гостиные'),(518,11,2,'2023-06-28 04:56:53','2023-06-28 04:56:53','Типы'),(610,14,21,'2023-07-27 14:13:52','2023-07-27 14:13:52','Особенности'),(611,14,29,'2023-07-27 14:13:52','2023-07-27 14:13:52','Вид'),(612,14,33,'2023-07-27 14:13:52','2023-07-27 14:13:52','До моря'),(613,14,10,'2023-07-27 14:13:52','2023-07-27 14:13:52','Спальни'),(614,14,15,'2023-07-27 14:13:52','2023-07-27 14:13:52','Ванные'),(615,14,348,'2023-07-27 14:13:52','2023-07-27 14:13:52','Гостиные'),(616,14,2,'2023-07-27 14:13:52','2023-07-27 14:13:52','Типы');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_drawings`
--

DROP TABLE IF EXISTS `product_drawings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_drawings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_drawings_product_id_foreign` (`product_id`),
  CONSTRAINT `product_drawings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_drawings`
--

LOCK TABLES `product_drawings` WRITE;
/*!40000 ALTER TABLE `product_drawings` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_drawings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_or_rent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_home` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `description_en` longtext COLLATE utf8mb4_unicode_ci,
  `description_tr` longtext COLLATE utf8mb4_unicode_ci,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citizenship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disposition` longtext COLLATE utf8mb4_unicode_ci,
  `disposition_en` longtext COLLATE utf8mb4_unicode_ci,
  `disposition_tr` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commissions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cryptocurrency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grajandstvo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complex_or_not` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (6,NULL,NULL,NULL,'Balbey, 431. Sk. No:4, 07040 Muratpaşa','Balbey, 431. Sk. No:4, 07040 Muratpaşa','1250','500',325,'Описание на Русском\r\nОписание на Русском\r\nОписание на Русском','Описание на Англиском\r\nОписание на Англиском\r\nОписание на Англиском','Описание на ТурецкомОписание на ТурецкомОписание на ТурецкомОписание на ТурецкомОписание на Турецком','30.70762736931459','36.89084813973061',NULL,NULL,'Расположения на Русском\r\nРасположения на Русском\r\nРасположения на Русском\r\nРасположения на Русском','Расположения на АнглискомРасположения на Англиском\r\nРасположения на Англиском\r\nРасположения на Англиском','Расположения на ТурецкомРасположения на Турецком\r\nРасположения на Турецком\r\nРасположения на Турецком','2023-06-09 03:59:24','2023-06-09 08:44:41','Да','Нет','Да','Да','Застройщик',NULL,NULL),(7,NULL,NULL,NULL,'Дом у моря','152','125','1111',100000,'Описание на РусскомОписание на РусскомОписание на РусскомОписание на Русском','Описание на АнглискомОписание на АнглискомОписание на АнглискомОписание на Англиском','Описание на ТурецкомОписание на ТурецкомОписание на ТурецкомОписание на ТурецкомОписание на Турецком','5646854654','654564654',NULL,NULL,'Расположения на РусскомРасположения на РусскомРасположения на РусскомРасположения на Русском','Расположения на АнглискомРасположения на АнглискомРасположения на АнглискомРасположения на Англиском','Расположения на ТурецкомРасположения на ТурецкомРасположения на ТурецкомРасположения на Турецком','2023-06-09 04:11:41','2023-06-09 08:56:14','Да','Нет','Нет','Да','Владелец',NULL,NULL),(8,NULL,NULL,NULL,'test','qwjoi','11','2',1,'123','123','123','1231','213',NULL,NULL,'123123','123','123','2023-06-09 09:30:39','2023-06-09 09:30:46','Да','Да','Да','Да','Застройщик',NULL,NULL),(9,NULL,'10',NULL,'test','awsid','wqpeop','wqi[po',123,'qwdoi','qwasoid','idasoi','12323','2312',NULL,NULL,'sodi','qwie-qw','iwqedi','2023-06-09 09:33:53','2023-06-09 09:37:35','Да','Да','Да','Да','Застройщик',NULL,NULL),(11,'17','30','sale','Balbey, 431. Sk. No:4, 07040 Muratpaşa','Balbey, 431. Sk. No:4, 07040 Muratpaşa','1250','500',350000,'Описание на РусскомОписание на РусскомОписание на Русском','Описание на АнглискомОписание на АнглискомОписание на Англиском','Описание на ТурецкомОписание на ТурецкомОписание на ТурецкомОписание на Турецком','30.707758','36.890808',NULL,NULL,'Расположения на РусскомРасположения на РусскомРасположения на РусскомРасположения на Русском','Расположения на АнглискомРасположения на АнглискомРасположения на Англиском','Расположения на ТурецкомРасположения на ТурецкомРасположения на Турецком','2023-06-09 09:50:14','2023-06-28 04:56:53','Да','Да','Да','Да','Владелец','Да',NULL),(12,'17','35','sale','Название','Balbey, 431. Sk. No:4, 07040 Muratpaşa','200','400',50000,'Описание на Русском','Описание на Англиском','Описание на Турецком','41.01384','28.979530',NULL,NULL,'Расположения на Русском','Расположения на Англиском','Расположения на Турецком','2023-06-18 14:31:12','2023-06-19 06:24:30','Да','Да','Да','Да','Застройщик','Да',NULL),(13,'17','35','sale','Уютная вилла в современном комплексе','Balbey, 431. Sk. No:4, 07040 Muratpaşa','400','800',345000,'Описание на Русском','Описание на Англиском','Описание на Турецком','41.01384','30.69556',NULL,NULL,'Расположения на Русском','Расположения на Англиском','Расположения на Турецком','2023-06-18 14:38:42','2023-06-26 09:58:04','Нет','Нет','Да','Да','Застройщик','Да',NULL),(14,'17','30','sale','124124','123124','23423','234234',124124,'23443','234234','23423423','234234','234234',NULL,NULL,'234234','234','234','2023-07-27 13:49:03','2023-07-27 14:13:52','Да','Да','Да','Да','Застройщик','Да','Да');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rasrochkas`
--

DROP TABLE IF EXISTS `rasrochkas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rasrochkas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` json DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_tr` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rasrochkas`
--

LOCK TABLES `rasrochkas` WRITE;
/*!40000 ALTER TABLE `rasrochkas` DISABLE KEYS */;
INSERT INTO `rasrochkas` VALUES (1,NULL,'\"<p>rasrochka</p>\"','\"<p>en<\\/p>\"','\"<p>tr<\\/p>\"','2023-07-06 06:51:08','2023-07-10 14:09:45');
/*!40000 ALTER TABLE `rasrochkas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fio` longtext COLLATE utf8mb4_unicode_ci,
  `product_id` bigint unsigned DEFAULT NULL,
  `messenger` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requests_product_id_foreign` (`product_id`),
  CONSTRAINT `requests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (1,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 12:12:48','2023-07-12 12:12:48'),(2,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 12:12:54','2023-07-12 12:12:54'),(3,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 12:17:51','2023-07-12 12:17:51'),(4,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 12:21:07','2023-07-12 12:21:07'),(5,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-23',NULL,'1','2023-07-12 12:21:16','2023-07-12 12:21:16'),(6,NULL,NULL,'WhatsApp','Россия (Russia)','+7(435) 634-63-46',NULL,'1','2023-07-12 12:23:21','2023-07-12 12:23:21'),(7,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 12:24:52','2023-07-12 12:24:52'),(8,NULL,NULL,'WhatsApp','Россия (Russia)','+7(123) 123-12-31',NULL,'1','2023-07-12 12:25:24','2023-07-12 12:25:24'),(9,NULL,NULL,NULL,'','213123123123',NULL,'1','2023-07-12 14:27:53','2023-07-12 14:27:53'),(10,NULL,NULL,NULL,'','12312313',NULL,'1','2023-07-12 14:29:06','2023-07-12 14:29:06'),(11,'3123123',NULL,NULL,'','123123123',NULL,'1','2023-07-12 14:31:42','2023-07-12 14:31:42'),(12,'123123',12,NULL,'','123123',NULL,'1','2023-07-12 14:34:54','2023-07-12 14:34:54'),(13,'Arman',13,NULL,'','897987987',NULL,'1','2023-07-12 14:40:01','2023-07-12 14:40:01'),(14,NULL,NULL,'WhatsApp','Россия (Russia)','+7(235) 235-23-52',NULL,'1','2023-07-12 14:59:01','2023-07-12 14:59:01'),(15,NULL,NULL,'WhatsApp','Россия (Russia)','+7(423) 423-42-34',NULL,'1','2023-07-12 15:14:47','2023-07-12 15:14:47'),(16,NULL,NULL,'WhatsApp','Россия (Russia)','+7(435) 634-56-34',NULL,'1','2023-07-12 15:15:16','2023-07-12 15:15:16'),(17,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 15:16:22','2023-07-12 15:16:22'),(18,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 15:17:09','2023-07-12 15:17:09'),(19,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 15:17:41','2023-07-12 15:17:41'),(20,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 523-42-34',NULL,'1','2023-07-12 15:18:10','2023-07-12 15:18:10'),(21,NULL,NULL,'WhatsApp','Россия (Russia)','+7(345) 435-43-54',NULL,'1','2023-07-12 15:19:35','2023-07-12 15:19:35'),(22,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'1','2023-07-12 15:20:18','2023-07-12 15:20:18'),(23,NULL,NULL,'WhatsApp','Россия (Russia)','+7(234) 234-23-42',NULL,'2','2023-07-12 15:21:42','2023-07-17 07:57:01'),(24,'asfasfas',12,NULL,'','213123123',NULL,'1','2023-07-12 15:24:15','2023-07-17 07:58:46');
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@mail.ru','$2y$10$GRKLuj5wSinKpp/Rm/BJVOGyxeYkuk3nMQ50/G.DI71OYuAt1F12q','1',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vng_and_grjs`
--

DROP TABLE IF EXISTS `vng_and_grjs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vng_and_grjs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `header` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_tr` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `vng_and_grjs_chk_1` CHECK (json_valid(`content`))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vng_and_grjs`
--

LOCK TABLES `vng_and_grjs` WRITE;
/*!40000 ALTER TABLE `vng_and_grjs` DISABLE KEYS */;
INSERT INTO `vng_and_grjs` VALUES (1,NULL,'\"<p>hello world<\\/p>\\r\\n<p>&nbsp;<\\/p>\"','\"<p>en<\\/p>\"','\"<p>tr<\\/p>\\r\\n<p>&nbsp;<\\/p>\"','2023-07-04 08:41:54','2023-07-10 14:12:35');
/*!40000 ALTER TABLE `vng_and_grjs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-29 17:17:31
