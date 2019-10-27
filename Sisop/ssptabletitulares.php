<?php
 require 'conex.php';

if(isset($_POST["draw"]))
    {
        $draw=$_POST["draw"];

    }else{

         $draw=1;
    
    };


function catname($catnum){

switch ($catnum) {
        case '0'  : return 'Sin Clasificar';
        case '1'  : return 'Tema';
        case '2'  : return 'Actor';
        case '3'  : return 'Evento';
        case '4'  : return 'Hecho';
    }
};

function colorcat($catnum){

switch ($catnum) {
        case '0'  : return 'chip gray accent-2';
        case '1'  : return 'chip light-green accent-3';
        case '2'  : return 'chip red accent-2';
        case '3'  : return 'chip blue accent-1';
        case '4'  : return 'chip yellow accent-4';
        default   : return 'chip gray darken-4';
    }
};


function get_total_all_records()
{
 global   $conecta;
 $statement = $conecta->prepare("SELECT * FROM titulares");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
};

//SET lc_time_names = "es_ES"; 
$conecta->exec("SET CHARACTER SET utf8");

$alltitulars='SELECT  id,       DATE_FORMAT(fecha_noticia,  "%d de %M, %Y") as fecha_noticia, 
                                titular,
                                (SELECT  medio.nombre FROM sisop.medio WHERE medio.id = titulares.medio) as Medio,
                                (select count(id_tit) FROM tagsxtitular WHERE id_tit= titulares.id) as Tags
              FROM sisop.titulares';


$searchcount=0;
if(!empty($_POST["search"]["value"]))
    {
     $alltitulars .= ' WHERE titular LIKE "%'.$_POST["search"]["value"].'%" ';
     $searchcount++;
    };



     if (!empty($_POST['is_fecha']) && isset($_POST['is_fecha'])) {
        if ($searchcount>0){ $alltitulars .=' AND ';}else{$alltitulars .=' WHERE ';};  
            $alltitulars .= ' fecha_noticia ="'.$_POST['is_fecha'].'"';
            $searchcount++;
        };


     
     if (isset($_POST['is_titular']) && !empty($_POST['is_titular'])) {
        if ($searchcount>0) { $alltitulars .=' AND ';}else{$alltitulars .=' WHERE ';};
            $alltitulars .= ' titular ="'.$_POST['is_titular'].'"';
            $searchcount++;
        };
    
    
    if (isset($_POST['is_medio']) && !empty($_POST['is_medio'])) {
        if ($searchcount>0) { $alltitulars .=' AND ';}else{$alltitulars .=' WHERE ';};   
            $alltitulars .= ' Medio ='.$_POST['is_medio'];
            $searchcount++;
        };

    if (isset($_POST['is_tags']) && !empty($_POST['is_tags'])) {
       // if ($searchcount>0) { $alltitulars .=' AND ';}else{$alltitulars .=' WHERE ';};
        if ($_POST['is_tags']=="false") {$ta="<1";}else{$ta=">=1";}
            $alltitulars ='SELECT * FROM ('.$alltitulars.') as sub_table WHERE Tags '.$ta;
            $searchcount++;
        };



if(isset($_POST["order"]))
    {


            switch ($_POST['order']['0']['column']) {
               case '0'  : $col='id';
                break;
               case '1'  : $col='fecha_noticia';
                break;
               case '3'  : $col='titular';
                break;
               case '2'  : $col='Medio';
                break;
               case '4'  : $col='Tags';
                break;
               default   : $col='id';
                break;
                                                                };

     $alltitulars .= ' ORDER BY '. $col .' '.$_POST['order']['0']['dir'].' ';
    }else{
    $alltitulars .= ' ORDER BY tags desc ';
    };



if($_POST["length"] != -1)
    {
     $alltitulars .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    };
/*
var_dump($alltitulars);
var_dump($_POST);
*/

$tagsstatement=$conecta->prepare($alltitulars);

$tagsstatement->execute();

$res=$tagsstatement->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$filtered_rows = $tagsstatement->rowCount();

$tagsxtit='SELECT
        (select catag from tags where cod_tag=id_tag) as cat,
        (select tag from   tags  where cod_tag=id_tag) as etique
        FROM tagsxtitular 
        WHERE id_tit=:idtit;';

$txtstmt=$conecta->prepare($tagsxtit);

    foreach($res as $row)
    {
    
    $txtstmt->bindParam(":idtit",$row["id"]); 
    $txtstmt->execute();
    $tagsxt=$txtstmt->fetchAll(PDO::FETCH_ASSOC);
        $t="";
        foreach($tagsxt as $tag){
            //$t=array();
            $t.=  '<div class="chip '.colorcat($tag["cat"]).'">'.$tag['etique'].'</div>';
        };


        $sub_array = array();
        $sub_array[]   = $row["id"];       
        $sub_array[]   = $row["fecha_noticia"];
        $sub_array[]   = $row["Medio"];
        $sub_array[]   = $row["titular"];
        $sub_array[]   = $t;
        $sub_array[]   = '<a id="'.$row["id"].'" class="btn-floating yellow darken-1 editbut"><i class="material-icons">mode_edit</i></a>';
        $sub_array[]   = '<a id="'.$row["id"].'" class="btn-floating red delbut"><i  class="material-icons">delete</i></a>';
        $data[] = $sub_array;
    };


$output = array(
 "draw"    => intval($draw),
 "recordsTotal"  =>  get_total_all_records(),
 "recordsFiltered" => $filtered_rows,
 "data"    => $data
);
echo json_encode($output);






?>