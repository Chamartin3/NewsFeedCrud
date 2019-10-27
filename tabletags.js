jQuery(document).ready(function($) {



$('.filtrocatbtn').on('click', function(event) {
  var search= $(this).attr('value');
  console.log(search)
  $('#tagtable').DataTable().destroy();
  tag_table_summon(search)
  
  })

if (por!='') {

var por = $('#progressbar1').attr('value')
var porcentaje =100-por.substr(1).slice(0, -1)
 if (porcentaje==100) {
    
    $('#progressbar1').addClass('unexistent')
    $('#bar').addClass('unexistent')
 }else{

    $('#progressbar1').LineProgressbar({
      percentage: porcentaje,
      fillBackgroundColor: '#080592',
      height: '25px',
      radius: '15px'
      })
}

}
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

tag_table_summon()
function tag_table_summon(busq) {
  var tagtable = $('#tagtable').DataTable( {
    language:idioma,
    processing:true,
    serverSide: true,
    dom: 'lf<B>rtip',
    buttons: [/*'copy', 'csv', 'excel', 'pdf', 'print',*/
                {
                text: 'Limpiar',
                className: 'btn datatablesbut blue darken-4',
                action: function ( e, dt, node, config ) {
                     $('#tagtable').DataTable().destroy();
                     tag_table_summon()
                    }
                },
                {
                text: 'Sin Clasificar',
                className: 'btn datatablesbut grey darken-1',
                action: function ( e, dt, node, config ) {
                     $('#tagtable').DataTable().destroy();
                     tag_table_summon("0")
                    }
                }
        ],
/*  columns: [{ 
      searchable: true }
             ],     
*/  columnDefs: [{
                targets: [ 0,1 ],
                visible: false,
                searchable: true
            }],
    order:[],
    ajax: {
        url: 'Sisop/ssptabletags.php',
        type: 'POST',
        data:{busq: busq}
    },
  })
  $('select').not('.disabled').material_select()
}


$('.filtrocat').on('click', function(event) {
  var search= $(this).attr('value');
  console.log(search)
  tagtable.columns( "3" )
        .search(search)
        .draw();
  //tagtable.fnFilter(search);
  //tagtable.fnDraw();
  });


  $.ajax({
    url: 'Sisop/ssptabletags.php',
    type: 'POST',
    success:function(data){
      $('#datos').append(data)

    }
  });





})