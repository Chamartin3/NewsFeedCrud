<?php
 require 'conex.php';

	$date='SELECT distinct(DATE_FORMAT(fecha_noticia,"%Y, %m, %d"))
 			as fecha FROM sisop.titulares';
		$statement = $conecta->prepare($date);
		$statement->execute();
		$res=$statement->fetchAll(PDO::FETCH_ASSOC);

	foreach($res as $row){
			echo $row["fecha"].'/';
		};


?>