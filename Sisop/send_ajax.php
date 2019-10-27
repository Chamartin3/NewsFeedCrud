<?php require 'conex.php';


$conecta->exec("SET CHARACTER SET utf8");




if ($_POST['proposito']=="new_tags") {

	$dependiente='SELECT max(dep) AS ch from tags WHERE cod_scat="0-0"';
	$stm_dep=$conecta->prepare($dependiente);
	$stm_dep->execute();
		while ($r = $stm_dep->fetch(PDO::FETCH_ASSOC)) {$string_coddep=($r["ch"]);};

		$int_codep=intval($string_coddep)+1;
		$new_tags	= array();
		$new_tags 	= explode(',',$_POST['new_tags']);	

	$qntags='INSERT INTO tags (datetime,cod_scat, tag,dep)
                             VALUES (NOW(),"0-0", :tag, :dep);';
		$stm=$conecta->prepare($qntags);
		$count=0;

		foreach ($new_tags as $nt) {
	
			$stm->bindParam(":tag",$nt);
			$stm->bindParam(":dep",$int_codep);
			$stm->execute();
			$count++;
			echo '{"tag":"'.$nt.'", "catag":"0","cod_tag":"0-0-'.$int_codep.'"}/';
			$int_codep++;			
   		}		
}






if ($_POST['proposito']=="reg_titulares") {


	$t_tags= array();
	
	$t_titular	= $_POST['t_titular'];
	$t_date		= $_POST['t_date'];
	$t_medio	= intval($_POST['t_medio']);
	$t_tags 	= explode(',',$_POST['t_tags']);
	$user 		= $_POST['t_user'];


	$query_tit='INSERT INTO titulares (fecha_de_registro, fecha_noticia, medio, registrador, titular)
			   VALUES (NOW(), :fecha, :medio, :user, :titular)';
    
    $stm=$conecta->prepare($query_tit);

    $stm->bindParam(":titular",	$t_titular);
	$stm->bindParam(":fecha",	$t_date);
	$stm->bindParam(":user",	$user);
	$stm->bindParam(":medio",	$t_medio);

	$result=$stm->execute();
    $idtit=$conecta->lastInsertId();	
	if ($result) {
			
		echo '<div class="col s12 green lighten-4" style="text-align: center; position: absolute;"> Datos insertados correctamente insertados</div>';

		$query_nexo='INSERT INTO tagsxtitular (id_tit, id_tag)
					 	  VALUES (:tit,:tag)';			

		$stm2=$conecta->prepare($query_nexo);
		$count=0;

		foreach ($t_tags as $tag) {

		$intit=intval($idtit);	
			$stm2->bindParam(":tit",$idtit);	
			$stm2->bindParam(":tag",$tag);	
			$result2=$stm2->execute();
			echo $t_tags;
	
		$count++;

		};
			if (!$result2) {
				echo '<div class="col s12 red lighten-4" style="text-align: center; position: absolute;"> Error en tags </div>';
			};
	}else{
		echo '<div class="col s12 red lighten-4" style="padding:10px; text-align: center; position: absolute;"> Error </div>';		
	};	
};



if ($_POST['proposito']=="update"){

	$id = $_POST['id'];


	if (!empty($_POST['f4_path'])) { 
		$foto = $_POST['f4_path'];
	}else{
   		$foto = 'img/profile.png';
	};

 	$nombre = $_POST['f4_name'];

 	$nivel = intval($_POST['f4_nivel']);
 
 	$email = $_POST['f4_mail'];


	if (!empty($_POST['f4_contra'])) {
		$contra = $_POST['f4_contra'];
		$contraencript= password_hash($contra, PASSWORD_BCRYPT);	
	 	$queryup= 'UPDATE users SET 
	 		username=:nombre,
	 		contra=:contra,
	 		nivel=:nivel,
	 		foto=:foto,
	 		email=:email
	 		WHERE id=:id;';

	$stm=$conecta->prepare($queryup);
        $stm->bindParam(":id",$id);
		$stm->bindParam(":nombre",$nombre);
		$stm->bindParam(":contra",$contraencript);
		$stm->bindParam(":nivel",$nivel);
		$stm->bindParam(":foto",$foto);
		$stm->bindParam(":email",$email);

	 }else{
	 	$queryup= 'UPDATE users SET 
	 		username=:nombre,
	 		nivel=:nivel,
 			foto=:foto,
	 		email=:email
	 		WHERE id=:id;';

	 	$stm=$conecta->prepare($queryup);
        $stm->bindParam(":id",$id);
		$stm->bindParam(":nombre",$nombre);
		$stm->bindParam(":nivel",$nivel);
		$stm->bindParam(":foto",$foto);
		$stm->bindParam(":email",$email);
	 };


	$stm->execute();
};

if ($_POST['proposito']=="new") {

	if (isset( $_POST['f4_name']) && isset($_POST['f4_contra']) && isset($_POST['f4_nivel'])) {

		if (isset($_POST['f4_path'])) { 
			$logo = $_POST['f4_path'];
		}else{
   		   	$logo = 'img/profile.php';
		};

 		$contra = $_POST['f4_contra'];
 		$contraencript= password_hash($contra, PASSWORD_BCRYPT);
		$nombre = $_POST['f4_name'];
		$nivel = intval($_POST['f4_nivel']);
 		$email = $_POST['f4_mail'];

 //if (isset($_POST['f3_url'])) {
 	//$url= filter_var($_POST['f3_url'], FILTER_SANITIZE_URL);
 //};
		$querymedios= 'INSERT INTO users 
							(username,contra,nivel,foto,email)
                        VALUES 
                             (:nombre,:contra, :nivel, :logo,:email);';

			$stm=$conecta->prepare($querymedios);
			$stm->bindParam(":nombre",$nombre);
			$stm->bindParam(":contra",$contraencript);
			$stm->bindParam(":nivel",$nivel);
			$stm->bindParam(":logo",$logo);
			$stm->bindParam(":email",$email);
			$stm->execute();

			echo "Los Datos fueron registrados correctamente";
	} 
};

if ($_POST['form']="f3") {

	if (isset( $_POST['f3_name']) && isset($_POST['f3_input2']) && isset($_POST['f3_sel'])) {

 		$logo = $_POST['f3_path'];
 		$nombre = $_POST['f3_name'];
 		$tipo = $_POST['f3_input2'];
 		$pais = $_POST['f3_pais'];
 		$naturaleza = $_POST['f3_sel'];

 		if (isset($_POST['f3_url'])) {
 			$url= filter_var($_POST['f3_url'], FILTER_SANITIZE_URL);
 		};


		$querymedios= 'INSERT INTO medio (nombre, naturaleza, tipo, pais, logo, url)
                             VALUES (:nombre,:naturaleza, :tipo, :pais, :logo,:url);';

		$stm=$conecta->prepare($querymedios);
		$stm->bindParam(":nombre",$nombre);
		$stm->bindParam(":naturaleza",$naturaleza);
		$stm->bindParam(":tipo",$tipo);
		$stm->bindParam(":pais",$pais);
		$stm->bindParam(":logo",$logo);
		$stm->bindParam(":url",$url);
		$stm->execute();

		echo "Los Datos fueron registrados correctamente";		
	} 
};

if (isset($_POST['f2_cat']) && isset($_POST['f2_scatsel']) && isset($_POST['f2_tags'])){


	$scat=$_POST['f2_scatsel'];
	$tag=$_POST['f2_tags'];


	$dependiente='SELECT max(dep) AS ch from tags WHERE cod_scat=:scat';
	$stm_dep=$conecta->prepare($dependiente);
	$stm_dep->bindParam(":scat",$scat);
	$stm_dep->execute();
		while ($r = $stm_dep->fetch(PDO::FETCH_ASSOC)) {
			$string_coddep=($r["ch"]); 
		 	};
	$int_codep=intval($string_coddep)+1;




	$insert='INSERT INTO tags (datetime,cod_scat, tag,dep)
                             VALUES (NOW(),:subcat, :tag, :dep);';
	$stm=$conecta->prepare($insert);
	$stm->bindParam(":tag",$tag);
	$stm->bindParam(":subcat",$scat);
	$stm->bindParam(":dep",$int_codep);
	$stm->execute();
};

if (isset($_POST['cat']) && isset($_POST['sub_cat'])) {
	$cat=       intval($_POST['cat']);
	$subcat=	$_POST['sub_cat'];


	$codhijo='SELECT max(cod_hijo) AS ch from sub_categorias WHERE cod_parent=:cat';
	$stm_codhijo=$conecta->prepare($codhijo);
	$stm_codhijo->bindParam(":cat",$cat);
	$stm_codhijo->execute();
 		while ($r = $stm_codhijo->fetch(PDO::FETCH_ASSOC)) {
			$string_codhijo=($r["ch"]); 
			};

	$int_codhijo=intval($string_codhijo)+1;



	$insert='INSERT INTO sub_categorias (cod_parent, cod_hijo, subcat)
                             VALUES (:cat,:codhijo,:subcat);';

	$cat=intval($cat);
	$stm=$conecta->prepare($insert);
		$stm->bindParam(":cat",$cat);
		$stm->bindParam(":subcat",$subcat);
		$stm->bindParam(":codhijo",$int_codhijo);
		$stm->execute();
};
?>