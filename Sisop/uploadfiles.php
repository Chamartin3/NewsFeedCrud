<?php

$f3_name=$_POST['f3_name'];
$f3_input2=$_POST['f3_input2'];
$f3_pais=$_POST['f3_pais'];
$f3_sel=$_POST['f3_sel'];


 if($_FILES['f3_file']['name'] != '')  
 {  

 if ($_FILES['f3_file']['error'] == 1) {
         echo '<script>alert("El achivo es demasiado grande")</script>';
  }else{
          $nn = $_POST['f3_name'];
          $preextension = explode(".", $_FILES['f3_file']['name']); 
          $extension =strtolower(end($preextension));

          $allowed_type = array("jpg", "jpeg", "png", "gif");  
          if(in_array($extension, $allowed_type))  
          {  
               $new_name = strtolower($nn) . "." . $extension;  
               $path = "img/" . $new_name;  
               if(move_uploaded_file($_FILES['f3_file']['tmp_name'], $path))  
               {  
                    echo 'Datos subidos correctamente';  
               }  
          }  
          else  
          {  
               echo "Tipo de archivo invalido";
          } 
     } 
 };

 ?>  



