<?php
require 'conexao.php';

$id = 0;

if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];
}

if(!empty($_POST))
{
    $id = $_POST['id'];

    //Delete do banco:
    //$pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM pecas where idPeca = '$id'";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    //Banco::desconectar();
    header("Location: pecas.php");
}
?>

