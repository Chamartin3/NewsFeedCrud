<?php require 'conex.php';



function getstattag(){
global  $conecta;
	$qstats='SELECT 100-(count(distinct(id_tit))/(SELECT count(id) FROM sisop.titulares)*100) as r FROM tagsxtitular;';

	$statement = $conecta->prepare($qstats);
	$statement->execute();
	$res=$statement->fetchAll(PDO::FETCH_ASSOC);

foreach($res as $row){

	echo $row['r'];
	};	


}

function getlist($look){

global  $conecta;	
if ($look=="fecha"){
	$listf='SELECT distinct(fecha_noticia) as fecha FROM sisop.titulares';
		$statement = $conecta->prepare($listf);
		$statement->execute();
		$res=$statement->fetchAll(PDO::FETCH_ASSOC);

		foreach($res as $row){

			echo '<option value="'.$row["fecha"].'">'.$row["fecha"].'</option>';
		};
};


if ($look=="titular"){
	$listt='SELECT titular FROM sisop.titulares';
		$statement = $conecta->prepare($listt);
		$statement->execute();
		$res=$statement->fetchAll(PDO::FETCH_ASSOC);

		foreach($res as $row){

			echo '<option value="'.$row["titular"].'">'.$row["titular"].'</option>';
		};
};

if ($look=="medio"){
	$listm='SELECT id, nombre FROM sisop.medio';
		$statement = $conecta->prepare($listm);
		$statement->execute();
		$res=$statement->fetchAll(PDO::FETCH_ASSOC);

		foreach($res as $row){

			echo '<option value="'. $row['id'].'">'. $row['nombre'].'</option>';
			
		};
};



};







function getStatistiscs($val, $cat)
{


global  $conecta;
	$qstats='SELECT 
            	catag as cat,
            	COUNT(catag) as tags,
            	ROUND((COUNT(catag) / (SELECT COUNT(catag) FROM sisop.tags)) * 100) as peso,
            	ROUND((COUNT(catag) / (SELECT COUNT(catag) FROM sisop.tags where catag !=0)) * 100) as pesopost,
            	(select count(distinct(id_tit)) FROM tagsxtitular WHERE substring(tagsxtitular.id_tag,1,1)=catag) as titulares
        FROM
            sisop.tags
        WHERE 
			catag=:cat
		GROUP BY 
			catag;';

	$statement = $conecta->prepare($qstats);
	$statement->bindParam(":cat",$cat);
	$statement->execute();
	$res=$statement->fetchAll(PDO::FETCH_ASSOC);

foreach($res as $row){

	echo $row[$val];
	};
};

?>