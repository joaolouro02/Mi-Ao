-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25-Maio-2023 às 13:31
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `salao`
--
CREATE DATABASE salao;
use salao;

-- --------------------------------------------------------

--
-- Estrutura da tabela `apagados`
--

DROP TABLE IF EXISTS `apagados`;
CREATE TABLE IF NOT EXISTS `apagados` (
  `nome` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `tipo` int NOT NULL,
  `imagem` varchar(20) NOT NULL,
  `telemovel` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `morada` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `nome` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`nome`) VALUES
('joana'),
('joao'),
('maria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_servico`
--

DROP TABLE IF EXISTS `funcionario_servico`;
CREATE TABLE IF NOT EXISTS `funcionario_servico` (
  `idFuncionario` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idServico` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idFuncionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `funcionario_servico`
--

INSERT INTO `funcionario_servico` (`idFuncionario`, `idServico`) VALUES
('joana', '45'),
('joao', '56'),
('maria', '5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `n` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `funcionarioId` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dia` date NOT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFim` time DEFAULT NULL,
  `preco` int NOT NULL,
  KEY `reservas_fk` (`n`),
  KEY `reservas_fk_2` (`funcionarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

DROP TABLE IF EXISTS `servico`;
CREATE TABLE IF NOT EXISTS `servico` (
  `servicoId` int NOT NULL,
  `tipo` varchar(40) NOT NULL,
  PRIMARY KEY (`servicoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`servicoId`, `tipo`) VALUES
(1, 'Cao Lavar'),
(2, 'Cao Cortar'),
(3, 'Gato Lavar'),
(4, 'Gato Cortar'),
(5, 'Lavar'),
(6, 'Cortar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `nome` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` int NOT NULL,
  `imagem` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telemovel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `morada` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`nome`, `pass`, `tipo`, `imagem`, `telemovel`, `mail`, `morada`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 3, 'admin.png', '333', 'admin@gmail.com', 'travessa'),
('cliente', '4983a0ab83ed86e0e7213c8783940193', 1, 'cliente.png', '3344', 'cliente@gmail.com', 'rua'),
('joana', '18f01959ff46071d73905d549cafde20', 2, 'func.png', '11', 'joana@gmail.com', 'rua azul'),
('joao', 'dccd96c256bc7dd39bae41a405f25e43', 2, 'func.png', '111', 'joao@gmail.com', 'rua verde'),
('maria', '263bce650e68ab4e23f28263760b9fa5', 2, 'func.png', '999', 'maria@gmail.com', 'rua vermelha');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario` FOREIGN KEY (`nome`) REFERENCES `utilizador` (`nome`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `funcionario_servico`
--
ALTER TABLE `funcionario_servico`
  ADD CONSTRAINT `fk_funcionario_servico_funcionario` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`nome`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reservas_fk` FOREIGN KEY (`n`) REFERENCES `utilizador` (`nome`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_fk_2` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`nome`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
