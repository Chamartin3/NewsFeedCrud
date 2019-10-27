<?php
session_start();

require 'Sisop/conex.php';

$user=htmlentities(addslashes($_POST['username']));
$pass=htmlentities(addslashes($_POST['password']));



$query= 'SELECT id, username, contra, nivel, foto FROM users WHERE username=:login;';

	$stm=$conecta->prepare($query);
		$stm->bindParam(":login",$user);
		$stm->execute();


$hash="";

while ($res=$stm->fetch(PDO::FETCH_ASSOC) ) {
	$hash= $res['contra'];

	$u=$res['username'];
	$n=$res['nivel'];
	$f=$res['foto'];
	$i=$res['id'];
	};

if (password_verify($pass,$hash)) {

    $_SESSION['user']['id']		= $i;
	$_SESSION['user']['name']	= $u;
	$_SESSION['user']['lvl']	= $n;
    $_SESSION['user']['img']	= $f;
    $_SESSION['user']['init']	= time();   
	echo 'exito';
}else{
	echo '<div  class="col s12 red lighten-4" style="padding:10px; text-align: center"> clave o usuario incorrecto</div>';
};

 
?>