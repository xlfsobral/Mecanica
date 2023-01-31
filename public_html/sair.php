<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['idcargo']);


header("Location: index.php");
exit;