<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title> Formularios Materialize </title>
        <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
<script    src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

<link rel="stylesheet" href="js/Croppie-master/croppie.css" />
<script src="js/Croppie-master/croppie.js"></script>


</head>

<body>

<?php require 'bring.php'; ?>

<div class="container"> 
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                                                   Formulario  1     

 	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<div class="card-panel #1e88e5 blue darken-1"> <h4 style="color: #FFFFFF" >Formulario de Sub-Categoría</h4></div>
<form class="col s12" id="f1_form" >
<div class="row">
		<div class="input-field col s6">
		    <select required id="cat" name="cat" >  	
		      <option value="" disabled selected>Seleccione la categoría</option>
			     <?php
		         $catego=bringcats();
             	 foreach ($catego as $c) {
			     echo '<option value="' .$c['id'].'">'.$c['cat'].'</option>';
		         }?>
	         </select>
		    <label>Categória</label>
		</div>

        <div class="input-field col s6">
          <input required placeholder="Nombre de subcategoría" id="sub_cat" name="sub_cat" type="text" class="validate">
          <label for="sub_cat">Sub-categoría</label>
        </div>

        <div class="row">
        <div class="input-field col s4">
		   <input type="submit" id="f1_submit" class="btn blue darken-1">
		</div>
		<div id=f1_notify class="input-field col s6">
	   </div>
</div>
</div>

</form>


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                                                   Formulario  2   

 	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<div class="card-panel #1e88e5 blue darken-2" id="head2"> <h4 style="color: #FFFFFF" >Formulario de Etiquetas</h4></div>
<form class="col s12" id="f2_form">

<div class="row">
		<div class="input-field col s6">
		    <select id="f2_cat" name="f2_cat">
		      <option value="" disabled selected>Seleccione la Categoría</option>
			     <?php
		         $catego=bringcats();
             	 foreach ($catego as $c) {
			     echo '<option value="' .$c['id'].'">'.$c['cat'].'</option>';
		         }?>

		    </select>
		    <label>Categoría</label>
		</div>



		<div style="visibility:hidden" id="f2_scat"  name="f2_scat" class="input-field col s6">
		    <select  id="f2_scatsel" name="f2_scatsel" >
		      <option  value="" disabled selected >Seleccione la Sub-Categoría</option>
		</select>
		    <label>Sub-Categoría</label>
          </div>



        <div class="input-field col s12">
          <input placeholder="Nombre de Etiqueta" id="f2_tags" name='f2_tags' type="text" class="validate">
          <label for="tag">Etiqueta</label>
        </div>
</div>
<div class="row">
        <div class="input-field col s4">
		   <input type="submit" id="f2_submit" class="btn blue darken-2">
		</div>
		<div id=f2_notify class="input-field col s6">
	   </div>
</div>

</form>




 <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                                                   Formulario  3      margin-left:50px 

 	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="card-panel #1e88e5 blue darken-3"> <h4 style="color: #FFFFFF" >Formulario de Medios</h4></div>
<form class="col s12" id="f3_form" method="POST">
    <div class="row">
        <div class="input-field col s6">
          <input placeholder="Nombre deL Medio" id="f3_name" name="f3_name"  type="text" class="validate">
          <label for="sub_cat">Nombre</label>
        </div>
        <div class="col offset-s1" >
		<img id='f3_img_preview_img' class="responsive-img circle center-align hoverable" src="img/profile.png" style="height: 300px ; width:300px; position: absolute; margin-top: 50px">
		<a class="btn-floating btn-large waves-effect waves-light red" id="f3_remove_button" style="position: absolute;margin-top: 300px;visibility: hidden">
			<i class="md-48 material-icons" style="font-size: 36px">delete_forever</i>
		</a>
 	<div name="f3_path" id="f3_path" style="position: absolute;visibility: hidden"></div>
 	</div>
 </div>

    <div class="row">
        <div class="input-field col s6">
          <input type="text" id="f3_input2" name="f3_input2">
          <label for="autocomplete-input">Alcance</label>
        </div>
    </div>        


    <div class="row">
        <div class="input-field col s6">
          <input type="text" id="f3_pais" name="f3_pais">
          <label for="autocomplete-input">Pais</label>
        </div>
    </div>	

    <div class="row">
        <div class="input-field col s6">
          <input type="url" id="f3_url" name="f3_url">
          <label>Pagina Web</label>
        </div>
    </div>	

    <div class="row">

         <div class="input-field col s6">
		    <select id="f3_sel" name="f3_sel">
		      <option value="" disabled selected>Seleccione Tendencia</option>
		      <option>Gobierno</option>
		      <option>Intermedio</option>
		      <option>Oposición</option>
		    </select>
		     <label>Tendencia</label>
		     <br><br>
		</div>


         <div class="input-field col s6">
             <div class="file-field input-field">
		        <div class="btn blue darken-3">
		            <span><i class="material-icons">file_upload</i></span>
		            <input id="f3_file" name="f3_file" type="file"> 
		        </div>
		        <div class="file-path-wrapper">
		            <input id="f3_fileroute" class="file-path validate" type="text" placeholder="Logo del Medio">
		        </div>
		     </div>
	    </div>
    
    </div>

	<div class="row">
        <div class="input-field col s4">
		   <input type="submit" id="f3_submit" name="f3_submit" class="btn blue darken-3">
		</div>
		<div id=f3_notify class="input-field col s6">
	   </div>
     </div> 

</form>




 <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                                                   Formulario  4     

 	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="card-panel #1e88e5 blue darken-4"> <h4 style="color: #FFFFFF" >Registro de Usuarios</h4></div>

<form id="f4_form">
  <div class="row">
		     <div id=f4_notify></div>
</div>
<div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">account_circle</i>
          <input required pattern="[A-Za-z0-9._+-]{6,}" id="f4_name" type="text" class="validate">
          <label for="f4_name">Nombre de Usuario</label>
        </div>

<div class="col s6">
		     <div class="file-field input-field" >
		      <div class="btn blue darken-4">
		        <span><i class="material-icons">file_upload</i></span>
		             <input type="file" id='f4_file'> 
		        </div>
		   		      <div class="file-path-wrapper">
		             <input class="file-path validate" id='f4_fileroute' type="text" placeholder="Imagen de Usuario">
		        </div>
		    </div>	

		     <img id='f4_img_preview_img' class="responsive-img circle center-align hoverable" src="img/profile.png" style="height: 270px ; width:270px; position: absolute;margin-left: 70px">
		     		<a class="btn-floating btn-large waves-effect waves-light red" id="f4_remove_button" style="position: absolute;margin-top: 240px;margin-left: 70px; visibility: hidden">
			<i class="md-48 material-icons" style="font-size: 36px">delete_forever</i>
		</a>
 	<div name="f4_path" id="f4_path" style="position: absolute;visibility: hidden"></div>
</div>	

</div>
<div class="row">	
        <div class="input-field col s6">
          <i class="material-icons prefix">email</i>
          <input  id="f4_mail" type="email" class="validate">
          <label for="f4_contra2">Correo Electrónico</label>
        </div>
</div>

<div class="row">	
        <div class="input-field col s6">
          <i class="material-icons prefix">vpn_key</i>
          <input required pattern="[A-Za-z0-9._+-]{8,}" id="f4_contra" type="password" class="validate">
          <label for="f4_contra">Contraseña</label>
        </div>
</div>
<div class="row">	
        <div class="input-field col s6">
          <i class="material-icons prefix">vpn_key</i>
          <input  requiredpattern="[A-Za-z0-9._+-]{8,}" id="f4_contra2" type="password" class="validate">
          <label for="f4_contra2">Confirmación de Contraseña</label>
        </div>
</div>

<div class="row">
	
       <div class="input-field col s6">
		    <select  id="f4_nivel"> 
		      <option value="" disabled selected>Nivel</option>
		      <option value="4">Administrador</option>
		      <option value="3">Supervisor</option>
		      <option value="2">Registrador</option>
		      <option value="1">Cliente</option>
		    </select>
		     <label>Nivel</label>
		  </div>     

    <div class="input-field col s6">
		 <div class="row">
		     <input type="submit" id="f4_submit" name="f4_submit" class="btn blue darken-3" style="margin-left: 150px">
		 </div>
      
    </div>
 </div>

</form>
 <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                                                   Formulario  5     

 	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="card-panel #1e88e5 blue darken-5"> <h4 style="color: #FFFFFF" >Formulario Geografico Dependiente</h4></div>
<form class="col s12">

<div class="row">
	<div class="input-field col s6 offset-s3">
		    <select>
		      <option value="" disabled selected>Seleccione Estado</option>


		    </select>
		    <label>Estado</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s6 offset-s3">
		    <select>
		      <option value="" disabled selected>Seleccione Municipio</option>


		    </select>
		    <label>Municipio</label>
	</div>
</div>


<div class="row">
	<div class="input-field col s6 offset-s3">
		    <select>
		      <option value="" disabled selected>Seleccione Parroquia</option>


		    </select>
		    <label>Parroquia</label>
	</div>
</div>
</form>

 <!-- Formulario  6 -->

<div class="card-panel #1e88e5 blue darken-5"> <h4 style="color: #FFFFFF" >Formulario de Chips</h4></div>
	<form class="col s12">

	<div class="input-field col s6 offset-s3">
 		<div class="chips chips-autocomplete"></div>
	</div>


	  <!-- Customizable input  -->
	 <div class="input-field col s6 offset-s3">
	  <div class="chips">
	    <input class="custom-class">
	  </div>
	</div>
</form>

</div>


 <!-- Formulario  7 -->



 <!-- Formulario 1 
<label id="#bb"  class="waves-effect waves-light btn" style="display: table;"> 
     <input placeholder="Nombre de subcategoría" id="sub_cat" type="file" style="" style="display: none;">
<a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i> </a>
</label>




        
    </div>


<label id="#bb"  style="padding: 10px;  background: red;  display: table; color: #fff;"> 
    	Enter Your File
    	 <input type="file" id="File"  size="60" style="display: none" >
</label>



 -->
<div id="modalimagecrop" class="modal" style="height: 800px; width:400px">    
	<div class="modal-content">
    <div class="row">
    			<h4 style="text-align:center">Recortar imagen </h4>
    			<div class="col s3 offset-s2">
    				<div class="input-field " id='f3_img_preview' name='f3_img_preview'  style="width:200px; height: 200px;">
    			</div>
                </div>
    </div> 
    </div>           

    <div class="row">
    			<div class="modal-footer">
    			<div class="col s3 offset-s1">
    				<input type="button" id="img_modalsubmit" name="img_modalsubmit" class="btn blue darken-3" value="Recortar"
    				style="width:200px; margin-left: 45px";>
    			<div id="hiddenmodalid1" style="visibility: hidden;"></div>
    			<div id="hiddenmodalid2" style="visibility: hidden;"></div>
    			<div id="hiddenmodalid3" style="visibility: hidden;"></div>
    			</div>
    		   </div>
    </div>		
</div>
  

</body>


f4_name
f4_file
f4_fpath
f4_mail
f4_contra
f4_contra2
f4_nivel
f4_submit
f4_notify


<script>
$(document).ready(function(){
	
	$('select').not('.disabled').material_select()

	$('.modal').modal()

	$('.chips').material_chip()
	
	$('.chips-initial').material_chip({
        data: [
        {tag: 'Apple',}, 
        {tag: 'Microsoft',}, 
        {tag: 'Google',}          
        ]
     })

    $('.chips-autocomplete').material_chip({
      autocompleteOptions: {
      data: {
        'Apple': null,
        'Microsoft': null,
        'Google': null
      },
      limit: Infinity,
      minLength: 1
      }
     })     		

    $('.chips-placeholder').material_chip({
     placeholder: 'Enter a tag',
     secondaryPlaceholder: '+Tag',
     })

    $('#f1_submit').on('click', function(event) {
	    event.preventDefault()
	    var cat= $('#cat').val()
	    var sub_cat= $('#sub_cat').val()
	    if (cat == '' || sub_cat == ''){
		     $('#f1_notify').empty()
		     $('#f1_notify').fadeIn().append('<div class="col s12 red lighten-4" style="padding:10px; text-align: center"> Introduzca los datos completos </div>')
				 setTimeout(function (){
					$('#f1_notify').fadeOut('slow')
					},2000);
	    }else{
            $.ajax({
	    		url:"send_ajax.php",
	    		method:"POST",
	    		data:{
				cat:cat, 
				sub_cat:sub_cat
	    		},
	    		success:function (data) {
	    			$("#f1_form").trigger('reset')
	    			$('#f1_notify').empty()
	    			$('#f1_notify').fadeIn().append('<div class="col s12 green lighten-4" style="padding:10px; text-align: center"> Datos Enviados Correctamente </div>')
						setTimeout(function (){
				            $('#f1_notify').fadeOut('slow')
							},2000)
			    }
		    })
        }
	 })

    $('#f2_cat').on('change', function() {
	    var cate= $(this).val()
	    $('#f2_scat').attr('style', 'visibility: visible')
	         $.ajax({
    		     url: 'bring.php',
    		     type: 'POST',
    		     data: 'id_cat='+ cate,
    	         })
    	            .done(function(res) {
    		        $('#f2_scatsel').empty();
    		        $('#f2_scatsel').append('<option  value="" disabled selected >Seleccione la Sub-Categoría</option>')
    		  	    res = JSON.parse(res);
    		        res.forEach(function(res){
			         $('#f2_scatsel').append('<option value="' +res.cod_subcat+'">'+res.subcat+'</option>')
		             })
    		        $('#f2_scatsel').material_select()
	                 })

    	           .fail(function() {
		             console.log("error")
	                })

    	           .always(function() {
		             console.log("complete")
	     });
     });

    $('#f2_submit').on('click', function(event) {
	    event.preventDefault();
    	var f2_cat= $('#f2_cat').val()
	    var f2_scatsel= $('#f2_scatsel').val()
	    var f2_tags= $('#f2_tags').val()
		if (f2_cat == '' || f2_scatsel == '' || f2_tags == ''){
			$('#f2_notify').empty();
			$('#f2_notify').fadeIn().append('<div class="col s12 red lighten-4" style="padding:10px; text-align: center"> Introduzca los datos completos </div>');
				setTimeout(function (){
				$('#f2_notify').fadeOut('slow')
				},2000);		
		}else{	
			$.ajax({
			    url:"send_ajax.php",
				method:"POST",
				data:{
					f2_cat:f2_cat, 
					f2_scatsel:f2_scatsel, 
					f2_tags:f2_tags},
				success:function (data) {
					$("#f2_form").trigger('reset')
					$('#f2_notify').empty()
					$('#f2_notify').fadeIn().append('<div class="col s12 green lighten-4" style="padding:10px; text-align: center"> Datos Enviados Correctamente </div>')
						setTimeout(function (){
						$('#f2_notify').fadeOut('slow')
						},2000)					}
		     })
		 }
	 })

    $('#f3_file').on('change',function() {
	    var fileread = new FileReader()
	    fileread.onload = function(event){
        image_crop.croppie('bind', {
       		 url: event.target.result
             }).then(function(){   
             })
        }	
        fileread.readAsDataURL(this.files[0])
	    $('#modalimagecrop').modal('open')
	    $('#hiddenmodalid1').val('#f3_img_preview_img')
	    $('#hiddenmodalid2').val('#f3_remove_button')
	    $('#hiddenmodalid3').val('#f3_path')
     })

    $(document).on('click', '#f3_remove_button', function(){
        if(confirm("¿Deseas eliminar esta imagen?")){  
            var path = $('#f3_img_preview_img').attr('src')
            console.log(path);
            $.ajax({  
                url:"delete.php",  
                type:"POST",  
                data:{path:path},  
                success:function(data){  
                    if(data != ''){
                    	$("#f3_file").val('') 
                        $("#f3_fileroute").val('') 
                        $('#f3_img_preview_img').attr('src', 'img/profile.png')
                        $('#f3_remove_button').css('visibility', 'hidden')
                        $('#f3_notify').empty()
						$('#f3_notify').fadeIn().append('<div class="col s12 yellow lighten-4" style="padding:10px; text-align: center"> '+data+'</div>')
						    setTimeout(function (){
						    $('#f3_notify').fadeOut('slow')
						    },5000);
                     }      
                 }  
                })  
        }else{  
            return false 
        }  
     }) 

    $(document).on('click', '#f4_remove_button', function(){  
           if(confirm("¿Deseas eliminar esta imagen?"))  
           {  
                var path = $('#f4_img_preview_img').attr('src');
                console.log(path);

                $.ajax({  
                     url:"delete.php",  
                     type:"POST",  
                     data:{path:path},  
                     success:function(data){  
                          if(data != '')  
                          {    $("#f4_file").val(''); 
                               $("#f4_fileroute").val(''); 
                               $('#f4_img_preview_img').attr('src', 'img/profile.png');
                               $('#f4_remove_button').css('visibility', 'hidden');
                               $('#f4_notify').empty();
						       $('#f4_notify').fadeIn().append('<div class="col s12 yellow lighten-4" style="padding:10px; text-align: center"> '+data+'</div>');
						       setTimeout(function (){
						       $('#f4_notify').fadeOut('slow');
											},5000);
                      
                           }      
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
     }); 

    $('#img_modalsubmit').click(function(event){
        image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
            }).then(function(response){
            $.ajax({
                url:"upload.php",
                type: "POST",
                data:{"image": response},
                success:function(data){
                    $('#modalimagecrop').modal('close');
                    $($('#hiddenmodalid1').val()).attr('src', data);
                    $($('#hiddenmodalid2').val()).css('visibility', 'visible');
                    $($('#hiddenmodalid3').val()).val(data)
                 }
             })
         })
     })

    var image_crop = $('#f3_img_preview')
        .croppie({
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

    $('#f3_form').on('submit', function(e){
        e.preventDefault();
        var f3_name		= $('#f3_name').val()
	    var f3_input2	= $('#f3_input2').val()
	    var f3_pais		= $('#f3_pais').val()
        var f3_sel		= $('#f3_sel').val()
        var f3_path 	= $('#f3_path').val()
        var f3_url 		= $('#f3_url').val()
	    if (f3_name == '' || f3_input2 == '' || f3_pais == ''|| f3_sel == ''){
			 $('#f3_notify').empty();
			 $('#f3_notify').fadeIn().append('<div class="col s12 red lighten-4" style="padding:10px; text-align: center"> Introduzca los datos completos </div>')
			     setTimeout(function (){ 
				 $('#f3_notify').fadeOut('slow')
				 },3000)
	    }else{
             var form= "f3"
             $.ajax({  
                url:"send_ajax.php",  
                method:"POST",
                data:{
                	f3_path:f3_path,
					f3_name:f3_name,
					f3_input2:f3_input2,
					f3_pais:f3_pais,
					f3_sel:f3_sel,
					f3_url:f3_url,
					form:form},  
                success:function(data)  
                    {console.log(data)
                    $("#f3_form").trigger('reset')
					$('#f3_notify').empty()
					$('#f3_img_preview_img').attr('src', 'img/profile.png')
                    $('#f3_remove_button').css('visibility', 'hidden')
					$('#f3_notify').fadeIn().append('<div class="col s12 green lighten-4" style="padding:10px; text-align: center"> '+data+'</div>');
						   setTimeout(function (){
						    $('#f3_notify').fadeOut('slow')
							},5000);                 
                    }  
             }) 
         } 
     }) 

    $('#f4_form').on('submit', function(e){
        e.preventDefault();
        var form 		= "f4"
		var f4_name 	= $('#f4_name').val()
		var f4_contra 	= $('#f4_contra').val()
		var f4_contra2 	= $('#f4_contra2').val()
		var f4_nivel 	= $('#f4_nivel').val()
        var f4_mail 	= $('#f4_mail').val()
        var f4_path 	= $('#f4_path').val()

        if (f4_name == '' || f4_nivel == '' || f4_contra == '' || f4_contra2 == ''){
		    $('#f4_notify').empty()
		    $('#f4_notify').fadeIn().append('<div class="col s12 red lighten-4" style="padding:10px; text-align: center"> Datos Incompletos</div>')
		        setTimeout(function (){
				$('#f4_notify').fadeOut('slow')
				},5000)
	    }else{
			$.ajax({
				url: 'send_ajax.php',
				method: 'POST',
				data: {
					f4_name: f4_name,
				    f4_contra: f4_contra,
				    f4_nivel: f4_nivel,
				    form: form,
				    f4_mail: f4_mail,
				    f4_path:f4_path	
				    },
				success:function(data)  
                    {console.log(f4_path)
                    
                    $("#f4_form").trigger('reset')
                    $('#f4_img_preview_img').attr('src', 'img/profile.png')
                    $('#f4_remove_button').css('visibility', 'hidden')
					$('#f4_notify').empty()
                    console.log(f4_path)
					$('#f4_notify').fadeIn().append('<div class="col s12 green lighten-4" style="padding:10px; text-align: center">'+data+'</div>')
							setTimeout(function (){
						    $('#f4_notify').fadeOut('slow')
							},5000);  
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
     })


/* 


*/






});
</script>
<script>
/*


            $.ajax({  
                url:"send_ajax.php",  
                method:"POST",  
                data:{
                	f4_name:f4_name,
					f4_contra:f4_contra,
					f3_pais:f3_pais,
					f4_mail:f4_mail,
					form:form},  
                    success:function(data)  
                {       console.log(data);
                       $("#f4_form").trigger('reset');
						$('#f4_notify').empty();
						$('#f4_img_preview_img').attr('src', 'img/profile.png');
                        $('#f4_remove_button').css('visibility', 'hidden');
						$('#f4_notify').fadeIn().append('<div class="col s12 green lighten-4" style="padding:10px; text-align: center"> '+data+'</div>');
						   setTimeout(function (){
						    $('#f4_notify').fadeOut('slow');
												},5000); 
                }  				
			})
			.done(function() {
				console.log("Exito"+data);
			})
			.fail(function() {
				console.log("error"+data);
			});



});














/*





*/
</script>



</html>
