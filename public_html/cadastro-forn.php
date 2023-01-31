<?php
    require 'header.php';
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
} 
else{
  header("Location: index.php");
}

if(isset($_POST['cnpj']) && !empty($_POST['cnpj'])){				
						$razaoSocial = $_POST['razaosocial'];
						$nomeFantasia = $_POST['nomefantasia'];
						$cnpj = $_POST['cnpj'];
						$rua = $_POST['rua'];
						$bairro = $_POST['bairro'];
						$cidade = $_POST['cidade'];
						$estado = $_POST['estado'];
						$numero = $_POST['numero'];
						$email = $_POST['email'];
						$telefone = $_POST['telefone'];	

						$sql = $pdo->prepare("INSERT INTO Fornecedor (idFornecedor, razaoSocial, nomeFantasia, cnpj, rua, bairro, cidade, estado, numero, email, telefone) VALUES(DEFAULT, :razaoSocial, :nomeFantasia, :cnpj, :rua, :bairro, :cidade, :estado, :numero, :email, :telefone)");
						$sql->bindValue(":razaoSocial",$razaoSocial,PDO::PARAM_STR);
						$sql->bindValue(":nomeFantasia",$nomeFantasia,PDO::PARAM_STR);
						$sql->bindValue(":cnpj",$cnpj,PDO::PARAM_STR);
						$sql->bindValue(":rua",$rua,PDO::PARAM_STR);
						$sql->bindValue(":bairro",$bairro,PDO::PARAM_STR);
						$sql->bindValue(":cidade",$cidade,PDO::PARAM_STR);
						$sql->bindValue(":estado",$estado,PDO::PARAM_STR);
						$sql->bindValue(":numero",$numero,PDO::PARAM_STR);
						$sql->bindValue(":email",$email,PDO::PARAM_STR);
						$sql->bindValue(":telefone",$telefone,PDO::PARAM_STR);
						$sql->execute();
						 header("Location: fornecedor.php");  
	}
else{
  header("Location: fornecedor.php");

}
?>