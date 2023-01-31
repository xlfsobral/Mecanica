<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
<link href="assets/DataTables-1.10.20/css/buttons.dataTables.min.css" rel="stylesheet" />
<link href="assets/DataTables-1.10.20/css/select.dataTables.min.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="assets/js/mask.js"></script>
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/DataTables-1.10.20/js/dataTables.buttons.min.js"></script>
<script src="assets/DataTables-1.10.20/js/dataTables.select.min.js"></script>
<script src="assets/DataTables-1.10.20/js/currenty.js"></script>

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