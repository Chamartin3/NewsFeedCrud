<script src="modal_users.js"></script>
<div id="modalusers" class="modal modal-fixed-footer">
    <div class="modal-content">
    <h4 style="color: #0d47a1" id=titulomodal>Agregar Usuario</h4>
        <form id="f4_form">
            <div class="row">
		          <div id=f4_notify></div>
            </div>
            <div class="row">
                    <div class="col m6 s12">
                        <div class="row"> 
        		            <div class="input-field col  s12">
          				        <i class="material-icons prefix">account_circle</i>
          				        <input required pattern="[A-Za-z0-9._+-]{6,}" id="f4_name" type="text" class="validate">
          				        <label data-error="Error: El nombre  debe ser de minimo 6 caracteres sin espacios"  for="f4_name" >Nombre de Usuario</label>
        			        </div>
            	        </div>
          	            <div class="row"> 
                        	<div class="input-field col  s12">
          	         		<i class="material-icons prefix">email</i>
          	         		<input  id="f4_mail" type="email" class="validate">
          	         		<label for="f4_contra2" data-error="Error: introduzca un correo valido" >Correo Electrónico</label>
        	           	    </div>
          	            </div>

            	       <div class="row">	
			                <div class="input-field col  s12">
			                     <i class="material-icons prefix">vpn_key</i>
			                     <input required pattern="[A-Za-z0-9._+-]{8,}" id="f4_contra" type="password" class="validate">
			                     <label data-error="Error: La contraseña debe ser de minimo 8 caracteres sin espacios" for="f4_contra">Contraseña</label>
			                </div>
          	            </div>
          	            <div class="row">	
			                <div class="input-field col  s12">
			                <i class="material-icons prefix">vpn_key</i>
			                <input  required pattern="[A-Za-z0-9._+-]{8,}" id="f4_contra2" type="password" class="validate">
			                <label for="f4_contra2">Confirmación de Contraseña</label>
			                </div>
	                    </div>

                      <div class="row">
                          <div id=select_nivel class="input-field col  s12">
                            <select  id="f4_nivel"> 
                             <option value="" disabled selected>Nivel</option>
                              <option value="4">Administrador</option>
                              <option value="3">Supervisor</option>
                              <option value="2">Registrador</option>
                              <option value="1">Cliente</option>
                             </select>
                             <label>Nivel</label>
                        </div>     
                      </div>
<div class="row">
                     <div class="input-field col s6">
          <div id=t_tags class="chips chips-autocomplete chips-placeholder"></div>
                        <label for="t_date">Fecha de la Noticia</label>
                      </div>
</div>
                    </div>
                    <div class="col m6 s12">
                      <div class="row"> 
                          <div> 
                              <img id='f4_img_preview_img' class="responsive-img circle center-align hoverable" src="Sisop/img/profile.png" style="height: 270px ; width:270px; position:absolute;margin-left: 10px;">
                              <a class="btn-floating btn-large waves-effect waves-light red" id="f4_remove_button" style="margin-top: 240px;margin-left: 10px; visibility: hidden">
                              <i class="md-48 material-icons" style="font-size: 36px">delete_forever</i>
                            </a>
                            <div name="f4_path" id="f4_path" style="position:absolute;visibility: hidden"></div>  
                          </div> 
                      </div>
                        <div class="row"> 
        					        <div class="col s12"  >
			  	                <div id="f4_file_field" class="file-field input-field" >
		    				              <div class="btn blue darken-4">
		     				               <span><i class="material-icons">file_upload</i></span>
		       			                <input type="file" id='f4_file'> 
		        			           </div>
		   		      		        <div class="file-path-wrapper">
		             			        <input class="file-path validate" id='f4_fileroute' type="text" placeholder="Imagen de Usuario">
		        			          </div>
    		    			        </div>

<!----> 				    </div> 
				        </div>
				    </div>
			</div>
           
    </div>	   
    <div class="modal-footer">
      <input type="submit" id="f4_submit" name="f4_submit" class="waves-effect  btn-flat">
    </div>
    <div id="propositomodal" style="visibility: hidden;"></div>
    <div id="iduser" style="visibility: hidden;"></div>
</form> 
</div>
 



<div id="modalimagecrop" class="modal" style="height: 800px; width:400px">    

        <div class="modal-content">
            <div class="row">
    			<h4 style="text-align:center">Recortar imagen </h4>
    			<div class="col s3 offset-s2">
    			     <div class="input-field " id='crop_img_preview' name='crop_img_preview'  style="width:200px; height: 200px;">
    			     </div>
                </div>
            </div> 
        </div>  
        <div class="modal-footer">         
            <div class="row">
    			<div class="col s3 offset-s1">
    				<input type="button" id="img_modalsubmit" name="img_modalsubmit" class="btn blue darken-3" value="Recortar" style="width:200px; margin-left: 45px";>
    			    <div id="hiddenmodalid1" style="visibility: hidden;"></div>
    			    <div id="hiddenmodalid2" style="visibility: hidden;"></div>
    			    <div id="hiddenmodalid3" style="visibility: hidden;"></div>
              <div id="locationid" name='users' style="visibility: hidden;"></div>
              <div id="imagepath" style="visibility: hidden;"></div>
    			</div>
    		</div>
        </div>		
</div>
