<?php

require 'home.php';
include 'modals_registro.php';
include 'Sisop/tabletagsbuttons.php';

 if (($_SESSION['user']['lvl']<0)) {
 header('Location: login.php');
}; ?>

 <link rel="stylesheet" href="css/jquery.lineProgressbar.min.css" />
 <script    src="Sisop/js/jquery.lineProgressbar.js"> </script>
<head>
	<title>Registro</title>
</head>
<style>
	.material-tooltip { white-space: pre; border-radius: 20%;}

</style>
<div class="container">
<div class="row">
	<div id="bar">
	    <h6>Categorizacíón de Etiquetas</h6>	
		<div  id="progressbar1" value="'<?php intval(getStatistiscs("peso",0))?>'" ></div>
	</div>
	<div class="col s8 offset-s2">
	<strong><h6>Categorías</h6></strong>
	
	<table>

		<td>
			<div value="2" class="card red darken-2 waves-effect waves-light filtrocatbtn tooltipped" data-position="bottom" data-delay="50" 
			data-tooltip="<?php getStatistiscs("tags",2)?> tags(<?php getStatistiscs("pesopost",2)?>%)
<?php getStatistiscs("titulares",2)?> Titulares" 
			style="color:white;  border-radius: 50%;text-align:  center; height: 100px; width: 100px">
				<p>	Actor</p>
		<h4><?php getStatistiscs('tags',2)?> </h4>
			</div>
		</td>


		<td>
			<div value="1" class="card green darken-2 waves-effect waves-light filtrocatbtn tooltipped" data-position="bottom" data-delay="50" 
			data-tooltip="<?php getStatistiscs("tags",1)?> tags(<?php getStatistiscs("pesopost",1)?>%)
<?php getStatistiscs("titulares",1)?> Titulares" 
			style="color:white;  border-radius: 50%;text-align:  center; height: 100px; width: 100px">
				<p>Tema</p>
				<h4><?php getStatistiscs('tags',1)?> </h4> 

			</div>
		</td>


		<td>
			<div value="3" class="card blue darken-2 waves-effect waves-light filtrocatbtn tooltipped" data-position="bottom" data-delay="50" 
			data-tooltip="<?php getStatistiscs("tags",3)?> tags (<?php getStatistiscs("pesopost",3)?>%)
<?php getStatistiscs("titulares",3)?> Titulares" 
				 style="color:white;  border-radius: 50%;text-align:  center; height: 100px; width: 100px">
				<p>Evento</p>
<h4><?php getStatistiscs('tags',3)?> </h4>

		</div>
		</td>


		<td>
			<div value="4" class="card yellow darken-2 waves-effect waves-light filtrocatbtn tooltipped" data-position="bottom" data-delay="50" 
			data-tooltip="<?php getStatistiscs("tags",4)?> tags(<?php getStatistiscs("pesopost",4)?>%)
<?php getStatistiscs("titulares",4)?> Titulares" 

				 style="color:white;  border-radius: 50%; text-align: center;  height: 100px; width: 100px">
			<p>	Hecho</p>
				<h4><?php getStatistiscs('tags',4)?> </h4>

			</div>
		</td>
	</table>
</div>
</div>



	<div class="row">
		<table id="tagtable" class="bordered highlight centered responsive-table">
			<thead>
				<th>cod</th>				
				<th>Categoria</th>
				<th>Sub-Categoría</th>				
				<th>Etiqueta</th>
				<th>Titulares</th>
				<th>Modificar</th>
				<th>Fusionar</th>
				<th>Eliminar</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

	<div data-target="modaltags" class="fixed-action-btn modal-trigger" style="margin-right: 70px">
<a id="addbtntags" class="btn-floating btn-large light-green accent-4" href="#modaltags">
      <i class="large material-icons">add</i>
 </a>
</div>

</div>
<script>$(document).ready(function(){


$('#addbtntags').on('click', function(){
	$("#tags_form").trigger('reset') 
	$('#tags_titulo').text('Nueva Etiqueta')
	$('#tags_propositomodal').text('new')
	$('#tag_scat').attr('style', 'visibility: hidden')
	$('#select_cat>.select-wrapper>.select-dropdown').attr('value','Seleccione la Categoría')
    $('#tag_cat').val("") 
    $('#tagsupdate').replaceWith('<a id="tagssubmit" style="height: 70px; text-align:center;" class="modal-action waves-effect waves-green btn-flat col s4 tsubmit">Enviar</a>')
    	
    });

$('tbody').on('click', '.fuzebut', function() {

$('#fuze_rowchanged').val($(this).parents('tr'))
$('#modalfuze').modal('open');
$('#fuze_form').trigger('reset')
	var valor 	= $(this).attr('id')
	var sessionid = $('#user_id').attr('name')
	$.ajax({
	       	url: 'Sisop/ssptabletitularescrud.php',
			type: 'POST',
			data: {consult:'uniquetags',
				   id: valor,
				  },
			dataType:"json",
			success:function(eti){
				$('#fuze_codtag').val(eti.codigo)
				$('#fu_tag').val(eti.nombre)
				$('#fu_tag+label').addClass('active')
				$('#fu_cat').val(eti.categoria)
				$('#fu_cat+label').addClass('active')
				$('#fu_scat').val(eti.subcat)
				$('#fu_scat+label').addClass('active')
                $('#fuze_scat>.select-wrapper>.select-dropdown').prop( "disabled", true )
                $('#fuze_tag>.select-wrapper>.select-dropdown').prop( "disabled", true )           
                				
			}
		})
})






$('tbody').on('click', '.delbut', function() {
	var valor 	  = $(this).attr('id')
	var cod 	  = $(this).attr('name')
		swal({
 			 title: "¿Deseas eliminar esta etiqueta?",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
		})
.then((confirm) => {
  if (confirm) {
			$.ajax({
	         	url: 'Sisop/ssptabletitularescrud.php',
				type: 'POST',
				data: {consult: 'tagdelete',
					   id: valor,
					   cod:cod
					  },
				success:function(dato){
					swal("Haz eliminado la etiqueta", {
         			 icon: "success",});
					$(this).parent().parent().fadeOut('slow')
					console.log(dato)
					$('#tagtable').DataTable().row( $(this).parents('tr') ).remove().draw();
					//$('#tittable').DataTable().destroy();
					//load_table(idioma)

                     }
				    }) 
	            }else {
    				swal("Se ha cancelado la eliminación");
  				}
  			})
        });



$('tbody').on('click', '.editbut', function() {
	var valor 	= $(this).attr('id')
	var sessionid = $('#user_id').attr('name')

	$.ajax({
	       	url: 'Sisop/ssptabletitularescrud.php',
			type: 'POST',
			data: {consult:'uniquetags',
				   id: valor,
				  },
			dataType:"json",
			success:function(eti){
				
				$("#tags_form").trigger('reset') 
				$('#tags_titulomodal').text('Modificar Etiqueta')
				$('#tags_propositomodal').text('tagupdate')
				$('#tag_cat').val(eti.categoria)
      			$('#nametag').val(eti.nombre)
      			var cate= eti.catag
      			$('#tag_scat').attr('style', 'visibility: visible')
           		$.ajax({
            		 url: 'Sisop/bring.php',
            		 type: 'POST',
            		 data: 'id_cat='+ cate,
            		   })
                  .done(function(res) {
              
                $('#f2_scatsel').append('<option  value="" disabled selected >Seleccione la Sub-Categoría</option>')
                res = JSON.parse(res);
                res.forEach(function(res){
               		$('#f2_scatsel').append('<option value="' +res.cod_subcat+'">'+res.subcat+'</option>')
                 })
                $('#f2_scatsel').material_select()
                $('#tag_scat>.select-wrapper>.select-dropdown').attr('value',eti.subcat)
                $('#f2_scatsel').val(eti.cod_scat) 

				
                $('#select_cat>.select-wrapper>.select-dropdown').attr('value',eti.categoria)
                $('#tag_cat').val(eti.catag)


                $('#tagssubmit').replaceWith('<a id="tagsupdate" style="height: 70px; text-align:center;" class="modal-action waves-effect waves-green btn-flat col s4 tsubmit">Actualizar</a>')

                $('#cod_tag').val(valor);
                $('#tag_rowchanged').val($(this).parents('tr'))
                $('#modaltags').modal('open');

                
				 })
                 .fail(function() {
                 console.log("error")
                  })
             }
       });
     });




})</script>