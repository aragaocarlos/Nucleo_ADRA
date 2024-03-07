-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07/03/2024 às 16:04
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administracao`
--

DROP TABLE IF EXISTS `administracao`;
CREATE TABLE IF NOT EXISTS `administracao` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `imagem` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `administracao`
--

INSERT INTO `administracao` (`id`, `nome`, `login`, `senha`, `imagem`) VALUES
(3, 'Luiz Carlos', 'luizcj', '1234', ''),
(4, 'Rodrigo Ribeiro da Costa Silva', 'rodrigoribeiro', '1234', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(80) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `sexo` enum('F','M') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `idade` int NOT NULL,
  `rg` char(12) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `pcd` tinyint DEFAULT NULL,
  `pcd_desc` varchar(255) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `endereco_id` int UNSIGNED DEFAULT NULL,
  `imagem` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `rg_UNIQUE` (`rg`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_aluno_endereco1_idx` (`endereco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome_completo`, `nome`, `sobrenome`, `sexo`, `email`, `nascimento`, `idade`, `rg`, `cpf`, `pcd`, `pcd_desc`, `login`, `senha`, `telefone`, `endereco_id`, `imagem`) VALUES
(6, 'Luiz Carlos Aragão Carreira', 'Luiz', 'Carreira', 'M', 'luiz10junior@gmail.com', '2000-09-09', 23, '3827472', '03059302023', 0, 'Nenhum', 'luizcj', '1234', '91985472131', 8, NULL),
(15, 'Rodrigo Ribeiro da Silva Costa', 'Rodrigo', 'Costa', 'M', 'rodrigoribeiro@gmail.com', '1998-01-09', 26, '000000', '011.504.652-63', 1, 'Cadeirante', 'rodrigoribeiro', '1234', '91985472131', 10, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno_has_turma`
--

DROP TABLE IF EXISTS `aluno_has_turma`;
CREATE TABLE IF NOT EXISTS `aluno_has_turma` (
  `aluno_id` int UNSIGNED NOT NULL,
  `turma_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`aluno_id`,`turma_id`),
  KEY `fk_aluno_has_turma_turma1_idx` (`turma_id`),
  KEY `fk_aluno_has_turma_aluno1_idx` (`aluno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `aluno_has_turma`
--

INSERT INTO `aluno_has_turma` (`aluno_id`, `turma_id`) VALUES
(6, 3),
(13, 3),
(15, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividade`
--

DROP TABLE IF EXISTS `atividade`;
CREATE TABLE IF NOT EXISTS `atividade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comando` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prazo` date DEFAULT NULL,
  `turma` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
CREATE TABLE IF NOT EXISTS `avaliacao` (
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `aluno_id`, `turma_id`, `n1`, `n2`, `n3`, `faltas`, `situacao`) VALUES
(6, 13, NULL, 7, 7, 7, 25, ''),
(7, 6, 3, 1, 1, 7, 14, 'REPROVADO'),
(8, 15, 3, 1, 1, 1, 0, 'REPROVADO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aluno_id` int NOT NULL,
  `turma_id` int NOT NULL,
  `post_id` int NOT NULL,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `texto` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `comentario`
--

INSERT INTO `comentario` (`id`, `aluno_id`, `turma_id`, `post_id`, `nome`, `sobrenome`, `data`, `texto`) VALUES
(3, 0, 3, 2, 'Simone', 'Amaral', '2024-03-15', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat sit amet lorem non pretium. Nulla facilisi. Praesent mollis in nibh in porta.'),
(16, 4, 3, 38, 'Simone', 'Amaral', '2024-03-06', 'WQWQQQQQQQQQQQ'),
(17, 4, 3, 38, 'Simone', 'Amaral', '2024-03-06', 'SSSSSSSSSSSSSSSSSSSSSSSSSS');

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  `descricao` text NOT NULL,
  `area` varchar(40) NOT NULL,
  `ch` smallint UNSIGNED DEFAULT NULL,
  `periodo` enum('M','V','N') DEFAULT NULL,
  `curso_inicio` date DEFAULT NULL,
  `curso_fim` date DEFAULT NULL,
  `hora_inicio` char(5) DEFAULT NULL,
  `hora_fim` char(5) DEFAULT NULL,
  `valor` decimal(6,2) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `sigla`, `descricao`, `area`, `ch`, `periodo`, `curso_inicio`, `curso_fim`, `hora_inicio`, `hora_fim`, `valor`) VALUES
(4, 'Técnico em Informática', 'TI', 'Terça e Quinta', 'Informática', 180, 'M', '2023-09-06', '2024-03-31', '19:00', '22:00', 1000.00),
(5, 'Técnico em Informática', 'TI', 'Terça e Quinta', 'Informática', 360, 'M', '2023-09-06', '2024-03-31', '19:00', '22:00', 1000.00),
(6, 'Desenvolvimento de Jogos', 'JG', 'Quarta e Sexta', 'Jogos', 100, 'V', '2023-09-06', '2024-03-31', '19:00', '22:00', 1000.00),
(7, 'Desenvolvimento de Jogos', 'JG', 'Quarta e Sexta', 'Jogos', 100, 'V', '2023-09-06', '2024-03-31', '19:00', '22:00', 1000.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(200) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` char(9) NOT NULL,
  `cidade` varchar(124) NOT NULL,
  `estado` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id`, `logradouro`, `numero`, `complemento`, `bairro`, `cep`, `cidade`, `estado`) VALUES
(6, 'Rua Domingos Marreiros', '1403', 'Apto 1804', 'Umarizal', '66060160', 'Belém', 'PA'),
(7, 'Rua Domingos Marreiros', '1245', 'Apto 1234', 'Fátima', '66060160', 'Belém', 'Pa'),
(10, 'Rua Domingos Marreiros', '1403', '3333', 'Fatima', '66060', '333', '33');

-- --------------------------------------------------------

--
-- Estrutura para tabela `matricula`
--

DROP TABLE IF EXISTS `matricula`;
CREATE TABLE IF NOT EXISTS `matricula` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `aluno_id` int UNSIGNED NOT NULL,
  `curso_id` int UNSIGNED NOT NULL,
  `situacao` enum('aprovado','reprovado','cursando') NOT NULL,
  `data_matricula` datetime NOT NULL,
  PRIMARY KEY (`id`,`aluno_id`,`curso_id`),
  KEY `fk_aluno_has_curso_curso1_idx` (`curso_id`),
  KEY `fk_aluno_has_curso_aluno1_idx` (`aluno_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `matricula`
--

INSERT INTO `matricula` (`id`, `aluno_id`, `curso_id`, `situacao`, `data_matricula`) VALUES
(2, 6, 4, 'cursando', '2024-02-11 19:43:23'),
(6, 6, 6, 'cursando', '2024-02-11 19:43:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mural`
--

DROP TABLE IF EXISTS `mural`;
CREATE TABLE IF NOT EXISTS `mural` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_curso` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aluno_id` int NOT NULL,
  `nome` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sobrenome` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conteudo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `anexo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turma` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `post`
--

INSERT INTO `post` (`id`, `aluno_id`, `nome`, `sobrenome`, `cargo`, `conteudo`, `anexo`, `horario`, `turma`) VALUES
(39, 0, 'Simone', 'Amaral', 'Professor', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', NULL, '06/03 17:04', 3),
(38, 0, 'Simone', 'Amaral', 'Professor', 'tttttttttttttttttttttttttttttttttttttttt', NULL, '06/03 17:02', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id_professor` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(40) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `sexo` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `nascimento` date NOT NULL,
  `idade` int DEFAULT NULL,
  `endereco_id` int UNSIGNED NOT NULL,
  `login` varchar(15) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `telefone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `imagem` text,
  PRIMARY KEY (`id_professor`),
  KEY `fk_professor_endereco1_idx` (`endereco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome_completo`, `nome`, `sobrenome`, `sexo`, `email`, `nascimento`, `idade`, `endereco_id`, `login`, `senha`, `telefone`, `imagem`) VALUES
(4, 'Simone dos Santos Amaral', 'Simone', 'Amaral', 'F', 'simoneamaral@gmail.com', '2024-02-01', NULL, 6, 'simoneamaral', '1234', '91985472131', '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');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_turma`
--

DROP TABLE IF EXISTS `professor_turma`;
CREATE TABLE IF NOT EXISTS `professor_turma` (
  `professor_id` int UNSIGNED NOT NULL,
  `turma_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`professor_id`,`turma_id`),
  KEY `fk_professor_has_turma_turma1_idx` (`turma_id`),
  KEY `fk_professor_has_turma_professor1_idx` (`professor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `professor_turma`
--

INSERT INTO `professor_turma` (`professor_id`, `turma_id`) VALUES
(4, 3),
(4, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

DROP TABLE IF EXISTS `turma`;
CREATE TABLE IF NOT EXISTS `turma` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` char(2) NOT NULL,
  `curso_id_curso` int UNSIGNED NOT NULL,
  `sala` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`curso_id_curso`),
  KEY `fk_turma_curso1_idx` (`curso_id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id`, `codigo`, `curso_id_curso`, `sala`) VALUES
(3, 'A', 4, '12'),
(4, 'B', 4, '10'),
(5, 'C', 6, NULL),
(6, 'D', 7, NULL);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_aluno_has_curso_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `fk_aluno_has_curso_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id_curso`);

--
-- Restrições para tabelas `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `fk_professor_endereco1` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
