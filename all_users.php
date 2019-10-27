<?php
require 'Sisop/conex.php';


$consult = $_POST['consult'];

$query   = 'SELECT * FROM users;';

if ($consult=="all") {
   $stm=$conecta->prepare($query);
   $stm->execute();
   while ($res=$stm->fetch(PDO::FETCH_ASSOC) ) {

    echo '		
        <tr id="row'.$res["id"].'"">         
        <td><a class="btn-floating btn-large grey lighten-5"> <i class="large material-icons"><img src="Sisop/'.$res["foto"].'" id="profile" class="circle"></i></a></td>
		<td>'.$res["username"].'</td>
		<td>';
        switch ($res["nivel"]) {
           case "1": echo"Cliente";
            break;
            case "2":echo"Registrador";
            break;
            case "3":echo"Supervisor";
            break;
            case "4":echo"Administrador";
            break;
        };
        echo '</td>
		<td><a id="'.$res["id"].'" class="btn-floating red delbut"><i  class="material-icons">delete</i></a> </td>
		<td><a id="'.$res["id"].'" class="btn-floating yellow darken-1 editbut"><i class="material-icons">mode_edit</i></a></td>
		</tr>
	 ';
	 };	
};


if ($consult=="delete") {
	$idfoto =$_POST['id'];
    $id =$_POST['id'];
    $foto= 'SELECT foto FROM users WHERE id = :id';
    $stm=$conecta->prepare($foto);
    $stm->bindParam(":id",$idfoto);
    $stm->execute();
    while ($res=$stm->fetch(PDO::FETCH_ASSOC) ) {
    echo $res["foto"];
    };

	$delete= 'DELETE FROM users WHERE id= :id;';
	$stm=$conecta->prepare($delete);
    $stm->bindParam(":id",$id);
    $stm->execute();
};

if ($consult=="unique") {
	$id =$_POST['id'];
    $update= 'SELECT * FROM users WHERE id = :id';
    $output= array();
    $stm=$conecta->prepare($update);
    $stm->bindParam(":id",$id);
    $stm->execute();
    $result=$stm->fetchAll();
    foreach ($result as $row) {
    	$output['username']= $row['username'];
     	$output['contra']= $row['contra'];
    	$output['nivel']= $row['nivel'];  	
    	$output['foto']= $row['foto'];
    	$output['email']= $row['email'];
    }
    echo json_encode($output);
	};






?>

