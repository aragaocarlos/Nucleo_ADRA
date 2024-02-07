CREATE DATABASE  IF NOT EXISTS `escola` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `escola`;
-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: escola
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `administracao`
--

DROP TABLE IF EXISTS `administracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administracao` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administracao`
--

LOCK TABLES `administracao` WRITE;
/*!40000 ALTER TABLE `administracao` DISABLE KEYS */;
/*!40000 ALTER TABLE `administracao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aluno` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `sexo` enum('F','M') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `rg` char(12) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `pcd` tinyint DEFAULT NULL,
  `pcd_desc` varchar(255) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `responsavel_id` int unsigned NOT NULL,
  `endereco_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `rg_UNIQUE` (`rg`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_aluno_responsavel1_idx` (`responsavel_id`),
  KEY `fk_aluno_endereco1_idx` (`endereco_id`),
  CONSTRAINT `fk_aluno_endereco1` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`),
  CONSTRAINT `fk_aluno_responsavel1` FOREIGN KEY (`responsavel_id`) REFERENCES `responsavel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluno`
--

LOCK TABLES `aluno` WRITE;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aluno_has_turma`
--

DROP TABLE IF EXISTS `aluno_has_turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aluno_has_turma` (
  `aluno_id` int unsigned NOT NULL,
  `turma_id` int unsigned NOT NULL,
  PRIMARY KEY (`aluno_id`,`turma_id`),
  KEY `fk_aluno_has_turma_turma1_idx` (`turma_id`),
  KEY `fk_aluno_has_turma_aluno1_idx` (`aluno_id`),
  CONSTRAINT `fk_aluno_has_turma_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  CONSTRAINT `fk_aluno_has_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluno_has_turma`
--

LOCK TABLES `aluno_has_turma` WRITE;
/*!40000 ALTER TABLE `aluno_has_turma` DISABLE KEYS */;
/*!40000 ALTER TABLE `aluno_has_turma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atividade`
--

DROP TABLE IF EXISTS `atividade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atividade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comando` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prazo` date DEFAULT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `turma` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividade`
--

LOCK TABLES `atividade` WRITE;
/*!40000 ALTER TABLE `atividade` DISABLE KEYS */;
/*!40000 ALTER TABLE `atividade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avaliacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aluno_id` int DEFAULT NULL,
  `turma_id` int DEFAULT NULL,
  `n1` float DEFAULT NULL,
  `n2` float DEFAULT NULL,
  `n3` float DEFAULT NULL,
  `faltas` int DEFAULT NULL,
  `situacao` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_aluno` (`aluno_id`),
  KEY `FK_turma` (`turma_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao`
--

LOCK TABLES `avaliacao` WRITE;
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conhecimento`
--

DROP TABLE IF EXISTS `conhecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conhecimento` (
  `id` int NOT NULL,
  `materia` varchar(45) NOT NULL,
  `assunto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conhecimento`
--

LOCK TABLES `conhecimento` WRITE;
/*!40000 ALTER TABLE `conhecimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `conhecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `id_curso` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  `descricao` text NOT NULL,
  `area` varchar(40) NOT NULL,
  `ch` smallint unsigned DEFAULT NULL,
  `periodo` enum('M','V','N') DEFAULT NULL,
  `curso_inicio` date DEFAULT NULL,
  `curso_fim` date DEFAULT NULL,
  `hora_inicio` char(5) DEFAULT NULL,
  `hora_fim` char(5) DEFAULT NULL,
  `valor` decimal(6,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(200) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` char(9) NOT NULL,
  `cidade` varchar(124) NOT NULL,
  `estado` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `frequencia` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `presenca` enum('presente','faltou') NOT NULL,
  `data` datetime NOT NULL,
  `situacao` enum('aprovado','reprovado') NOT NULL,
  `aluno_disciplina_aluno_id` int unsigned NOT NULL,
  `aluno_disciplina_disciplina_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequencia`
--

LOCK TABLES `frequencia` WRITE;
/*!40000 ALTER TABLE `frequencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `frequencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matricula` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `aluno_id` int unsigned NOT NULL,
  `curso_id` int unsigned NOT NULL,
  `situacao` enum('aprovado','reprovado','cursando') NOT NULL,
  `data_matricula` datetime NOT NULL,
  PRIMARY KEY (`id`,`aluno_id`,`curso_id`),
  KEY `fk_aluno_has_curso_curso1_idx` (`curso_id`),
  KEY `fk_aluno_has_curso_aluno1_idx` (`aluno_id`),
  CONSTRAINT `fk_aluno_has_curso_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  CONSTRAINT `fk_aluno_has_curso_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mural`
--

DROP TABLE IF EXISTS `mural`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mural` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_curso` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mural`
--

LOCK TABLES `mural` WRITE;
/*!40000 ALTER TABLE `mural` DISABLE KEYS */;
/*!40000 ALTER TABLE `mural` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sobrenome` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conteudo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `anexo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turma` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professor` (
  `id_professor` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nascimento` date NOT NULL,
  `endereco_id` int unsigned NOT NULL,
  PRIMARY KEY (`id_professor`),
  KEY `fk_professor_endereco1_idx` (`endereco_id`),
  CONSTRAINT `fk_professor_endereco1` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor_has_conhecimento`
--

DROP TABLE IF EXISTS `professor_has_conhecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professor_has_conhecimento` (
  `professor_id` int unsigned NOT NULL,
  `conhecimento_id` int NOT NULL,
  PRIMARY KEY (`professor_id`,`conhecimento_id`),
  KEY `fk_professor_has_conhecimento_conhecimento1_idx` (`conhecimento_id`),
  KEY `fk_professor_has_conhecimento_professor1_idx` (`professor_id`),
  CONSTRAINT `fk_professor_has_conhecimento_conhecimento1` FOREIGN KEY (`conhecimento_id`) REFERENCES `conhecimento` (`id`),
  CONSTRAINT `fk_professor_has_conhecimento_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id_professor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor_has_conhecimento`
--

LOCK TABLES `professor_has_conhecimento` WRITE;
/*!40000 ALTER TABLE `professor_has_conhecimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `professor_has_conhecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor_turma`
--

DROP TABLE IF EXISTS `professor_turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professor_turma` (
  `professor_id` int unsigned NOT NULL,
  `turma_id` int unsigned NOT NULL,
  PRIMARY KEY (`professor_id`,`turma_id`),
  KEY `fk_professor_has_turma_turma1_idx` (`turma_id`),
  KEY `fk_professor_has_turma_professor1_idx` (`professor_id`),
  CONSTRAINT `fk_professor_has_turma_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id_professor`),
  CONSTRAINT `fk_professor_has_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor_turma`
--

LOCK TABLES `professor_turma` WRITE;
/*!40000 ALTER TABLE `professor_turma` DISABLE KEYS */;
/*!40000 ALTER TABLE `professor_turma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsavel`
--

DROP TABLE IF EXISTS `responsavel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `responsavel` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `rg` char(12) NOT NULL,
  `cpf` char(14) NOT NULL,
  `parentesco` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsavel`
--

LOCK TABLES `responsavel` WRITE;
/*!40000 ALTER TABLE `responsavel` DISABLE KEYS */;
/*!40000 ALTER TABLE `responsavel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sala`
--

DROP TABLE IF EXISTS `sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sala` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `bloco` varchar(45) NOT NULL,
  `andar` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala`
--

LOCK TABLES `sala` WRITE;
/*!40000 ALTER TABLE `sala` DISABLE KEYS */;
/*!40000 ALTER TABLE `sala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sala_has_turma`
--

DROP TABLE IF EXISTS `sala_has_turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sala_has_turma` (
  `sala_id` tinyint unsigned NOT NULL,
  `turma_id` int unsigned NOT NULL,
  PRIMARY KEY (`sala_id`,`turma_id`),
  KEY `fk_sala_has_turma_turma1_idx` (`turma_id`),
  KEY `fk_sala_has_turma_sala1_idx` (`sala_id`),
  CONSTRAINT `fk_sala_has_turma_sala1` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`),
  CONSTRAINT `fk_sala_has_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala_has_turma`
--

LOCK TABLES `sala_has_turma` WRITE;
/*!40000 ALTER TABLE `sala_has_turma` DISABLE KEYS */;
/*!40000 ALTER TABLE `sala_has_turma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone_aluno`
--

DROP TABLE IF EXISTS `telefone_aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telefone_aluno` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(15) NOT NULL,
  `aluno_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_UNIQUE` (`numero`),
  KEY `fk_telefone_aluno1_idx` (`aluno_id`),
  CONSTRAINT `fk_telefone_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone_aluno`
--

LOCK TABLES `telefone_aluno` WRITE;
/*!40000 ALTER TABLE `telefone_aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone_aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone_professor`
--

DROP TABLE IF EXISTS `telefone_professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telefone_professor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(15) NOT NULL,
  `professor_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_telefone_professor_professor1_idx` (`professor_id`),
  CONSTRAINT `fk_telefone_professor_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id_professor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone_professor`
--

LOCK TABLES `telefone_professor` WRITE;
/*!40000 ALTER TABLE `telefone_professor` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone_professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turma`
--

DROP TABLE IF EXISTS `turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turma` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `codigo` char(2) NOT NULL,
  `curso_id_curso` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`curso_id_curso`),
  KEY `fk_turma_curso1_idx` (`curso_id_curso`),
  CONSTRAINT `fk_turma_curso1` FOREIGN KEY (`curso_id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turma`
--

LOCK TABLES `turma` WRITE;
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-06 20:12:06
