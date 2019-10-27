<?php

require 'conex.php';

if (isset($_GET['query'])) {
	$busq=$_GET['query'];
	$catstatement=$conecta->prepare('SELECT cod_tag, tag, catag FROM tags WHERE tag LIKE :busq ORDER BY tag');
	$catstatement->bindValue(':busq', '%' . $busq . '%' );

	$catstatement->execute();

	$resp=$catstatement->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($resp);	

}else{

	$catstatement=$conecta->prepare('SELECT id, tag, catag FROM tags');

	$catstatement->execute();

	$resp=$catstatement->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($resp);	


}


?>