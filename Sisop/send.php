<?php
require 'conex.php';



if (isset($_POST['cat'])) {
$cat=       intval($_POST['cat']);
$subcat=	$_POST['sub_cat'];


$codhijo='SELECT max(cod_hijo) AS ch from sub_categorias WHERE cod_parent=:cat';
$stm_codhijo=$conecta->prepare($codhijo);
$stm_codhijo->bindParam(":cat",$cat);
$stm_codhijo->execute();

 while ($r = $stm_codhijo->fetch(PDO::FETCH_ASSOC)) {
	$string_codhijo=($r["ch"]); 
};

$int_codhijo=intval($string_codhijo)+1;





$insert='INSERT INTO sub_categorias (cod_parent, cod_hijo, subcat)
                             VALUES (:cat,:codhijo,:subcat);';

$cat=intval($cat);
$stm=$conecta->prepare($insert);

$stm->bindParam(":cat",$cat);
$stm->bindParam(":subcat",$subcat);
$stm->bindParam(":codhijo",$int_codhijo);

/*
		        (select id from categorias where cat=":cat"),
*/
$stm->execute();

};



if (isset($_POST['f2_cat']) && isset($_POST['f2_scatsel']) && isset($_POST['f2_tags'])){


$scat=$_POST['f2_scatsel'];
$tag=$_POST['f2_tags'];

$dependiente='SELECT max(dep) AS ch from tags WHERE cod_scat=:scat';
$stm_dep=$conecta->prepare($dependiente);
$stm_dep->bindParam(":scat",$scat);
$stm_dep->execute();

 while ($r = $stm_dep->fetch(PDO::FETCH_ASSOC)) {
	$string_codhijo=($r["ch"]); 
};

$int_codep=intval($string_codhijo)+1;




$insert='INSERT INTO tags (datetime,cod_scat, tag,dep)
                             VALUES (NOW(),:subcat, :tag, :dep);';

$stm=$conecta->prepare($insert);

$stm->bindParam(":tag",$tag);
$stm->bindParam(":subcat",$scat);
$stm->bindParam(":dep",$int_codep);

$stm->execute();



};

?>


