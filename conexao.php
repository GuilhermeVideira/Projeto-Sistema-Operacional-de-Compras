<?php
include ('configuracao.php');

$PDO = new PDO('mysql:host='.$endereco.';port='.$porta.';dbname='.$banco, $usuario, $senha);
?>