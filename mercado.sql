-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mercado
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `categoriaID` int(11) NOT NULL AUTO_INCREMENT,
  `categoriaNome` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`categoriaID`),
  UNIQUE KEY `categoriaNome` (`categoriaNome`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Limpeza',1),(2,'Cama e Banho',1),(3,'Eletronicos',0),(4,'Alimentos',1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `fornecedorID` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFantasia` varchar(255) NOT NULL,
  `razaoSocial` varchar(255) NOT NULL,
  `ie` int(11) NOT NULL,
  `cnpj` int(11) NOT NULL,
  `cnae` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  PRIMARY KEY (`fornecedorID`),
  UNIQUE KEY `razaoSocial` (`razaoSocial`),
  UNIQUE KEY `ie` (`ie`),
  UNIQUE KEY `cnpj` (`cnpj`),
  UNIQUE KEY `cnae` (`cnae`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (1,'Barraca do Atacado do Ze','BAZ',11111111,22222222,33333333,'Rua do Fornecedor, 1'),(2,'Joao varejista','JV',33333333,1111111,222222,'Rua do Fornecedor,2'),(3,'Pedro Atacarejo','PA',44433,55522,666,'Rua do Fornecedor, 3'),(4,'Maria do Grao','MG',777777,888888,999999,'Rua do Fornecedor, 4'),(5,'O ze fornecedor','OZ',0,1234567,9876543,'Rua do Fornecedor, 5'),(9,'mc','mc',2414,23424,234324,'23424');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `loginID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) DEFAULT '21 9999-8888',
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `enderecoPadrao` varchar(255) NOT NULL,
  `restricao` int(1) NOT NULL,
  PRIMARY KEY (`loginID`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'Administrador','admin@admin.com.br','21 9999-8888','admin','12345','Rua da empresa, 71',0),(2,'Administrador2','admin2@admin.com.br','21 9999-8888','admin2','c4ca4238a0b923820dcc509a6f75849b','Rua da empresa, 71',0),(3,'Administrador3','admin3@admin.com.br','21 9999-8888','admin3','827','Rua da empresa, 71',0);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `produtoID` int(11) NOT NULL AUTO_INCREMENT,
  `produtoNome` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fornecedorID` int(11) NOT NULL,
  `categoriaID` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `produtoImagem` varchar(32) NOT NULL,
  PRIMARY KEY (`produtoID`),
  UNIQUE KEY `produtoNome` (`produtoNome`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Pedaço de bolo',4,4,2000,5.00,''),(2,'Pão Doce',2,2,11,11.00,''),(3,'Bala Juquinha',2,1,222,22.00,''),(4,'Jaca Manteiga',2,4,11,111.00,''),(5,'Veja Multiuso',2,1,100,20.00,''),(8,'Goiaba',2,2,100,100.00,''),(11,'Toalha de Banho',2,2,100,25.00,''),(14,'Buzina',3,4,333,33.00,''),(15,'Veja Multi Uso',3,1,33,333.00,''),(17,'pc',2,2,33,33.00,'');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-12 21:54:17
