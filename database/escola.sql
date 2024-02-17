-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11/02/2024 às 21:30
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `administracao`
--

INSERT INTO `administracao` (`id`, `nome`, `login`, `senha`) VALUES
(3, 'Luiz Carlos', 'luizcj', '1234');

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
  `rg` char(12) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `pcd` tinyint DEFAULT NULL,
  `pcd_desc` varchar(255) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `endereco_id` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `rg_UNIQUE` (`rg`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_aluno_endereco1_idx` (`endereco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome_completo`, `nome`, `sobrenome`, `sexo`, `email`, `nascimento`, `rg`, `cpf`, `pcd`, `pcd_desc`, `login`, `senha`, `endereco_id`) VALUES
(6, 'Luiz Carlos Aragão Carreira Junior', 'Luiz Carlos', 'Aragão', 'M', 'luiz10junior@gmail.com', '1998-09-01', '3827472', '03059302023', 1, '11aaaaaaaa', 'luizcj', '1234', NULL);

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
(6, 5),
(6, 6);

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
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conhecimento`
--

DROP TABLE IF EXISTS `conhecimento`;
CREATE TABLE IF NOT EXISTS `conhecimento` (
  `id` int NOT NULL,
  `materia` varchar(45) NOT NULL,
  `assunto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(4, 'Técnico em Informática', 'TI', 'Terça e Quinta', 'Informática', 360, 'M', '2023-09-06', '2024-03-31', '19:00', '22:00', 1000.00),
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id`, `logradouro`, `numero`, `complemento`, `bairro`, `cep`, `cidade`, `estado`) VALUES
(5, 'Rua Domingos Marreiros', '1403', 'Apto 1804', 'Umarizal', '66060160', 'Belém', 'PA'),
(6, 'Rua Domingos Marreiros', '1403', 'Apto 1804', 'Umarizal', '66060160', 'Belém', 'PA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
CREATE TABLE IF NOT EXISTS `frequencia` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `presenca` enum('presente','faltou') NOT NULL,
  `data` datetime NOT NULL,
  `situacao` enum('aprovado','reprovado') NOT NULL,
  `aluno_disciplina_aluno_id` int UNSIGNED NOT NULL,
  `aluno_disciplina_disciplina_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `nome` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sobrenome` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conteudo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `anexo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turma` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id_professor` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nascimento` date NOT NULL,
  `endereco_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_professor`),
  KEY `fk_professor_endereco1_idx` (`endereco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome`, `sobrenome`, `email`, `nascimento`, `endereco_id`) VALUES
(4, 'Simone', 'Amaral', 'simoneamaral@gmail.com', '2024-02-01', 5),
(5, 'Simone', 'Amaral', 'simoneamaral@gmail.com', '2024-02-01', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_has_conhecimento`
--

DROP TABLE IF EXISTS `professor_has_conhecimento`;
CREATE TABLE IF NOT EXISTS `professor_has_conhecimento` (
  `professor_id` int UNSIGNED NOT NULL,
  `conhecimento_id` int NOT NULL,
  PRIMARY KEY (`professor_id`,`conhecimento_id`),
  KEY `fk_professor_has_conhecimento_conhecimento1_idx` (`conhecimento_id`),
  KEY `fk_professor_has_conhecimento_professor1_idx` (`professor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `bloco` varchar(45) NOT NULL,
  `andar` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `sala`
--

INSERT INTO `sala` (`id`, `tipo`, `bloco`, `andar`) VALUES
(2, '1', '12', '1'),
(3, '1', '12', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sala_has_turma`
--

DROP TABLE IF EXISTS `sala_has_turma`;
CREATE TABLE IF NOT EXISTS `sala_has_turma` (
  `sala_id` tinyint UNSIGNED NOT NULL,
  `turma_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`sala_id`,`turma_id`),
  KEY `fk_sala_has_turma_turma1_idx` (`turma_id`),
  KEY `fk_sala_has_turma_sala1_idx` (`sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `sala_has_turma`
--

INSERT INTO `sala_has_turma` (`sala_id`, `turma_id`) VALUES
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefone_aluno`
--

DROP TABLE IF EXISTS `telefone_aluno`;
CREATE TABLE IF NOT EXISTS `telefone_aluno` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero` varchar(15) NOT NULL,
  `aluno_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_UNIQUE` (`numero`),
  KEY `fk_telefone_aluno1_idx` (`aluno_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefone_professor`
--

DROP TABLE IF EXISTS `telefone_professor`;
CREATE TABLE IF NOT EXISTS `telefone_professor` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero` varchar(15) NOT NULL,
  `professor_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_telefone_professor_professor1_idx` (`professor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

DROP TABLE IF EXISTS `turma`;
CREATE TABLE IF NOT EXISTS `turma` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` char(2) NOT NULL,
  `curso_id_curso` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`,`curso_id_curso`),
  KEY `fk_turma_curso1_idx` (`curso_id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id`, `codigo`, `curso_id_curso`) VALUES
(3, 'A', 4),
(4, 'B', 4),
(5, 'C', 6),
(6, 'D', 7);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_endereco1` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`);

--
-- Restrições para tabelas `aluno_has_turma`
--
ALTER TABLE `aluno_has_turma`
  ADD CONSTRAINT `fk_aluno_has_turma_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `fk_aluno_has_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`);

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

--
-- Restrições para tabelas `professor_has_conhecimento`
--
ALTER TABLE `professor_has_conhecimento`
  ADD CONSTRAINT `fk_professor_has_conhecimento_conhecimento1` FOREIGN KEY (`conhecimento_id`) REFERENCES `conhecimento` (`id`),
  ADD CONSTRAINT `fk_professor_has_conhecimento_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id_professor`);

--
-- Restrições para tabelas `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD CONSTRAINT `fk_professor_has_turma_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id_professor`),
  ADD CONSTRAINT `fk_professor_has_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`);

--
-- Restrições para tabelas `sala_has_turma`
--
ALTER TABLE `sala_has_turma`
  ADD CONSTRAINT `fk_sala_has_turma_sala1` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`),
  ADD CONSTRAINT `fk_sala_has_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`);

--
-- Restrições para tabelas `telefone_aluno`
--
ALTER TABLE `telefone_aluno`
  ADD CONSTRAINT `fk_telefone_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`);

--
-- Restrições para tabelas `telefone_professor`
--
ALTER TABLE `telefone_professor`
  ADD CONSTRAINT `fk_telefone_professor_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id_professor`);

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_curso1` FOREIGN KEY (`curso_id_curso`) REFERENCES `curso` (`id_curso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
