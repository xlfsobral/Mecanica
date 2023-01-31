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
  if(isset($_POST['nome']) && !empty($_POST['nome'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['tel'];
    $celular = $_POST['cel'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cargo = $_POST['cargo'];
    $salario = $_POST['salario'];
    $sql = $pdo->prepare("INSERT INTO funcionario ( matricula, nome, cpf, rg, celular, telefone, email, salario, rua, bairro, cidade, cargo) VALUES (DEFAULT,:nome,:cpf,:rg,:celular,:telefone,:email,:salario,:rua,:bairro,:cidade,:cargo)");
    $sql->bindValue(":nome",$nome,PDO::PARAM_STR);
    $sql->bindValue(":cpf",$cpf,PDO::PARAM_STR);
    $sql->bindValue(":rg",$rg,PDO::PARAM_STR);
    $sql->bindValue(":celular",$celular,PDO::PARAM_STR);
    $sql->bindValue(":telefone",$telefone,PDO::PARAM_STR);
    $sql->bindValue(":email",$email,PDO::PARAM_STR);
    $sql->bindValue(":salario",$salario,PDO::PARAM_STR);
    $sql->bindValue(":rua",$rua,PDO::PARAM_STR);
    $sql->bindValue(":bairro",$bairro,PDO::PARAM_STR);
    $sql->bindValue(":cidade",$cidade,PDO::PARAM_STR);
    $sql->bindValue(":cargo",$cargo,PDO::PARAM_STR);
    $sql->execute();  
    header("Location: funcionarios.php");
  } 
  else{
    header("Location: funcionarios.php");
  }
?>

</body>
</html>