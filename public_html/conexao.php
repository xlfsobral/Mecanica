
<?php
$dsn = "mysql:dbname=mecanica;host=localhost";
$dbuser = "root";
$dbpass = "";

try{
$pdo = new PDO($dsn, $dbuser, $dbpass,array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,));

}
catch(PDOExcpetion $e){
	echo "Falhou: ".$e->getMessage();

}

