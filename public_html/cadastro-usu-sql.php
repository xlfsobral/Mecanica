<?php

session_start();



if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

} 
else{
  header("Location: index.php");
}
require 'header.php';
	if(isset($_POST['idusu']) && !empty($_POST['idusu'])){
	$idusu = $_POST['idusu'];
    $login = $_POST['login'];
    $senha = sha1($_POST['senha']);
    $idfuncionario = $_POST['idusu'];
   

 $sql = $pdo->prepare("INSERT INTO usuario (idUsuario, login, senha, fkFuncionario) VALUES (:idusu,:login,:senha,:idfuncionario);");
    $sql->bindValue(":idusu",$idusu,PDO::PARAM_STR);
    $sql->bindValue(":login",$login,PDO::PARAM_STR);
    $sql->bindValue(":senha",$senha,PDO::PARAM_STR);
    $sql->bindValue(":idfuncionario",$idfuncionario,PDO::PARAM_STR);
    $sql->execute();  	

    header("Location: listar-usu.php");
}
else{
    header("Location: cadastro-usu.php");
}