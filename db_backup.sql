-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: item_database
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'customer 1'),(2,'customer 2'),(3,'customer 3'),(4,'customer 4');
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order_items`
--

LOCK TABLES `sales_order_items` WRITE;
/*!40000 ALTER TABLE `sales_order_items` DISABLE KEYS */;
INSERT INTO `sales_order_items` VALUES (25,56,4,2,5,3,0,1),(26,56,23,3,67,5,0,2),(27,57,4,2,3,2,0,1),(28,57,4,3,3,6,0,1),(29,57,4,4,2,5,0,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_orders`
--

LOCK TABLES `sales_orders` WRITE;
/*!40000 ALTER TABLE `sales_orders` DISABLE KEYS */;
INSERT INTO `sales_orders` VALUES (52,1,'2018-11-20','2018-11-20'),(53,4,'2018-11-20','2018-11-20'),(54,1,'2018-11-20','2018-11-20'),(55,1,'2018-11-20','2018-11-20'),(56,3,'2018-11-20','2018-11-20'),(57,1,'2018-11-20','2018-11-20');
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
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_movement_items`
--

LOCK TABLES `stock_movement_items` WRITE;
/*!40000 ALTER TABLE `stock_movement_items` DISABLE KEYS */;
INSERT INTO `stock_movement_items` VALUES (4,15,10,6,63),(9,30,2,4,80),(10,22,10,3,119),(11,26,2,3,120),(4,20,20,3,124),(11,16,22,3,125),(44,25,26,2,126),(15,35,23,6,129),(12,37,2,1,132),(10,39,2,3,133),(11,42,3,1,135),(4,44,55,2,136),(4,45,67,4,137),(27,45,87,4,138);
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_movements`
--

LOCK TABLES `stock_movements` WRITE;
/*!40000 ALTER TABLE `stock_movements` DISABLE KEYS */;
INSERT INTO `stock_movements` VALUES (15,1,2,'2019-03-09'),(16,5,5,'2022-02-04'),(20,1,1,'2018-11-10'),(22,1,1,'2018-11-10'),(24,6,1,'2018-11-12'),(25,1,1,'2018-11-12'),(26,1,1,'2018-11-12'),(27,1,1,'2018-11-12'),(28,1,1,'2018-11-12'),(29,1,1,'2018-11-12'),(30,6,1,'2018-11-13'),(31,1,1,'2018-11-13'),(32,1,1,'2018-11-13'),(33,6,1,'2016-11-13'),(34,5,2,'2018-11-14'),(35,5,2,'2018-11-14'),(37,1,1,'2018-11-14'),(38,1,1,'2018-11-14'),(39,1,1,'2018-11-14'),(40,1,1,'2018-11-16'),(41,1,1,'2018-11-16'),(42,1,1,'2018-11-17'),(43,1,1,'2018-11-17'),(44,1,1,'2018-11-18'),(45,1,1,'2018-11-18');
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
  `item_id` varchar(45) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_time` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_transactions_ibfk_1` (`warehouse_id`),
  CONSTRAINT `stock_transactions_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_transactions`
--

LOCK TABLES `stock_transactions` WRITE;
/*!40000 ALTER TABLE `stock_transactions` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
INSERT INTO `warehouses` VALUES (1,'warehouse5'),(2,'warehouse2'),(5,'warehouse1'),(6,'warehouse4');
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

-- Dump completed on 2018-11-20 17:57:46
