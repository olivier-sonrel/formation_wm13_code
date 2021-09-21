-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: corona
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.20.04.1

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
-- Table structure for table `tbl_category`
--
CREATE SCHEMA IF NOT EXISTS corona;
USE corona;

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_order` int NOT NULL,
  `category_status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` VALUES (3,'Reality Check','reality-check',2,'Active','Reality Check','Reality Check Description'),(6,'Coronavirus Pandemic','coronavirus-pandemic',1,'Active','Coronavirus Pandemic','Coronavirus Pandemic'),(7,'Covid 19 Lockdown','covid-19-lockdown',3,'Active','Covid 19 Lockdown','Covid 19 Lockdown'),(8,'Coronavirus Vaccine','coronavirus-vaccine',4,'Active','Coronavirus Vaccine','Coronavirus Vaccine'),(9,'Feature Story','feature-story',5,'Active','Feature Story','Feature Story');
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `person_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `person_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `person_message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment_time` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `news_id` int NOT NULL,
  `comment_status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comment`
--

LOCK TABLES `tbl_comment` WRITE;
/*!40000 ALTER TABLE `tbl_comment` DISABLE KEYS */;
INSERT INTO `tbl_comment` VALUES (4,'Patrick Henderson','david@gmail.com','This is a nice website. I love this website very much. I will recommend all the people about this website.','2020-04-04','08:32:17 am',1,'Approved'),(5,'Sabbir Mohammah','sabbirdu@gmail.com','This is a nice website. I want to learn new things each day from this website.','2020-04-04','09:04:37 am',1,'Approved'),(8,'David Beckham','david001@gmail.com','This is really a bad situation. I am too much worried about this. Hope, the world situation will be improved one day.','2020-04-05','14:18:59 pm',8,'Approved');
/*!40000 ALTER TABLE `tbl_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_country`
--

DROP TABLE IF EXISTS `tbl_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_country` (
  `country_id` int NOT NULL AUTO_INCREMENT,
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_country`
--

LOCK TABLES `tbl_country` WRITE;
/*!40000 ALTER TABLE `tbl_country` DISABLE KEYS */;
INSERT INTO `tbl_country` VALUES (1,'Afghanistan'),(2,'Albania'),(3,'Algeria'),(4,'American Samoa'),(5,'Andorra'),(6,'Angola'),(7,'Anguilla'),(8,'Antarctica'),(9,'Antigua and Barbuda'),(10,'Argentina'),(11,'Armenia'),(12,'Aruba'),(13,'Australia'),(14,'Austria'),(15,'Azerbaijan'),(16,'Bahamas'),(17,'Bahrain'),(18,'Bangladesh'),(19,'Barbados'),(20,'Belarus'),(21,'Belgium'),(22,'Belize'),(23,'Benin'),(24,'Bermuda'),(25,'Bhutan'),(26,'Bolivia'),(27,'Bosnia and Herzegovina'),(28,'Botswana'),(29,'Bouvet Island'),(30,'Brazil'),(31,'British Indian Ocean Territory'),(32,'Brunei Darussalam'),(33,'Bulgaria'),(34,'Burkina Faso'),(35,'Burundi'),(36,'Cambodia'),(37,'Cameroon'),(38,'Canada'),(39,'Cape Verde'),(40,'Cayman Islands'),(41,'Central African Republic'),(42,'Chad'),(43,'Chile'),(44,'China'),(45,'Christmas Island'),(46,'Cocos (Keeling) Islands'),(47,'Colombia'),(48,'Comoros'),(49,'Democratic Republic of the Congo'),(50,'Republic of Congo'),(51,'Cook Islands'),(52,'Costa Rica'),(53,'Croatia (Hrvatska)'),(54,'Cuba'),(55,'Cyprus'),(56,'Czech Republic'),(57,'Denmark'),(58,'Djibouti'),(59,'Dominica'),(60,'Dominican Republic'),(61,'East Timor'),(62,'Ecuador'),(63,'Egypt'),(64,'El Salvador'),(65,'Equatorial Guinea'),(66,'Eritrea'),(67,'Estonia'),(68,'Ethiopia'),(69,'Falkland Islands (Malvinas)'),(70,'Faroe Islands'),(71,'Fiji'),(72,'Finland'),(73,'France'),(74,'France, Metropolitan'),(75,'French Guiana'),(76,'French Polynesia'),(77,'French Southern Territories'),(78,'Gabon'),(79,'Gambia'),(80,'Georgia'),(81,'Germany'),(82,'Ghana'),(83,'Gibraltar'),(84,'Guernsey'),(85,'Greece'),(86,'Greenland'),(87,'Grenada'),(88,'Guadeloupe'),(89,'Guam'),(90,'Guatemala'),(91,'Guinea'),(92,'Guinea-Bissau'),(93,'Guyana'),(94,'Haiti'),(95,'Heard and Mc Donald Islands'),(96,'Honduras'),(97,'Hong Kong'),(98,'Hungary'),(99,'Iceland'),(100,'India'),(101,'Isle of Man'),(102,'Indonesia'),(103,'Iran (Islamic Republic of)'),(104,'Iraq'),(105,'Ireland'),(106,'Israel'),(107,'Italy'),(108,'Ivory Coast'),(109,'Jersey'),(110,'Jamaica'),(111,'Japan'),(112,'Jordan'),(113,'Kazakhstan'),(114,'Kenya'),(115,'Kiribati'),(116,'Korea, Democratic People\'s Republic of'),(117,'Korea, Republic of'),(118,'Kosovo'),(119,'Kuwait'),(120,'Kyrgyzstan'),(121,'Lao People\'s Democratic Republic'),(122,'Latvia'),(123,'Lebanon'),(124,'Lesotho'),(125,'Liberia'),(126,'Libyan Arab Jamahiriya'),(127,'Liechtenstein'),(128,'Lithuania'),(129,'Luxembourg'),(130,'Macau'),(131,'North Macedonia'),(132,'Madagascar'),(133,'Malawi'),(134,'Malaysia'),(135,'Maldives'),(136,'Mali'),(137,'Malta'),(138,'Marshall Islands'),(139,'Martinique'),(140,'Mauritania'),(141,'Mauritius'),(142,'Mayotte'),(143,'Mexico'),(144,'Micronesia, Federated States of'),(145,'Moldova, Republic of'),(146,'Monaco'),(147,'Mongolia'),(148,'Montenegro'),(149,'Montserrat'),(150,'Morocco'),(151,'Mozambique'),(152,'Myanmar'),(153,'Namibia'),(154,'Nauru'),(155,'Nepal'),(156,'Netherlands'),(157,'Netherlands Antilles'),(158,'New Caledonia'),(159,'New Zealand'),(160,'Nicaragua'),(161,'Niger'),(162,'Nigeria'),(163,'Niue'),(164,'Norfolk Island'),(165,'Northern Mariana Islands'),(166,'Norway'),(167,'Oman'),(168,'Pakistan'),(169,'Palau'),(170,'Palestine'),(171,'Panama'),(172,'Papua New Guinea'),(173,'Paraguay'),(174,'Peru'),(175,'Philippines'),(176,'Pitcairn'),(177,'Poland'),(178,'Portugal'),(179,'Puerto Rico'),(180,'Qatar'),(181,'Reunion'),(182,'Romania'),(183,'Russian Federation'),(184,'Rwanda'),(185,'Saint Kitts and Nevis'),(186,'Saint Lucia'),(187,'Saint Vincent and the Grenadines'),(188,'Samoa'),(189,'San Marino'),(190,'Sao Tome and Principe'),(191,'Saudi Arabia'),(192,'Senegal'),(193,'Serbia'),(194,'Seychelles'),(195,'Sierra Leone'),(196,'Singapore'),(197,'Slovakia'),(198,'Slovenia'),(199,'Solomon Islands'),(200,'Somalia'),(201,'South Africa'),(202,'South Georgia South Sandwich Islands'),(203,'South Sudan'),(204,'Spain'),(205,'Sri Lanka'),(206,'St. Helena'),(207,'St. Pierre and Miquelon'),(208,'Sudan'),(209,'Suriname'),(210,'Svalbard and Jan Mayen Islands'),(211,'Swaziland'),(212,'Sweden'),(213,'Switzerland'),(214,'Syrian Arab Republic'),(215,'Taiwan'),(216,'Tajikistan'),(217,'Tanzania, United Republic of'),(218,'Thailand'),(219,'Togo'),(220,'Tokelau'),(221,'Tonga'),(222,'Trinidad and Tobago'),(223,'Tunisia'),(224,'Turkey'),(225,'Turkmenistan'),(226,'Turks and Caicos Islands'),(227,'Tuvalu'),(228,'Uganda'),(229,'Ukraine'),(230,'United Arab Emirates'),(231,'United Kingdom'),(232,'United States'),(233,'United States minor outlying islands'),(234,'Uruguay'),(235,'Uzbekistan'),(236,'Vanuatu'),(237,'Vatican City State'),(238,'Venezuela'),(239,'Vietnam'),(240,'Virgin Islands (British)'),(241,'Virgin Islands (U.S.)'),(242,'Wallis and Futuna Islands'),(243,'Western Sahara'),(244,'Yemen'),(245,'Zambia'),(246,'Zimbabwe');
/*!40000 ALTER TABLE `tbl_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_coupon`
--

DROP TABLE IF EXISTS `tbl_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_coupon` (
  `coupon_id` int NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coupon_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coupon_discount` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coupon_maximum_use` int NOT NULL,
  `coupon_existing_use` int NOT NULL,
  `coupon_start_date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coupon_end_date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coupon_status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_coupon`
--

LOCK TABLES `tbl_coupon` WRITE;
/*!40000 ALTER TABLE `tbl_coupon` DISABLE KEYS */;
INSERT INTO `tbl_coupon` VALUES (1,'NICEMAN','Percentage','5',1,1,'2020-04-09','2020-04-16','Active'),(2,'STRONG','Amount','10',6,3,'2020-04-09','2020-04-24','Active');
/*!40000 ALTER TABLE `tbl_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_country_id` int NOT NULL,
  `customer_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_state` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_city` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_zip` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customer`
--

LOCK TABLES `tbl_customer` WRITE;
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
INSERT INTO `tbl_customer` VALUES (1,'John Doe','customer@gmail.com','111-222-3333',232,'4706 Romrog Way','NE','Kearney','68847','$2y$10$1VraM7ne9hpdxjXBlP5xmeg8B8Cc7ZP8K5saI6PwUqff1l4l3S7F.','','Active');
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_doctor`
--

DROP TABLE IF EXISTS `tbl_doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_doctor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `degree` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `practice_location` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `advice` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `instagram` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video_youtube` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doctor_order` int NOT NULL,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_doctor`
--

LOCK TABLES `tbl_doctor` WRITE;
/*!40000 ALTER TABLE `tbl_doctor` DISABLE KEYS */;
INSERT INTO `tbl_doctor` VALUES (1,'Dr. Brent Grundy','brent-grundy','Chairman, AA Hospital','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','<p>Fugit contentiones id nam, noster percipit ne mei. Duo no modo tempor, per ea quaeque commune complectitur, sed ex alia utamur apeirian. Est id solum dicant ceteros. Quem omnium dignissim in vim, sea nihil expetenda id, molestiae definitionem ad pri.</p>\r\n\r\n<p>Id per esse iudicabit expetendis, ne qui legimus accusata corrumpit. Ei has duis corrumpit, facilisis accommodare te nec. Ne usu molestiae voluptatum mediocritatem, tota percipitur ut qui. Ne modo idque feugait vel. Postea epicuri mei te. Ad tollit qualisque dignissim per, eu purto virtute fabulas his.</p>\r\n\r\n<p>Viris ignota vim et. Ea idque etiam liberavisse has. Ex mel lorem voluptatibus, sed vero accusata no. Ad pri utinam praesent, usu iuvaret adipisci contentiones an. Eum falli fabellas ut, usu te putent posidonium.</p>\r\n\r\n<p>Ei cum elit fuisset, ad tota assueverit scriptorem qui, pro ex utamur recteque incorrupte. Has iisque consectetuer eu. Malis doming eirmod id his, te mea novum offendit. Ea minim doming evertitur eum, latine neglegentur no nec. Ea pro putant perpetua interpretaris. Mea ne noster aliquando constituam, iudico discere neglegentur vel cu, mandamus corrumpit duo ne.</p>\r\n','<p>Mei te debet corrumpit, est semper abhorreant delicatissimi at. Usu oratio nostrum ei, an saepe accusamus mei. At justo inimicus complectitur pro, alia iudico nostrum eu sit, id sed tamquam delicata adipiscing. Dicam altera vituperata te eum, an zril dicant populo vix. Offendit dissentiet vix an, ut audiam aliquip complectitur cum. Et ius scribentur philosophia. Ei dolore nominati pro, pri no bonorum suscipit.</p>\r\n\r\n<p>Quo illum appetere fabellas et, ex his doctus rationibus. Cu oblique vocibus delicatissimi quo, consul oportere periculis at vis, vim eu decore utamur aperiri. In mei ferri soleat vidisse, te partem sadipscing qui. An iusto prompta fierent his, id mel oporteat probatus democritum, assum oblique laoreet ad vel. Sea etiam aeterno id. Ut diam tritani nam.</p>\r\n\r\n<p>Vel in nemore mandamus conceptam, no dicat persius democritum nam. Sit et vidit idque facilisi, ei iudico nostro vel, facer dictas definitionem his ne. Nemore latine erroribus id ius, pro dicunt accusam maiestatis ne, omnes discere cum id. In graeco habemus has.</p>\r\n\r\n<p>Quodsi efficiendi interpretaris sea ei. Et decore perfecto vis, cu insolens assentior nec, ullum delenit te nec. Mel ex dolor ponderum, quod nihil mei ut. Nisl efficiendi et has, nec cu veri ignota verterem. Ei mei dicit facilisis forensibus, ei eum delenit deserunt.</p>\r\n\r\n<p>Id ius enim soleat doming. Solum nihil nostrud ad his. Ex sumo feugiat interesset has, nisl debet sea ea, pri ei volutpat dissentias. Te essent aliquam pertinax mei, has utamur maiorum ex, id accumsan molestie efficiendi sit. Ad eam definiebas reformidans, ad audiam perfecto pro.</p>\r\n','<p>Eos malis necessitatibus an. Constituto comprehensam nam eu, eam consul salutandi et. No his fabulas fabellas pertinacia, eirmod scripserit vis at, mel et amet oblique epicuri. Paulo vitae nominavi eam in, diceret inermis vivendo est ei. Ius at salutatus adversarium, cu dictas eligendi sententiae vel. At dolorem iracundia scripserit per, ius ut maiestatis inciderint.</p>\r\n\r\n<p>Eum no duis idque complectitur, no vocent theophrastus quo, no nisl admodum epicuri pri. Id per mutat falli nominavi, simul placerat appellantur cum eu, nam habeo illud at. Ei possim officiis indoctum cum, electram efficiantur conclusionemque sed ne. Ad porro graeci scaevola has, ex euismod corpora fabellas usu. Vim no consul expetendis, eos graece dolorum disputationi ad.</p>\r\n\r\n<p>Mazim civibus consulatu duo in, omnium deserunt mea ad. Cum porro discere inermis id, mea ex soluta tamquam. Ut qui commune instructior. Ad sed omnis sonet audire, sed ea munere iuvaret.</p>\r\n\r\n<p>Ne delenit dolorem has, no vim dicta congue officiis, et nostrud qualisque ius. Lorem putant persius vis id, libris rationibus vel ei. Eu natum consectetuer mea. Ius ei vidit facilisis torquatos. Qui ad vide denique prodesset, causae voluptaria an nam.</p>\r\n\r\n<p>Cu case vocibus erroribus nec. Ea platonem mandamus est. Modo habeo veritus vis id. Stet gubergren no nec, pri cu atqui legere reformidans, pro error concludaturque te. Debet splendide cotidieque ne ius, vim fugit zril doctus ne.</p>\r\n','http://www.facebook.com','http://www.twitter.com','http://www.linkedin.com','http://www.youtube.com','http://www.instagram.com','brentgrundy@gmail.com','111-222-3333','http://www.brentgrundy.com','4008 Ocala Street\r\nOrlando, FL 32809','t8o4XNmAkKM','doctor-1.jpg',1,'Active','Dr. Brent Grundy','Dr. Brent Grundy Description'),(2,'Dr. Robin Cook','robin-cook','Medicine, BB Hospital','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','<p>Fugit contentiones id nam, noster percipit ne mei. Duo no modo tempor, per ea quaeque commune complectitur, sed ex alia utamur apeirian. Est id solum dicant ceteros. Quem omnium dignissim in vim, sea nihil expetenda id, molestiae definitionem ad pri.</p>\r\n\r\n<p>Id per esse iudicabit expetendis, ne qui legimus accusata corrumpit. Ei has duis corrumpit, facilisis accommodare te nec. Ne usu molestiae voluptatum mediocritatem, tota percipitur ut qui. Ne modo idque feugait vel. Postea epicuri mei te. Ad tollit qualisque dignissim per, eu purto virtute fabulas his.</p>\r\n\r\n<p>Viris ignota vim et. Ea idque etiam liberavisse has. Ex mel lorem voluptatibus, sed vero accusata no. Ad pri utinam praesent, usu iuvaret adipisci contentiones an. Eum falli fabellas ut, usu te putent posidonium.</p>\r\n\r\n<p>Ei cum elit fuisset, ad tota assueverit scriptorem qui, pro ex utamur recteque incorrupte. Has iisque consectetuer eu. Malis doming eirmod id his, te mea novum offendit. Ea minim doming evertitur eum, latine neglegentur no nec. Ea pro putant perpetua interpretaris. Mea ne noster aliquando constituam, iudico discere neglegentur vel cu, mandamus corrumpit duo ne.</p>\r\n','<p>Mei te debet corrumpit, est semper abhorreant delicatissimi at. Usu oratio nostrum ei, an saepe accusamus mei. At justo inimicus complectitur pro, alia iudico nostrum eu sit, id sed tamquam delicata adipiscing. Dicam altera vituperata te eum, an zril dicant populo vix. Offendit dissentiet vix an, ut audiam aliquip complectitur cum. Et ius scribentur philosophia. Ei dolore nominati pro, pri no bonorum suscipit.</p>\r\n\r\n<p>Quo illum appetere fabellas et, ex his doctus rationibus. Cu oblique vocibus delicatissimi quo, consul oportere periculis at vis, vim eu decore utamur aperiri. In mei ferri soleat vidisse, te partem sadipscing qui. An iusto prompta fierent his, id mel oporteat probatus democritum, assum oblique laoreet ad vel. Sea etiam aeterno id. Ut diam tritani nam.</p>\r\n\r\n<p>Vel in nemore mandamus conceptam, no dicat persius democritum nam. Sit et vidit idque facilisi, ei iudico nostro vel, facer dictas definitionem his ne. Nemore latine erroribus id ius, pro dicunt accusam maiestatis ne, omnes discere cum id. In graeco habemus has.</p>\r\n\r\n<p>Quodsi efficiendi interpretaris sea ei. Et decore perfecto vis, cu insolens assentior nec, ullum delenit te nec. Mel ex dolor ponderum, quod nihil mei ut. Nisl efficiendi et has, nec cu veri ignota verterem. Ei mei dicit facilisis forensibus, ei eum delenit deserunt.</p>\r\n\r\n<p>Id ius enim soleat doming. Solum nihil nostrud ad his. Ex sumo feugiat interesset has, nisl debet sea ea, pri ei volutpat dissentias. Te essent aliquam pertinax mei, has utamur maiorum ex, id accumsan molestie efficiendi sit. Ad eam definiebas reformidans, ad audiam perfecto pro.</p>\r\n','<p>Eos malis necessitatibus an. Constituto comprehensam nam eu, eam consul salutandi et. No his fabulas fabellas pertinacia, eirmod scripserit vis at, mel et amet oblique epicuri. Paulo vitae nominavi eam in, diceret inermis vivendo est ei. Ius at salutatus adversarium, cu dictas eligendi sententiae vel. At dolorem iracundia scripserit per, ius ut maiestatis inciderint.</p>\r\n\r\n<p>Eum no duis idque complectitur, no vocent theophrastus quo, no nisl admodum epicuri pri. Id per mutat falli nominavi, simul placerat appellantur cum eu, nam habeo illud at. Ei possim officiis indoctum cum, electram efficiantur conclusionemque sed ne. Ad porro graeci scaevola has, ex euismod corpora fabellas usu. Vim no consul expetendis, eos graece dolorum disputationi ad.</p>\r\n\r\n<p>Mazim civibus consulatu duo in, omnium deserunt mea ad. Cum porro discere inermis id, mea ex soluta tamquam. Ut qui commune instructior. Ad sed omnis sonet audire, sed ea munere iuvaret.</p>\r\n\r\n<p>Ne delenit dolorem has, no vim dicta congue officiis, et nostrud qualisque ius. Lorem putant persius vis id, libris rationibus vel ei. Eu natum consectetuer mea. Ius ei vidit facilisis torquatos. Qui ad vide denique prodesset, causae voluptaria an nam.</p>\r\n\r\n<p>Cu case vocibus erroribus nec. Ea platonem mandamus est. Modo habeo veritus vis id. Stet gubergren no nec, pri cu atqui legere reformidans, pro error concludaturque te. Debet splendide cotidieque ne ius, vim fugit zril doctus ne.</p>\r\n','http://www.facebook.com','http://www.twitter.com','http://www.linkedin.com','http://www.youtube.com','http://www.instagram.com','robincook@gmail.com','111-222-3334','http://www.robincook.com','4008 Ocala Street\r\nOrlando, FL 32809','FVIGhz3uwuQ','doctor-2.jpg',2,'Active','Dr. Robin Cook','Dr. Robin Cook Description'),(3,'Dr. Bob Smith','bob-smith','Neurologist, CC Clinic','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','<p>Fugit contentiones id nam, noster percipit ne mei. Duo no modo tempor, per ea quaeque commune complectitur, sed ex alia utamur apeirian. Est id solum dicant ceteros. Quem omnium dignissim in vim, sea nihil expetenda id, molestiae definitionem ad pri.</p>\r\n\r\n<p>Id per esse iudicabit expetendis, ne qui legimus accusata corrumpit. Ei has duis corrumpit, facilisis accommodare te nec. Ne usu molestiae voluptatum mediocritatem, tota percipitur ut qui. Ne modo idque feugait vel. Postea epicuri mei te. Ad tollit qualisque dignissim per, eu purto virtute fabulas his.</p>\r\n\r\n<p>Viris ignota vim et. Ea idque etiam liberavisse has. Ex mel lorem voluptatibus, sed vero accusata no. Ad pri utinam praesent, usu iuvaret adipisci contentiones an. Eum falli fabellas ut, usu te putent posidonium.</p>\r\n\r\n<p>Ei cum elit fuisset, ad tota assueverit scriptorem qui, pro ex utamur recteque incorrupte. Has iisque consectetuer eu. Malis doming eirmod id his, te mea novum offendit. Ea minim doming evertitur eum, latine neglegentur no nec. Ea pro putant perpetua interpretaris. Mea ne noster aliquando constituam, iudico discere neglegentur vel cu, mandamus corrumpit duo ne.</p>\r\n','<p>Mei te debet corrumpit, est semper abhorreant delicatissimi at. Usu oratio nostrum ei, an saepe accusamus mei. At justo inimicus complectitur pro, alia iudico nostrum eu sit, id sed tamquam delicata adipiscing. Dicam altera vituperata te eum, an zril dicant populo vix. Offendit dissentiet vix an, ut audiam aliquip complectitur cum. Et ius scribentur philosophia. Ei dolore nominati pro, pri no bonorum suscipit.</p>\r\n\r\n<p>Quo illum appetere fabellas et, ex his doctus rationibus. Cu oblique vocibus delicatissimi quo, consul oportere periculis at vis, vim eu decore utamur aperiri. In mei ferri soleat vidisse, te partem sadipscing qui. An iusto prompta fierent his, id mel oporteat probatus democritum, assum oblique laoreet ad vel. Sea etiam aeterno id. Ut diam tritani nam.</p>\r\n\r\n<p>Vel in nemore mandamus conceptam, no dicat persius democritum nam. Sit et vidit idque facilisi, ei iudico nostro vel, facer dictas definitionem his ne. Nemore latine erroribus id ius, pro dicunt accusam maiestatis ne, omnes discere cum id. In graeco habemus has.</p>\r\n\r\n<p>Quodsi efficiendi interpretaris sea ei. Et decore perfecto vis, cu insolens assentior nec, ullum delenit te nec. Mel ex dolor ponderum, quod nihil mei ut. Nisl efficiendi et has, nec cu veri ignota verterem. Ei mei dicit facilisis forensibus, ei eum delenit deserunt.</p>\r\n\r\n<p>Id ius enim soleat doming. Solum nihil nostrud ad his. Ex sumo feugiat interesset has, nisl debet sea ea, pri ei volutpat dissentias. Te essent aliquam pertinax mei, has utamur maiorum ex, id accumsan molestie efficiendi sit. Ad eam definiebas reformidans, ad audiam perfecto pro.</p>\r\n','<p>Eos malis necessitatibus an. Constituto comprehensam nam eu, eam consul salutandi et. No his fabulas fabellas pertinacia, eirmod scripserit vis at, mel et amet oblique epicuri. Paulo vitae nominavi eam in, diceret inermis vivendo est ei. Ius at salutatus adversarium, cu dictas eligendi sententiae vel. At dolorem iracundia scripserit per, ius ut maiestatis inciderint.</p>\r\n\r\n<p>Eum no duis idque complectitur, no vocent theophrastus quo, no nisl admodum epicuri pri. Id per mutat falli nominavi, simul placerat appellantur cum eu, nam habeo illud at. Ei possim officiis indoctum cum, electram efficiantur conclusionemque sed ne. Ad porro graeci scaevola has, ex euismod corpora fabellas usu. Vim no consul expetendis, eos graece dolorum disputationi ad.</p>\r\n\r\n<p>Mazim civibus consulatu duo in, omnium deserunt mea ad. Cum porro discere inermis id, mea ex soluta tamquam. Ut qui commune instructior. Ad sed omnis sonet audire, sed ea munere iuvaret.</p>\r\n\r\n<p>Ne delenit dolorem has, no vim dicta congue officiis, et nostrud qualisque ius. Lorem putant persius vis id, libris rationibus vel ei. Eu natum consectetuer mea. Ius ei vidit facilisis torquatos. Qui ad vide denique prodesset, causae voluptaria an nam.</p>\r\n\r\n<p>Cu case vocibus erroribus nec. Ea platonem mandamus est. Modo habeo veritus vis id. Stet gubergren no nec, pri cu atqui legere reformidans, pro error concludaturque te. Debet splendide cotidieque ne ius, vim fugit zril doctus ne.</p>\r\n','http://www.facebook.com','http://www.twitter.com','http://www.linkedin.com','http://www.youtube.com','http://www.instagram.com','bobsmith@gmail.com','111-222-3338','http://www.bobsmith.com','4008 Ocala Street\r\nOrlando, FL 32809','ejBbrLmKn54','doctor-3.jpg',3,'Active','Dr. Bob Smith','Dr. Bob Smith Description'),(4,'Dr. Patrick Henderson','patrick-henderson','Cardiologist, DD Clinic','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','<p>Fugit contentiones id nam, noster percipit ne mei. Duo no modo tempor, per ea quaeque commune complectitur, sed ex alia utamur apeirian. Est id solum dicant ceteros. Quem omnium dignissim in vim, sea nihil expetenda id, molestiae definitionem ad pri.</p>\r\n\r\n<p>Id per esse iudicabit expetendis, ne qui legimus accusata corrumpit. Ei has duis corrumpit, facilisis accommodare te nec. Ne usu molestiae voluptatum mediocritatem, tota percipitur ut qui. Ne modo idque feugait vel. Postea epicuri mei te. Ad tollit qualisque dignissim per, eu purto virtute fabulas his.</p>\r\n\r\n<p>Viris ignota vim et. Ea idque etiam liberavisse has. Ex mel lorem voluptatibus, sed vero accusata no. Ad pri utinam praesent, usu iuvaret adipisci contentiones an. Eum falli fabellas ut, usu te putent posidonium.</p>\r\n\r\n<p>Ei cum elit fuisset, ad tota assueverit scriptorem qui, pro ex utamur recteque incorrupte. Has iisque consectetuer eu. Malis doming eirmod id his, te mea novum offendit. Ea minim doming evertitur eum, latine neglegentur no nec. Ea pro putant perpetua interpretaris. Mea ne noster aliquando constituam, iudico discere neglegentur vel cu, mandamus corrumpit duo ne.</p>\r\n','<p>Mei te debet corrumpit, est semper abhorreant delicatissimi at. Usu oratio nostrum ei, an saepe accusamus mei. At justo inimicus complectitur pro, alia iudico nostrum eu sit, id sed tamquam delicata adipiscing. Dicam altera vituperata te eum, an zril dicant populo vix. Offendit dissentiet vix an, ut audiam aliquip complectitur cum. Et ius scribentur philosophia. Ei dolore nominati pro, pri no bonorum suscipit.</p>\r\n\r\n<p>Quo illum appetere fabellas et, ex his doctus rationibus. Cu oblique vocibus delicatissimi quo, consul oportere periculis at vis, vim eu decore utamur aperiri. In mei ferri soleat vidisse, te partem sadipscing qui. An iusto prompta fierent his, id mel oporteat probatus democritum, assum oblique laoreet ad vel. Sea etiam aeterno id. Ut diam tritani nam.</p>\r\n\r\n<p>Vel in nemore mandamus conceptam, no dicat persius democritum nam. Sit et vidit idque facilisi, ei iudico nostro vel, facer dictas definitionem his ne. Nemore latine erroribus id ius, pro dicunt accusam maiestatis ne, omnes discere cum id. In graeco habemus has.</p>\r\n\r\n<p>Quodsi efficiendi interpretaris sea ei. Et decore perfecto vis, cu insolens assentior nec, ullum delenit te nec. Mel ex dolor ponderum, quod nihil mei ut. Nisl efficiendi et has, nec cu veri ignota verterem. Ei mei dicit facilisis forensibus, ei eum delenit deserunt.</p>\r\n\r\n<p>Id ius enim soleat doming. Solum nihil nostrud ad his. Ex sumo feugiat interesset has, nisl debet sea ea, pri ei volutpat dissentias. Te essent aliquam pertinax mei, has utamur maiorum ex, id accumsan molestie efficiendi sit. Ad eam definiebas reformidans, ad audiam perfecto pro.</p>\r\n','<p>Eos malis necessitatibus an. Constituto comprehensam nam eu, eam consul salutandi et. No his fabulas fabellas pertinacia, eirmod scripserit vis at, mel et amet oblique epicuri. Paulo vitae nominavi eam in, diceret inermis vivendo est ei. Ius at salutatus adversarium, cu dictas eligendi sententiae vel. At dolorem iracundia scripserit per, ius ut maiestatis inciderint.</p>\r\n\r\n<p>Eum no duis idque complectitur, no vocent theophrastus quo, no nisl admodum epicuri pri. Id per mutat falli nominavi, simul placerat appellantur cum eu, nam habeo illud at. Ei possim officiis indoctum cum, electram efficiantur conclusionemque sed ne. Ad porro graeci scaevola has, ex euismod corpora fabellas usu. Vim no consul expetendis, eos graece dolorum disputationi ad.</p>\r\n\r\n<p>Mazim civibus consulatu duo in, omnium deserunt mea ad. Cum porro discere inermis id, mea ex soluta tamquam. Ut qui commune instructior. Ad sed omnis sonet audire, sed ea munere iuvaret.</p>\r\n\r\n<p>Ne delenit dolorem has, no vim dicta congue officiis, et nostrud qualisque ius. Lorem putant persius vis id, libris rationibus vel ei. Eu natum consectetuer mea. Ius ei vidit facilisis torquatos. Qui ad vide denique prodesset, causae voluptaria an nam.</p>\r\n\r\n<p>Cu case vocibus erroribus nec. Ea platonem mandamus est. Modo habeo veritus vis id. Stet gubergren no nec, pri cu atqui legere reformidans, pro error concludaturque te. Debet splendide cotidieque ne ius, vim fugit zril doctus ne.</p>\r\n','http://www.facebook.com','http://www.twitter.com','http://www.linkedin.com','http://www.youtube.com','http://www.instagram.com','patrickhenderson@gmail.com','111-222-3839','http://www.patrickhenderson.com','4008 Ocala Street\r\nOrlando, FL 32809','9ChxfL2HS1I','doctor-4.jpg',4,'Active','Dr. Patrick Henderson','Dr. Patrick Henderson Description');
/*!40000 ALTER TABLE `tbl_doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_email_template`
--

DROP TABLE IF EXISTS `tbl_email_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_email_template` (
  `et_id` int NOT NULL AUTO_INCREMENT,
  `et_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `et_content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `et_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`et_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_email_template`
--

LOCK TABLES `tbl_email_template` WRITE;
/*!40000 ALTER TABLE `tbl_email_template` DISABLE KEYS */;
INSERT INTO `tbl_email_template` VALUES (1,'Contact Form - your website','<p>You have received a message from a visitor. Detailed information is here:</p>\r\n\r\n<p><strong>Visitor Name:</strong> {{visitor_name}}</p>\r\n\r\n<p><strong>Visitor Email:</strong>&nbsp;{{visitor_email}}</p>\r\n\r\n<p><strong>Visitor Phone:</strong>&nbsp;{{visitor_phone}}</p>\r\n\r\n<p><strong>Visitor Message:&nbsp;</strong></p>\r\n\r\n<p>{{visitor_message}}</p>\r\n','Contact Page Message'),(2,'New Comment Posted','<p>You have received a new comment from a person. His detail is here:</p>\r\n\r\n<p><strong>Person Name:</strong> {{person_name}}</p>\r\n\r\n<p><strong>Person Email:</strong>&nbsp;{{person_email}}</p>\r\n\r\n<p><strong>Person Message:&nbsp;</strong></p>\r\n\r\n<p>{{person_message}}</p>\r\n\r\n<p>Go to this link to see this comment:&nbsp;{{comment_see_url}}</p>\r\n','Comment Message to Admin'),(3,'Verify Subscription','<p>Dear Sir,</p>\r\n\r\n<p>You have requested to be a subscriber in our website. Please click on the following link to confirm the subscription:</p>\r\n\r\n<p>{{verification_link}}</p>\r\n\r\n<p>Thank you so much!<br />\r\nMarketing Team</p>\r\n','Subscriber Message for Verification'),(4,'A News has been added','<p>Dear Subscriber,</p>\r\n\r\n<p>A news has been published. To see the news, please go to the following link:</p>\r\n\r\n<p>{{post_link}}</p>\r\n\r\n<p>Thank you!</p>\r\n','News Post Message to Active Subscribers'),(5,'Reset Password','<p>To reset your password, please click on the following link:</p>\r\n\r\n<p>{{reset_link}}</p>\r\n','Reset Password Message to Admin'),(6,'Confirm Registration','<p>To activate your account and confirm the registration, please click on the verify link below:</p>\r\n\r\n<p>{{verification_link}}</p>\r\n','Registration Email to Customer'),(7,'Reset Password','<p>To reset your password, please click on the following link:</p>\r\n\r\n<p>{{reset_link}}</p>\r\n','Reset Password Message to Customer'),(8,'Order Completed','<p>Dear {{customer_name}},</p>\r\n\r\n<p>Your order has been submitted successfully and we received the payment from you. After you process and ship the order, you will get all the products after a certain time period.&nbsp;</p>\r\n\r\n<p><strong>Payment Information:</strong></p>\r\n\r\n<p>Order Number: {{order_number}}<br />\r\n{{payment_method}}<br />\r\nPayment Date &amp; Time: {{payment_date_time}}<br />\r\nTransaction Id: {{transaction_id}}<br />\r\nShipping Cost: {{shipping_cost}}<br />\r\nCoupon Code: {{coupon_code}}<br />\r\nCoupon Discount: {{coupon_discount}}<br />\r\nPaid Amount: {{paid_amount}}<br />\r\nPayment Status: {{payment_status}}</p>\r\n\r\n<p>----------------------------------------</p>\r\n\r\n<p><strong>Your billing details:</strong></p>\r\n\r\n<p>Billing Name: {{billing_name}}<br />\r\nBilling Email: {{billing_email}}<br />\r\nBilling Phone: {{billing_phone}}<br />\r\nBilling Country: {{billing_country}}<br />\r\nBilling Address: {{billing_address}}<br />\r\nBilling State: {{billing_state}}<br />\r\nBilling City: {{billing_city}}<br />\r\nBilling Zip: {{billing_zip}}</p>\r\n\r\n<p>----------------------------------------</p>\r\n\r\n<p><strong>Your shipping details:</strong></p>\r\n\r\n<p>Shipping Name: {{shipping_name}}<br />\r\nShipping Email: {{shipping_email}}<br />\r\nShipping Phone: {{shipping_phone}}<br />\r\nShipping Country: {{shipping_country}}<br />\r\nShipping Address: {{shipping_address}}<br />\r\nShipping State: {{shipping_state}}<br />\r\nShipping City: {{shipping_city}}<br />\r\nShipping Zip: {{shipping_zip}}</p>\r\n\r\n<p>----------------------------------------</p>\r\n\r\n<p><strong>Products You Purchased:&nbsp;</strong></p>\r\n\r\n<p>{{product_detail}}</p>\r\n\r\n<p>Thank you!<br />\r\nThe ABC Team</p>\r\n','Order Completed Email to Customer'),(9,'Order Delivery Update','<p>Your order delivery status has been updated. Please check:</p>\r\n\r\n<p>Delivery Status: {{delivery_status}}<br />\r\nDelivery Note: {{delivery_note}}<br />\r\nDelivery Date and Time: {{delivery_date_time}}</p>\r\n','Order Delivery Information Email to Customer');
/*!40000 ALTER TABLE `tbl_email_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_faq`
--

DROP TABLE IF EXISTS `tbl_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_faq` (
  `faq_id` int NOT NULL AUTO_INCREMENT,
  `faq_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `faq_content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `faq_order` int NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_faq`
--

LOCK TABLES `tbl_faq` WRITE;
/*!40000 ALTER TABLE `tbl_faq` DISABLE KEYS */;
INSERT INTO `tbl_faq` VALUES (1,'What is COVID-19?','<p>Severe Acute Respiratory Syndrome Coronavirus-2 (SARS-CoV-2) is the name given to the 2019 novel coronavirus. COVID-19 is the name given to the disease associated with the virus. SARS-CoV-2 is a new strain of coronavirus that has not been previously identified in humans.</p>\r\n',1),(2,'Where do coronaviruses come from?','<p>Bats are considered natural hosts of these viruses yet several other species of animals are also known to act as sources. For instance, Middle East Respiratory Syndrome Coronavirus (MERS-CoV) is transmitted to humans from camels, and Severe Acute Respiratory Syndrome Coronavirus-1 (SARS-CoV-1) is transmitted to humans from civet cats. More information on coronaviruses can be found in the ECDC factsheet.</p>\r\n',2),(3,'Is this virus comparable to SARS or to the seasonal flu?','<p>The novel coronavirus detected in China in 2019 is closely related genetically to the SARS-CoV-1 virus. SARS emerged at the end of 2002 in China, and it caused more than 8 000 cases in 33 countries over a period of eight months. Around one in ten of the people who developed SARS died.</p>\r\n\r\n<p>As of 30 March 2020, the COVID-19 outbreak had caused over 700 000 cases worldwide since the first case was reported in China in January 2020. Of these, more than 30 000 are known to have died.</p>\r\n\r\n<p>See the situation updates for the latest available information.</p>\r\n',3),(4,'What is the mode of transmission? How (easily) does it spread?','<ol>\r\n	<li>While animals are believed to be the original source, the virus spread is now from person to person (human-to-human transmission). There is not enough epidemiological information at this time to determine how easily this virus spreads between people, but it is currently estimated that, on average, one infected person will infect between two and three other people.</li>\r\n	<li>The virus seems to be transmitted mainly via small respiratory droplets through sneezing, coughing, or when people interact with each other for some time in close proximity (usually less than one metre). These droplets can then be inhaled, or they can land on surfaces that others may come into contact with, who can then get infected when they touch their nose, mouth or eyes. The virus can survive on different surfaces from several hours (copper, cardboard) up to a few days (plastic and stainless steel). However, the amount of viable virus declines over time and may not always be present in sufficient numbers to cause infection.</li>\r\n	<li>The incubation period for COVID-19 (i.e. the time between exposure to the virus and onset of symptoms) is currently estimated to bet between one and 14 days.</li>\r\n	<li>We know that the virus can be transmitted when people who are infected show symptoms such as coughing. There is also some evidence suggesting that transmission can occur from a person that is infected even two days before showing symptoms; however, uncertainties remain about the effect of transmission by&nbsp; non-symptomatic persons.</li>\r\n</ol>\r\n',4),(5,'When is a person infectious?','<p>The infectious period may begin one to two days before symptoms appear, but people are likely most infectious during the symptomatic period, even if symptoms are mild and very non-specific. The infectious period is now estimated to last for 7-12 days in moderate cases and up to two weeks on average in severe cases.</p>\r\n',5),(6,'How severe is COVID-19 infection?','<p>Preliminary data from the EU/EEA (from the countries with available data) show that around 20-30% of diagnosed COVID-19 cases are hospitalised and 4% have severe illness. Hospitalisation rates are higher for those aged 60 years and above, and for those with other underlying health conditions.</p>\r\n',6);
/*!40000 ALTER TABLE `tbl_faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_file`
--

DROP TABLE IF EXISTS `tbl_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_file` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `file_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_file`
--

LOCK TABLES `tbl_file` WRITE;
/*!40000 ALTER TABLE `tbl_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_footer_link`
--

DROP TABLE IF EXISTS `tbl_footer_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_footer_link` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order1` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_footer_link`
--

LOCK TABLES `tbl_footer_link` WRITE;
/*!40000 ALTER TABLE `tbl_footer_link` DISABLE KEYS */;
INSERT INTO `tbl_footer_link` VALUES (1,'Coronavirus Pandemic','https://www.worldometers.info/coronavirus/',1),(2,'BBC News','https://www.bbc.com/news/coronavirus',2),(3,'Covid 19 in USA','https://www.livescience.com/coronavirus-updates-united-states.html',3);
/*!40000 ALTER TABLE `tbl_footer_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_footer_page`
--

DROP TABLE IF EXISTS `tbl_footer_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_footer_page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int NOT NULL,
  `order1` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_footer_page`
--

LOCK TABLES `tbl_footer_page` WRITE;
/*!40000 ALTER TABLE `tbl_footer_page` DISABLE KEYS */;
INSERT INTO `tbl_footer_page` VALUES (1,11,2),(2,12,3),(4,1,1);
/*!40000 ALTER TABLE `tbl_footer_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_menu` (
  `menu_id` int NOT NULL AUTO_INCREMENT,
  `menu_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_id` int NOT NULL,
  `menu_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_order` int NOT NULL,
  `menu_parent` int NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu`
--

LOCK TABLES `tbl_menu` WRITE;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` VALUES (1,'Other',0,'Home','/',1,0),(2,'Page',2,'','',3,0),(3,'Other',0,'Pages','javascript:void;',7,0),(4,'Page',1,'','',2,0),(5,'Page',3,'','',3,3),(6,'Page',4,'','',4,3),(7,'Page',5,'','',6,0),(8,'Page',6,'','',8,0),(9,'Page',7,'','',5,3),(10,'Page',8,'','',6,3),(11,'Page',9,'','',1,3),(12,'Page',10,'','',2,3),(13,'Page',13,'','',4,0);
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_news`
--

DROP TABLE IF EXISTS `tbl_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `news_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `news_content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `news_content_short` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `news_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `news_order` int NOT NULL,
  `news_status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_news`
--

LOCK TABLES `tbl_news` WRITE;
/*!40000 ALTER TABLE `tbl_news` DISABLE KEYS */;
INSERT INTO `tbl_news` VALUES (1,'Volunteer army helping neighbours','volunteer-army-helping-neighbours','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium.','2020-04-03','news-1.jpg',6,1,'Active','Volunteer army helping neighbours','Volunteer army helping neighbours'),(5,'Measures taken to stop Coronavirus','measures-taken-to-stop-coronavirus','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium.','2020-04-03','news-5.jpg',3,2,'Active','Measures taken to stop Coronavirus','Measures taken to stop Coronavirus'),(6,'NHS Nightingale built in nine days','nhs-nightingale-built-in-nine-days','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium.','2020-04-03','news-6.jpg',6,3,'Active','NHS Nightingale built in nine days','NHS Nightingale built in nine days'),(7,'Making rapid life and death decisions','making-rapid-life-death-decisions','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium.','2020-04-03','news-7.jpg',6,4,'Active','Making rapid life and death decisions','Making rapid life and death decisions'),(8,'Police issue 144 fines during lockdown','police-fines-during-lockdown','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium.','2020-04-03','news-8.jpg',7,5,'Active','Police issue 144 fines during lockdown','Police issue 144 fines during lockdown'),(9,'Reason taking so long to develop vaccine','reason-taking-so-long-to-develop-vaccine','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium.','2020-04-03','news-9.jpg',8,6,'Active','Reason taking so long to develop vaccine','Reason taking so long to develop vaccine'),(10,'Partners respond in the Pacific when outbreak','partners-respond-in-the-pacific-when-outbreak','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium.','2020-04-03','news-10.jpg',9,7,'Active','Partners respond in the Pacific when outbreak','Partners respond in the Pacific when outbreak');
/*!40000 ALTER TABLE `tbl_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `billing_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `billing_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `billing_phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `billing_country` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `billing_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `billing_state` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `billing_city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `billing_zip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_country` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_state` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_zip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_date_time` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `txnid` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_cost` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coupon_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coupon_discount` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `card_number` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `card_cvv` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `card_expiry_month` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `card_expiry_year` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bank_information` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order`
--

LOCK TABLES `tbl_order` WRITE;
/*!40000 ALTER TABLE `tbl_order` DISABLE KEYS */;
INSERT INTO `tbl_order` VALUES (9,0,'David','david001@gmail.com','Guest','David','david001@gmail.com','345-788-2222','United States','4604 Airplane Avenue','CT','New Britain','06051','David','david001@gmail.com','345-788-2222','United States','4604 Airplane Avenue','CT','New Britain','06051','2020-04-11 18:24:12','ch_1GWm7uBoKopKik6AGwKtowQk','5.00','NICEMAN','5','14.25','4242424242424242','345','08','2020','','Stripe','Completed','5e91ef2c432db'),(10,1,'John Doe','customer@gmail.com','Returning Customer','John Doe','arefin2k@gmail.com','111-222-3333','United States','4706 Romrog Way','NE','Kearney','68847','John Doe','customer@gmail.com','111-222-3333','United States','4706 Romrog Way','NE','Kearney','68847','2020-04-11 18:42:29','ch_1GWmPcBoKopKik6Ab5kGRRFL','20.00','STRONG','10','16.00','4242424242424242','233','08','2020','','Stripe','Completed','5e91f3758dd6e'),(25,1,'John Doe','customer@gmail.com','Returning Customer','John Doe','arefin2k@gmail.com','111-222-3333','United States','4706 Romrog Way','NE','Kearney','68847','John Doe','customer@gmail.com','111-222-3333','United States','4706 Romrog Way','NE','Kearney','68847','2020-04-16 13:44:40','0FG10958DV106580N','0','STRONG','10','80.00','','','','','','PayPal','Completed','5e98614880783'),(31,0,'Smith','smith099@gmail.com','Guest','Smith','smith099@gmail.com','459-223-6246','United States','3464 Randolph Street','MA','Fall River','02720','Smith','smith099@gmail.com','459-223-6246','United States','3464 Randolph Street','MA','Fall River','02720','2020-04-17 06:30:58','87P86248C0595883D','0','','0','8.00','','','','','','PayPal','Completed','5e994d220f170');
/*!40000 ALTER TABLE `tbl_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order_delivery`
--

DROP TABLE IF EXISTS `tbl_order_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_order_delivery` (
  `delivery_id` int NOT NULL AUTO_INCREMENT,
  `delivery_status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `delivery_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `delivery_created` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order_delivery`
--

LOCK TABLES `tbl_order_delivery` WRITE;
/*!40000 ALTER TABLE `tbl_order_delivery` DISABLE KEYS */;
INSERT INTO `tbl_order_delivery` VALUES (2,'Received','We have received your order.','2020-04-16 16:39:17 PM','5e98614880783'),(3,'Received','','2020-04-17 08:55:18 AM','5e91ef2c432db'),(4,'Received','','2020-04-17 08:55:27 AM','5e91f3758dd6e'),(7,'Received','','2020-04-17 09:02:22 AM','5e994d220f170');
/*!40000 ALTER TABLE `tbl_order_delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order_detail`
--

DROP TABLE IF EXISTS `tbl_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_order_detail` (
  `order_detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_price` float NOT NULL,
  `product_qty` int NOT NULL,
  `payment_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`order_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order_detail`
--

LOCK TABLES `tbl_order_detail` WRITE;
/*!40000 ALTER TABLE `tbl_order_detail` DISABLE KEYS */;
INSERT INTO `tbl_order_detail` VALUES (25,9,3,'N95 Respirator',8,1,'Completed','5e91ef2c432db'),(24,9,1,'Face Covering Mask',2,1,'Completed','5e91ef2c432db'),(26,10,1,'Face Covering Mask',2,3,'Completed','5e91f3758dd6e'),(45,25,5,'Dettol Soap',10,2,'Completed','5e98614880783'),(46,25,8,'Ventilator',70,1,'Completed','5e98614880783'),(52,31,3,'N95 Respirator',8,1,'Completed','5e994d220f170');
/*!40000 ALTER TABLE `tbl_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_page`
--

DROP TABLE IF EXISTS `tbl_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_page` (
  `page_id` int NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_layout` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_page`
--

LOCK TABLES `tbl_page` WRITE;
/*!40000 ALTER TABLE `tbl_page` DISABLE KEYS */;
INSERT INTO `tbl_page` VALUES (1,'About','about','<h3>What is COVID-19</h3>\r\n\r\n<ul>\r\n	<li>COVID-19 is the disease caused by the new coronavirus that emerged in China in December 2019.</li>\r\n	<li>COVID-19 symptoms include cough, fever and shortness of breath. COVID-19 can be severe, and some cases have caused death.</li>\r\n	<li>The new coronavirus can be spread from person to person. It is diagnosed with a laboratory test.</li>\r\n	<li>There is no coronavirus vaccine yet. Prevention involves frequent hand-washing, coughing into the bend of your elbow and staying home when you are sick.</li>\r\n</ul>\r\n\r\n<h3>How is COVID-19 spread?</h3>\r\n\r\n<p>COVID-19 can be passed from person to person through droplets from coughs and sneezes. COVID-19 has been detected in people all over the world, and is considered a pandemic.</p>\r\n\r\n<p>The spread of this new coronavirus is being monitored by the Centers for Disease Control (CDC), the World Health Organization and health organizations like Johns Hopkins across the globe.</p>\r\n\r\n<h3>How did this new coronavirus spread to humans?</h3>\r\n\r\n<p>COVID-19 appeared in Wuhan, a city in China, in December 2019. Although health officials are still tracing the exact source of this new coronavirus, early hypotheses thought it may be linked to a seafood market in Wuhan, China. Some people who visited the market developed viral pneumonia caused by the new coronavirus. A study that came out on Jan. 25, 2020, notes that the individual with the first reported case became ill on Dec. 1, 2019, and had no link to the seafood market. Investigations are ongoing as to how this virus originated and spread.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n','Full Width Page Layout','page-banner-1.jpg','Active','About Us','This is description in about us page.'),(2,'Prevention','preventions','','Prevention Page Layout','page-banner-2.jpg','Active','Preventions','Preventions Description'),(3,'FAQ','faq','','FAQ Page Layout','page-banner-3.jpg','Active','Freequently Asked Questions (FAQ)','Freequently Asked Questions (FAQ) Description'),(4,'Doctors','doctors','','Doctor Page Layout','page-banner-4.jpg','Active','Doctors','Doctors Description'),(5,'News','news','','News Page Layout','page-banner-5.jpg','Active','News','News Description'),(6,'Contact','contact','','Contact Us Page Layout','page-banner-6.jpg','Active','Contact','Contact'),(7,'Who We Are','who-we-are','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Full Width Page Layout','page-banner-7.jpg','Active','Who We Are','Who We Are'),(8,'What We Do','what-we-do','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Full Width Page Layout','page-banner-8.jpg','Active','What We Do','What We Do'),(9,'Photo Gallery','photo-gallery','','Photo Gallery Page Layout','page-banner-9.jpg','Active','Photo Gallery','Photo Gallery'),(10,'Video Gallery','video-gallery','','Video Gallery Page Layout','page-banner-10.jpg','Active','Video Gallery','Video Gallery'),(11,'Privacy Policy','privacy-policy','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Full Width Page Layout','page-banner-11.jpg','Active','Privacy Policy','Privacy Policy'),(12,'Terms and Conditions','terms-and-conditions','<p>Lorem ipsum dolor sit amet, ea qui tation adversarium definitionem, eu labitur denique est. Ad duo quando recusabo petentium. Mea elit affert oportere ex. Ut error affert accusam pri. Sit no causae vidisse invenire, bonorum inermis nec ex.</p>\r\n\r\n<p>Eam sint reformidans ex, ex doming iracundia his. Sint modus pro ne, vix ut omnis scripta corpora. Sea graecis suavitate te. Eum tantas possim torquatos ei. An qui falli sadipscing suscipiantur. At congue forensibus constituto his, erat vidit veniam vis eu, dico soleat possim nec ei.</p>\r\n\r\n<p>Cu modo adipisci sea. At clita doctus sit. Pri ex solet deterruisset, falli harum fuisset qui ei, an commune delicata patrioque sit. Fabulas adversarium no sea, at quis disputando pri, meis epicurei eloquentiam vix ad. An consulatu sententiae posidonium his, te elaboraret cotidieque eos, sed an illud recteque.</p>\r\n\r\n<p>Eu per altera aliquam consulatu, ea pro nulla doctus. Sea porro everti an, nostrud ceteros nam no. Ei quando qualisque his, alterum ocurreret nec eu, dolorum deseruisse ad mel. Nam vidit omnis ad, pro eu veniam efficiendi, sea an iriure vivendo appetere. Usu ad latine vocibus voluptatum.</p>\r\n\r\n<p>Et bonorum consetetur mediocritatem qui, cu est omnis persequeris, mea te doctus incorrupte. Vix et tale justo. Vel te lorem sapientem interesset. Ne ius tantas saperet officiis, volutpat adolescens ut sea, an animal consectetuer vis. Nonumy ornatus constituam vis ne, cum ne vidisse patrioque.</p>\r\n','Full Width Page Layout','page-banner-12.jpg','Active','Terms and Conditions','Terms and Conditions'),(13,'Products','products','','Product Page Layout','page-banner-13.jpg','Active','Products','Products');
/*!40000 ALTER TABLE `tbl_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_photo`
--

DROP TABLE IF EXISTS `tbl_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_photo` (
  `photo_id` int NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo_caption` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo_order` int NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_photo`
--

LOCK TABLES `tbl_photo` WRITE;
/*!40000 ALTER TABLE `tbl_photo` DISABLE KEYS */;
INSERT INTO `tbl_photo` VALUES (1,'photo-1.jpg','China Corona Virus - What we know so far',1),(2,'photo-2.jpg','Coronavirus claims 210 lives in Iran',2),(3,'photo-3.jpg','Vietnam says all its infected patients cured',3),(4,'photo-4.jpg','Protective measures have been stepped up in China',4),(5,'photo-5.png','Coronavirus likely now gathering steam',5),(7,'photo-7.jpg','China to probe death of \'hero\' doctor who raised alarm on coronavirus',6);
/*!40000 ALTER TABLE `tbl_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_prevention`
--

DROP TABLE IF EXISTS `tbl_prevention`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_prevention` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `short_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prevention_order` int NOT NULL,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_prevention`
--

LOCK TABLES `tbl_prevention` WRITE;
/*!40000 ALTER TABLE `tbl_prevention` DISABLE KEYS */;
INSERT INTO `tbl_prevention` VALUES (1,'Wash Hands Regularly','wash-hands-regularly','<p>Lorem ipsum dolor sit amet, porro dicam docendi mei an. Vis paulo euismod delectus an. Te has prima fierent, suscipit platonem necessitatibus nec cu. Eu cum justo munere malorum, quo cu quando adipisci, ex porro ceteros duo. Has cu aeterno fastidii vituperatoribus, duo ea nihil percipitur.</p>\r\n\r\n<p>Ne mea quaestio tincidunt, modus cetero singulis et per. Vix ne fuisset senserit. Partem instructior ne per. Ea est erant forensibus, pri ne prima mucius dictas, in cum graeci corpora volutpat. Cum ea virtute feugait delicatissimi, reque clita vel at, habeo luptatum et eam.</p>\r\n\r\n<p>Id duo alia animal apeirian, cum persius aliquam incorrupte et. Utinam deleniti ponderum ex mel, adhuc singulis democritum has ad, te duo postea antiopam consectetuer. Sit stet tractatos definiebas no, malis libris delicata mei te. At dicit habemus adversarium eam, falli error quo ex, no mel altera cetero officiis. Has ad affert putent epicuri, alia dolorem scriptorem sea an.</p>\r\n','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','prevention-1.png','Wash Hands Regularly','Wash Hands Regularly Description',1,'Active'),(2,'Avoid close contact','avoid-close-contact','<p>Lorem ipsum dolor sit amet, porro dicam docendi mei an. Vis paulo euismod delectus an. Te has prima fierent, suscipit platonem necessitatibus nec cu. Eu cum justo munere malorum, quo cu quando adipisci, ex porro ceteros duo. Has cu aeterno fastidii vituperatoribus, duo ea nihil percipitur.</p>\r\n\r\n<p>Ne mea quaestio tincidunt, modus cetero singulis et per. Vix ne fuisset senserit. Partem instructior ne per. Ea est erant forensibus, pri ne prima mucius dictas, in cum graeci corpora volutpat. Cum ea virtute feugait delicatissimi, reque clita vel at, habeo luptatum et eam.</p>\r\n\r\n<p>Id duo alia animal apeirian, cum persius aliquam incorrupte et. Utinam deleniti ponderum ex mel, adhuc singulis democritum has ad, te duo postea antiopam consectetuer. Sit stet tractatos definiebas no, malis libris delicata mei te. At dicit habemus adversarium eam, falli error quo ex, no mel altera cetero officiis. Has ad affert putent epicuri, alia dolorem scriptorem sea an.</p>\r\n','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','prevention-2.png','Avoid close contact','Avoid close contact Description',2,'Active'),(8,'Stay home and self-isolate','stay-home-and-self-isolate','<p>Lorem ipsum dolor sit amet, porro dicam docendi mei an. Vis paulo euismod delectus an. Te has prima fierent, suscipit platonem necessitatibus nec cu. Eu cum justo munere malorum, quo cu quando adipisci, ex porro ceteros duo. Has cu aeterno fastidii vituperatoribus, duo ea nihil percipitur.</p>\r\n\r\n<p>Ne mea quaestio tincidunt, modus cetero singulis et per. Vix ne fuisset senserit. Partem instructior ne per. Ea est erant forensibus, pri ne prima mucius dictas, in cum graeci corpora volutpat. Cum ea virtute feugait delicatissimi, reque clita vel at, habeo luptatum et eam.</p>\r\n\r\n<p>Id duo alia animal apeirian, cum persius aliquam incorrupte et. Utinam deleniti ponderum ex mel, adhuc singulis democritum has ad, te duo postea antiopam consectetuer. Sit stet tractatos definiebas no, malis libris delicata mei te. At dicit habemus adversarium eam, falli error quo ex, no mel altera cetero officiis. Has ad affert putent epicuri, alia dolorem scriptorem sea an.</p>\r\n','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','prevention-8.jpg','Stay home and self-isolate','Stay home and self-isolate Description',3,'Active'),(9,'Touch mouth, eye & nose','touch-mouth-eye-nose','<p>Lorem ipsum dolor sit amet, porro dicam docendi mei an. Vis paulo euismod delectus an. Te has prima fierent, suscipit platonem necessitatibus nec cu. Eu cum justo munere malorum, quo cu quando adipisci, ex porro ceteros duo. Has cu aeterno fastidii vituperatoribus, duo ea nihil percipitur.</p>\r\n\r\n<p>Ne mea quaestio tincidunt, modus cetero singulis et per. Vix ne fuisset senserit. Partem instructior ne per. Ea est erant forensibus, pri ne prima mucius dictas, in cum graeci corpora volutpat. Cum ea virtute feugait delicatissimi, reque clita vel at, habeo luptatum et eam.</p>\r\n\r\n<p>Id duo alia animal apeirian, cum persius aliquam incorrupte et. Utinam deleniti ponderum ex mel, adhuc singulis democritum has ad, te duo postea antiopam consectetuer. Sit stet tractatos definiebas no, malis libris delicata mei te. At dicit habemus adversarium eam, falli error quo ex, no mel altera cetero officiis. Has ad affert putent epicuri, alia dolorem scriptorem sea an.</p>\r\n','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','prevention-9.jpg','Touch mouth, eye & nose','Touch mouth, eye & nose Description',4,'Active'),(12,'Use Mask When Outside','use-mask-when-outside','<p>Lorem ipsum dolor sit amet, porro dicam docendi mei an. Vis paulo euismod delectus an. Te has prima fierent, suscipit platonem necessitatibus nec cu. Eu cum justo munere malorum, quo cu quando adipisci, ex porro ceteros duo. Has cu aeterno fastidii vituperatoribus, duo ea nihil percipitur.</p>\r\n\r\n<p>Ne mea quaestio tincidunt, modus cetero singulis et per. Vix ne fuisset senserit. Partem instructior ne per. Ea est erant forensibus, pri ne prima mucius dictas, in cum graeci corpora volutpat. Cum ea virtute feugait delicatissimi, reque clita vel at, habeo luptatum et eam.</p>\r\n\r\n<p>Id duo alia animal apeirian, cum persius aliquam incorrupte et. Utinam deleniti ponderum ex mel, adhuc singulis democritum has ad, te duo postea antiopam consectetuer. Sit stet tractatos definiebas no, malis libris delicata mei te. At dicit habemus adversarium eam, falli error quo ex, no mel altera cetero officiis. Has ad affert putent epicuri, alia dolorem scriptorem sea an.</p>\r\n','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','prevention-12.jpg','Use Mask When Outside','Use Mask When Outside Description',5,'Active'),(13,'Keep Home Yard Clean','keep-home-yard-clean','<p>Lorem ipsum dolor sit amet, porro dicam docendi mei an. Vis paulo euismod delectus an. Te has prima fierent, suscipit platonem necessitatibus nec cu. Eu cum justo munere malorum, quo cu quando adipisci, ex porro ceteros duo. Has cu aeterno fastidii vituperatoribus, duo ea nihil percipitur.</p>\r\n\r\n<p>Ne mea quaestio tincidunt, modus cetero singulis et per. Vix ne fuisset senserit. Partem instructior ne per. Ea est erant forensibus, pri ne prima mucius dictas, in cum graeci corpora volutpat. Cum ea virtute feugait delicatissimi, reque clita vel at, habeo luptatum et eam.</p>\r\n\r\n<p>Id duo alia animal apeirian, cum persius aliquam incorrupte et. Utinam deleniti ponderum ex mel, adhuc singulis democritum has ad, te duo postea antiopam consectetuer. Sit stet tractatos definiebas no, malis libris delicata mei te. At dicit habemus adversarium eam, falli error quo ex, no mel altera cetero officiis. Has ad affert putent epicuri, alia dolorem scriptorem sea an.</p>\r\n','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','prevention-13.jpg','Keep Home Yard Clean','Keep Home Yard Clean Description',6,'Active');
/*!40000 ALTER TABLE `tbl_prevention` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_old_price` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_current_price` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_stock` int NOT NULL,
  `product_content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_content_short` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_return_policy` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_featured_photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_order` int NOT NULL,
  `product_status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product`
--

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` VALUES (1,'Face Covering Mask','face-covering-normal-mask','3.5','2',4,'<p>Lorem ipsum dolor sit amet, erat dicat percipitur vix in, habeo expetendis nam et, his homero verterem molestiae ea. Tantas legere blandit duo ei, ei malis maluisset voluptatum mei. Ne mel alia consul equidem, at mea timeam indoctum explicari. Ut detracto gubergren dissentiet sea, harum dolores deserunt ut sed. Mel ne animal invidunt petentium, te mei exerci voluptaria. Quo id populo fabulas voluptatum, ius ei legere deterruisset, et nec ridens liberavisse. Nusquam partiendo scribentur quo an.</p>\r\n\r\n<p>Et duo inermis tacimates, sed id posse intellegebat, ut sed agam aperiri. Nam ex dolorem vivendum, te omnis eleifend est, atqui tempor fabellas ne qui. Cotidieque reprehendunt eam no. Sed at alii sanctus, ius dictas mediocritatem in. Qui stet principes ut, ad pro dicat oporteat. Doctus senserit sea ut, eum an iisque neglegentur. Fugit putant consequuntur id sit.</p>\r\n\r\n<p>In vidisse referrentur consectetuer duo. Dolor vocibus consulatu an pro, ei sed graece tritani perpetua. Mel et dolorem percipit, per nemore commune gloriatur no. Ex sed minim utamur intellegebat. &nbsp;</p>\r\n','Lorem ipsum dolor sit amet, erat dicat percipitur vix in, habeo expetendis nam et, his homero verterem molestiae ea.','<p>Eu eos malis dicat facilisis, aliquip alterum assentior at vix. Inimicus interpretaris ei vim, graece singulis atomorum ad per, ea sed admodum apeirian indoctum. Cu pro tantas reprehendunt. Usu menandri pertinacia et, vis ne scaevola dissentias. In ornatus eligendi persequeris his, ea usu causae labitur. At porro delectus sed. Quot minim ei has, has id dolore maiorum interesset.</p>\r\n\r\n<p>Justo incorrupte ea quo, adhuc eligendi reprimique pro et. Eos nobis aeterno conclusionemque ei, no eam dolor delectus. Error altera argumentum quo ea, eam ne antiopam assentior. Ea mea ullum dicant timeam, sea affert reformidans ad. Ei dicam appetere sea, id phaedrum moderatius sed.</p>\r\n\r\n<p>Ad mel velit quidam honestatis. Has no mediocrem repudiandae, mel in ceteros perfecto gubergren, has ne dignissim consequat theophrastus. Duo et assum harum iriure, solum ubique philosophia per an, mea clita nominati reprehendunt ei. Zril melius dignissim qui ad. Debitis fierent quo in, no usu affert aeterno.</p>\r\n','product-1.jpg',1,'Active','Face Covering Mask','Face Covering Mask'),(2,'Surgical Mask','surgical-mask','5','4',3,'<p>Lorem ipsum dolor sit amet, erat dicat percipitur vix in, habeo expetendis nam et, his homero verterem molestiae ea. Tantas legere blandit duo ei, ei malis maluisset voluptatum mei. Ne mel alia consul equidem, at mea timeam indoctum explicari. Ut detracto gubergren dissentiet sea, harum dolores deserunt ut sed. Mel ne animal invidunt petentium, te mei exerci voluptaria. Quo id populo fabulas voluptatum, ius ei legere deterruisset, et nec ridens liberavisse. Nusquam partiendo scribentur quo an.</p>\r\n\r\n<p>Et duo inermis tacimates, sed id posse intellegebat, ut sed agam aperiri. Nam ex dolorem vivendum, te omnis eleifend est, atqui tempor fabellas ne qui. Cotidieque reprehendunt eam no. Sed at alii sanctus, ius dictas mediocritatem in. Qui stet principes ut, ad pro dicat oporteat. Doctus senserit sea ut, eum an iisque neglegentur. Fugit putant consequuntur id sit.</p>\r\n\r\n<p>In vidisse referrentur consectetuer duo. Dolor vocibus consulatu an pro, ei sed graece tritani perpetua. Mel et dolorem percipit, per nemore commune gloriatur no. Ex sed minim utamur intellegebat.</p>\r\n','Lorem ipsum dolor sit amet, erat dicat percipitur vix in, habeo expetendis nam et, his homero verterem molestiae ea. ','<p>Eu eos malis dicat facilisis, aliquip alterum assentior at vix. Inimicus interpretaris ei vim, graece singulis atomorum ad per, ea sed admodum apeirian indoctum. Cu pro tantas reprehendunt. Usu menandri pertinacia et, vis ne scaevola dissentias. In ornatus eligendi persequeris his, ea usu causae labitur. At porro delectus sed. Quot minim ei has, has id dolore maiorum interesset.</p>\r\n\r\n<p>Justo incorrupte ea quo, adhuc eligendi reprimique pro et. Eos nobis aeterno conclusionemque ei, no eam dolor delectus. Error altera argumentum quo ea, eam ne antiopam assentior. Ea mea ullum dicant timeam, sea affert reformidans ad. Ei dicam appetere sea, id phaedrum moderatius sed.</p>\r\n\r\n<p>Ad mel velit quidam honestatis. Has no mediocrem repudiandae, mel in ceteros perfecto gubergren, has ne dignissim consequat theophrastus. Duo et assum harum iriure, solum ubique philosophia per an, mea clita nominati reprehendunt ei. Zril melius dignissim qui ad. Debitis fierent quo in, no usu affert aeterno.</p>\r\n','product-2.png',2,'Active','Surgical Mask','Surgical Mask'),(3,'N95 Respirator','n95-respirator','10','8',0,'<p>Lorem ipsum dolor sit amet, erat dicat percipitur vix in, habeo expetendis nam et, his homero verterem molestiae ea. Tantas legere blandit duo ei, ei malis maluisset voluptatum mei. Ne mel alia consul equidem, at mea timeam indoctum explicari. Ut detracto gubergren dissentiet sea, harum dolores deserunt ut sed. Mel ne animal invidunt petentium, te mei exerci voluptaria. Quo id populo fabulas voluptatum, ius ei legere deterruisset, et nec ridens liberavisse. Nusquam partiendo scribentur quo an.</p>\r\n\r\n<p>Et duo inermis tacimates, sed id posse intellegebat, ut sed agam aperiri. Nam ex dolorem vivendum, te omnis eleifend est, atqui tempor fabellas ne qui. Cotidieque reprehendunt eam no. Sed at alii sanctus, ius dictas mediocritatem in. Qui stet principes ut, ad pro dicat oporteat. Doctus senserit sea ut, eum an iisque neglegentur. Fugit putant consequuntur id sit.</p>\r\n\r\n<p>In vidisse referrentur consectetuer duo. Dolor vocibus consulatu an pro, ei sed graece tritani perpetua. Mel et dolorem percipit, per nemore commune gloriatur no. Ex sed minim utamur intellegebat.</p>\r\n','Lorem ipsum dolor sit amet, erat dicat percipitur vix in, habeo expetendis nam et, his homero verterem molestiae ea.','<p>Eu eos malis dicat facilisis, aliquip alterum assentior at vix. Inimicus interpretaris ei vim, graece singulis atomorum ad per, ea sed admodum apeirian indoctum. Cu pro tantas reprehendunt. Usu menandri pertinacia et, vis ne scaevola dissentias. In ornatus eligendi persequeris his, ea usu causae labitur. At porro delectus sed. Quot minim ei has, has id dolore maiorum interesset.</p>\r\n\r\n<p>Justo incorrupte ea quo, adhuc eligendi reprimique pro et. Eos nobis aeterno conclusionemque ei, no eam dolor delectus. Error altera argumentum quo ea, eam ne antiopam assentior. Ea mea ullum dicant timeam, sea affert reformidans ad. Ei dicam appetere sea, id phaedrum moderatius sed.</p>\r\n\r\n<p>Ad mel velit quidam honestatis. Has no mediocrem repudiandae, mel in ceteros perfecto gubergren, has ne dignissim consequat theophrastus. Duo et assum harum iriure, solum ubique philosophia per an, mea clita nominati reprehendunt ei. Zril melius dignissim qui ad. Debitis fierent quo in, no usu affert aeterno.</p>\r\n','product-3.jpg',3,'Active','N95 respirator','N95 respirator'),(4,'Hand Sanitizer','hand-sanitizer','6','5',0,'<p>Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut. Prima impetus virtute usu ex, et vim numquam efficiantur, cu vis option civibus. Ad tale quas corpora has, melius nostrud ius ad, sonet consectetuer signiferumque cu usu. Sed te adhuc atomorum, ad quo erant alterum reprimique. Virtute equidem deseruisse vim ei.</p>\r\n\r\n<p>Eu vim atqui ludus petentium, suas idque est id. Ne veniam oblique propriae vim, dicant forensibus definitionem vix eu. Pri eu probatus abhorreant, nonumy aliquid perpetua ut usu. Etiam iudicabit vituperata ne est, id sed everti utroque, vis ea oblique pertinax concludaturque.</p>\r\n\r\n<p>Te cum abhorreant temporibus, eam mazim platonem ea. Dolor abhorreant sea et, usu cu debet bonorum, aliquando instructior necessitatibus vix te. Ea ubique percipit recusabo cum, regione consulatu interpretaris vim no, mel altera fabulas probatus ad. Ignota tritani ad nam, eu per delectus perfecto conceptam.</p>\r\n\r\n<p>An sanctus pertinax cotidieque sed, quo te habemus molestiae consetetur, at salutandi periculis expetendis vim. Quando nusquam eum ut, ius an quem alii. Sit ad ullum consequuntur. Ei sea iudico sententiae honestatis, mel dolorem pertinax senserit ei, cu causae timeam eripuit sit. Sed ex habeo blandit oporteat, ex usu autem iisque. Vel minim dicam soleat te, denique liberavisse ex usu, cibo omnes te eam. Pri esse nobis no, no quo volutpat vulputate.</p>\r\n','Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut.','<p>Eu eos malis dicat facilisis, aliquip alterum assentior at vix. Inimicus interpretaris ei vim, graece singulis atomorum ad per, ea sed admodum apeirian indoctum. Cu pro tantas reprehendunt. Usu menandri pertinacia et, vis ne scaevola dissentias. In ornatus eligendi persequeris his, ea usu causae labitur. At porro delectus sed. Quot minim ei has, has id dolore maiorum interesset.</p>\r\n\r\n<p>Justo incorrupte ea quo, adhuc eligendi reprimique pro et. Eos nobis aeterno conclusionemque ei, no eam dolor delectus. Error altera argumentum quo ea, eam ne antiopam assentior. Ea mea ullum dicant timeam, sea affert reformidans ad. Ei dicam appetere sea, id phaedrum moderatius sed.</p>\r\n\r\n<p>Ad mel velit quidam honestatis. Has no mediocrem repudiandae, mel in ceteros perfecto gubergren, has ne dignissim consequat theophrastus. Duo et assum harum iriure, solum ubique philosophia per an, mea clita nominati reprehendunt ei. Zril melius dignissim qui ad. Debitis fierent quo in, no usu affert aeterno.</p>\r\n','product-4.png',4,'Active','Hand Sanitizer',''),(5,'Dettol Soap','dettol-soap','13','10',10,'<p>Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut. Prima impetus virtute usu ex, et vim numquam efficiantur, cu vis option civibus. Ad tale quas corpora has, melius nostrud ius ad, sonet consectetuer signiferumque cu usu. Sed te adhuc atomorum, ad quo erant alterum reprimique. Virtute equidem deseruisse vim ei.</p>\r\n\r\n<p>Eu vim atqui ludus petentium, suas idque est id. Ne veniam oblique propriae vim, dicant forensibus definitionem vix eu. Pri eu probatus abhorreant, nonumy aliquid perpetua ut usu. Etiam iudicabit vituperata ne est, id sed everti utroque, vis ea oblique pertinax concludaturque.</p>\r\n\r\n<p>Te cum abhorreant temporibus, eam mazim platonem ea. Dolor abhorreant sea et, usu cu debet bonorum, aliquando instructior necessitatibus vix te. Ea ubique percipit recusabo cum, regione consulatu interpretaris vim no, mel altera fabulas probatus ad. Ignota tritani ad nam, eu per delectus perfecto conceptam.</p>\r\n\r\n<p>An sanctus pertinax cotidieque sed, quo te habemus molestiae consetetur, at salutandi periculis expetendis vim. Quando nusquam eum ut, ius an quem alii. Sit ad ullum consequuntur. Ei sea iudico sententiae honestatis, mel dolorem pertinax senserit ei, cu causae timeam eripuit sit. Sed ex habeo blandit oporteat, ex usu autem iisque. Vel minim dicam soleat te, denique liberavisse ex usu, cibo omnes te eam. Pri esse nobis no, no quo volutpat vulputate.</p>\r\n','Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut. ','<p>Eu eos malis dicat facilisis, aliquip alterum assentior at vix. Inimicus interpretaris ei vim, graece singulis atomorum ad per, ea sed admodum apeirian indoctum. Cu pro tantas reprehendunt. Usu menandri pertinacia et, vis ne scaevola dissentias. In ornatus eligendi persequeris his, ea usu causae labitur. At porro delectus sed. Quot minim ei has, has id dolore maiorum interesset.</p>\r\n\r\n<p>Justo incorrupte ea quo, adhuc eligendi reprimique pro et. Eos nobis aeterno conclusionemque ei, no eam dolor delectus. Error altera argumentum quo ea, eam ne antiopam assentior. Ea mea ullum dicant timeam, sea affert reformidans ad. Ei dicam appetere sea, id phaedrum moderatius sed.</p>\r\n\r\n<p>Ad mel velit quidam honestatis. Has no mediocrem repudiandae, mel in ceteros perfecto gubergren, has ne dignissim consequat theophrastus. Duo et assum harum iriure, solum ubique philosophia per an, mea clita nominati reprehendunt ei. Zril melius dignissim qui ad. Debitis fierent quo in, no usu affert aeterno.</p>\r\n','product-5.jpg',5,'Active','Dettol Soap','Dettol Soap'),(6,'Savlon Handwash','savlon-handwash','16','12',1,'<p>Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut. Prima impetus virtute usu ex, et vim numquam efficiantur, cu vis option civibus. Ad tale quas corpora has, melius nostrud ius ad, sonet consectetuer signiferumque cu usu. Sed te adhuc atomorum, ad quo erant alterum reprimique. Virtute equidem deseruisse vim ei.</p>\r\n\r\n<p>Eu vim atqui ludus petentium, suas idque est id. Ne veniam oblique propriae vim, dicant forensibus definitionem vix eu. Pri eu probatus abhorreant, nonumy aliquid perpetua ut usu. Etiam iudicabit vituperata ne est, id sed everti utroque, vis ea oblique pertinax concludaturque.</p>\r\n\r\n<p>Te cum abhorreant temporibus, eam mazim platonem ea. Dolor abhorreant sea et, usu cu debet bonorum, aliquando instructior necessitatibus vix te. Ea ubique percipit recusabo cum, regione consulatu interpretaris vim no, mel altera fabulas probatus ad. Ignota tritani ad nam, eu per delectus perfecto conceptam.</p>\r\n\r\n<p>An sanctus pertinax cotidieque sed, quo te habemus molestiae consetetur, at salutandi periculis expetendis vim. Quando nusquam eum ut, ius an quem alii. Sit ad ullum consequuntur. Ei sea iudico sententiae honestatis, mel dolorem pertinax senserit ei, cu causae timeam eripuit sit. Sed ex habeo blandit oporteat, ex usu autem iisque. Vel minim dicam soleat te, denique liberavisse ex usu, cibo omnes te eam. Pri esse nobis no, no quo volutpat vulputate.</p>\r\n','Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut.','<p>Eu eos malis dicat facilisis, aliquip alterum assentior at vix. Inimicus interpretaris ei vim, graece singulis atomorum ad per, ea sed admodum apeirian indoctum. Cu pro tantas reprehendunt. Usu menandri pertinacia et, vis ne scaevola dissentias. In ornatus eligendi persequeris his, ea usu causae labitur. At porro delectus sed. Quot minim ei has, has id dolore maiorum interesset.</p>\r\n\r\n<p>Justo incorrupte ea quo, adhuc eligendi reprimique pro et. Eos nobis aeterno conclusionemque ei, no eam dolor delectus. Error altera argumentum quo ea, eam ne antiopam assentior. Ea mea ullum dicant timeam, sea affert reformidans ad. Ei dicam appetere sea, id phaedrum moderatius sed.</p>\r\n\r\n<p>Ad mel velit quidam honestatis. Has no mediocrem repudiandae, mel in ceteros perfecto gubergren, has ne dignissim consequat theophrastus. Duo et assum harum iriure, solum ubique philosophia per an, mea clita nominati reprehendunt ei. Zril melius dignissim qui ad. Debitis fierent quo in, no usu affert aeterno.</p>\r\n','product-6.jpg',6,'Active','Savlon Handwash','Savlon Handwash'),(7,'PPE Protector','personal-protective-equipment','24','20',4,'<p>Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut. Prima impetus virtute usu ex, et vim numquam efficiantur, cu vis option civibus. Ad tale quas corpora has, melius nostrud ius ad, sonet consectetuer signiferumque cu usu. Sed te adhuc atomorum, ad quo erant alterum reprimique. Virtute equidem deseruisse vim ei.</p>\r\n\r\n<p>Eu vim atqui ludus petentium, suas idque est id. Ne veniam oblique propriae vim, dicant forensibus definitionem vix eu. Pri eu probatus abhorreant, nonumy aliquid perpetua ut usu. Etiam iudicabit vituperata ne est, id sed everti utroque, vis ea oblique pertinax concludaturque.</p>\r\n\r\n<p>Te cum abhorreant temporibus, eam mazim platonem ea. Dolor abhorreant sea et, usu cu debet bonorum, aliquando instructior necessitatibus vix te. Ea ubique percipit recusabo cum, regione consulatu interpretaris vim no, mel altera fabulas probatus ad. Ignota tritani ad nam, eu per delectus perfecto conceptam.</p>\r\n\r\n<p>An sanctus pertinax cotidieque sed, quo te habemus molestiae consetetur, at salutandi periculis expetendis vim. Quando nusquam eum ut, ius an quem alii. Sit ad ullum consequuntur. Ei sea iudico sententiae honestatis, mel dolorem pertinax senserit ei, cu causae timeam eripuit sit. Sed ex habeo blandit oporteat, ex usu autem iisque. Vel minim dicam soleat te, denique liberavisse ex usu, cibo omnes te eam. Pri esse nobis no, no quo volutpat vulputate.</p>\r\n','Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut.','<p>Eu eos malis dicat facilisis, aliquip alterum assentior at vix. Inimicus interpretaris ei vim, graece singulis atomorum ad per, ea sed admodum apeirian indoctum. Cu pro tantas reprehendunt. Usu menandri pertinacia et, vis ne scaevola dissentias. In ornatus eligendi persequeris his, ea usu causae labitur. At porro delectus sed. Quot minim ei has, has id dolore maiorum interesset.</p>\r\n\r\n<p>Justo incorrupte ea quo, adhuc eligendi reprimique pro et. Eos nobis aeterno conclusionemque ei, no eam dolor delectus. Error altera argumentum quo ea, eam ne antiopam assentior. Ea mea ullum dicant timeam, sea affert reformidans ad. Ei dicam appetere sea, id phaedrum moderatius sed.</p>\r\n\r\n<p>Ad mel velit quidam honestatis. Has no mediocrem repudiandae, mel in ceteros perfecto gubergren, has ne dignissim consequat theophrastus. Duo et assum harum iriure, solum ubique philosophia per an, mea clita nominati reprehendunt ei. Zril melius dignissim qui ad. Debitis fierent quo in, no usu affert aeterno.</p>\r\n','product-7.jpg',7,'Active','Personal Protective Equipment (PPE)','Personal Protective Equipment (PPE)'),(8,'Ventilator','ventilator','90','70',4,'<p>Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut. Prima impetus virtute usu ex, et vim numquam efficiantur, cu vis option civibus. Ad tale quas corpora has, melius nostrud ius ad, sonet consectetuer signiferumque cu usu. Sed te adhuc atomorum, ad quo erant alterum reprimique. Virtute equidem deseruisse vim ei.</p>\r\n\r\n<p>Eu vim atqui ludus petentium, suas idque est id. Ne veniam oblique propriae vim, dicant forensibus definitionem vix eu. Pri eu probatus abhorreant, nonumy aliquid perpetua ut usu. Etiam iudicabit vituperata ne est, id sed everti utroque, vis ea oblique pertinax concludaturque.</p>\r\n\r\n<p>Te cum abhorreant temporibus, eam mazim platonem ea. Dolor abhorreant sea et, usu cu debet bonorum, aliquando instructior necessitatibus vix te. Ea ubique percipit recusabo cum, regione consulatu interpretaris vim no, mel altera fabulas probatus ad. Ignota tritani ad nam, eu per delectus perfecto conceptam.</p>\r\n\r\n<p>An sanctus pertinax cotidieque sed, quo te habemus molestiae consetetur, at salutandi periculis expetendis vim. Quando nusquam eum ut, ius an quem alii. Sit ad ullum consequuntur. Ei sea iudico sententiae honestatis, mel dolorem pertinax senserit ei, cu causae timeam eripuit sit. Sed ex habeo blandit oporteat, ex usu autem iisque. Vel minim dicam soleat te, denique liberavisse ex usu, cibo omnes te eam. Pri esse nobis no, no quo volutpat vulputate.</p>\r\n','Lorem ipsum dolor sit amet, te constituto intellegam eloquentiam sed, putent accusamus temporibus his ut. ','<p>Eu eos malis dicat facilisis, aliquip alterum assentior at vix. Inimicus interpretaris ei vim, graece singulis atomorum ad per, ea sed admodum apeirian indoctum. Cu pro tantas reprehendunt. Usu menandri pertinacia et, vis ne scaevola dissentias. In ornatus eligendi persequeris his, ea usu causae labitur. At porro delectus sed. Quot minim ei has, has id dolore maiorum interesset.</p>\r\n\r\n<p>Justo incorrupte ea quo, adhuc eligendi reprimique pro et. Eos nobis aeterno conclusionemque ei, no eam dolor delectus. Error altera argumentum quo ea, eam ne antiopam assentior. Ea mea ullum dicant timeam, sea affert reformidans ad. Ei dicam appetere sea, id phaedrum moderatius sed.</p>\r\n\r\n<p>Ad mel velit quidam honestatis. Has no mediocrem repudiandae, mel in ceteros perfecto gubergren, has ne dignissim consequat theophrastus. Duo et assum harum iriure, solum ubique philosophia per an, mea clita nominati reprehendunt ei. Zril melius dignissim qui ad. Debitis fierent quo in, no usu affert aeterno.</p>\r\n','product-8.jpg',8,'Active','Ventilator','Ventilator');
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_banner`
--

DROP TABLE IF EXISTS `tbl_setting_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banner_prevention_detail` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_doctor_detail` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_news_detail` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_category_detail` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_search` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_product_detail` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_cart` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_checkout` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_login` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_registration` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_forget_password` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner_customer_panel` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_banner`
--

LOCK TABLES `tbl_setting_banner` WRITE;
/*!40000 ALTER TABLE `tbl_setting_banner` DISABLE KEYS */;
INSERT INTO `tbl_setting_banner` VALUES (1,'banner_prevention_detail.jpg','banner_doctor_detail.jpg','banner_news_detail.jpg','banner_category_detail.jpg','banner_search.jpg','banner_product_detail.jpg','banner_cart.jpg','banner_checkout.jpg','banner_login.jpg','banner_registration.jpg','banner_forget_password.jpg','banner_customer_panel.jpg');
/*!40000 ALTER TABLE `tbl_setting_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_contact`
--

DROP TABLE IF EXISTS `tbl_setting_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact_phone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_contact`
--

LOCK TABLES `tbl_setting_contact` WRITE;
/*!40000 ALTER TABLE `tbl_setting_contact` DISABLE KEYS */;
INSERT INTO `tbl_setting_contact` VALUES (1,'3153 Foley Street\r\nMiami, FL 33176','Office 1: 954-648-1802\r\nOffice 2: 963-612-1782','sales@yourwebsite.com\r\nsupport@yourwebsite.com');
/*!40000 ALTER TABLE `tbl_setting_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_email`
--

DROP TABLE IF EXISTS `tbl_setting_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_email` (
  `id` int NOT NULL AUTO_INCREMENT,
  `send_email_from` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receive_email_to` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtp_active` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtp_ssl` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtp_host` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtp_port` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtp_username` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtp_password` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_email`
--

LOCK TABLES `tbl_setting_email` WRITE;
/*!40000 ALTER TABLE `tbl_setting_email` DISABLE KEYS */;
INSERT INTO `tbl_setting_email` VALUES (1,'contact@yourwebsite.com','personal_email@gmail.com','Yes','Yes','smtp_host','smtp_port','smtp_username','smtp_password');
/*!40000 ALTER TABLE `tbl_setting_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_favicon`
--

DROP TABLE IF EXISTS `tbl_setting_favicon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_favicon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `favicon` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_favicon`
--

LOCK TABLES `tbl_setting_favicon` WRITE;
/*!40000 ALTER TABLE `tbl_setting_favicon` DISABLE KEYS */;
INSERT INTO `tbl_setting_favicon` VALUES (1,'favicon.png');
/*!40000 ALTER TABLE `tbl_setting_favicon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_footer`
--

DROP TABLE IF EXISTS `tbl_setting_footer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_footer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `footer_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `footer_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `footer_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `copyright` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_footer`
--

LOCK TABLES `tbl_setting_footer` WRITE;
/*!40000 ALTER TABLE `tbl_setting_footer` DISABLE KEYS */;
INSERT INTO `tbl_setting_footer` VALUES (1,'ABC Steet, NewYork.','info@yourwebsite.com','123-456-7878','Copyright © 2020. All Rights Reserved.');
/*!40000 ALTER TABLE `tbl_setting_footer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_home`
--

DROP TABLE IF EXISTS `tbl_setting_home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_home` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_image_heading` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_image_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_image_btn_text` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_image_btn_url` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_image_photo` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_video_heading` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_video_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_video_btn_text` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_video_btn_url` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_type_video_yt_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symptom_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symptom_subtitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symptom_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_subtitle` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_btn_text` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_btn_url` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_yt_video` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_bg` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_video_bg` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `special_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prevention_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prevention_subtitle` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prevention_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doctor_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doctor_subtitle` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doctor_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_text` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_btn_text` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_btn_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_bg` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `latest_news_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `latest_news_subtitle` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `latest_news_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `newsletter_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `newsletter_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `newsletter_bg` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `newsletter_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `outbreak_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `outbreak_subtitle` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `outbreak_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `outbreak_icon1` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `outbreak_icon2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `outbreak_icon3` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `countrywise_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `countrywise_subtitle` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `countrywise_status` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_home`
--

LOCK TABLES `tbl_setting_home` WRITE;
/*!40000 ALTER TABLE `tbl_setting_home` DISABLE KEYS */;
INSERT INTO `tbl_setting_home` VALUES (1,'TheCorona - Coronavirus (Covid-19) Medical Prevention Script','Home Page Description','Slider','We are number one software firm in the country','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, at usu eius eligendi singulis.','Read More','http://www.google.com','header_image.jpg','We are number one software firm in the country','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, at usu eius eligendi singulis.','Read More','http://www.twitter.com','sHP0UIdZyI4','Covid-19 Symptoms','Please see all the important symptoms from here','Show','What is Covid-19','The detailed information about Covid-19 Attacks','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, at usu eius eligendi singulis. Sea ocurreret principes ne.\r\n\r\nDuo luptatum delicata evertitur ad. Usu te quaerendum definitiones, ne mundi volutpat duo, in dissentias temporibus pri. Duo ferri dicant definitionem te.','Read More','/page/about','sHP0UIdZyI4','special_bg.jpg','special_video_bg.jpg','Show','Prevention from Corona Virus','Follow these steps to get away from the dangerous Corona Virus','Show','Expert Doctors','See all our corona virus expert doctors who will help you the best','Show','Feeling Sick Now!','If you are feeling sick like fever, cough, headache, breath shortness, sore throat etc. don&#39;t be late. Make an appointment as soon as possible.','Make An Appointment','/page/doctors','appointment_bg.jpg','Show','Latest News','See all the latest news about corona virus from here','Show','Newsletter','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid fugit expedita, iure ullam cum vero ex sint aperiam maxime.','newsletter_bg.jpg','Show','Covid-19 Outbreak','At a glance pandemic report on Covid-19 Corona Virus','Show','outbreak_icon1.png','outbreak_icon2.png','outbreak_icon3.png','Countrywise Report','See detailed report of Covid-19 Coronavirus Countrywise','Show');
/*!40000 ALTER TABLE `tbl_setting_home` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_logo`
--

DROP TABLE IF EXISTS `tbl_setting_logo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logo_admin` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_logo`
--

LOCK TABLES `tbl_setting_logo` WRITE;
/*!40000 ALTER TABLE `tbl_setting_logo` DISABLE KEYS */;
INSERT INTO `tbl_setting_logo` VALUES (1,'logo.png','logo_admin.png');
/*!40000 ALTER TABLE `tbl_setting_logo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_order`
--

DROP TABLE IF EXISTS `tbl_setting_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_information` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_order`
--

LOCK TABLES `tbl_setting_order` WRITE;
/*!40000 ALTER TABLE `tbl_setting_order` DISABLE KEYS */;
INSERT INTO `tbl_setting_order` VALUES (1,'ABC Company Inc.\r\n16190 Coastal Highway\r\nLewes, DE 19900\r\nUnited States');
/*!40000 ALTER TABLE `tbl_setting_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_pages`
--

DROP TABLE IF EXISTS `tbl_setting_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_pages`
--

LOCK TABLES `tbl_setting_pages` WRITE;
/*!40000 ALTER TABLE `tbl_setting_pages` DISABLE KEYS */;
INSERT INTO `tbl_setting_pages` VALUES (1,'Search Page','Search Page Description','Search Page'),(2,'Cart Page','Cart Page Description','Cart Page'),(3,'Checkout Page','Checkout Page Description','Checkout Page'),(4,'Login Page','Login Page Description','Login Page'),(5,'Registration Page','Registration Page Description','Registration Page'),(6,'Forget Password Page','Forget Password Page Description','Forget Password Page'),(7,'Customer Panel','Customer Page Description','Customer Panel Pages');
/*!40000 ALTER TABLE `tbl_setting_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_payment`
--

DROP TABLE IF EXISTS `tbl_setting_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paypal_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stripe_public_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stripe_secret_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_payment`
--

LOCK TABLES `tbl_setting_payment` WRITE;
/*!40000 ALTER TABLE `tbl_setting_payment` DISABLE KEYS */;
INSERT INTO `tbl_setting_payment` VALUES (1,'xicia_b@shop.com','pk_test_0SwMWadgu8DwmEcPdUPRsZ7b','sk_test_TFcsLJ7xxUtpALbDo1L5c1PN');
/*!40000 ALTER TABLE `tbl_setting_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_sidebar`
--

DROP TABLE IF EXISTS `tbl_setting_sidebar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_sidebar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `total_recent_news` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_sidebar`
--

LOCK TABLES `tbl_setting_sidebar` WRITE;
/*!40000 ALTER TABLE `tbl_setting_sidebar` DISABLE KEYS */;
INSERT INTO `tbl_setting_sidebar` VALUES (1,5);
/*!40000 ALTER TABLE `tbl_setting_sidebar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting_top_bar`
--

DROP TABLE IF EXISTS `tbl_setting_top_bar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_setting_top_bar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `top_bar_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `top_bar_phone` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting_top_bar`
--

LOCK TABLES `tbl_setting_top_bar` WRITE;
/*!40000 ALTER TABLE `tbl_setting_top_bar` DISABLE KEYS */;
INSERT INTO `tbl_setting_top_bar` VALUES (1,'info@yourwebsite.com','123-456-7878');
/*!40000 ALTER TABLE `tbl_setting_top_bar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shipping`
--

DROP TABLE IF EXISTS `tbl_shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_shipping` (
  `shipping_id` int NOT NULL AUTO_INCREMENT,
  `shipping_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_cost` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_order` int NOT NULL,
  `shipping_status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`shipping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_shipping`
--

LOCK TABLES `tbl_shipping` WRITE;
/*!40000 ALTER TABLE `tbl_shipping` DISABLE KEYS */;
INSERT INTO `tbl_shipping` VALUES (1,'Free Shipping','Shipment will be within 10-15 Days','0',1,'Active'),(2,'Same day delivery','Shipment will be within 1 Day.','20',4,'Active'),(3,'2-Day Shipping','Shipment will be within 2 Days.','10',3,'Active'),(4,'Standard Shipping','Shipment will be within 5-10 Day.','5',2,'Active');
/*!40000 ALTER TABLE `tbl_shipping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_slider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `button_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `button_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slide_order` int NOT NULL,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_slider`
--

LOCK TABLES `tbl_slider` WRITE;
/*!40000 ALTER TABLE `tbl_slider` DISABLE KEYS */;
INSERT INTO `tbl_slider` VALUES (4,'slider-4.jpg','Help to prevent the Covid-19 Corona Virus','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, at usu eius eligendi singulis.','Read More','/page/preventions',1,'Active'),(5,'slider-5.jpg','Possible symptoms of the Covid-19','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, at usu eius eligendi singulis.','Read More','#symptom',2,'Active');
/*!40000 ALTER TABLE `tbl_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_social`
--

DROP TABLE IF EXISTS `tbl_social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_social` (
  `social_id` int NOT NULL AUTO_INCREMENT,
  `social_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `social_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `social_icon` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `social_status` int NOT NULL,
  `social_order` int NOT NULL,
  PRIMARY KEY (`social_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_social`
--

LOCK TABLES `tbl_social` WRITE;
/*!40000 ALTER TABLE `tbl_social` DISABLE KEYS */;
INSERT INTO `tbl_social` VALUES (1,'Facebook','http://www.facebook.com','fa fa-facebook',1,1),(2,'Twitter','http://www.twitter.com','fa fa-twitter',1,2),(3,'LinkedIn','http://www.linkedin.com','fa fa-linkedin',1,3),(4,'Pinterest','http://www.pinterest.com','fa fa-pinterest',1,4),(5,'YouTube','http://www.youtube.com','fa fa-youtube',1,5),(6,'Instagram','','fa fa-instagram',0,6);
/*!40000 ALTER TABLE `tbl_social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subscriber`
--

DROP TABLE IF EXISTS `tbl_subscriber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_subscriber` (
  `subs_id` int NOT NULL AUTO_INCREMENT,
  `subs_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subs_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subs_date_time` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subs_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subs_active` int NOT NULL,
  PRIMARY KEY (`subs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subscriber`
--

LOCK TABLES `tbl_subscriber` WRITE;
/*!40000 ALTER TABLE `tbl_subscriber` DISABLE KEYS */;
INSERT INTO `tbl_subscriber` VALUES (1,'patrick@gmail.com','2020-04-04','2020-04-04 10:58:09','',1),(2,'david@gmail.com','2020-04-05','2020-04-05 11:22:34','',1);
/*!40000 ALTER TABLE `tbl_subscriber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_symptom`
--

DROP TABLE IF EXISTS `tbl_symptom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_symptom` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symptom_order` int NOT NULL,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_symptom`
--

LOCK TABLES `tbl_symptom` WRITE;
/*!40000 ALTER TABLE `tbl_symptom` DISABLE KEYS */;
INSERT INTO `tbl_symptom` VALUES (1,'Fever','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','symptom-1.png',1,'Active'),(2,'Cough','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','symptom-2.png',2,'Active'),(3,'Headache','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','symptom-3.png',3,'Active'),(4,'Breath Shortness','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','symptom-4.png',4,'Active'),(5,'Sore Throat','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','symptom-5.png',5,'Active'),(6,'Diarrhea','Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has.','symptom-6.png',6,'Active');
/*!40000 ALTER TABLE `tbl_symptom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'Mr. Brent','admin@gmail.com','$2y$10$lntHOFvgiCPOrIqNgrFqNOoM7LhbwLEezFBKrJTCc0bH3INfOZ2jm','user-1.jpg','8ec1209200b517b3d11c57ad6b067cfecfd1124bbe950a5aa8997812b78ea001','Admin','Active');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_video`
--

DROP TABLE IF EXISTS `tbl_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_video` (
  `video_id` int NOT NULL AUTO_INCREMENT,
  `video_youtube` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video_caption` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video_order` int NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_video`
--

LOCK TABLES `tbl_video` WRITE;
/*!40000 ALTER TABLE `tbl_video` DISABLE KEYS */;
INSERT INTO `tbl_video` VALUES (1,'3Ke0FDGJc6Y','Doctors, nurses contracting coronavirus at alarming rate',1),(2,'W5tv6qoUnnI','New details on the coronavirus spread in Europe',2),(3,'Vau2Nav3-0A','New York City Setting Up Makeshift Morgues As Coronavirus Deaths Surge',3),(4,'Wl9AJ4q4d_k','Italy\'s Coronavirus Outbreak May Have Finally Reached Its Peak',4),(5,'HlFOEyyGFOo','Johnson & Johnson exec hopeful on possible coronavirus vaccine',5),(6,'5DGwOJXSxqg','COVID-19 Animation: What Happens If You Get Coronavirus?',6);
/*!40000 ALTER TABLE `tbl_video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-05  8:20:25
