<?php



//login.php



include('admin/database_connection.php');



session_start();



if(isset($_SESSION["apoderado_id"]))

{

  header('location:index.php');

}





?>



<!DOCTYPE html>

<html lang="en">

<head>

  <title>Iniciar Sesión - Apoderado</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>



</head>

<body>

<!--Login-->

<div class="container text-center" style="padding-top: 40px;">
  <img src="logo.png" alt="..." class="img-fluid" style="padding-bottom: 20px;" width="80px">
  <h6 class="text-center fw-bolder">Accezz</h6>
</div>
<div class="position-absolute bottom-0 start-50 translate-middle-x">


</div>

<div class="container">

  <div class="row">

    <div class="col-md-4">



    </div>

    <div class="col-md-4" style="margin-top:20px;">

      <div class="card shadow">

        <div class="card-header">Plataforma Apoderado</div>

        <div class="card-body">

          <h3 class="fw-bolder">Bienvenido(a)</h3>

          <span class="">Ingrese sus datos para Acceder</span>

          <hr>

          <form class="" method="post" id="apoderado_login_form">

            <div class="mb-3 col-auto">

              <input placeholder="Correo" type="text" name="apoderado_emailid" id="apoderado_emailid" class="form-control" />

              <span id="error_apoderado_emailid" class="text-danger"></span>

            </div>

            <div class="mb-3 col-auto">

              <input placeholder="Contraseña" type="password" name="apoderado_password" id="apoderado_password" class="form-control" />

              <span id="error_apoderado_password" class="text-danger"></span>

            </div>

            <div class="mb-3 col-auto">

              <input type="submit" name="apoderado_login" id="apoderado_login" class="btn btn-dark" value="Ingresar" />

            </div>

          </form>

        </div>

      </div>

    </div>
    <div class="container text-center" style="padding-top: 15px;">
    <div class="text-center">
      <div class="btn-group shadow">
        <a href="../" class="btn btn-secondary" >Docente</a>
        <a class="btn btn-secondary  active" aria-current="page">Apoderado</a>
        <a href="../admin/" class="btn btn-secondary">Admin</a>
      </div> 

  </div>

</div>



</body>

</html>



<script>

$(document).ready(function(){

  $('#apoderado_login_form').on('submit', function(event){

    event.preventDefault();

    $.ajax({

      url:"check_apoderado_login.php",

      method:"POST",

      data:$(this).serialize(),

      dataType:"json",

      beforeSend:function(){

        $('#apoderado_login').val('Validando...');

        $('#apoderado_login').attr('disabled','disabled');

      },

      success:function(data)

      {

        if(data.success)

        {

          location.href="index.php";

        }

        if(data.error)

        {

          $('#apoderado_login').val('Login');

          $('#apoderado_login').attr('disabled', false);

          if(data.error_apoderado_emailid != '')

          {

            $('#error_apoderado_emailid').text(data.error_apoderado_emailid);

          }

          else

          {

            $('#error_apoderado_emailid').text('');

          }

          if(data.error_apoderado_password != '')

          {

            $('#error_apoderado_password').text(data.error_apoderado_password);

          }

          else

          {

            $('#error_apoderado_password').text('');

          }

        }

      }

    })

  });

});

</script>