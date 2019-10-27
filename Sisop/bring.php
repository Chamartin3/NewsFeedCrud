<?php
require 'conex.php';


if (isset($_POST['id_cat'])) {

$cat=$_POST['id_cat'];

$scatstatement=$conecta->prepare('SELECT * FROM sub_categorias WHERE cod_parent=:cat');
$scatstatement->bindParam(":cat",$cat);
$scatstatement->execute();

$res=$scatstatement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($res);	
}


if (isset($_POST['scat'])){

bringtags($_POST['scat']);
}




function bringtags($idscat)
{

global $conecta;


$conecta->exec("SET CHARACTER SET utf8");
$catstatement=$conecta->prepare('SELECT * FROM tags WHERE cod_scat=:idscat');
$catstatement->bindParam(":idscat",$idscat);
$catstatement->execute();

$resp=$catstatement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resp);

}

function bringcats()
{

global $conecta;

$conecta->exec("SET CHARACTER SET utf8");
$catstatement=$conecta->prepare('SELECT * FROM categorias WHERE id>0');

$catstatement->execute();

$resp=$catstatement->fetchAll(PDO::FETCH_ASSOC);

return $resp;

}



function bringmedios()
{
	global $conecta;
	$conecta->exec("SET CHARACTER SET utf8");
	$catstatement=$conecta->prepare('SELECT id, nombre FROM medio');

	$catstatement->execute();

	$resp=$catstatement->fetchAll(PDO::FETCH_ASSOC);

	return $resp;

}







?>