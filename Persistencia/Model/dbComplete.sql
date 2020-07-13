CREATE DATABASE  IF NOT EXISTS `deliciascalvo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `deliciascalvo`;
-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: deliciascalvo
-- ------------------------------------------------------
-- Server version	8.0.17

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
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accion` (
  `idAccion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`idAccion`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
INSERT INTO `accion` VALUES (1,'Crear producto'),(2,'Actualizar producto'),(3,'Agregar ingredientes a producto'),(4,'Crear categoria'),(5,'Actualizar categoria'),(6,'Crear ingrediente'),(7,'Actualizar ingrediente'),(8,'Crear proveedor'),(9,'Actualizar proveedor'),(10,'Crear cliente'),(11,'Actualizar cliente'),(12,'Crear inventarista'),(13,'Actualizar inventarista'),(14,'Actualizar estado cliente'),(15,'Actualizar estado inventarista'),(16,'Actualizar contraseña administrador'),(17,'Log in'),(18,'Log out'),(19,'Actualizar ingredientes a producto'),(20,'Borrar ingredientes a producto'),(21,'Actualizar contraseña'),(22,'Actualizar información personal'),(23,'Compra'),(24,'Crear administrador'),(25,'Actualizar stock de ingredientes');
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idAdministrador`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'Mateo','Epalza Ramirez','admin@gmail.com','202cb962ac59075b964b07152d234b70',NULL),(2,'Pedro','Pineda','PedroAdmin@gmail.com','202cb962ac59075b964b07152d234b70',NULL);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Hamburguesas'),(2,'Lasañas'),(3,'Perros Calientes'),(4,'Tacos'),(5,'Pizza');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `activation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Juana','Gomez','juana@gmail.com','202cb962ac59075b964b07152d234b70','static/img/Users/2020_07_12_22_48_23_images.jpg',1,'2e0aca891f2a8aedf265edf533a6d9a8'),(2,'Pepita','Perez','Pepita@gmail.com','202cb962ac59075b964b07152d234b70','',1,'fa84632d742f2729dc32ce8cb5d49733'),(3,'Martina','Epalza','Martina@gmail.com','202cb962ac59075b964b07152d234b70','',1,'9bab7341f4429f78ade492da0318aa42'),(4,'Camila','Ortiz','Camila@gmail.com','202cb962ac59075b964b07152d234b70','',1,'d240cb4a3e3d2ed5250ac2e1480422f0'),(5,'Daniela','Forero','Daniela@gmail.com','202cb962ac59075b964b07152d234b70','',1,'67606d48e361ce176ca71fd54fcf4286'),(6,'Nicolas','Verdugo','Nicolas@gmail.com','202cb962ac59075b964b07152d234b70','',1,'82b8a3434904411a9fdc43ca87cee70c'),(7,'Santiago','Bolaños','Santiago@gmail.com','202cb962ac59075b964b07152d234b70','',1,'46936add066bd6422b3ac74a0ccb7174'),(8,'Sebastian','Meneses','Sebastian@gmail.com','202cb962ac59075b964b07152d234b70','',-1,'d5bd121564004e506f5610496ab2f876'),(9,'Gloria','Ramirez','Gloria@gmail.com','202cb962ac59075b964b07152d234b70','',0,'272e11700558e27be60f7489d2d782e7');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `valor` float NOT NULL,
  `FK_idCliente` int(11) NOT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `FK_idCliente` (`FK_idCliente`),
  CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`FK_idCliente`) REFERENCES `cliente` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (1,'2020-07-12 22:49:40',39000,1);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturaproducto`
--

DROP TABLE IF EXISTS `facturaproducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturaproducto` (
  `FK_idFactura` int(11) NOT NULL,
  `FK_idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`FK_idFactura`,`FK_idProducto`),
  KEY `FK_idProducto` (`FK_idProducto`),
  CONSTRAINT `facturaproducto_ibfk_1` FOREIGN KEY (`FK_idFactura`) REFERENCES `factura` (`idFactura`),
  CONSTRAINT `facturaproducto_ibfk_2` FOREIGN KEY (`FK_idProducto`) REFERENCES `producto` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturaproducto`
--

LOCK TABLES `facturaproducto` WRITE;
/*!40000 ALTER TABLE `facturaproducto` DISABLE KEYS */;
INSERT INTO `facturaproducto` VALUES (1,5,1,25000),(1,7,1,14000);
/*!40000 ALTER TABLE `facturaproducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingrediente`
--

DROP TABLE IF EXISTS `ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingrediente` (
  `idIngrediente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `FK_idProveedor` int(11) NOT NULL,
  PRIMARY KEY (`idIngrediente`),
  KEY `FK_idProveedor` (`FK_idProveedor`),
  CONSTRAINT `ingrediente_ibfk_1` FOREIGN KEY (`FK_idProveedor`) REFERENCES `proveedor` (`idProveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingrediente`
--

LOCK TABLES `ingrediente` WRITE;
/*!40000 ALTER TABLE `ingrediente` DISABLE KEYS */;
INSERT INTO `ingrediente` VALUES (1,'Queso doble crema',196,1),(2,'Salsa de piña',100,5),(3,'Salsa de tomate',97,5),(4,'Salsa rosada',100,5),(5,'Lechuga',100,6),(6,'Tomate',100,6),(7,'Cebolla',97,6),(8,'Pan de hamburguesa',248,4),(9,'Carne de hamburguesa',250,8),(10,'Pimenton rojo',100,6),(11,'Cilantro',100,6),(12,'Ajo',98,6),(13,'Crema de leche',100,3),(14,'Papa francesa',150,2),(15,'Jamón de pollo',150,2),(16,'Jamón de cerdo',150,2),(17,'Sal',250,9),(18,'Pimienta',250,9),(19,'Frijoles',210,9),(20,'Salsa habanero',150,9),(21,'Salsa de mayonesa',247,5),(22,'Aguacate',25,6),(23,'Harina',150,9),(24,'Pimentón verde',100,6),(25,'Pollo desmechado',100,8),(26,'Queso cheddar',145,1),(27,'Pechuga de pollo',100,8),(28,'Tocineta',96,8),(29,'carne desmechada',92,8),(30,'Albahaca',100,6),(31,'Mariscos',150,8),(32,'Pan de ajo',100,9),(33,'Salsa de mostaza',150,9),(34,'Pan de perro',150,9),(35,'Salchicha de perro',250,2),(36,'Queso cheddar derretido',250,1),(37,'Tortilla de taco',250,9),(38,'Aguacate',150,6),(39,'Pepperoni',150,8),(40,'Salsa BBQ',250,5);
/*!40000 ALTER TABLE `ingrediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredienteproducto`
--

DROP TABLE IF EXISTS `ingredienteproducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredienteproducto` (
  `FK_idProducto` int(11) NOT NULL,
  `FK_idIngrediente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`FK_idProducto`,`FK_idIngrediente`),
  KEY `FK_idIngrediente` (`FK_idIngrediente`),
  CONSTRAINT `ingredienteproducto_ibfk_1` FOREIGN KEY (`FK_idProducto`) REFERENCES `producto` (`idProducto`),
  CONSTRAINT `ingredienteproducto_ibfk_2` FOREIGN KEY (`FK_idIngrediente`) REFERENCES `ingrediente` (`idIngrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredienteproducto`
--

LOCK TABLES `ingredienteproducto` WRITE;
/*!40000 ALTER TABLE `ingredienteproducto` DISABLE KEYS */;
INSERT INTO `ingredienteproducto` VALUES (1,3,3),(1,5,2),(1,6,2),(1,8,2),(1,9,1),(1,26,2),(2,1,2),(2,5,2),(2,6,2),(2,7,2),(2,21,3),(2,27,1),(3,3,3),(3,7,1),(3,8,2),(3,9,3),(3,26,2),(3,28,2),(4,6,2),(4,7,3),(4,8,2),(4,26,3),(4,28,3),(5,3,3),(5,7,3),(5,8,2),(5,21,3),(5,26,5),(5,28,4),(6,5,2),(6,6,2),(6,8,2),(6,21,2),(6,26,2),(6,28,2),(7,1,4),(7,12,2),(7,29,8),(8,1,6),(8,13,3),(8,31,8),(9,1,8),(9,11,2),(9,13,4),(9,28,3),(9,32,2),(10,1,5),(10,12,2),(10,13,4),(10,29,6),(11,29,3),(11,34,1),(11,35,1),(11,36,1),(12,3,1),(12,7,1),(12,24,1),(12,33,1),(12,34,1),(12,35,1),(13,3,1),(13,33,1),(13,34,1),(13,35,1),(14,6,2),(14,7,2),(14,25,3),(14,37,1),(15,5,2),(15,7,2),(15,10,2),(15,27,1),(15,37,1),(16,7,5),(16,29,9),(16,30,5),(16,37,1),(17,7,2),(17,29,2),(17,30,2),(17,37,1),(18,12,2),(18,22,2),(18,27,1),(18,29,3),(18,37,2),(19,5,2),(19,6,3),(19,7,3),(19,20,2),(19,37,3),(20,6,2),(20,7,3),(20,20,3),(20,25,5),(20,37,2),(21,1,6),(21,6,5),(21,23,3),(21,24,1),(21,39,5),(22,1,6),(22,23,4),(22,39,9),(23,1,6),(23,23,6),(23,25,5),(23,40,3),(24,1,6),(24,6,5),(24,23,3),(24,29,6),(25,1,6),(25,6,5),(25,23,5),(25,24,1),(25,25,5),(25,29,5),(26,1,16),(26,6,6),(26,23,6);
/*!40000 ALTER TABLE `ingredienteproducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventarista`
--

DROP TABLE IF EXISTS `inventarista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventarista` (
  `idInventarista` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`idInventarista`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventarista`
--

LOCK TABLES `inventarista` WRITE;
/*!40000 ALTER TABLE `inventarista` DISABLE KEYS */;
INSERT INTO `inventarista` VALUES (1,'Juan','Gomez','Juan@gmail.com','202cb962ac59075b964b07152d234b70','',1),(2,'Alberto','Ramirez','Alberto@gmail.com','202cb962ac59075b964b07152d234b70','',1),(3,'Danna','Perea','Danna@gmail.com','202cb962ac59075b964b07152d234b70','',0),(4,'Alfredo','León','Alfredo@gmail.com','202cb962ac59075b964b07152d234b70','',0);
/*!40000 ALTER TABLE `inventarista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logadministrador`
--

DROP TABLE IF EXISTS `logadministrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logadministrador` (
  `idLogAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `informacion` text NOT NULL,
  `FK_idAccion` int(11) NOT NULL,
  `browser` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL,
  `FK_idAdministrador` int(11) NOT NULL,
  PRIMARY KEY (`idLogAdministrador`),
  KEY `FK_idAccion` (`FK_idAccion`),
  KEY `FK_idAdministrador` (`FK_idAdministrador`),
  CONSTRAINT `logadministrador_ibfk_1` FOREIGN KEY (`FK_idAccion`) REFERENCES `accion` (`idAccion`),
  CONSTRAINT `logadministrador_ibfk_2` FOREIGN KEY (`FK_idAdministrador`) REFERENCES `administrador` (`idAdministrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logadministrador`
--

LOCK TABLES `logadministrador` WRITE;
/*!40000 ALTER TABLE `logadministrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `logadministrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logcliente`
--

DROP TABLE IF EXISTS `logcliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logcliente` (
  `idLogCliente` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `informacion` text NOT NULL,
  `FK_idAccion` int(11) NOT NULL,
  `browser` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL,
  `FK_idCliente` int(11) NOT NULL,
  PRIMARY KEY (`idLogCliente`),
  KEY `FK_idAccion` (`FK_idAccion`),
  KEY `FK_idCliente` (`FK_idCliente`),
  CONSTRAINT `logcliente_ibfk_1` FOREIGN KEY (`FK_idAccion`) REFERENCES `accion` (`idAccion`),
  CONSTRAINT `logcliente_ibfk_2` FOREIGN KEY (`FK_idCliente`) REFERENCES `cliente` (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logcliente`
--

LOCK TABLES `logcliente` WRITE;
/*!40000 ALTER TABLE `logcliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `logcliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginventarista`
--

DROP TABLE IF EXISTS `loginventarista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginventarista` (
  `idLogInventarista` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `informacion` text NOT NULL,
  `FK_idAccion` int(11) NOT NULL,
  `browser` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL,
  `FK_idInventarista` int(11) NOT NULL,
  PRIMARY KEY (`idLogInventarista`),
  KEY `FK_idAccion` (`FK_idAccion`),
  KEY `FK_idInventarista` (`FK_idInventarista`),
  CONSTRAINT `loginventarista_ibfk_1` FOREIGN KEY (`FK_idAccion`) REFERENCES `accion` (`idAccion`),
  CONSTRAINT `loginventarista_ibfk_2` FOREIGN KEY (`FK_idInventarista`) REFERENCES `inventarista` (`idInventarista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginventarista`
--

LOCK TABLES `loginventarista` WRITE;
/*!40000 ALTER TABLE `loginventarista` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginventarista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio` float NOT NULL,
  `FK_idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `FK_idCategoria` (`FK_idCategoria`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`FK_idCategoria`) REFERENCES `categoria` (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Hamburguesa sencilla','static/img/Productos/2020_07_12_19_03_53_hamburguesa1.png','Hamburguesa con queso cheddar, vegetales, salsas al gusto y el secreto de la casa',15000,1),(2,'Hamburguesa de pollo','static/img/Productos/2020_07_12_19_07_42_hamburguesa_pollo.png','Hamburguesa de pollo con queso cheddar, vegetales, salsas al gusto y el secreto de la casa',14000,1),(3,'Hamburguesa triple parrilla','static/img/Productos/2020_07_12_19_19_26_hamburguesa_triple.png','Hamburguesa con tres carnes de res, queso cheddar, vegetales de la casa, salsas al gusto y el secreto de la casa',18000,1),(4,'Hamburguesa triple parrilla especial','static/img/Productos/2020_07_12_19_22_10_hamburguesa_triple_especial.png ','Hamburguesa con tres carnes de res, queso cheddar, vegetales , salsas al gusto, anillos de cebolla, tocineta y el secreto de la casa.',21000,1),(5,'Hamburguesa parrillada especial','static/img/Productos/2020_07_12_19_25_59_hamburguesa_casa_especial.png','Hamburguesa con cinco carnes de res, queso cheddar, jamón de cerdo, vegetales de la casa, salsas al gusto, tocineta y el secreto de la casa.',25000,1),(6,'Hamburguesa doble parrilla','static/img/Productos/2020_07_12_19_31_24_hamburguesa_doble_carne.png','Hamburguesa con tres carnes de res, queso cheddar, vegetales de la casa, salsas al gusto y el secreto de la casa',16000,1),(7,'Lasaña personal','static/img/Productos/2020_07_12_19_40_35_lasana1.png','Porción personal de lasaña de carne de tres niveles, con salsa de la casa',14000,2),(8,'Lasaña de mariscos','static/img/Productos/2020_07_12_19_51_57_lasana2.png','Porción personal de lasaña de mariscos de tres niveles, con salsa especial de la casa',18000,2),(9,'Lasaña tradicional','static/img/Productos/2020_07_12_19_56_42_lasana3.png','Lasaña tradicional mixta, acompañada de pan de ajo y salsa especial de la casa',20000,2),(10,'Lasaña de carne especial','static/img/Productos/2020_07_12_20_00_29_lasana4.png','Porción personal de lasaña de carne de cuatro niveles, con extra queso y con nuestra salsa de la casa',16000,2),(11,'Perro caliente XL','static/img/Productos/2020_07_12_20_25_55_hotdog1.png','Perro caliente de 25cm de largo acompañado con chilli, queso cheddar derretido y salsas al gusto.',20000,3),(12,'Perro caliente especial','static/img/Productos/2020_07_12_20_29_02_hotdog2.png','Perro caliente de 25cm de largo acompañado con pepinillos, queso cheddar derretido y cebolla y salsas al gusto.',16000,3),(13,'Perro caliente sencillo','static/img/Productos/2020_07_12_20_30_50_hotdog3.png','Perro caliente sencillo de 10cm de largo acompañado de salsas al gusto.',14000,3),(14,'Taco pintao','static/img/Productos/2020_07_12_21_26_51_taco1.png','Taco de pollo con tomate, cebolla, albahaca y la salsa de la casa ',16000,4),(15,'Taco grillado','static/img/Productos/2020_07_12_21_28_26_taco3.png','Taco relleno de pechuga de pollo con tomate, cebolla, albahaca, limón y la salsa de la casa',17000,4),(16,'Combo de tacos al pastor','static/img/Productos/2020_07_12_21_30_33_taco4.png ','5 tacos al pastor con tortilla de maíz, cebolla, albahaca y la salsa de la casa',30000,4),(17,'Taco al pastor (unidad)','static/img/Productos/2020_07_12_21_31_40_taco5.png','Taco al pastor con tortilla de maíz, cebolla, albahaca y la salsa de la casa',12000,4),(18,'Combo doble de tacos','static/img/Productos/2020_07_12_21_32_51_taco6.png','2 tacos, 1 al pastor el otro con pollo desmenuzado con tortilla de maíz, cebolla, albahaca y la salsa de la casa',18000,4),(19,'Combo de tacos chili','static/img/Productos/2020_07_12_21_33_57_taco7.png','3 tacos con tortilla de maíz, cebolla, albahaca, lechuga, salsa valentina, salsa picante y la salsa de la casa',22000,4),(20,'Taco de pollo picante','static/img/Productos/2020_07_12_21_35_50_taco2.png','2 tacos de pollo con tortilla de maíz, cebolla, albahaca, salsa valentina, salsa picante habanero y la salsa de la casa',17000,4),(21,'Pizza carne y vegetales','static/img/Productos/2020_07_12_22_03_13_pizza1.png','Pizza grande de pepperoni acompañada de tomate y pimenton verde',21000,5),(22,'Pizza de pepperoni','static/img/Productos/2020_07_12_22_03_52_pizza2.png','Pizza grande de pepperoni con queso',22000,5),(23,'Pizza de pollo BBQ','static/img/Productos/2020_07_12_22_04_42_pizza3.png','Pizza de pollo BBQ acompañada con queso y salsa de la casa',22000,5),(24,'Pizza de carnes','static/img/Productos/2020_07_12_22_05_16_pizza4.png','Pizza de carnes acompañada de queso y salsa de la casa',23000,5),(25,'Pizza carnes mixta','static/img/Productos/2020_07_12_22_06_46_pizza5.png','Pizza de carne y pollo acompañada de pimentón verde y champiñones',23000,5),(26,'Chicago pizza','static/img/Productos/2020_07_12_22_07_40_pizza6.png','Pizza con salsa napolitana y rellena completamente de queso.',27000,5);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nit` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  PRIMARY KEY (`idProveedor`),
  UNIQUE KEY `nit` (`nit`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,1026299,'Alqueria',7793395,'calle 4 a su # 77j-42'),(2,6541235,'Zenú',9874564,'calle 40 # 58-74'),(3,4561238,'Colanta',4561236,'calle 45 # 78-56'),(4,5642135,'Bimbo',1234568,'calle 55 a sur # 78j-41'),(5,6935214,'Fruco',2356894,'calle 78 # 56-96'),(6,654123,'Productos frescos S.A',4456258,'calle 96 # 45-32'),(7,1234568,'Pastas doria',1234568,'calle 105 # 78-54'),(8,5646512,'Distribuidora de carnes la 11',5236547,'calle 55 a sur # 78j-41'),(9,5215235,'Distribuidora de abarrotes',1234567,'calle 55 a sur # 78j-41');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-12 23:36:35
