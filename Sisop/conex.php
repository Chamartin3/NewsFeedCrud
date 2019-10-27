<?php
   

$servidor='localhost';
$usuario='root';
$contras='';
$datab='sisop';

try {
	$conecta= new PDO("mysql:host=$servidor;dbname=$datab",$usuario,$contras, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='es_ES'"]);
	$conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} 
catch (PDOException $e) {
	echo "Fallo en conexión". $e->getMessage();
	}

$conecta->exec("SET CHARACTER SET utf8");

?>