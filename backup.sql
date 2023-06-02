-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: texkoin
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Temporary table structure for view `ranking_setores`
--

DROP TABLE IF EXISTS `ranking_setores`;
/*!50001 DROP VIEW IF EXISTS `ranking_setores`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ranking_setores` AS SELECT 
 1 AS `setor`,
 1 AS `total_texkoins`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `setores`
--

DROP TABLE IF EXISTS `setores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setores` (
  `rank` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `qntdUsers` int(11) DEFAULT NULL,
  `texkoins` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setores`
--

LOCK TABLES `setores` WRITE;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
/*!40000 ALTER TABLE `setores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario` varchar(255) DEFAULT NULL,
  `primeiro_nome` varchar(255) DEFAULT NULL,
  `segundo_nome` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `setor` varchar(255) DEFAULT NULL,
  `texkoins` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('gustavo.henrique','Gustavo','Henrique','lixo','Engenharia',0.85,'ghost/1.png',1),('joao.canudo','João','Canudo Porshe',NULL,'Administrativo',0.39,'joao.canudo.png',3),('lucas.vela','Lucas','Vela Ferrari',NULL,'Comercial',0.18,'lucas.vela.png',4),('ana.bola','Ana','Bola Martelo',NULL,'Recursos Humanos',0.49,'ana.bola.png',5),('pedro.livro','Pedro','Livro Helicóptero',NULL,'Recursos Humanos',0.29,'pedro.livro.png',6),('maria.pipa','Maria','Pipa Girassol',NULL,'Compliance',0.40,'maria.pipa.png',7),('carlos.cadeira','Carlos','Cadeira Avião',NULL,'Marketing',0.34,'carlos.cadeira.png',8),('sofia.janela','Sofia','Janela Borboleta',NULL,'Compliance',0.21,'sofia.janela.png',9),('tiago.mesa','Tiago','Mesa Guitarra',NULL,'Comercial',0.70,'tiago.mesa.png',10),('isabela.porta','Isabela','Porta Computador',NULL,'Administrativo',0.33,'isabela.porta.png',11),('gabriel.cama','Gabriel','Cama Espelho',NULL,'Alianças',0.78,'gabriel.cama.png',12);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `ranking_setores`
--

/*!50001 DROP VIEW IF EXISTS `ranking_setores`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ranking_setores` AS select `usuarios`.`setor` AS `setor`,sum(`usuarios`.`texkoins`) AS `total_texkoins` from `usuarios` group by `usuarios`.`setor` order by `total_texkoins` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-02 11:36:33
