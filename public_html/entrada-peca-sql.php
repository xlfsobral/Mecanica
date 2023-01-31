<?php

session_start();



if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

} 
else{
  header("Location: index.php");
}
require 'header.php';
 date_default_timezone_set('America/Sao_Paulo');
  echo $data = date('Y-m-d');
	if(isset($_POST['idusu']) && !empty($_POST['idusu'])){
	$idusu = $_POST['idusu'];
    $quantidade = $_POST['quantidade'];   

 $sql = $pdo->prepare("INSERT INTO entrada_pecas (idEntrada, quantidade, dataEntrada, idPeca) VALUES (DEFAULT,:quantidade,:data,:idusu);");
    $sql->bindValue(":quantidade",$quantidade,PDO::PARAM_STR);
    $sql->bindValue(":data",$data,PDO::PARAM_STR);
    $sql->bindValue(":idusu",$idusu,PDO::PARAM_STR);   
    $sql->execute();  	

    header("Location: entrada-peca.php");
}
else{
    header("Location: entrada-peca.php");
}