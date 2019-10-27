<?php

require 'home.php';
include 'modals_registro.php';
include 'Sisop/tabletagsbuttons.php';

 if (($_SESSION['user']['lvl']<0)) {
 header('Location: login.php');
}; ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">

 <link rel="stylesheet" href="css/jquery.lineProgressbar.min.css" />
 <script    src="Sisop/js/jquery.lineProgressbar.js"> </script>

 <style>
 	.datatablesbut{

 		margin-left: 50px;
 		margin-top: 25px;


 	}


 </style>
<head>
	<title>Registro</title>

</head>
<div class="container">
    <div id="bar">
	    <h6>Titulares etiquetados</h6>	
		<div  id="progressbar1" value="'<?php intval(getstattag())?>'" ></div>
	</div>

	<div class="row">
		<table id="tittable" class="bordered striped highlight centered responsive-table">
			<thead>
				<tr>
				<th>id</th>
				
				<th>
			    
				 <input type="text" id="filter_fecha" class="datepickerfilter filters" placeholder="Fecha">
				</th>		

				<th>
				<select id="filter_medio" name="filter_medio" class="form-control filters">
					<option value="">Medio</option>
					<?php getlist("medio")?>
				</select>
				</th>			
				
				<th><select id="filter_titular" name="filter_titular" class="form-control filters">
					<option value="">Titular</option>
					<?php getlist("titular")?>
				</select>
				</th>				
				


				<th>
					<select id="filter_tags" name="filter_tags" class="form-control filters">
					<option value="">Tags</option>
					<option value="false">Sin Tags</option>
					<option value="true">Con Tags</option>
				</select>

				</th>

				<th>Modificar</th>
				<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
</div>
</div>
</div>


<script>$(document).ready(function(){

load_table(idioma)

function load_table(idioma,medio,titular,fecha,tags) {
  var tittable = $('#tittable').dataTable( {
    language:   idioma,
    processing: true,
    serverSide: true,
    dom: 'lf<B>rtip',
    buttons: [/*'copy', 'csv', 'excel', 'pdf', 'print',*/
                {
                text: 'Limpiar',
                className: 'btn datatablesbut blue darken-4',
                action: function ( e, dt, node, config ) {
                     $('#filter_medio').val('');
                     $('#filter_titular').val('');
                     $('#filter_fecha').val('');
                     $('#filter_tags').val('');
                     $('#tittable').DataTable().destroy();
                    load_table(idioma);
                }
              }
        ],
         fixedHeader: {
            header: true,
            footer: true
                },
    columnDefs: [{
            targets:    [ 0 ],
            visible:    false,
            searchable: true
            }],
    order:[],
    ajax: {
        url: 'Sisop/ssptabletitulares.php',
        type: 'POST',
        data:{is_medio:medio,
             is_titular:titular,
             is_fecha:fecha,
             is_tags:tags
           }
        }
  })
$('select').not('.disabled').material_select()
}



$.ajax({  
        url: 'Sisop/dates.php',
        success: function(data) {
          var ed=data;
          var ed2=ed.slice(0, -1).split("/")
          enabledates=ed2.forEach(splitter)
        }
    }).done(function() {

  console.log("success")
        $('.datepickerfilter').pickadate({
            selectMonths: true, 
            selectYears: 3, 
            today: 'Today',
            disable: enabled,
            clear: 'Clear',
            close: 'Ok',
            format: 'yyyy-mm-dd',
            closeOnSelect: false,
            container: undefined,
          });
})
var enabled=[true]
function splitter(a) {
   b=a.split(",")
    for(var i=0; i<b.length;i++) { b[i] = +b[i]};
    for(var i=0; i<b.length;i++) {if (i==1) { b[i]= b[i]-1}}; 
    enabled.push(b)  
}


$('.filters').on('change',function(event) {
    var medio    = $('#filter_medio').val();
    var titular  = $('#filter_titular').val();
    var fecha    = $('#filter_fecha').val();
    var tags    =  $('#filter_tags').val();    
    $('#tittable').DataTable().destroy();
    if(medio != '' || titular != '' || fecha != ''|| tags != ''){
      console.log(tags)
      load_table(idioma,medio,titular,fecha,tags);
    }else{
      load_table(idioma);  
  }


});		

var idioma= {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}



$('tbody').on('click', '.delbut', function() {
  var valor     = $(this).attr('id')
    swal({
           title: "¿Deseas eliminar este Titular?",
           icon: "warning",
           buttons: true,
           dangerMode: true,
          })
.then((confirm) => {
  if (confirm) {
      $.ajax({
        url: 'Sisop/ssptabletitularescrud.php',
        type: 'POST',
        data: {consult: 'delete',
             id: valor,
            },
        success:function(dato){
          $(this).parent().parent().fadeOut('slow')
          console.log(dato)
          $('#tittable').DataTable().row( $(this).parents('tr') ).remove().draw()
          swal("Has eliminado este titular", {
          icon: "success",});
                     }
            }) 
             } else {
    swal("Se ha cancelado la eliminación");
  }
}); 


        });

  



$('tbody').on('click', '.editbut', function() {
	var valor 	= $(this).attr('id')
	var sessionid = $('#user_id').attr('name')
	$.ajax({
	       	url: 'Sisop/ssptabletitularescrud.php',
			type: 'POST',
			data: {consult:'unique',
				   id: valor,
				  },
			dataType:"json",
			success:function(data){	
				$('.datepicker').pickadate({
    			selectMonths: true, // Creates a dropdown to control month
   				 selectYears: 15, 
   				 today: 'Today',
   				 clear: 'Clear',
    			close: 'Ok',
    			format: 'yyyy-mm-dd',
   				closeOnSelect: false, 
    			container: undefined 
 				});
        console.log("WTF?")
			      
			    $('#t_titular').val(data.titular)
      			$('#t_titular+label').attr('class',"active")
      			$('#t_date').val(data.fecha_noticia)
      			$('#t_date+label').attr('class',"active")
      			$('#t_medio_select>.select-wrapper>.select-dropdown').attr('value',data.medio)
       			$('#t_medio').val(data.id_medio)
            $('#t_id').val(valor)

     			$('#t_tags-autoselect').materialtags('removeAll');
				var lista = data.tags.split("/")
          		lista.splice(-1,1)
         		lista.forEach(agregar)
          			
                function agregar(item) {
            		var it = JSON.parse(item)
            		$('#t_tags-autoselect').materialtags('add',it)
                }

				  $('#t_titulomodal').text('Actualizar Titular')
     			$('#t_user').text(sessionid)
     			$('#propositomodal').val('update')
     			$('#tsubmit_t').css('visibility', 'hidden');
				  $('#tsubmit_f').css('visibility', 'hidden');
				  $('#tsubmit_s').replaceWith('<a id="tupdate" style=" text-align:center;" class="modal-action waves-effect waves-red btn-flat col s4 ">Actualizar Datos</a>');
     			$('#modaltitulares').modal('open');
				
			}	
	})
})





})</script>

		
	</div>
</div>