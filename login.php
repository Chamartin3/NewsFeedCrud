<?php session_start();

if (isset($_SESSION['user']['name'])) {

    header('Location:home.php'); 
 
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
  <meta name="author" content="Vincent Garreau" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <!-- Compiled and minified JavaScript   <div class="col s1 offset-s3 offset-m4 offset-l4" >
             <img src="Sisop/img/panop.png" class="responsive-img circle center-align hoverable" style="width: 70px;height: 70px;position: absolute; margin-left: 15vw"> -->
<script    src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/sisanimate.css">

</head>

<body  id="particles-js" style="background-color: #0317B0">


      <!--  <div class="col s1 offset-s3 offset-m4 offset-l4" >
             <img src="Sisop/img/panop.png" class="responsive-img circle center-align hoverable" style="width: 70px;height: 70px;position: absolute; margin-left: 15vw"> -->

    <div  class="container" style="position: absolute; margin-left: 5vw" >

<div class="col s1 offset-s3 offset-m4 offset-l4" >
<img src="Sisop/img/panop.png" id="sisop" class="responsive-img circle "> 
</div>
             <div class="row" style="margin-top: 180px;margin-bottom: 20px">
             <div class="col s1">
             </div>     
            </div>
           <div class="row" style="margin-top: 20px">


           <div class="col l5 m6 s12 offset-l5 offset-m4" style="background-color: rgba(255, 255, 255, 0.8);border-radius: 15px;">
                 <form id=form_login>
                  <div class="row">
                    <br>
                  </div>
                        <div class="row"> 
                            <div class="input-field col s12">
                              <i class="material-icons prefix">account_circle</i>
                              <input  required id="username" name="username" type="text" class="validate">
                              <label for="username">Usuario</label>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="input-field col s12">
                              <i class="material-icons prefix">vpn_key</i>
                              <input required pattern="[A-Za-z0-9._+-]{8,}" id="password" name="password" type="password" class="validate">
                              <label for="password">Contraseña</label>
                           </div>
                        </div>

                        <div class="row">
                          <div class="input-field col s6 offset-s4 offset-m3">
                             <input type="submit" id="submit" name="submit" class="btn blue darken-3" value="Entrar">
                        </div>
                        </div>
                        <div class="row">
                          <div id=login_notify class="col s12">
                        </div>

                      
                </form>
        </div>

    </div>
</div>
</div>






<!-- scripts -->




<script>
  $(document).ready(function(){

$('#form_login').on('submit', function(event) {
    event.preventDefault();
    var username = $('#username').val()
    var password = $('#password').val()
    $('#login_notify').empty()
    console.log(username)
    console.log(password)
    $.ajax({
      url: 'logn_verify.php',
      type: 'POST',
      data: {
        username: username,
        password: password,
        },
      success:function(data){
        $('#login_notify').fadeIn('fast')
        $('#login_notify').delay(4000).fadeOut('slow') 
        if (data=="exito") {
           $('#login_notify').append('<div ID="notify" class="col s12 green lighten-4" style="padding:10px; text-align: center">verificando </div>')
           $('#sisop').attr('id', 'sisopspin')
                setTimeout(function (){
               $(location).attr('href','home.php')
               },1000);
        }else{
          $('#form_login').trigger('reset')
          $('#login_notify').append(data)
        }

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
    

});





 });


</script>






<script src="js/particles.min.js"></script>
<script src="js/app.js"></script>

<!-- stats.js -->

</script>

</body>
</html>