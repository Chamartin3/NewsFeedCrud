jQuery(document).ready(function($) {


  $('#newtags').on('click',function() {

      $('#modalnewtags').modal('open');
  })

  $('#reg_titulares').on('click',function() {
      $('#modaltitulares').modal('open');
      var user= $('#userinfo').attr('name')
      $('#t_user').attr('name', user);
  })

  var etiquetas = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('tag'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
           // prefetch:'data.json',
            remote: {
                url: 'Sisop/tags.php?query=%QUERY',
                wildcard: '%QUERY'}
    });

  etiquetas.initialize();

  var tagfield = $('#t_tags-autoselect');

        tagfield.materialtags({
            itemValue:'cod_tag',
            itemText: 'tag',
            tagClass: function(item) {
              switch (item.catag) {
                case '0'  : return 'chip gray accent-2';
                case '1'  : return 'chip green accent-3';
                case '2'  : return 'chip red accent-2';
                case '3'  : return 'chip blue accent-1';
                case '4'  : return 'chip yellow accent-4';
             }
           },
            typeaheadjs: {
                name: 'etiquetas',
                displayKey: 'tag',
                source: etiquetas.ttAdapter()
            }
        });


  $('#ttsubmit').on('click', function(e) {
     var  new_tags    = $('#tt_tags-autoselect').val()
     if (new_tags == '') {
     }else{
         $.ajax({
           url: 'Sisop/send_ajax.php',
           type: 'POST',
           data: {
                  new_tags:new_tags,
                  proposito: "new_tags"
                  },
        success:function(data){
          $('#modalnewtags').modal('open')
          console.log(data)

          var lista = data.split("/")
          lista.splice(-1,1)

          function agregar(item) {
            var $it = JSON.parse(item)
            tagfield.materialtags('add',$it)
          }

          lista.forEach(agregar)
          $('#tt_tags-autoselect').materialtags('removeAll');
          $('#modalnewtags').modal('close')
         
          }
      })
     }
   })

  function t_submit(e) {
    var  t_titular = $('#t_titular').val()
    var  t_date    = $('#t_date').val()
    var  t_medio   = $('#t_medio').val()
    var  t_tags    = $('#t_tags-autoselect').val()
    var  t_user    = $('#t_user').attr('name')
    var  proposito = "reg_titulares"

    if (t_titular == '' || t_date == '' || t_medio == '' || t_tags == '') {
      $('#t_notify').empty()
      $('#t_notify').fadeIn().append(
          '<div style="padding:10px; text-align: center"> <div class="col s12 red lighten-4" ; text-align: center"> Por favor, complete los campos </div> </div>');
             setTimeout(function (){
              $('#t_notify').fadeOut('slow');
            },5000);
             return false 

     }else{
      e.preventDefault();
      $.ajax({
        url: 'Sisop/send_ajax.php',
        type: 'POST',
        data: {t_titular:t_titular,
               t_date:t_date,
               t_medio:t_medio,
               t_tags:t_tags,
               t_user:t_user,
               proposito: proposito},
        success:function(data){
          $('#t_notify').empty()
          $('#t_notify').fadeIn().append(
              '<div style="padding:10px; text-align: center">'+data+'</div>');
                 setTimeout(function (){
                  $('#t_notify').fadeOut('slow');
                },5000);
                          
        }
      }) 
        return true  
      }
   }
             

    $('#tsubmit_t').on('click', function(e) {
                  var t=t_submit(e)
                  if (t){
                    $('#t_titular').val('')
                    $('#t_titular').focus();
                    $('#t_tags-autoselect').materialtags('removeAll')
                  }else{
                       console.log('faltan datos')
                  }                                     
      });
    
    $('#tsubmit_f').on('click', function(e) {
                var t=t_submit(e)
                if (t){
                     $('#t_titular').val('')
                     $('.picker').addClass('picker--focused picker--opened')
                     $('#t_tags-autoselect').materialtags('removeAll')                    
                    }else{
      
                    console.log('faltan datos')
                   }              
      });

		$('#tsubmit_s').on('click', function(e) {
                  var t=t_submit(e)
                  if (t){
                     $('#t_form').trigger('reset')
                     $('#modaltitulares').modal('close')
                     $('#t_tags-autoselect').materialtags('removeAll')                    
                  }else{
                    console.log(t_tags)
                  console.log('faltan datos')
                  }  
 			}); 

  $('select').not('.disabled').material_select()

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    format: 'yyyy-mm-dd',
    closeOnSelect: false, // Close upon selecting a date,
    container: undefined // ex. 'body' will append picker to body
  });

  $('.chips').material_chip();
  
  $('.chips-placeholder').material_chip({
    placeholder: 'introduzca las etiquetas',
    secondaryPlaceholder: '+etiqueta',
  });

  $('.tooltipped').tooltip({delay: 50});


 $('#tag_cat').on('change', function() {
      var cate= $(this).val()

      $('#tag_scat').attr('style', 'visibility: visible')
           $.ajax({
             url: 'Sisop/bring.php',
             type: 'POST',
             data: {id_cat:cate}
               }).done(function(res) {
                      $('#f2_scatsel').empty();
                      $('#f2_scatsel').append('<option  value="" disabled selected >Seleccione la Sub-Categoría</option>')
                      res = JSON.parse(res);
                      res.forEach(function(res){
                        $('#f2_scatsel').append('<option value="' +res.cod_subcat+'">'+res.subcat+'</option>')
                        })
                      $('#f2_scatsel').material_select()
                }).fail(function() {
                    console.log("error")
                    })
      });

  $('#tags_submit').on('click', function(e) {
      e.preventDefault();
      var f2_cat= $('#tag_cat').val()
      var f2_scatsel= $('#f2_scatsel').val()
      var f2_tags= $('#nametag').val()
      if (f2_cat == '' || f2_scatsel == '' || f2_tags == ''){
        $('#tags_notify').empty();
        $('#tags_notify').fadeIn().append('<div class="col s12 red lighten-4" style="padding:10px; text-align: center"> Introduzca los datos completos </div>');
        setTimeout(function (){
            $('#tags_notify').fadeOut('slow')
            },2000);    
      }else{  
        $.ajax({
          url:"Sisop/send_ajax.php",
          method:"POST",
          data:{
                f2_cat:f2_cat, 
                f2_scatsel:f2_scatsel, 
                f2_tags:f2_tags},
          success:function (data) {
            $("#tags_form").trigger('reset')
            $('#tags_notify').empty()
            $('#f2_scatsel').empty();
            $('#f2_scatsel').css('visibility', 'hidden')
            $('#tags_notify').fadeIn().append('<div class="col s12 green lighten-4" style="padding:10px; text-align: center"> Datos Enviados Correctamente </div>')
             setTimeout(function (){
               $('#tags_notify').fadeOut('slow')
               },2000)         
          }
         })
       }
   })



$('#fuze_cat').on('change', function() {
      var cate= $(this).val()
      //$('#fuze_scat').attr('style', 'visibility: visible')
           $.ajax({
             url: 'Sisop/bring.php',
             type: 'POST',
             data: 'id_cat='+ cate,
               }).done(function(res) {
                                             
                      $('#fuze_tagsel').empty()
                      $('#fuze_tag>.select-wrapper>.select-dropdown').val("Seleccione la Etiqueta")
                      $('#fuze_tag>.select-wrapper>.select-dropdown').prop( "disabled", true )


                      $('#fuze_scatsel').removeAttr('disabled')
                      $('#fuze_scatsel').empty()
                      $('#fuze_scatsel').append('<option  value="" disabled selected >Seleccione la Sub-Categoría</option>')
                      res = JSON.parse(res);
                      res.forEach(function(res){
                        $('#fuze_scatsel').append('<option value="' +res.cod_subcat+'">'+res.subcat+'</option>')
                        })
                      $('#fuze_scatsel').material_select()
                }).fail(function() {
                    console.log("error")
                    })
      });


$('#fuze_scatsel').on('change', function() {
      var scat= $(this).val()
     // $('#fuze_scat').attr('style', 'visibility: visible')
           $.ajax({
             url: 'Sisop/bring.php',
             type: 'POST',
             data: {scat:scat}
               }).done(function(res) {

                      $('#fuze_tagsel').removeAttr('disabled')
                      $('#fuze_tagsel').empty();
                      $('#fuze_tagsel').append('<option  value="" disabled selected >Seleccione la Etiqueta</option>')
                      res = JSON.parse(res);
                      res.forEach(function(res){
                        $('#fuze_tagsel').append('<option value="' +res.cod_tag+'">'+res.tag+'</option>')
                        })
                      $('#fuze_tagsel').material_select()
                }).fail(function() {
                    console.log("error")
                    })
      });



$('#modaltags').on('click', '#tagsupdate', function(i) {
  i.preventDefault();
    var  name      = $('#nametag').val()
    var  scat      = $('#f2_scatsel').val()
    var  id_tag    = $('#cod_tag').val()
    var proposito  ="updatetag"

    $.ajax({
      url: 'Sisop/ssptabletitularescrud.php',
      type: 'POST',
      data: { name   :   name,
              id     :   id_tag,
              scat   :   scat,
              consult:   "updatetag"
            },
    })
    .done(function(e) {
      $('#modaltags').modal('close')
      swal("Se ha modificado la etiqueta nueva con exito", {
          icon: "success"})
      $('#tagtable').DataTable().row( $('#tag_rowchanged').val() ).remove().draw();



    })
    .fail(function(e) {
      console.log("error"+e);
    })

    
});


$('#modaltags').on('click', '#tagssubmit', function(i) {
  i.preventDefault();

    var  name      = $('#nametag').val()
    var  scat      = $('#f2_scatsel').val()
    var consult  = "newtag"
    $.ajax({
      url: 'Sisop/ssptabletitularescrud.php',
      type: 'POST',
      data: { name: name,
              scat: scat,
              consult: "newtag"
      },
    })
    .done(function(e) {
      $('#modaltags').modal('close')
      swal("Se ha agregado la etiqueta nueva con exito", {
          icon: "success"})
    })
    .fail(function(e) {
      console.log("error"+e);
    })
    

});



$('#modalnewsubcats').on('click', '#scatsubmit', function(i) {
  i.preventDefault();
    var  cat      = $('#sc_cat').val()
    var  scat     = $('#scsub_cat').val()
    var  tcat     = $('#sc_catselect>.select-wrapper>.select-dropdown').val()
 $.ajax({
      url: 'Sisop/ssptabletitularescrud.php',
      type: 'POST',
      data: { cat: cat,
              scat: scat,
              consult: "newsubcat"
      },
    })
    .done(function(v) {
      $('#select_cat>.select-wrapper>.select-dropdown').attr('value',tcat)
      $('#tag_cat').val(cat)

      $('#tag_scat>.select-wrapper>.select-dropdown').attr('value',scat)
      $('#f2_scatsel').val(v) 
      $('#modalnewsubcats').modal('close')
   


      })
    .fail(function(e) {
      console.log("error"+e);
    })
    

});






$('#modalfuze').on('click', '#fuzesubmit',function(i) {
  i.preventDefault();
    var  oldtag    = $('#fuze_codtag').val()
    var  newtag    = $('#fuze_tagsel').val()

    var  n_oldtag    = $('#fu_tag').val()
    var  n_newtag    = $('#fuze_tag>.select-wrapper>.select-dropdown').val()

   if (oldtag==newtag) {
      swal("No se pueden realizar combinación, las dos etiquetas corresponden a la misma instancia", {
          icon: "warning"})
    }else{
    
    swal({
       title: "¿Deseas unir estas etiquetas?",
        text: 'Todos los titulares que contengan se la etiqueta "'+n_oldtag+'", pasarán ahora tener la etiqueta: "'+n_newtag+'"',
        icon: "warning",
        buttons: true,
        dangerMode: true,
         })
        .then((confirm) => {
         if (confirm) {

 

      $.ajax({
        url: 'Sisop/ssptabletitularescrud.php',
        type: 'POST',
        data: {old    :  oldtag,
               new    :  newtag,
               consult:  'fusion'},
              })
    .done(function(i) {
      console.log(i);
       $('#modalfuze').modal('close')
      swal("Las etiquetas se han combinado exitosamente", {
          icon: "success"})
         $('#tagtable').DataTable().row( $('#fuze_rowchanged').val() ).remove().draw();



      })
    .fail(function(e) {
      console.log("Error: "+e);
    })
   }
})
}
});






$('#modaltitulares').on('click', '#tupdate', function(i) {
  i.preventDefault();

    var  t_titular = $('#t_titular').val()
    var  idtit     = $('#t_id').val()
    var  t_date    = $('#t_date').val()
    var  t_medio   = $('#t_medio').val()
    var  t_tags    = $('#t_tags-autoselect').val()
    var  proposito = $('#propositomodal').val()

    $.ajax({
      url: 'Sisop/ssptabletitularescrud.php',
      type: 'POST',
      data: {titular: t_titular,
             id: idtit,
             fecha: t_date,
             medio: t_medio,
             etiqs: t_tags,
             consult: 'updatetit',
              },
    })
    .done(function(res) {
      console.log(res);
      $('#t_form').trigger('reset')
      $('#modaltitulares').modal('close')
      $('#t_tags-autoselect').materialtags('removeAll')
      $('#tittable').DataTable().row( $(this).parents('tr') ).draw() 

    })
    .fail(function(e) {
      console.log("error"+e);
    })




      

});












})
