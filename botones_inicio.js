
$(document).ready(function(){

$('select').not('.disabled').material_select()

$(".unexistent").remove();

$(".button-collapse").sideNav();

$('.modal').modal();

$('.dropdown-button').dropdown();

$('#botonesdeusuario').on('click', '#userinfo', function() {
  var valor   = $(this).attr('name');
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
              if (data.nivel<3) {
                    $('#select_nivel').css('visibility', 'hidden')
                    }
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
            $('#locationid').attr('name',"home")
            $('#modalusers').modal('open');
        }
      })  
})

})