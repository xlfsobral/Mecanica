<!DOCTYPE html>
<html>
<head>
  <?php

    require 'header.php';
session_start();

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

} 
else{
  header("Location: index.php");
}
?>
</head>
<body>
<?php
	if(isset($_POST['idusu']) && !empty($_POST['idusu'])){
		
		 $idusu = $_POST['idusu'];
		 $sql = $pdo->prepare("DELETE FROM usuario WHERE fkFuncionario =  :idusu");
		 $sql->bindValue(":idusu",$idusu,PDO::PARAM_INT);
		 $sql->execute();
	header("Location: listar-usu.php");
	}
	else{
		header("Location: listar-usu.php");
	}
?>

</body>
</html>