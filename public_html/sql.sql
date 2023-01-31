CREATE DATABASE IF NOT EXISTS mecanica

USE mecanica

CREATE TABLE IF NOT EXISTS Funcionario(
matricula INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(150) NOT NULL,
cpf VARCHAR(15) NOT NULL UNIQUE,
rg VARCHAR(9) NOT NULL UNIQUE,
celular VARCHAR(15) NOT NULL,
telefone VARCHAR(15),
email VARCHAR(60) UNIQUE,
salario FLOAT,
rua VARCHAR(50) NOT NULL,
bairro VARCHAR(30) NOT NULL,
cidade VARCHAR(30) NOT NULL,
cargo INT NOT NULL) 
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Cliente(
idCliente INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(150) NOT NULL,
cpf VARCHAR(15) NOT NULL UNIQUE,
rg VARCHAR(15) NOT NULL UNIQUE,
celular VARCHAR(15) NOT NULL,
telefone VARCHAR(15),
email VARCHAR(60) UNIQUE,
veiculo VARCHAR(30)NOT NULL,
placa VARCHAR(7)NOT NULL)
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Fornecedor(
idFornecedor INT PRIMARY KEY AUTO_INCREMENT,
razaoSocial VARCHAR(60) NOT NULL UNIQUE,
nomeFantasia VARCHAR(60) NOT NULL,
cnpj VARCHAR(18) NOT NULL UNIQUE,
rua VARCHAR(50) NOT NULL,
bairro VARCHAR(30) NOT NULL,
cidade VARCHAR(30) NOT NULL,
estado VARCHAR(2) NOT NULL,
email VARCHAR(60) NOT NULL UNIQUE,
telefone VARCHAR(15)NOT NULL)
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Pecas(
idPeca INT PRIMARY KEY AUTO_INCREMENT,
descricao VARCHAR(50) NOT NULL,
preco FLOAT,
idFornecedor INT NOT NULL,
FOREIGN KEY (idFornecedor) REFERENCES Fornecedor (idFornecedor))
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Servico(
ordemServico INT PRIMARY KEY AUTO_INCREMENT,
maoDeObra FLOAT NOT NULL,
total FLOAT NOT NULL,
nf VARCHAR(15),
idCliente INT NOT NULL,
idPeca INT NOT NULL,
FOREIGN KEY (idCliente) REFERENCES Cliente (idCliente),
FOREIGN KEY (idPeca) REFERENCES Pecas (idPeca))
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Usuario(
idUsuario INT PRIMARY KEY,
login VARCHAR(20) NOT NULL UNIQUE,
senha VARCHAR(40) NOT NULL,
idFuncionario INT NOT NULL,
FOREIGN KEY (idFuncionario) REFERENCES Funcionario (matricula))
ENGINE = INNODB;

