<?php
 require 'conex.php';

if(isset($_POST["draw"])){
    $draw=$_POST["draw"];
}else{
     $draw=1;
};


function get_total_all_records()
{
 global   $conecta;
 $statement = $conecta->prepare("SELECT * FROM tags");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
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

$conecta->exec("SET CHARACTER SET utf8");

$alltags='SELECT id, 
                tags.tag AS etiqueta,
                (SELECT COUNT(tagsxtitular.id_tag) FROM tagsxtitular WHERE cod_tag=id_tag) AS Titulares,
                sub_categorias.subcat as Subcategoria,
                catag,
                cod_tag
            FROM tags
            LEFT JOIN sub_categorias
            ON tags.cod_scat=sub_categorias.cod_subcat';

$contador=0; 



if(isset($_POST["busq"])){
    if ($contador>0) {  $alltags .=' AND ';}else{$alltags .=' WHERE ';}
 $alltags .= ' catag  ='.$_POST["busq"];
 $contador++;
}



if(!empty($_POST["search"]["value"]))
    {     if ($contador>0) {  $alltags .=' AND ('; $close=") "; }else{$alltags .=' WHERE ';$close=" ";}
     $alltags .= '  tags.tag LIKE "%'.$_POST["search"]["value"].'%" ';
     $alltags .= ' OR sub_categorias.subcat  LIKE "%'.$_POST["search"]["value"].'%"'.$close;
     $contador++; }


 $alltags .= ' GROUP BY tags.cod_tag ';

if(isset($_POST["order"]))
    {

            switch ($_POST['order']['0']['column']) {
               case '0'  : $col='catag';
                break;
               case '1'  : $col='catag';
                break;
               case '2'  : $col= 'Subcategoria';
                break;                
               case '3'  : $col='etiqueta';
                break;
               case '4'  : $col='Titulares';
                break;
               default   : $col='id';
                break;
                                                                };

     $alltags .= ' ORDER BY '. $col .' '.$_POST['order']['0']['dir'].' ';
    }else{
    $alltags .= 'ORDER BY Titulares desc ';
    }

if($_POST["length"] != -1)
    {
     $alltags .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    };

//  var_dump($alltags);
$tagsstatement=$conecta->prepare($alltags);

$tagsstatement->execute();

$res=$tagsstatement->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$filtered_rows = $tagsstatement->rowCount();
foreach($res as $row)
{
 $sub_array = array();
 $sub_array[]   = $row["catag"];
 $sub_array[]   = catname($row["catag"]);
 $sub_array[]   = $row["Subcategoria"]; 
 $sub_array[]   = '<div class="chip '.colorcat($row["catag"]).'">'.$row["etiqueta"].'</div>';
 $sub_array[]   = $row["Titulares"];
 $sub_array[]   = '<a id="'.$row["id"].'" name="'.$row["cod_tag"].'"  class="btn-floating yellow darken-1 editbut"><i class="material-icons">mode_edit</i></a>';
 $sub_array[]   = '<a id="'.$row["id"].'" name="'.$row["cod_tag"].'"  class="btn-floating orange darken-1 fuzebut" ><i class="material-icons">cached</i></a>';
 $sub_array[]   = '<a id="'.$row["id"].'" name="'.$row["cod_tag"].'" class="btn-floating red delbut"><i  class="material-icons">delete</i></a>';
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($draw),
 "recordsTotal"  => $filtered_rows,
 "recordsFiltered" => get_total_all_records() ,
 "data"    => $data
);
echo json_encode($output);






?>