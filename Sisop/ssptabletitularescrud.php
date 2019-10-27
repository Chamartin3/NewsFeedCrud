<?php  

require 'conex.php';


$consult = $_POST['consult'];


if ($consult=="tagdelete") {
    $id =$_POST['id'];
    $cod =$_POST['cod'];

    $delete= 'DELETE FROM tags WHERE id= :id;';
    $stm=$conecta->prepare($delete);
    $stm->bindParam(":id",$id);
    $stm->execute();

    $deltags= 'DELETE FROM tagsxtitular WHERE id_tag= :cod;';
    $stm2=$conecta->prepare($deltags);
    $stm2->bindParam(":cod",$cod);
    $stm2->execute();
    echo "Datos Borrados Correctamente";
};


if ($consult=="delete") {
    $id =$_POST['id'];
	$delete= 'DELETE FROM titulares WHERE id= :id;';
	$stm=$conecta->prepare($delete);
    $stm->bindParam(":id",$id);
    $stm->execute();

    $deltags= 'DELETE FROM tagsxtitular WHERE id_tit= :id;';
    $stm2=$conecta->prepare($deltags);
    $stm2->bindParam(":id",$id);
    $stm2->execute();
    echo "Datos Borrados Correctamente";
};



if ($consult=="unique") {
    if (empty($_POST['id'])) {
        echo "error en el id";
      
    }else{
    $id =$_POST['id'];
    $update= 'SELECT fecha_noticia,
                     titular, 
                     medio as id_medio,
                     (select nombre From medio where id=titulares.medio) as medio FROM titulares WHERE id = :id';
    $output= array();
    $stm=$conecta->prepare($update);
    $stm->bindParam(":id",$id);
    $stm->execute();
    $result=$stm->fetchAll();

    $updatetags= 'SELECT DISTINCT(id_tag),
                (SELECT tag FROM tags WHERE tags.cod_tag = tagsxtitular.id_tag) as nametag
                FROM
                sisop.tagsxtitular
                WHERE id_tit = :id;';
    $stmtags=$conecta->prepare($updatetags);

    foreach ($result as $row) {
        $output['fecha_noticia']= $row['fecha_noticia'];
        $output['titular']= $row['titular'];
        $output['medio']= $row['medio'];
        $output['id_medio']= $row['id_medio'];
        $stmtags->bindParam(":id",$id);
        $stmtags->execute();
        $res=$stmtags->fetchAll();
        $suboutput="";
        foreach ($res as $nt) {
            $idtag=$nt['id_tag'];
            $tag=$nt['nametag'];
            $catag=substr($nt['id_tag'], 0,1);
            $suboutput.= '{"tag":"'.$tag.'",
                           "catag":"'.$catag.'",
                           "cod_tag":"'.$idtag.'"}/';          
        }
        $output['tags']=$suboutput;
    }
   //var_dump($output);

    echo json_encode($output);
    };
        
    };



if ($consult=="uniquetags") {
    if (empty($_POST['id'])) {
        echo "error en el id";
      
    }else{
    $id =$_POST['id'];
    $updatet= 'SELECT tag as nombre,
    catag,(select cat from categorias where categorias.id=tags.catag) as categoria,
    cod_scat,(select subcat from sub_categorias where sub_categorias.cod_subcat=tags.cod_scat) as sub_categoria,
    cod_tag
            FROM sisop.tags wHERE id=:id;';
    $output= array();
    $stm=$conecta->prepare($updatet);
    $stm->bindParam(":id",$id);
    $stm->execute();
    $result=$stm->fetchAll();
    foreach ($result as $row) {
        $output['nombre']= $row['nombre'];
        $output['catag']= $row['catag'];
        $output['categoria']= $row['categoria'];
        $output['cod_scat']= $row['cod_scat'];
        $output['subcat']= $row['sub_categoria'];+
        $output['codigo']= $row['cod_tag'];          
    }
   //var_dump($output);

    echo json_encode($output);
    };
        
    };



if ($consult=="newtag") {
        if (empty($_POST['name'])) {
            echo "sin nombre";
      
        }else{
    $name   =   $_POST['name'];
    $sub    =   $_POST['scat'];


$dependiente='SELECT max(dep) AS dep from tags WHERE cod_scat=:scat';
    $stm_dep=$conecta->prepare($dependiente);
    $stm_dep->bindParam(":scat",$sub);
    $stm_dep->execute();
        while ($r = $stm_dep->fetch(PDO::FETCH_ASSOC)) {

            $string_coddep=($r["dep"]);
        };

        $int_codep=intval($string_coddep)+1; 

    $qtag='INSERT INTO tags (datetime,cod_scat, tag,dep)
                     VALUES (NOW(),:sub,:tag,:dep);';
    $stm=$conecta->prepare($qtag);


            $stm->bindParam(":tag",$name);
            $stm->bindParam(":sub",$sub);
            $stm->bindParam(":dep",$int_codep);
            $stm->execute();
            echo '{"tag":"'.$name.'","cod_tag":"'.$sub."-".$int_codep.'"}/';

}}




if ($consult=="updatetag") {
        if (empty($_POST['name'])) {
            echo "sin nombre";
        }else{
    $name   =   $_POST['name'];
    $sub    =   $_POST['scat'];
    $id     =   $_POST['id'];


$qscat='SELECT cod_scat  from tags WHERE id=:id';
    $ssc=$conecta->prepare($qscat);
    $ssc->bindParam(":id",$id);
    $ssc->execute();

        while ($r = $ssc->fetch(PDO::FETCH_ASSOC)) {
            $prev_codscat=($r["cod_scat"]);
        };

if ($prev_codscat==$sub) {
         $qtag='UPDATE tags SET
          `datetime` = NOW(),
          `tag` = :name
          WHERE `id` = :id;';

            $stm=$conecta->prepare($qtag);
            $stm->bindParam(":name",$name);
            $stm->bindParam(":id",$id);
            $stm->execute();
            echo 'Actualizaciónm ejecutada';

}else{



       $dependiente='SELECT max(dep) AS dep from tags WHERE cod_scat=:scat';
       $stm_dep=$conecta->prepare($dependiente);
       $stm_dep->bindParam(":scat",$sub);
       $stm_dep->execute();
        while ($r = $stm_dep->fetch(PDO::FETCH_ASSOC)) {
            $string_coddep=($r["dep"]); };

        $int_codep=intval($string_coddep)+1; 
         $qtag='UPDATE tags SET
          `datetime` = NOW(),
          `tag` = :name,
          `dep` = :dep,
          `cod_scat` = :sub
          WHERE `id` = :id;';

            $stm=$conecta->prepare($qtag);
            $stm->bindParam(":name",$name);
            $stm->bindParam(":id",$id);
            $stm->bindParam(":sub",$sub);
            $stm->bindParam(":dep",$int_codep);
            $stm->execute();
            echo ('Actualización ejecutada cod'.$sub.$int_codep);
 }
}};


if ($consult=="newsubcat") {

    if (!empty($_POST['cat']) && !empty($_POST['scat'])) {
        $cat=       intval($_POST['cat']);
        $subcat=    $_POST['scat'];

        $codhijo='SELECT max(cod_hijo) AS ch from sub_categorias WHERE cod_parent=:cat';
        $stm_codhijo=$conecta->prepare($codhijo);
        $stm_codhijo->bindParam(":cat",$cat);
        $stm_codhijo->execute();
        while ($r = $stm_codhijo->fetch(PDO::FETCH_ASSOC)) {
            $string_codhijo=($r["ch"]); 
            };

         $int_codhijo=intval($string_codhijo)+1;

        $insert='INSERT INTO sub_categorias (cod_parent, cod_hijo, subcat) VALUES (:cat,:codhijo,:subcat);';

        $cat=intval($cat);
        $stm=$conecta->prepare($insert);
        $stm->bindParam(":cat",$cat);
        $stm->bindParam(":subcat",$subcat);
        $stm->bindParam(":codhijo",$int_codhijo);
        $stm->execute();

        echo $cat."-".$int_codhijo;
}else{
    echo "Variables vacias";
};
}



if ($consult=="fusion") {
    if (!empty($_POST['old']) && !empty($_POST['new'])) {
        $old=$_POST['old'];
        $new=$_POST['new'];

        $query= 'UPDATE tagsxtitular SET
        id_tag = :new
        WHERE id_tag = :old;';
        $stm=$conecta->prepare($query);
        $stm->bindParam(":new",$new);
        $stm->bindParam(":old",$old);
        $stm->execute();

        $q2= 'DELETE FROM tags
        WHERE cod_tag = :old;';
        $stm=$conecta->prepare($q2);
        $stm->bindParam(":old",$old);
        $stm->execute();

        echo("datos reemplazados");


    }else{

        echo ("variables vacias");
    }


};


if ($consult=="updatetit") {

$id      =   $_POST['id'];
$titular =   $_POST['titular'];
$fecha   =   $_POST['fecha'];
$medio   =   $_POST['medio'];
$tags    =   $_POST['etiqs'];

$qutit='UPDATE titulares SET
`fecha_de_registro` = NOW(),
`fecha_noticia` = :fecha,
`medio` = :medio,
`titular` = :tit
WHERE `id` = :id;';

$stm=$conecta->prepare($qutit);
$stm->bindParam(":fecha",$fecha);
$stm->bindParam(":medio",$medio);
$stm->bindParam(":tit",$titular);
$stm->bindParam(":id",$id);
$stm->execute();
echo "Actualización realizada con exito";

$oldtags = array();

$qarray='SELECT id_tag FROM tagsxtitular WHERE id_tit=:id';
$stm2=$conecta->prepare($qarray);
$stm2->bindParam(":id",$id);
$stm2->execute();

$newtags=explode(",", $tags);

 while ($r = $stm2->fetch(PDO::FETCH_ASSOC)) {
            $oldtags[]=$r["id_tag"]; 
            };

$intid=intval($id);
foreach ($oldtags as $old) {
    $steli=$conecta->prepare('DELETE FROM  tagsxtitular WHERE id_tit=:id AND id_tag=:old');
    $steli->bindParam(":id",$intid);

    if(in_array($old, $newtags)){
    }else{
    $steli->bindParam(":old",$old);
    $steli->execute();
    }
};

foreach ($newtags as $new) {
    $stagre=$conecta->prepare('INSERT INTO tagsxtitular (id_tit, id_tag) VALUES (:id,:new)');
    $stagre->bindParam(":id",$intid);

    if(in_array($new, $oldtags)){
    }else{
        $stagre->bindParam(":new",$new);
        $stagre->execute();
    }
};

}





/*
if ($consult=="uniquetags") {
    $id =$_POST['id'];
    $updatetags= 'SELECT DISTINCT(id_tag),
                (SELECT tag FROM tags WHERE tags.cod_tag = tagsxtitular.id_tag) as nametag
                FROM
                sisop.tagsxtitular;';
    $stmtags=$conecta->prepare($updatetags);
    $stmtags->bindParam(":id",$id);
    $stmtags->execute();
    $result=$stm->fetchAll();
        foreach ($result as $nt) {
            $idtag=$nt['id_tag'];
            $tag=$nt['nametag'];
            $catag=substr($nt['id_tag'], 0,1);
            echo '{"tag":"'.$idtag.'", "catag":'.$catag.',"cod_tag":'.$idtag.'"}/';          
        }
    };   
*/
?>