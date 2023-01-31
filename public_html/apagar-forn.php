<?php
    require 'header.php';
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
} 
else{
  header("Location: index.php");
}

			if(isset($_POST['idusu']) && !empty($_POST['idusu'])){
						$id = $_POST['idusu'];
			$sql2 = $pdo->prepare("DELETE FROM fornecedor WHERE idFornecedor = :id");           	
			$sql2->bindValue(":id",$id,PDO::PARAM_STR);
			$sql2->execute();
  			header("Location: fornecedor.php");
		 } 
		 else{
  header("Location: fornecedor.php");
}