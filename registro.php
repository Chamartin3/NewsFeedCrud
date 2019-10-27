<?php

require 'home.php';
include 'modals_registro.php';
 if (($_SESSION['user']['lvl']<0)) {
 header('Location: login.php');
};

?>


<script src="modal_users.js"></script>
<head>
	<title>Registro</title>
</head>
<div class="container">
	<div class="row">

        <div class="col s12 m6">
          <div class="card indigo darken-4">
            <div class="card-content white-text">
              <span class="card-title">Registro de Titulares</span>
            </div>
            <div class="card-action">
              <a id="reg_titulares" href="#modaltitiulares">Iniciar</a>
            </div>
          </div>
        </div>

        <div class="col s12 m6">
          <div class="card orange darken-4">
            <div class="card-content white-text">
              <span class="card-title">Registro de Bits Personales</span>
            </div>
            <div class="card-action">
              <a id="reg_bits" href="#">Iniciar</a>
            </div>
          </div>
        </div>

	</div>
</div>

<script>
  

</script>