<?php
session_start();
if (isset($_SESSION['user']['name'])) {
}else{
 header('Location:login.php');
};
?>

<!DOCTYPE html:5>
<html lang="es">

<?php
include 'modal_users.php';
include 'permits.php';
$lvl=$_SESSION['user']['lvl'];
$img=$_SESSION['user']['img'];
$nam=$_SESSION['user']['name'];
$idu=$_SESSION['user']['id'];
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

    
    <link rel="stylesheet" type="text/css" href="css/sisanimate.css">
    <link rel="stylesheet" href="Sisop/js/Croppie-master/croppie.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
     <link rel="stylesheet" href="css/jquery.lineProgressbar.min.css" />

      
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>



</head>



<body>
  <nav class="blue darken-5" >
    <div class="nav-wrapper blue darken-4">
    	<a href="home.php" class="brand-logo right"> <img src="Sisop/img/panop.png" id="sisop2" class="circle "></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="left  hide-on-med-and-down">
         <li class=<?php Level($lvl,1); ?> ><a href="registro.php">Registro</a></li>
         <li class=<?php Level($lvl,2); ?> ><a class="dropdown-button" href="#!" data-activates="ndropdowncorrect">Corrección <i class="material-icons left ">arrow_drop_down</i></a></li>
         <li class=<?php Level($lvl,3); ?> ><a href="">Supervisión </a></li>
         <li class=<?php Level($lvl,4); ?> ><a class="dropdown-button" href="#!" data-activates="ndropanalisis">Analisis de Datos <i class="material-icons left ">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>  

<ul id="ndropdowncorrect" class="dropdown-content">
  <li><a href="tagtable.php">Tags</a></li>
  <li><a href="tabletits.php"">Titulares</a></li>
</ul>   


<ul id="ndropanalisis" class="dropdown-content">
  <li><a href="#!">Actor</a></li>
  <li><a href="#!">Tema</a></li>
  <li><a href="#!">E/H</a></li>
</ul>

<ul id="dropdowncorrect" class="dropdown-content">
  <li><a href="tagtable.php">Tags</a></li>
  <li><a href="tabletits.php"">Titulares</a></li>
</ul>   


<ul id="dropanalisis" class="dropdown-content">
  <li><a href="#!">Actor</a></li>
  <li><a href="#!">Tema</a></li>
  <li><a href="#!">E/H</a></li>
</ul>


<ul class="side-nav" id="mobile-demo">
  <li class=<?php Level($lvl,1); ?> ><a href="registro.php">Registro</a></li>
  <li class=<?php Level($lvl,2); ?> ><a class="dropdown-button" href="#!" data-activates="dropdowncorrect">Corrección <i class="material-icons left ">arrow_drop_down</i></a></li>
  <li class=<?php Level($lvl,3); ?> ><a href="">Supervisión </a></li>
  <li class=<?php Level($lvl,4); ?> ><a class="dropdown-button" href="#!" data-activates="dropanalisis">Analisis de Datos <i class="material-icons left ">arrow_drop_down</i></a></li>
</ul>

<div class="fixed-action-btn" id="botonesdeusuario">
    <a class="btn-floating btn-large blue darken-4">
      <i class="large material-icons"><img src=<?php propic($img);?> id="profile" class="circle"></i>
    </a>
    <ul>
      <li class=<?php Level($lvl,1); ?> ><a href="out.php" class="btn-floating red"><i  class="material-icons">exit_to_app</i></a></li>
      <li class=<?php Level($lvl,1); ?> ><a id="userinfo" name=<?php ididentify()?> class="btn-floating yellow darken-1"><i class="material-icons">build</i></a></li>
      <li class=<?php Level($lvl,3); ?> ><a href="users.php" class="btn-floating green"><i class="material-icons">people</i></a></li>
    </ul>
</div>

<div id="user_id" name= <?php echo"'".$idu."'" ?> style="position: absolute;visibility: hidden;"></div>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="Sisop/js/jquery.lineProgressbar.js"> </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
 <script src="addons/typeahead/typeahead.bundle.min.js"></script>
 <script src="addons/materialize-tags/js/materialize-tags.min.js"></script>
 <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script><script src="//cdn.datatables.net/buttons/1.0.0/js/dataTables.buttons.min.js"></script>  
<script src="Sisop/js/Croppie-master/croppie.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="modal_users.js"></script>
    <script src="modal_registro.js"></script>
    <script src="botones_inicio.js"></script>
    <script src="tabletags.js"></script> 



</body>
</html>






