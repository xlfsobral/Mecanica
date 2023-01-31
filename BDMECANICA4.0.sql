
CREATE TABLE IF NOT EXISTS Funcionario(
matricula INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
cpf VARCHAR(15) NOT NULL UNIQUE,
rg VARCHAR(15) NOT NULL UNIQUE,
celular VARCHAR(15) NOT NULL UNIQUE,
telefone VARCHAR(15),
email VARCHAR(60) UNIQUE,
salario FLOAT NOT NULL,
rua VARCHAR(50) NOT NULL,
bairro VARCHAR(30) NOT NULL,
cidade VARCHAR(30) NOT NULL,
cargo INT NOT NULL) 
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Cliente(
idCliente INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
cpf VARCHAR(15) NOT NULL UNIQUE,
rg VARCHAR(15) NOT NULL UNIQUE,
celular VARCHAR(15) NOT NULL UNIQUE,
telefone VARCHAR(15),
email VARCHAR(60) UNIQUE,
veiculo VARCHAR(30)NOT NULL,
placa VARCHAR(7)NOT NULL UNIQUE)
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Fornecedor(
idFornecedor INT PRIMARY KEY AUTO_INCREMENT,
razaoSocial VARCHAR(60) NOT NULL,
nomeFantasia VARCHAR(60) NOT NULL,
cnpj VARCHAR(18) NOT NULL UNIQUE,
rua VARCHAR(50) NOT NULL,
bairro VARCHAR(30) NOT NULL,
cidade VARCHAR(30) NOT NULL,
estado VARCHAR(2) NOT NULL,
numero VARCHAR(5) NOT NULL,
email VARCHAR(60) NOT NULL UNIQUE,
telefone VARCHAR(15)NOT NULL UNIQUE)
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Pecas(
idPeca INT PRIMARY KEY AUTO_INCREMENT,
descricao VARCHAR(50) NOT NULL,
preco DECIMAL(9,2) NOT NULL DEFAULT '0.00',
fkFornecedor INT NOT NULL,
FOREIGN KEY (fkFornecedor) REFERENCES Fornecedor (idFornecedor))
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Entrada_Pecas(
idEntrada INT PRIMARY KEY AUTO_INCREMENT,
quantidade INT,
dataEntrada DATE,
idPeca INT,
FOREIGN KEY (idPeca) REFERENCES Pecas (idPeca))

CREATE TABLE IF NOT EXISTS Saida_Pecas(
idSaida INT PRIMARY KEY AUTO_INCREMENT,
quantidade INT,
dataSaida DATE,
idPeca INT,
FOREIGN KEY (idPeca) REFERENCES Pecas (idPeca))

CREATE TABLE IF NOT EXISTS Estoque(
idEstoque INT PRIMARY KEY AUTO_INCREMENT,
quantidade INT,
idPeca INT)

CREATE TABLE IF NOT EXISTS Servico(
ordemServico INT PRIMARY KEY AUTO_INCREMENT,
descricao VARCHAR(200) NOT NULL,
maoDeObra FLOAT NOT NULL,
total FLOAT NOT NULL,
nf VARCHAR(15),
dataServico DATE NOT NULL,
fkCliente INT NOT NULL,
fkPeca INT NOT NULL,
FOREIGN KEY (fkCliente) REFERENCES Cliente (idCliente),
FOREIGN KEY (fkPeca) REFERENCES Pecas (idPeca))
ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS Usuario(
idUsuario INT PRIMARY KEY,
login VARCHAR(20) NOT NULL UNIQUE,
senha VARCHAR(40) NOT NULL,
fkFuncionario INT NOT NULL UNIQUE,
FOREIGN KEY (fkFuncionario) REFERENCES Funcionario (matricula))
ENGINE = INNODB;


-- Procedure de atualização do estoque
DELIMITER //
  CREATE PROCEDURE `SP_AtualizaEstoque`( `idPc` int, qtde_comprada int)
BEGIN
    declare contador int(11);
 
    SELECT count(*) into contador FROM Estoque WHERE idPeca = idPc;
 
    IF contador > 0 THEN
        UPDATE estoque SET quantidade = quantidade + qtde_comprada WHERE idPeca = idPc;
    ELSE
        INSERT INTO estoque (quantidade, idPeca) values (qtde_comprada, idPc);
    END IF;
END //
DELIMITER ;

-- Trigger Entrada de peças Pós Insert
DELIMITER //
CREATE TRIGGER `TRG_EntradaPecas_AI` AFTER INSERT ON `Entrada_Pecas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.idPeca, new.quantidade);
END //
DELIMITER ;


-- Trigger Entrada de peças Pós Update
DELIMITER //
CREATE TRIGGER `TRG_EntradaPecas_AU` AFTER UPDATE ON `Entrada_Pecas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.idPeca, new.quantidade - old.quantidade);
END //
DELIMITER ;

-- Trigger Entrada de peças Pós Delete
DELIMITER //
CREATE TRIGGER `TRG_EntradaPecas_AD` AFTER DELETE ON `Entrada_Pecas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (old.idPeca, old.quantidade * -1);
END //
DELIMITER ;


-- Trigger Saida de peças Pós Insert
DELIMITER //
CREATE TRIGGER `TRG_SaidaPecas_AI` AFTER INSERT ON `Saida_Pecas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque ( new.idPeca, new.quantidade * -1);
END //
DELIMITER ;


-- Trigger Saida de peças Pós UPDATE
DELIMITER //
CREATE TRIGGER `TRG_SaidaPecas_AU` AFTER UPDATE ON `Saida_Pecas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.idPeca, old.quantidade - new.quantidade);
END //
DELIMITER ;


-- Trigger Saida de peças Pós Delete
DELIMITER //
CREATE TRIGGER `TRG_SaidaPecas_AD` AFTER DELETE ON `Saida_Pecas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (old.idPeca, old.quantidade);
END //
DELIMITER ;

INSERT INTO Pecas VALUES (NULL, 'Freio', 199.50, 1)
INSERT INTO Pecas VALUES (NULL, 'Motor', 245.99, 1)
INSERT INTO Pecas VALUES (NULL, 'Parachoque', 49.90, 1)
INSERT INTO Pecas VALUES (NULL, 'Radiador', 174.20, 1)
INSERT INTO Pecas VALUES (NULL, 'Embreagem', 300.00, 1)

INSERT INTO Entrada_Pecas VALUES (NULL, 10, '2019-11-06', 1)
INSERT INTO Entrada_Pecas VALUES (NULL, 7, '2019-11-06', 2)
INSERT INTO Entrada_Pecas VALUES (NULL, 10, '2019-11-15', 3)
INSERT INTO Entrada_Pecas VALUES (NULL, 5, '2019-05-06', 1)


INSERT INTO Saida_Pecas VALUES (NULL, 2, '2019-11-12', 1)
INSERT INTO Saida_Pecas VALUES (NULL, 5, '2019-11-15', 2)
INSERT INTO Saida_Pecas VALUES (NULL, 3, '2019-11-25', 3)
INSERT INTO Saida_Pecas VALUES (NULL, 5, '2019-11-27', 3)




INSERT INTO `fornecedor` (`idFornecedor`, `razaoSocial`, `nomeFantasia`, `cnpj`, `rua`, `bairro`, `cidade`, `estado`, `numero`, `email`, `telefone`) VALUES
(null, 'Ype', 'Ype', '11.561.565/6165-1', 'Rua', 'Bairro', 'Cidade', 'SP', 561, 'lol@gmail.com', '446165');


INSERT INTO `funcionario` (`matricula`, `nome`, `cpf`, `rg`, `celular`, `telefone`, `email`, `salario`, `rua`, `bairro`, `cidade`, `cargo`) VALUES
(null, 'empregado 1', '161.455.464-55', '545454555', '19 9 9988-55555', '19 3804-5563', 'empregado@gmail.com', 1300, 'Rua dos pikoes', 'Jardim Rola', 'Rolandia', 1),
(null, 'dono 1', '1223.455.464-55', '225454555', '19 9 9988-55554', '19 3804-5563', 'dono@gmail.com', 1300, 'Rua dos pikoes', 'Jardim Rola', 'Rolandia', 0),
(null, 'Rafinha', '321', '123', '321', '123', 'Basto@gmai.com', 5, 'Rola', 'Amparo', 'Rolandinha', 0);

INSERT INTO `usuario` (`idUsuario`, `login`, `senha`, `fkFuncionario`) VALUES
(1, 'empregado', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(2, 'dono', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2);
