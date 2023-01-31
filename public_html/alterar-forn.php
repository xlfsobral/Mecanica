<?php
    require 'header.php';
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
} 
else{
  header("Location: index.php");
}
			if(isset($_POST['idusu']) && !empty($_POST['idusu'])){

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
						$id = $_POST['idusu'];

			$sql2 = $pdo->prepare("UPDATE fornecedor SET razaoSocial = :razaoSocial, nomeFantasia = :nomeFantasia, cnpj = :cnpj,rua = :rua, bairro = :bairro, cidade = :cidade, estado = :estado, numero = :numero, email = :email, telefone = :telefone  WHERE idFornecedor = :id");
                   
                    	
						$sql2->bindValue(":razaoSocial",$razaoSocial,PDO::PARAM_STR);
						$sql2->bindValue(":nomeFantasia",$nomeFantasia,PDO::PARAM_STR);
						$sql2->bindValue(":cnpj",$cnpj,PDO::PARAM_STR);
						$sql2->bindValue(":rua",$rua,PDO::PARAM_STR);
						$sql2->bindValue(":bairro",$bairro,PDO::PARAM_STR);
						$sql2->bindValue(":cidade",$cidade,PDO::PARAM_STR);
						$sql2->bindValue(":estado",$estado,PDO::PARAM_STR);
						$sql2->bindValue(":numero",$numero,PDO::PARAM_STR);
						$sql2->bindValue(":email",$email,PDO::PARAM_STR);
						$sql2->bindValue(":telefone",$telefone,PDO::PARAM_STR);
						$sql2->bindValue(":id", $id, PDO::PARAM_STR);
						$sql2->execute();
						 header("Location: fornecedor.php");  

		 } 
		 else{
  header("Location: fornecedor.php");
}