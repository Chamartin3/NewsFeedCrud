
<?php
session_start();
    $i= $_SESSION['user']['id'];


session_destroy();
session_start();

if (isset($_POST['name'])) {
	$_SESSION['user']['name']	= $_POST['name'];
	$_SESSION['user']['lvl']	= $_POST['lvl'];
    $_SESSION['user']['img']	= $_POST['img'];
    $_SESSION['user']['id']	    = $i;


}



?>