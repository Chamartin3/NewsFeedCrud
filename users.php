<?php

require 'home.php';
 if (($_SESSION['user']['lvl']<3)) {
 header('Location:login.php');
};

?>


<head>
	<title>Usuarios Registrados</title>
</head>


<div class="Container">
<div class="row" style="margin-top: 10hv">
<h2 style="color: #0d47a1"> Usuarios Registrados</h2>
</div>
<div class="row">
	<div id="tabla_users" class="col s12 m6 offset-m3">
		<table class="highlight bordered">
			<thead>
				<th>Foto</th>
				<th>Usuario</th>
				<th>Nivel</th>
				<th>Eliminar</th>
				<th>Modificar</th>
			</thead>
			<tbody>	
			</tbody>
			</table>
	</div>
</div>


<div data-target="modalusers" class="fixed-action-btn modal-trigger" style="margin-right: 70px">
<a id="addbtn" class="btn-floating btn-large light-green accent-4" href="#modalusers">
      <i class="large material-icons">add</i>
 </a>
</div>

</body>

<script>

$(document).ready(function(){

$('.modal').modal();

$.ajax({
	url: 'all_users.php',
	type: 'POST',
	data: {consult:'all'},
	success:function(data){
		$('tbody').append(data)
	}
	})
		.done(function() {
		console.log("success");
		})
		.fail(function() {
		console.log("error");
		})
		.always(function() {
		console.log("complete");
     });




$('#addbtn').on('click', function(){
	$("#f4_form").trigger('reset')
	$("#f4_file").val('') 
	$("#f4_fileroute").val('') 
	$('#f4_img_preview_img').attr('src', 'Sisop/img/profile.png')
	$('#titulomodal').text('Nuevo Usuario')
	$('#propositomodal').text('new')
	$('#f4_file').css('visibility','initial' );
    $('#f4_file_field').css('visibility','initial' );
     $('#f4_remove_button').css('visibility', 'hidden');

});



$('tbody').on('click', '.delbut', function() {
	var sessionid = $('#user_id').attr('name')
	var valor 	  = $(this).attr('id')
	var row 	  = "#row"+valor
	if (sessionid == valor) {
		swal({
 			 title: "No puedes eliminar a tu propio usuario",
  			icon: "error",
		})
	}else{
		swal({
           title: "¿Deseas eliminar este usuario?",
           icon: "warning",
           buttons: true,
           dangerMode: true,
          })
		.then((confirm) => {
		if (confirm) {
			$.ajax({
	         	url: 'all_users.php',
				type: 'POST',
				data: {consult: 'delete',
					   id: valor,
					  },
				success:function(dato){
					$(row).fadeOut('slow')
					$.ajax({  
                     	url:"Sisop/delete.php",  
                     	type:"POST",  
                     	data:{path:dato}
                     	}) 
                     }
				    }) 
	            }
	        })
           }

        });


$('tbody').on('click', '.editbut', function() {
	var valor 	= $(this).attr('id')
	  console.log(valor);
	$.ajax({
	       	url: 'all_users.php',
			type: 'POST',
			data: {consult: 'unique',
				   id: valor,
				  },
			dataType:"json",
			success:function(data){
			      
			      $('#f4_name').val(data.username)
      			  $('#f4_name+label').attr('class',"active")
      			  $('#f4_mail').val(data.email)
      			  $('#f4_mail+label').attr('class',"active")
         	      switch(data.nivel) {
     			     case "1":lvl= "Cliente"
     			   break;
     			     case "2":lvl= "Registrador"
     			   break;
     			     case "3":lvl= "Supervisor"
     			   break;
    			      case "4":lvl= "Administrador"
     			   break;
       			   }
       			   $('#select_nivel>.select-wrapper>.select-dropdown').attr('value',lvl)
       			    $('#f4_nivel').val(data.nivel)
       			    console.log(data)
       			    console.log(data.foto)
       			    console.log("users")

       			    if (data.foto!="img/profile.png") {
       			    	$('#f4_file_field').css('visibility', 'hidden')
      					$('#f4_file').css('visibility', 'hidden')
      					$('#f4_remove_button').css('visibility', 'visible')
       			    }else{
       			    	$('#f4_file_field').css('visibility', 'visible')
      					$('#f4_file').css('visibility', 'visible')
      					$('#f4_remove_button').css('visibility', 'hidden')
      					$('#f4_fileroute').val(data.foto)
      					$('#f4_path').val(data.foto)
       			    }

       			    $('#imagepath').attr('name',data.foto)    				
      				$('#f4_img_preview_img').attr('src',"Sisop/"+data.foto)	
     				$('#titulomodal').text('Actualizar Información')
     				$('#propositomodal').text('update')
     				$('#iduser').text(valor)
     				$('#modalusers').modal('open');
   
				}
			}) 	
});





});

</script>
</html>