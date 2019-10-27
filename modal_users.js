jQuery(document).ready(function($) {



/*
 $(document).on('change', '.filters', function(){

  }

/*********************************************************************************************************************

                                      <<<<<<<<<<<< Modal Users >>>>>>>>>>>>>


**************************************************************************************************************************/

$('select').not('.disabled').material_select()

$('.modal').modal();

$('#img_modalsubmit').click(function(event){
        image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
            }).then(function(response){
            $.ajax({
                url:"Sisop/upload.php",
                type: "POST",
                data:{"image": response},
                success:function(data){
                    $('#modalimagecrop').modal('close');
                    $($('#hiddenmodalid1').val()).attr('src',"Sisop/"+data);
                    $($('#hiddenmodalid2').val()).css('visibility', 'visible');
                    $($('#hiddenmodalid3').val()).val(data)
                    $('#f4_file').css('visibility','hidden' );
                    $('#f4_file_field').css('visibility','hidden' );
                    $('#imagepath').attr('name',data) 

                    

                 }
             })
         })
 })

var image_crop = $('#crop_img_preview').croppie({
      enableExif: true,
      enforceBoundary:false,
      viewport:{
      width:200,
      height:200,
      type:'circle'
      },
         boudary:{
         width:300,
         height:300,
         }
 })

$('#f4_file').on('change',function() {
   var fileread = new FileReader();
   fileread.onload = function(event){
        image_crop.croppie('bind', {
        url: event.target.result
        }).then(function(){   
        })
   }
   fileread.readAsDataURL(this.files[0])
           $('#modalimagecrop').modal('open')
           $('#hiddenmodalid1').val('#f4_img_preview_img')
           $('#hiddenmodalid2').val('#f4_remove_button')
           $('#hiddenmodalid3').val('#f4_path')

})


$('#f4_contra2').on('change',function() {
        var contra1 = $('#f4_contra').val()
        var contra2 = $('#f4_contra2').val()
        if (contra1!==contra2) {
            $('#f4_notify').empty()
            $('#f4_notify').fadeIn().append(
          '<div class="col s12 red lighten-4" style="padding:10px; text-align: center"> las contraseñas no coinciden </div>');
            setTimeout(function (){
            $('#f4_notify').fadeOut('slow');
            },5000);


            }
})

$('#f4_submit').on('click', function(e){
        e.preventDefault();
        var proposito = $('#propositomodal').text();
        var form    = "f4"
        var f4_name   = $('#f4_name').val()
        var f4_contra   = $('#f4_contra').val()
        var f4_contra2  = $('#f4_contra2').val()
        var f4_nivel  = $('#f4_nivel').val()
        var f4_mail   = $('#f4_mail').val()
        var f4_path   = $('#f4_path').val()
        var id       =  $('#iduser').text()
        console.log($('#propositomodal').text());
    
  if (proposito == "new") {

      if (f4_name == '' || f4_nivel == '' || f4_contra == '' || f4_contra2 == ''){
      
        $('#f4_notify').empty()
        $('#f4_notify').fadeIn().append('<div class="col s12 red lighten-4" style="padding:10px; text-align: center"> Datos Incompletos</div>')
            setTimeout(function (){
        $('#f4_notify').fadeOut('slow')
        },5000)
      
      }else{
        console.log('nuevo proposito');
        $.ajax({
        url: 'Sisop/send_ajax.php',
        method: 'POST',
        data: {
            f4_name: f4_name,
            f4_contra: f4_contra,
            f4_nivel: f4_nivel,
            proposito: proposito,
            f4_mail: f4_mail,
            f4_path:f4_path 
            },
        success:function(data)  
                {
                    console.log(f4_path)
                    $('#modalusers').modal('close')
                    $("#f4_form").trigger('reset')
                    $('#f4_img_preview_img').attr('src', 'Sisop/img/profile.png')
                    $('#f4_remove_button').css('visibility', 'hidden')
                    $('#f4_notify').empty()
                    $( "tbody" ).empty()
                    $.ajax({
                      url: 'all_users.php',
                      type: 'POST',
                      data: {consult:'all'},
                      success:function(data){
                      $('tbody').append(data)
                      }
                    })
                    console.log(f4_path)
                    $('#f4_notify').fadeIn().append('<div class="col s12 green lighten-4" style="padding:10px; text-align: center">'+data+'</div>')
                       setTimeout(function (){
                    $('#f4_notify').fadeOut('slow')
                    
                    },100);  
                }
            })
              .done(function(data) {
              console.log("exito")
              })
              .fail(function() {
              $('#f4_notify').fadeIn().append('<div class="col s12 red lighten-4" style="padding:10px; text-align: center"> error'+datos+'</div>')
              })
              .always(function() {
              console.log("complete");
              }); 
      }
  }else{
       var f4_path   = $('#imagepath').attr('name')
        $.ajax({
        url: 'Sisop/send_ajax.php',
        method: 'POST',
        data: {
            id:id,
            f4_name: f4_name,
            f4_contra: f4_contra,
            f4_nivel: f4_nivel,
            proposito: proposito,
            f4_mail: f4_mail,
            f4_path:f4_path 
            },      
            success:function(data){  
                    $("#f4_form").trigger('reset')
                    $('#f4_img_preview_img').attr('src','Sisop/img/profile.png')
                    $('#f4_remove_button').css('visibility', 'hidden')
                    $('#f4_notify').empty()
                        $( "tbody" ).empty()
                        $.ajax({
                        url: 'all_users.php',
                        type: 'POST',
                        data: {consult:'all'},
                       success:function(data){$('tbody').append(data)}
                      })
                      
                    
                    $('#f4_notify').fadeIn().append('<div class="col s12 green lighten-4" style="padding:10px; text-align: center">'+data+'</div>')
                       setTimeout(function (){
                        var loc = $('#locationid').attr('name')
                        
                         if (loc=='home') {
                            $.ajax({
                            url: 'sessionupdate.php',
                            type: 'POST',
                            data: {
                              name: f4_name,
                              lvl: f4_nivel,
                              img: f4_path},
                            success:function(data){
                           }
                          })    
                    }

                    $('#f4_notify').fadeOut('slow')
                    $('#modalusers').modal('close')
                   },1000);  
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
        
        }

     })
    $(document).on('click', '#f4_remove_button', function(){  
           if(confirm("¿Deseas eliminar esta imagen?"))  
           {  
                var path = $('#f4_img_preview_img').attr('src')
                var id       =  $('#iduser').text()
                var arraypath= path.split('/')
                var path2 ="img/"+arraypath[2]



                $.ajax({  
                     url:"Sisop/delete.php",  
                     type:"POST",  
                     data:{path:path2,
                            id:id},  
                     success:function(data){  
                          if(data != '')  
                          {    $("#f4_file").val(''); 
                               $("#f4_fileroute").val(''); 
                               $('#f4_img_preview_img').attr('src', 'Sisop/img/profile.png');
                               $('#imagepath').attr('name','img/profile.png')
                               $('#f4_remove_button').css('visibility', 'hidden');
                               $('#f4_file').css('visibility','visible' );
                               $('#f4_file_field').css('visibility','visible' );
                               $('#f4_notify').empty();
                   $('#f4_notify').fadeIn().append('<div class="col s12 yellow lighten-4" style="padding:10px; text-align: center">'+data+'</div>');
                   setTimeout(function (){
                   $('#f4_notify').fadeOut('slow');
                      },900);
                      
                           }      
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
     }); 


});