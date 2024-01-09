-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01/12/2023 às 20:27
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `administracao`
--

INSERT INTO `administracao` (`id`, `nome`, `login`, `senha`) VALUES
(1, 'Luiz Carlos', 'luizcj', '1234'),
(2, 'Luiz Carlos', 'luizcj', '1234');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `sexo` enum('F','M') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `rg` char(12) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `responsavel_id` int UNSIGNED NOT NULL,
  `endereco_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `rg_UNIQUE` (`rg`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_aluno_responsavel1_idx` (`responsavel_id`),
  KEY `fk_aluno_endereco1_idx` (`endereco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome`, `sobrenome`, `sexo`, `email`, `nascimento`, `rg`, `cpf`, `login`, `senha`, `responsavel_id`, `endereco_id`) VALUES
(4, 'Luiz Carlos', 'Aragão', 'M', 'luiz10junior@gmail.com', '1998-09-01', '3827472', '03059304444', 'luizcj', '1234', 2, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno_disciplina`
--

DROP TABLE IF EXISTS `aluno_disciplina`;
CREATE TABLE IF NOT EXISTS `aluno_disciplina` (
  `aluno_id` int UNSIGNED NOT NULL,
  `disciplina_id` int UNSIGNED NOT NULL,
  `nota_1` decimal(4,2) NOT NULL,
  `nota_2` decimal(4,2) NOT NULL,
  `nota_3` decimal(4,2) NOT NULL,
  `nota_4` decimal(4,2) NOT NULL,
  `situacao` enum('aprovado','reprovado','cursando') NOT NULL,
  `ano` date NOT NULL,
  PRIMARY KEY (`aluno_id`,`disciplina_id`),
  KEY `fk_aluno_has_disciplina_disciplina1_idx` (`disciplina_id`),
  KEY `fk_aluno_has_disciplina_aluno1_idx` (`aluno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `area_disciplina`
--

DROP TABLE IF EXISTS `area_disciplina`;
CREATE TABLE IF NOT EXISTS `area_disciplina` (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  `disciplina_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_area_disciplina_disciplina1_idx` (`disciplina_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `situacao` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_aluno` (`aluno_id`),
  KEY `FK_turma` (`turma_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `aluno_id`, `turma_id`, `n1`, `n2`, `n3`, `faltas`, `situacao`) VALUES
(1, 2, 2, 10, 10, 10, 24, 'APROVADO'),
(2, NULL, NULL, 10, 10, 10, 24, 'APROVADO');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `sigla`, `descricao`, `area`, `ch`, `periodo`, `curso_inicio`, `curso_fim`, `hora_inicio`, `hora_fim`, `valor`) VALUES
(2, 'Técnico em Informática', 'TI', 'Turno Noturno 19:00h às 22:00h', 'Informática', 360, 'N', '2023-09-06', '2023-09-23', '19:00', '22:00', 1000.00),
(3, 'Desenvolvimento de Jogos', 'TI', 'Turno Noturno 19:00h às 22:00h', 'Informática', 360, 'N', '2023-09-06', '2023-09-23', '19:00', '22:00', 1000.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `id_dis` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `modulo` char(2) NOT NULL,
  `aulas_semana` tinyint UNSIGNED NOT NULL,
  `aulas_total` tinyint(1) NOT NULL,
  `ch` smallint NOT NULL,
  `curso_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_dis`),
  KEY `fk_disciplina_curso1_idx` (`curso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `disciplina`
--

INSERT INTO `disciplina` (`id_dis`, `nome`, `modulo`, `aulas_semana`, `aulas_total`, `ch`, `curso_id`) VALUES
(2, 'Técnico em Informática', '1', 5, 100, 100, 2),
(3, 'Desenvolvimento de Jogos', '1', 5, 100, 100, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id`, `logradouro`, `numero`, `complemento`, `bairro`, `cep`, `cidade`, `estado`) VALUES
(3, 'Rua Domingos Marreiros', '1403', 'Apto 1804', 'Fátima', '66060160', 'Belém', 'PA');

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
  PRIMARY KEY (`id`),
  KEY `fk_frequencia_aluno_disciplina1_idx` (`aluno_disciplina_aluno_id`,`aluno_disciplina_disciplina_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `post`
--

INSERT INTO `post` (`id`, `nome`, `sobrenome`, `cargo`, `conteudo`, `anexo`, `horario`, `turma`) VALUES
(15, 'Luiz Carlos', 'Aragão', 'Aluno', 'jahfubedfuw3lfmlkwmfrmker', NULL, '23/09 20:10', 2),
(14, 'Luiz Carlos', 'Aragão', 'Aluno', 'rrrrrrrrrrrrrrrrrrrrrr', NULL, '23/09 19:17', 2),
(13, 'Luiz Carlos', 'Aragão', 'Aluno', 'wwwwwwwwwww', NULL, '23/09 16:57', 2),
(16, 'Luiz Carlos', 'Aragão', 'Aluno', 'wwwwwwwwwwwwwwwwwwww', NULL, '28/11 09:35', 2),
(17, 'Luiz Carlos', 'Aragão', 'Aluno', '33333333', NULL, '01/12 00:32', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome`, `sobrenome`, `email`, `nascimento`, `endereco_id`) VALUES
(2, 'Simone', 'Amaral', 'simoneamaral@edu.pa.senac.br', '0000-00-00', 3),
(3, 'Ivo', 'Barbosa', 'simoneamaral@edu.pa.senac.br', '0000-00-00', 3);

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

--
-- Despejando dados para a tabela `professor_turma`
--

INSERT INTO `professor_turma` (`professor_id`, `turma_id`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `responsavel`
--

DROP TABLE IF EXISTS `responsavel`;
CREATE TABLE IF NOT EXISTS `responsavel` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `rg` char(12) NOT NULL,
  `cpf` char(14) NOT NULL,
  `parentesco` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `responsavel`
--

INSERT INTO `responsavel` (`id`, `nome`, `sobrenome`, `rg`, `cpf`, `parentesco`) VALUES
(2, 'Maria', 'Eunice', '3827472', '03059302023', 'Mãe'),
(3, 'Maria', 'Eunice', '3827472', '03059302023', 'Mãe');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `disciplina_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_turma_disciplina1_idx` (`disciplina_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id`, `codigo`, `disciplina_id`) VALUES
(2, '20', 2);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_endereco1` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`),
  ADD CONSTRAINT `fk_aluno_responsavel1` FOREIGN KEY (`responsavel_id`) REFERENCES `responsavel` (`id`);

--
-- Restrições para tabelas `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
  ADD CONSTRAINT `fk_aluno_has_disciplina_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `fk_aluno_has_disciplina_disciplina1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id_dis`);

--
-- Restrições para tabelas `aluno_has_turma`
--
ALTER TABLE `aluno_has_turma`
  ADD CONSTRAINT `fk_aluno_has_turma_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `fk_aluno_has_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`);

--
-- Restrições para tabelas `area_disciplina`
--
ALTER TABLE `area_disciplina`
  ADD CONSTRAINT `fk_area_disciplina_disciplina1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id_dis`);

--
-- Restrições para tabelas `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_disciplina_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id_curso`);

--
-- Restrições para tabelas `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `fk_frequencia_aluno_disciplina1` FOREIGN KEY (`aluno_disciplina_aluno_id`,`aluno_disciplina_disciplina_id`) REFERENCES `aluno_disciplina` (`aluno_id`, `disciplina_id`);

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
  ADD CONSTRAINT `fk_turma_disciplina1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id_dis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
