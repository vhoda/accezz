<?php
//login.php
include('admin/database_connection.php');
session_start();

if(isset($_SESSION["teacher_id"]))
{
  header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Iniciar Sesión - Docente</title>
  <link rel="icon" type="image/png" href="logo.png" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
        function info(){
            swal({
          title: "Accezz",
          text: "Es una plataforma web que Registra y administra alumnos y docentes en 1 solo entorno",
          icon: "info",
          button: "OK",
        });
    }
    </script>	
</head>
<body>
<!--Login-->
<div class="container text-center" style="padding-top: 30px;">
  <img src="logo.png" alt="..." class="img-fluid" style="padding-bottom: 15px;" width="80px">
  <h4 class="text-center fw-bolder">Accezz</h4>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4" style="margin-top:20px;">

      <div class="card shadow">
        <div class="card-header">Plataforma Docente</div>
        <div class="card-body">

          <h3 class="fw-bolder">Bienvenido(a)</h3>
          <span class="">Ingrese sus datos para Acceder</span>
          <hr>

          <form class="" method="post" id="teacher_login_form">
            <div class="mb-3 col-auto">
              <input placeholder="Correo" type="text" name="teacher_emailid" id="teacher_emailid" class="form-control" />
              <span id="error_teacher_emailid" class="text-danger"></span>
            </div>
            <div class="mb-3 col-auto">
              <input placeholder="Contraseña" type="password" name="teacher_password" id="teacher_password" class="form-control" />
              <span id="error_teacher_password" class="text-danger"></span>
            </div>
            <div class="mb-3 col-auto">
              <input type="submit" name="teacher_login" id="teacher_login" class="btn btn-dark" value="Ingresar" />
              <a href="#" onclick="info()" ><i class="bi bi-info-square-fill text-dark" style="font-size: 1.5rem;"></i></a>
            </div>
          </form>

        </div>
      </div>
    </div>
    <div class="container text-center" style="padding-top: 15px;">
    <div class="text-center">
      <div class="btn-group shadow">
        <a class="btn btn-secondary active" aria-current="page">Docente</a>
        <a href="./apoderado/" class="btn btn-secondary">Apoderado</a>
        <a href="./admin/" class="btn btn-secondary">Admin</a>
      </div> 
    </div>
  </div>
</div>
<span class="position-absolute bottom-0 start-0 badge text-bg-success">Build Ready 1.0</span>

</body>
</html>

<script>

$(document).ready(function(){

  $('#teacher_login_form').on('submit', function(event){

    event.preventDefault();

    $.ajax({

      url:"check_teacher_login.php",

      method:"POST",

      data:$(this).serialize(),

      dataType:"json",

      beforeSend:function(){

        $('#teacher_login').val('Validando...');

        $('#teacher_login').attr('disabled','disabled');

      },

      success:function(data)

      {

        if(data.success)

        {

          location.href="index.php";

        }

        if(data.error)

        {

          $('#teacher_login').val('Login');

          $('#teacher_login').attr('disabled', false);

          if(data.error_teacher_emailid != '')

          {

            $('#error_teacher_emailid').text(data.error_teacher_emailid);

          }

          else

          {

            $('#error_teacher_emailid').text('');

          }

          if(data.error_teacher_password != '')

          {

            $('#error_teacher_password').text(data.error_teacher_password);

          }

          else

          {

            $('#error_teacher_password').text('');

          }

        }

      }

    })

  });

});

</script>