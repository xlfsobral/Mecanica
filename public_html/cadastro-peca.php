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
  if(isset($_POST['desc']) && !empty($_POST['desc'])){
    $desc = $_POST['desc'];
    $preco = $_POST['prec'];
    $forn = $_POST['forn'];
    $sql = $pdo->prepare("INSERT INTO pecas ( idPeca, descricao, preco, fkFornecedor) VALUES (DEFAULT,:descricao,:preco,:fkFornecedor)");
    $sql->bindValue(":descricao",$desc,PDO::PARAM_STR);
    $sql->bindValue(":preco",$preco,PDO::PARAM_STR);
    $sql->bindValue(":fkFornecedor",$forn,PDO::PARAM_STR);
    $sql->execute();  
    header("Location: pecas.php");
  } 
  else{
    header("Location: pecas.php");
  }
?>

</body>
</html>