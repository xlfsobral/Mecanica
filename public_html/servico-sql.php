<?php

session_start();



if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

} 
else{
  header("Location: index.php");
}
require 'header.php';
	if(isset($_POST['cliente']) && !empty($_POST['cliente'])){
	$descricao = $_POST['descricao'];
  $maodeobra = $_POST['maodeobra'];
  $total = $_POST['total'];
  $data = $_POST['date'];
  $cliente = $_POST['cliente'];
  $peca = $_POST['peca'];
  $quantidade = 1; 

  $sql = $pdo->prepare("INSERT INTO saida_pecas (idSaida, quantidade, dataSaida, idPeca) VALUES (DEFAULT,:quantidade,:data,:peca);");
    $sql->bindValue(":quantidade",$quantidade,PDO::PARAM_STR);
    $sql->bindValue(":data",$data,PDO::PARAM_STR);
    $sql->bindValue(":peca",$peca,PDO::PARAM_STR);   
    $sql->execute();


 $sql2 = $pdo->prepare("INSERT INTO servico (ordemServico, descricao, maoDeObra, total, dataServico, fkCliente, fkPeca) VALUES (DEFAULT,:descricao, :maodeobra, :total, :dataservico, :fkcliente, :fkpeca);");
    $sql2->bindValue(":descricao",$descricao,PDO::PARAM_STR);
    $sql2->bindValue(":maodeobra",$maodeobra,PDO::PARAM_STR);
    $sql2->bindValue(":total",$total,PDO::PARAM_STR);
    $sql2->bindValue(":dataservico",$data,PDO::PARAM_STR);
    $sql2->bindValue(":fkcliente",$cliente,PDO::PARAM_STR);
    $sql2->bindValue(":fkpeca",$peca,PDO::PARAM_STR);    
    $sql2->execute();  	

    header("Location: entrada-peca.php");
}
else{
    header("Location: entrada-peca.php");
}