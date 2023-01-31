-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Nov-2019 às 01:03
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mecanica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `veiculo` varchar(30) NOT NULL,
  `placa` varchar(7) NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `rg` (`rg`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `idFornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(60) NOT NULL,
  `nomeFantasia` varchar(60) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `numero` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  PRIMARY KEY (`idFornecedor`),
  UNIQUE KEY `razaoSocial` (`razaoSocial`),
  UNIQUE KEY `cnpj` (`cnpj`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idFornecedor`, `razaoSocial`, `nomeFantasia`, `cnpj`, `rua`, `bairro`, `cidade`, `estado`, `numero`, `email`, `telefone`) VALUES
(6, 'Ype', 'Ype', '11.561.565/6165-1', 'Rua', 'Bairro', 'Cidade', 'SP', 561, 'lol@gmail.com', '446165');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `matricula` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `salario` float DEFAULT NULL,
  `rua` varchar(50) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `cargo` int(11) NOT NULL,
  PRIMARY KEY (`matricula`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `rg` (`rg`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`matricula`, `nome`, `cpf`, `rg`, `celular`, `telefone`, `email`, `salario`, `rua`, `bairro`, `cidade`, `cargo`) VALUES
(1, 'empregado 1', '161.455.464-55', '545454555', '19 9 9988-55555', '19 3804-5563', 'empregado@gmail.com', 1300, 'Rua dos pikoes', 'Jardim Rola', 'Rolandia', 1),
(3, 'dono 1', '1223.455.464-55', '225454555', '19 9 9988-55555', '19 3804-5563', 'dono@gmail.com', 1300, 'Rua dos pikoes', 'Jardim Rola', 'Rolandia', 0),
(11, 'Rafinha', '321', '123', '321', '123', 'Basto@gmai.com', 5, 'Rola', 'Amparo', 'Rolandinha', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pecas`
--

CREATE TABLE IF NOT EXISTS `pecas` (
  `idPeca` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `preco` float DEFAULT NULL,
  `idFornecedor` int(11) NOT NULL,
  PRIMARY KEY (`idPeca`),
  KEY `idFornecedor` (`idFornecedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE IF NOT EXISTS `servico` (
  `ordemServico` int(11) NOT NULL AUTO_INCREMENT,
  `maoDeObra` float NOT NULL,
  `total` float NOT NULL,
  `nf` varchar(15) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `idPeca` int(11) NOT NULL,
  PRIMARY KEY (`ordemServico`),
  KEY `idCliente` (`idCliente`),
  KEY `idPeca` (`idPeca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `idFuncionario` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `login` (`login`),
  KEY `idFuncionario` (`idFuncionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `senha`, `idFuncionario`) VALUES
(1, 'empregado', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(3, 'dono', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pecas`
--
ALTER TABLE `pecas`
  ADD CONSTRAINT `pecas_ibfk_1` FOREIGN KEY (`idFornecedor`) REFERENCES `fornecedor` (`idFornecedor`);

--
-- Limitadores para a tabela `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `servico_ibfk_2` FOREIGN KEY (`idPeca`) REFERENCES `pecas` (`idPeca`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`matricula`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
