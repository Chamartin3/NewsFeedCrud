
  <?php

 if (($_SESSION['user']['lvl']<0)) {
    header('Location: /login.php');
};
include 'Sisop/bring.php';
?>


<link rel="stylesheet" href="css/materialize-tags.min.css">


  <div style="max-height: 150vh" id="modaltitulares" class="modal">
    <div class=modal-content>
      <div class="row">
        <div class="col s9">
          <h4 id="t_titulomodal">Registro de Titulares</h4>
        </div>
        <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="t_user"></div>
        </div>
        <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="propositomodal"></div>
        </div>
        <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="t_id"></div>
        </div>        
      </div>
        <div id="t_notify" class="input-field col s12"> </div>
    
 <form  id="t_form" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input required placeholder="Titular" id="t_titular" type="text" class="validate">
          <label for="t_titular">Titular</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s6">
          <input required type="text" id="t_date" class="datepicker">
          <label for="t_date">Fecha de la Noticia</label>
       </div>


        <div id="t_medio_select" class="input-field col s6"> 
          <select required id="t_medio" name="t_medio">
              <option value="" disabled selected>Seleccione el Medio</option>
              <?php
               $medios=bringmedios();
               foreach ($medios as $c) {
               echo '<option value="' .$c['id'].'">'.$c['nombre'].'</option>';
                }?>
           </select>
          <label>Medio de Comunicación</label>
        </div>
      </div>


    <div class="row">
         <div class="input-field col s11">  
               <input required type="text" id="t_tags-autoselect" class="typehead-input" data-role="materialtags"/>
               <label for="t_tags-autoselect">Etiquetas de la Noticia</label>
         </div>
         <div class="input-field col s1">
          <a id="newtags" class="waves-effect waves-light btn-floating tooltipped" data-position="top" data-delay="50" data-tooltip="Agregar etiquetas nuevas"><i class="material-icons left">add</i></a>  
         </div>         
         
    </div>
  </form>
</div>
    <div class=modal-footer>
      <div class="row">
      <a id="tsubmit_t" style="height: 70px; text-align:center;" class="modal-action waves-effect waves-green btn-flat col s4 tsubmit">Enviar y nuevo titular</a>
      <a id="tsubmit_f" style="height: 70px; text-align:center;" class="modal-action waves-effect waves-green btn-flat col s4 tsubmit">Enviar y nueva fecha</a>
      <a id="tsubmit_s" style="height: 70px; text-align:center;" class="modal-action waves-effect waves-green btn-flat col s4 tsubmit">Enviar y terminar</a>
</div>
    </div>
  </div>



  <div  id="modalnewtags" class="modal bottom-sheet">
    <div id="tags_notify"></div>
    <div class=modal-content>
        <h4 id="tags_titulo">Agregar nuevos tags</h4>
         <div class="input-field col s12">  
               <input required type="text" id="tt_tags-autoselect" class="typehead-input" data-role="materialtags"/>
               <label for="tt_tags-autoselect">Nuevas Etiquetas</label>
         </div>
    </div>
       <div class=modal-footer>
         <div class="row">
          <a id="ttsubmit" style="text-align:center;" class="modal-action waves-effect waves-green btn-flat col s12">Agregar</a>
        </div>
      </div>
</div>






 <div style="max-height: 150vh" id="modaltags" class="modal">
    <div class=modal-content>
      <div class="row">
        <div class="col s9">
          <h4 id="tags_titulomodal">Registro de Tags</h4>
        </div>
        <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="tags_user"></div>
        </div>
            <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="tag_rowchanged"></div>
        </div>
          <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="cod_tag"></div>
        </div>
      </div>
        <div id="t_notify" class="input-field col s12"> </div>
    
 <form  id="tags_form" class="col s12">
  
<div class="row">
    <div id="select_cat" class="input-field col s6">
        <select id="tag_cat" name="tag_cat">
          <option value="" disabled selected>Seleccione la Categoría</option>
           <?php $catego=bringcats(); 
            foreach ($catego as $c) {
              echo '<option value="' .$c['id'].'">'.$c['cat'].'</option>';
             }?>

        </select>
        <label>Categoría</label>
    </div>

    <div style="visibility:hidden" id="tag_scat"  name="tag_scat" class="input-field col s5">
        <select  id="f2_scatsel" name="f2_scatsel" >
          <option  value="" disabled selected >Seleccione la Sub-Categoría</option>
    </select>
        <label>Sub-Categoría</label>
    </div>
    <div class="input-field col s1">
          <a id="newsubat" class="waves-effect waves-light btn-floating tooltipped modal-trigger" href="#modalnewsubcats" data-position="top" data-delay="50" data-tooltip="Agregar nueva"><i class="material-icons left">add</i></a>  
    </div>    



        <div class="input-field col s12">
          <input   placeholder="Nombre de Etiqueta" id="nametag" name='nametag' type="text" class="validate">
          <label for="tag">Etiqueta</label>
        </div>
</div>

</form>
</div>
    <div class=modal-footer>
      <a id="tagssubmit" style="height: 70px; text-align:center;" class="modal-action waves-effect waves-green btn-flat col s4 tsubmit">Enviar</a>
</div>
    </div>
  </div>


  <div  id="modalnewsubcats" class="modal" style="max-height: 500px;height: 500px">
    <div id="subcats_notify"></div>
    <div class=modal-content>
        <h4 id="tags_titulo">Nueva subcategoría</h4>
    <form class="col s12" id="f1_form" >
    <div class="row">
      <div id="sc_catselect" class="input-field col s6">
        <select required id="sc_cat" name="sc_cat" >    
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
          <input required placeholder="Nombre de subcategoría" id="scsub_cat" name="scsub_cat" type="text" class="validate">
          <label for="sub_cat">Sub-categoría</label>
        </div>
          </div>
      </form>
      </div>
       <div class=modal-footer>
         <div class="row">
          <a id="scatsubmit" style="text-align:center;" class="modal-action waves-effect waves-green btn-flat col s12">Agregar</a>
        </div>
      </div>
</div>






 <div style="max-height: 150vh" id="modalfuze" class="modal">
    <div class=modal-content>
      <div class="row">
        <div class="col s9">
          <h4 id="tags_titulomodal">Unir Tags</h4>
        </div>
        <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="fuze_user"></div>
        </div>
        <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="fuze_codtag"></div>
        </div> 
        <div class="col s1">
          <div style="visibility: hidden; position: absolute;" id="fuze_rowchanged"></div>
        </div>       
      </div>
        <div id="fuze_notify" class="input-field col s12"> </div>
    
 <form  id="fuze_form" class="col s12">  

<div class="row">
    <div  class="input-field col s6">
       <input placeholder=" "  disabled value="" id="fu_cat" type="text" >
      <label>Categoría</label>
    </div>

    <div id="fuze_select_cat" class="input-field col s6">
        <select id="fuze_cat" name="fuze_cat">
          <option value="" disabled selected>Seleccione la Categoría</option>
           <?php $catego=bringcats(); 
            foreach ($catego as $c) {
              echo '<option value="' .$c['id'].'">'.$c['cat'].'</option>';
             }?>
        </select>
        <label>Nueva Categoría</label>
    </div>

</div>

<div class="row">
    <div  class="input-field col s6">
      <input placeholder=" " disabled value="" id="fu_scat" type="text" >
        <label>Sub-Categoría</label>    
    </div>

    <div  id="fuze_scat"  name="fuze_scat" class="input-field col s6">
        <select placeholder=" " disabled id="fuze_scatsel" name="fuze_scatsel" >
          <option  value="" disabled selected >Seleccione la Sub-Categoría</option>
        </select>
        <label>Nueva Sub-Categoría</label>
    </div>

</div>

<div class="row">
      <div  class="input-field col s6">
        <input placeholder=" " disabled value="" id="fu_tag" type="text" >
        <label>Nombre</label>
      </div>

      <div class="input-field col s6" id="fuze_tag"  name="fuze_tag">
        <select  disabled id="fuze_tagsel" name="fuze_tagsel" >
          <option  value="" disabled selected >Seleccione la etiqueta</option>
        </select>
        <label>Nuevo Nombre</label>
      </div>


</div>

</form>
</div>
    <div class=modal-footer>
      <a id="fuzesubmit" style="height: 70px; text-align:center;" class="waves-effect waves-green btn-flat col s4">Enviar</a>
</div>
    </div>
  </div>


    <script src="addons/typeahead/typeahead.bundle.min.js"></script>
    <script src="addons/materialize-tags/js/materialize-tags.min.js"></script>
