<?php

echo '<style type="text/css">.unexistent {visibility: hidden;}</style>';
function Level($lvl,$permit){
	if($lvl <= ($permit-1)) {
        echo '"unexistent';
    }else{
        echo '""';
     };
};

function propic($img){
	if (isset($img)) {
         echo ("Sisop/".$_SESSION['user']['img']);
    }else{
         echo "Sisop/img/profile.png ";
     };
};

function ididentify(){
    echo "'".$_SESSION['user']['id']."'";
};


?>