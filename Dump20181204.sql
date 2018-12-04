-- MySQL dump 10.15  Distrib 10.0.36-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: item_database
-- ------------------------------------------------------
-- Server version	10.0.36-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'customer 1'),(2,'customer 2'),(3,'customer 3'),(4,'customer 4'),(5,'customer 5');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_groups`
--

DROP TABLE IF EXISTS `item_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_groups`
--

LOCK TABLES `item_groups` WRITE;
/*!40000 ALTER TABLE `item_groups` DISABLE KEYS */;
INSERT INTO `item_groups` VALUES (1,'Beverage'),(4,'Alcohols');
/*!40000 ALTER TABLE `item_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `purchase_unit` int(11) NOT NULL,
  `sell_unit` int(11) NOT NULL,
  `usage_unit` int(11) NOT NULL,
  `item_group_id` int(11) NOT NULL,
  `sell_unit_qty` int(11) NOT NULL,
  `usage_unit_qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_unit` (`purchase_unit`),
  KEY `sell_unit` (`sell_unit`),
  KEY `usage_unit` (`usage_unit`),
  KEY `item_group_id` (`item_group_id`),
  CONSTRAINT `items_ibfk_1` FOREIGN KEY (`purchase_unit`) REFERENCES `units` (`id`),
  CONSTRAINT `items_ibfk_2` FOREIGN KEY (`sell_unit`) REFERENCES `units` (`id`),
  CONSTRAINT `items_ibfk_3` FOREIGN KEY (`usage_unit`) REFERENCES `units` (`id`),
  CONSTRAINT `items_ibfk_4` FOREIGN KEY (`item_group_id`) REFERENCES `item_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (4,'coca cola5',3,4,2,4,24,750),(9,'asdfghjqer12354',4,3,4,1,12,12),(10,'coca cola 5',4,3,3,1,13,10),(11,'sdgsdggsd',4,1,1,1,0,0),(12,'sdgsdg',1,1,1,1,0,0),(13,'dfhdfh',1,1,1,1,0,0),(14,'gfjfj',1,1,1,1,0,0),(15,'pepsi',1,1,1,1,0,0),(16,'dfhdfh',1,1,1,1,0,0),(17,'dfasf',1,1,1,1,0,0),(18,'sdgsdgsdg',1,1,1,1,0,0),(19,'sdfsdf',1,1,1,1,0,0),(23,'pepsi',1,3,2,1,10,12),(24,'pepsi',1,1,1,1,0,0),(25,'pepsi',1,1,1,1,0,0),(26,'dfhdfh',1,1,1,1,0,0),(27,'pepsi',1,1,1,1,0,0),(29,'fdgdfg',1,1,1,1,0,0),(31,'dfhdfh',1,1,1,1,0,0),(32,'dfhdfh',1,1,1,1,0,0),(33,'coca cola',1,1,1,1,12,0),(34,'dfhdfh',1,1,1,1,30,11),(35,'pepsijkjk',1,1,1,1,45,45),(36,'pepsi',1,3,3,1,12,1),(37,'dfhdfh',1,1,1,1,12,11),(38,'dfhdfh',1,1,1,1,13,12),(39,'dfhdfh',1,1,1,1,12,11),(40,'dfhdfh',1,1,1,1,12,11),(41,'dfhdfh',1,1,1,1,12,11),(42,'dfhdfh',1,1,1,1,54,5),(43,'cola',1,1,1,1,45,55),(44,'sprite',1,3,4,1,33,3),(46,'abcdef',3,2,4,1,22,12),(47,'zzzzzzzzzzzzzz',1,1,1,1,4,2),(48,'adcdefgh',3,2,3,1,2,3),(51,'pepsi',1,1,1,1,3,4),(54,'pepsi',1,1,1,1,23,3),(55,'coca cola 6',3,1,1,1,3,4),(57,'coca cola 5',1,1,1,1,5,6),(59,'coca cola 5',1,1,1,1,77,77),(60,'7up',1,2,3,1,33,30);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order_items`
--

DROP TABLE IF EXISTS `sales_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_order_items_ibfk_1` (`sales_order_id`),
  KEY `sales_order_items_ibfk_2` (`item_id`),
  KEY `sales_order_items_ibfk_3` (`unit_id`),
  KEY `sales_order_items_ibfk_4` (`warehouse_id`),
  CONSTRAINT `sales_order_items_ibfk_1` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sales_order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sales_order_items_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sales_order_items_ibfk_4` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order_items`
--

LOCK TABLES `sales_order_items` WRITE;
/*!40000 ALTER TABLE `sales_order_items` DISABLE KEYS */;
INSERT INTO `sales_order_items` VALUES (71,71,4,2,9,25,0,1),(240,78,4,2,22,200,0,1),(241,78,13,1,22,200,0,1),(246,84,4,2,1,3,0,1),(247,84,10,3,1,200,0,1),(261,82,4,3,1,200,0,1),(262,82,10,4,2,200,0,1),(275,86,4,2,2,19,0,1),(276,86,24,1,23,200,0,1),(277,86,23,1,32,200,0,1),(278,85,4,2,1,200,0,1),(283,69,4,2,2,12,0,1),(285,88,4,2,432,4,0,1),(287,90,4,2,2,2,0,1),(288,90,4,2,22,2,0,1),(289,90,4,2,33,23,0,1),(290,90,4,2,23,32,0,1),(291,90,4,2,23,33,0,1),(292,90,4,2,22,32,0,1),(293,90,4,2,32,33,0,1),(294,90,4,2,32,32,0,1),(295,90,4,2,32,33,0,1),(296,90,4,2,22,43,0,1),(297,90,4,2,33,22,0,1),(298,90,4,2,32,33,0,1),(299,90,4,2,22,33,0,1),(300,90,4,2,22,33,0,1),(301,90,4,2,33,33,0,1),(302,90,4,2,22,33,0,1),(303,90,4,2,22,33,0,1),(307,88,14,1,45,12,0,1),(308,88,11,1,22,12,0,1),(309,88,9,3,22,12,0,1),(310,88,29,1,33,23,0,1),(311,88,15,1,5,12,0,1),(312,88,13,1,23,4,0,1),(313,88,25,1,4,2,0,1),(314,88,38,1,2,33,0,1),(315,88,26,1,44,23,0,1),(316,88,42,1,43,43,0,1),(317,88,27,1,22,43,0,1),(318,88,47,1,33,23,0,1),(319,88,55,1,22,4,0,1),(320,88,18,1,2,2,0,1),(321,88,44,1,5,33,0,1),(322,88,43,1,3,45,0,1),(323,88,24,1,2,12,0,1),(324,88,41,1,3,33,0,1),(325,93,4,2,2,123,0,1),(326,93,10,3,22,123,0,1),(327,93,55,1,5,34,0,1),(328,93,44,1,4,44,0,1),(329,89,10,4,2,12,0,1),(333,100,13,1,1,12,0,1),(334,101,4,2,3,12,0,1),(336,103,4,2,2,12,0,1),(337,103,13,1,5,33,0,1),(338,103,18,1,22,12,0,1),(339,105,11,1,2,12,0,1),(340,71,12,1,22,5,0,1),(341,106,9,3,46,5,0,1),(342,106,12,1,2,12,0,1),(343,96,9,3,2,2,0,1),(344,96,4,3,2,123,0,2),(345,107,9,3,2,2,0,1),(346,108,4,2,2,2,0,2),(347,109,4,2,22,22,0,2),(348,110,4,2,3,3,0,2),(350,112,4,2,2,2,0,2),(351,113,4,2,2,2,0,2);
/*!40000 ALTER TABLE `sales_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_orders`
--

DROP TABLE IF EXISTS `sales_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `created_date` date NOT NULL,
  `delivary_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_name` (`customer_id`),
  CONSTRAINT `sales_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_orders`
--

LOCK TABLES `sales_orders` WRITE;
/*!40000 ALTER TABLE `sales_orders` DISABLE KEYS */;
INSERT INTO `sales_orders` VALUES (69,1,'2018-11-27','2018-11-28'),(71,2,'2018-11-23','2018-11-18'),(76,1,'2018-11-23','2018-11-23'),(78,4,'2018-11-23','2018-11-29'),(82,4,'1970-01-04','1970-01-02'),(83,4,'1970-01-01','1970-01-01'),(84,1,'1970-01-01','1970-01-01'),(85,3,'1970-01-01','1970-01-02'),(86,4,'1970-01-02','1970-01-09'),(87,1,'1970-01-01','1970-01-01'),(88,1,'1970-01-01','1970-01-01'),(89,1,'1970-01-01','1970-01-01'),(90,1,'1970-01-01','1970-01-01'),(93,1,'1970-01-01','1970-01-01'),(94,1,'1970-01-01','1970-01-01'),(95,1,'1970-01-01','1970-01-01'),(96,1,'2018-12-03','2018-12-05'),(97,1,'1970-01-01','1970-01-01'),(98,1,'1970-01-01','1970-01-01'),(99,1,'1970-01-01','1970-01-01'),(100,1,'1970-01-01','1970-01-01'),(101,1,'1970-01-01','1970-01-01'),(103,1,'1970-01-01','1970-01-01'),(104,1,'1970-01-01','1970-01-01'),(105,1,'1970-01-01','1970-01-01'),(106,1,'2018-12-03','2018-12-04'),(107,1,'2018-12-03','2018-12-05'),(108,1,'2018-12-03','2018-12-12'),(109,1,'2018-12-03','2018-12-12'),(110,1,'2018-12-03','2018-12-12'),(112,1,'2018-12-03','2018-12-07'),(113,1,'2018-12-03','2018-12-10');
/*!40000 ALTER TABLE `sales_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_movement_items`
--

DROP TABLE IF EXISTS `stock_movement_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_movement_items` (
  `item_id` int(11) NOT NULL,
  `stock_movement_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `stock_movement_id` (`stock_movement_id`),
  KEY `stock_movement_items_ibfk_3` (`unit_id`),
  CONSTRAINT `stock_movement_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `stock_movement_items_ibfk_2` FOREIGN KEY (`stock_movement_id`) REFERENCES `stock_movements` (`id`),
  CONSTRAINT `stock_movement_items_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_movement_items`
--

LOCK TABLES `stock_movement_items` WRITE;
/*!40000 ALTER TABLE `stock_movement_items` DISABLE KEYS */;
INSERT INTO `stock_movement_items` VALUES (4,15,10,6,63),(9,30,2,4,80),(10,22,10,3,119),(11,26,2,3,120),(4,20,20,3,124),(11,16,22,3,125),(44,25,26,2,126),(15,35,23,6,129),(12,37,2,1,132),(10,39,2,3,133),(11,42,222,1,135),(4,44,22,2,136),(55,44,23,3,147),(10,42,22,4,158),(4,42,222,2,159),(24,44,26,1,161),(10,45,22,4,162),(13,46,22,1,166),(11,46,5,4,167);
/*!40000 ALTER TABLE `stock_movement_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_movements`
--

DROP TABLE IF EXISTS `stock_movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_warehouse_id` int(11) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `posting_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_movements_ibfk_1` (`from_warehouse_id`),
  KEY `stock_movements_ibfk_2` (`to_warehouse_id`),
  CONSTRAINT `stock_movements_ibfk_1` FOREIGN KEY (`from_warehouse_id`) REFERENCES `warehouses` (`id`),
  CONSTRAINT `stock_movements_ibfk_2` FOREIGN KEY (`to_warehouse_id`) REFERENCES `warehouses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_movements`
--

LOCK TABLES `stock_movements` WRITE;
/*!40000 ALTER TABLE `stock_movements` DISABLE KEYS */;
INSERT INTO `stock_movements` VALUES (15,1,2,'2019-03-09'),(16,5,5,'2022-02-04'),(20,1,1,'2018-11-10'),(22,1,1,'2018-11-10'),(24,6,1,'2018-11-12'),(25,1,1,'2018-11-12'),(26,1,1,'2018-11-12'),(27,1,1,'2018-11-12'),(28,1,1,'2018-11-12'),(29,1,1,'2018-11-12'),(30,6,1,'2018-11-13'),(31,1,1,'2018-11-13'),(32,1,1,'2018-11-13'),(33,6,1,'2016-11-13'),(34,5,2,'2018-11-14'),(35,5,2,'2018-11-14'),(37,1,1,'2018-11-14'),(38,1,1,'2018-11-14'),(39,1,1,'2018-11-14'),(40,1,1,'2018-11-16'),(42,1,1,'2018-11-17'),(44,1,1,'2018-11-26'),(45,1,5,'2018-11-28'),(46,1,6,'2018-11-28');
/*!40000 ALTER TABLE `stock_movements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_transactions`
--

DROP TABLE IF EXISTS `stock_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `referenceid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `unit_id` (`unit_id`),
  KEY `warehouse_id` (`warehouse_id`),
  CONSTRAINT `stock_transactions_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `stock_transactions_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  CONSTRAINT `stock_transactions_ibfk_3` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_transactions`
--

LOCK TABLES `stock_transactions` WRITE;
/*!40000 ALTER TABLE `stock_transactions` DISABLE KEYS */;
INSERT INTO `stock_transactions` VALUES (1,10,4,6,1,2,12,'0000-00-00',0),(2,33,1,1,1,22,33,'0000-00-00',0),(3,55,3,1,1,2,22,'0000-00-00',0),(4,44,4,2,1,3,33,'0000-00-00',0),(5,23,2,1,1,4,44,'0000-00-00',0),(6,55,3,1,1,2,12,'0000-00-00',0),(7,44,4,2,1,3,13,'0000-00-00',0),(8,33,1,1,1,21,31,'0000-00-00',0),(9,9,4,1,1,1,12,'0000-00-00',0),(10,10,4,1,1,2,11,'0000-00-00',0),(11,9,4,1,1,2,12,'0000-00-00',0),(12,10,4,1,1,4,11,'0000-00-00',0),(13,10,4,1,1,2,3,'0000-00-00',0),(14,10,4,1,1,5,3,'0000-00-00',0),(15,13,1,1,1,2,12,'0000-00-00',0),(16,9,4,1,1,2,33,'0000-00-00',0),(17,13,1,1,1,22,12,'0000-00-00',0),(18,9,4,1,1,2,33,'0000-00-00',0),(19,13,3,1,1,22,12,'0000-00-00',0),(20,9,2,1,1,3,33,'0000-00-00',0),(21,55,3,1,1,5,12,'0000-00-00',0),(22,9,4,1,1,2,123,'2018-11-22',0),(23,9,4,1,1,3,123,'2018-11-22',0),(24,14,1,1,1,22,12,'2018-11-22',0),(25,4,2,1,1,10,2,'2018-11-22',72),(26,4,2,1,1,2,12,'2018-11-22',0),(27,4,2,1,1,22,123,'2018-11-22',0),(28,4,3,1,1,22,123,'2018-11-22',0),(29,4,3,1,1,222,123,'2018-11-22',0),(30,4,3,1,1,226,123,'2018-11-22',0),(31,4,3,1,1,226,123,'2018-11-22',0),(32,4,3,1,1,226,123,'2018-11-22',0),(33,4,3,1,1,225,123,'2018-11-22',0),(34,4,3,1,1,226,123,'2018-11-22',70),(35,4,2,1,1,9,25,'2018-11-23',71),(36,4,2,1,1,2,2,'2018-11-23',72),(37,10,4,1,1,22,2,'2018-11-23',73),(38,13,1,1,1,5,2,'2018-11-23',73),(39,4,1,1,1,62,2,'2018-11-23',74),(40,4,3,1,1,3,2,'2018-11-23',0),(41,4,1,1,1,5,2,'2018-11-23',0),(42,9,3,1,1,22,1,'2018-11-23',75),(43,11,1,1,1,2,12,'2018-11-23',76),(45,9,3,1,1,56,12,'2018-11-23',76),(46,9,3,1,1,56,12,'2018-11-23',76),(47,11,1,1,1,2,12,'2018-11-23',76),(48,13,4,1,1,22,12,'2018-11-23',76),(49,4,2,1,1,22,12,'2018-11-23',76),(50,4,2,1,1,2,12,'2018-11-23',76),(51,12,1,1,1,2,12,'2018-11-23',76),(53,10,1,1,1,2,12,'2018-11-23',76),(54,14,1,1,1,2,12,'2018-11-23',76),(55,10,3,1,1,33,21,'2018-03-23',77),(58,10,1,1,1,22,12,'2018-11-22',68),(59,4,2,1,1,32,20,'2018-03-23',77),(61,9,3,1,1,22,12,'2018-11-01',79),(62,4,3,1,1,22,12,'2018-11-23',79),(63,9,4,1,1,5,12,'2018-11-23',79),(64,10,3,1,1,2,12,'2018-11-01',79),(65,11,1,1,1,3,543,'2018-11-01',79),(66,14,1,1,1,22,12,'2018-11-01',79),(67,9,4,2,1,22,12,'2018-11-01',79),(68,10,3,1,1,3,32,'2018-11-26',80),(69,15,1,1,1,22,33,'2018-11-26',80),(70,12,1,1,1,2,12,'2018-11-26',80),(71,4,2,1,1,2,22,'2018-11-26',80),(72,14,1,1,1,2,12,'2018-11-26',80),(73,10,3,1,1,2,11,'2018-11-26',80),(74,4,3,2,1,2,22,'2018-11-26',80),(75,4,2,1,1,2,22,'2018-11-26',80),(76,10,4,1,1,3,32,'2018-11-26',80),(77,10,3,1,1,3,32,'2018-11-26',80),(78,10,3,1,1,3,32,'2018-11-26',80),(79,10,3,1,1,3,32,'2018-11-26',80),(80,9,3,1,1,5,7,'2018-11-26',80),(81,11,4,1,1,1,3,'2018-11-26',80),(82,11,4,1,1,2,12,'2018-11-26',80),(83,12,1,1,1,2,12,'2018-11-26',80),(84,14,1,1,1,22,9,'2018-11-26',80),(85,9,4,1,1,5,7,'2018-11-26',80),(164,4,2,1,1,22,200,'2018-11-23',78),(165,13,1,1,1,22,200,'2018-11-23',78),(170,4,2,1,1,1,3,'1970-01-01',84),(171,10,3,1,1,1,200,'1970-01-01',84),(185,4,3,1,1,1,200,'1970-01-04',82),(186,10,4,1,1,2,200,'1970-01-04',82),(199,4,2,1,1,2,19,'1970-01-02',86),(200,24,1,1,1,23,200,'1970-01-02',86),(201,23,1,1,1,32,200,'1970-01-02',86),(202,4,2,1,1,1,200,'1970-01-01',85),(207,4,2,1,1,2,12,'2018-11-27',69),(209,4,2,1,1,432,4,'1970-01-01',88),(211,4,2,1,1,2,2,'1970-01-01',90),(212,4,2,1,1,22,2,'1970-01-01',90),(213,4,2,1,1,33,23,'1970-01-01',90),(214,4,2,1,1,23,32,'1970-01-01',90),(215,4,2,1,1,23,33,'1970-01-01',90),(216,4,2,1,1,22,32,'1970-01-01',90),(217,4,2,1,1,32,33,'1970-01-01',90),(218,4,2,1,1,32,32,'1970-01-01',90),(219,4,2,1,1,32,33,'1970-01-01',90),(220,4,2,1,1,22,43,'1970-01-01',90),(221,4,2,1,1,33,22,'1970-01-01',90),(222,4,2,1,1,32,33,'1970-01-01',90),(223,4,2,1,1,22,33,'1970-01-01',90),(224,4,2,1,1,22,33,'1970-01-01',90),(225,4,2,1,1,33,33,'1970-01-01',90),(226,4,2,1,1,22,33,'1970-01-01',90),(227,4,2,1,1,22,33,'1970-01-01',90),(231,14,1,1,1,45,12,'1970-01-01',88),(232,11,1,1,1,22,12,'1970-01-01',88),(233,9,3,1,1,22,12,'1970-01-01',88),(234,29,1,1,1,33,23,'1970-01-01',88),(235,15,1,1,1,5,12,'1970-01-01',88),(236,13,1,1,1,23,4,'1970-01-01',88),(237,25,1,1,1,4,2,'1970-01-01',88),(238,38,1,1,1,2,33,'1970-01-01',88),(239,26,1,1,1,44,23,'1970-01-01',88),(240,42,1,1,1,43,43,'1970-01-01',88),(241,27,1,1,1,22,43,'1970-01-01',88),(242,47,1,1,1,33,23,'1970-01-01',88),(243,55,1,1,1,22,4,'1970-01-01',88),(244,18,1,1,1,2,2,'1970-01-01',88),(245,44,1,1,1,5,33,'1970-01-01',88),(246,43,1,1,1,3,45,'1970-01-01',88),(247,24,1,1,1,2,12,'1970-01-01',88),(248,41,1,1,1,3,33,'1970-01-01',88),(249,4,2,1,1,2,123,'1970-01-01',93),(250,10,3,1,1,22,123,'1970-01-01',93),(251,55,1,1,1,5,34,'1970-01-01',93),(252,44,1,1,1,4,44,'1970-01-01',93),(253,10,4,1,1,2,12,'1970-01-01',89),(254,13,1,1,1,1,12,'1970-01-01',100),(255,4,2,1,1,3,12,'1970-01-01',101),(256,16,1,5,1,5,12,'1970-01-01',102),(257,4,2,1,1,2,12,'1970-01-01',103),(258,13,1,1,1,5,33,'1970-01-01',103),(259,18,1,1,1,22,12,'1970-01-01',103),(260,11,1,1,1,2,12,'1970-01-01',105),(261,12,1,1,1,22,5,'2018-11-23',71),(262,9,3,1,1,46,5,'2018-12-03',106),(263,12,1,1,1,2,12,'2018-12-03',106),(264,9,3,1,1,2,2,'2018-12-03',96),(265,4,3,2,1,2,123,'2018-12-03',96),(266,9,3,1,1,2,2,'2018-12-03',107),(267,4,2,2,1,2,2,'2018-12-03',108),(268,4,2,2,1,22,22,'2018-12-03',109),(269,4,2,2,1,3,3,'2018-12-03',110),(270,4,2,2,1,2,2,'2018-12-03',111),(271,4,2,2,1,2,2,'2018-12-03',112),(272,4,2,2,1,2,2,'2018-12-03',113);
/*!40000 ALTER TABLE `stock_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'Carton1'),(2,'Bottle'),(3,'Box'),(4,'ml'),(6,'kg'),(7,'grams'),(9,'boxes');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
INSERT INTO `warehouses` VALUES (1,'warehouse5'),(2,'warehouse2'),(5,'warehouse1'),(6,'warehouse4'),(8,'warehouse3');
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-04 10:55:33
