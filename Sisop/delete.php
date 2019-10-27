 <?php

include 'conex.php';



 if(!empty($_POST["path"]))  
 {  
      if(unlink($_POST["path"]))  
      {  
      	
        $id=$_POST["id"];
      
		$queryup= 'UPDATE users SET foto="img/profile.png"
 							 WHERE id=:id;';
		$stm=$conecta->prepare($queryup);
		$stm->bindParam(":id",$id);
		$stm->execute();
		echo 'Imagen Borrada';  
          
      }  
 }  

 ?>  