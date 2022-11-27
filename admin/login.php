<?php

//login.php

include('database_connection.php');

session_start();

if(isset($_SESSION["admin_id"]))
{
  header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Accezz - Admin</title>
  <link rel="icon" type="image/png" href="logo.png" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
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
        <div class="card-header">Plataforma Administrador</div>
        <div class="card-body">
          <h3 class="fw-bolder">Bienvenido(a)</h3>
          <span class="">Ingrese sus datos para Acceder</span>
          <hr>

          <form method="post" id="admin_login_form">
            <div class="mb-3 col-auto">
              <input placeholder="Usuario" type="text" name="admin_user_name" id="admin_user_name" class="form-control" />
              <span id="error_admin_user_name" class="text-danger"></span>
            </div>
            <div class="mb-3 col-auto">
              <input placeholder="Contraseña" type="password" name="admin_password" id="admin_password" class="form-control" />
              <span id="error_admin_password" class="text-danger"></span>
            </div>
            <div class="mb-3 col-auto">
              <input type="submit" name="admin_login" id="admin_login" class="btn btn-dark" value="Ingresar" />
            </div>
          </form>
          
        </div>
      </div>
    </div>
    </div>
    <div class="container text-center" style="padding-top: 15px;">
    <div class="text-center">
      <div class="btn-group shadow">
        <a href="../"class="btn btn-secondary">Docente</a>
        <a href="../apoderado/" class="btn btn-secondary">Apoderado</a>
        <a class="btn btn-secondary active" aria-current="page">Admin</a>
      </div> 
    </div>
  </div>
</div>

</body>
</html>

<script>
$(document).ready(function(){
  $('#admin_login_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"check_admin_login.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function(){
        $('#admin_login').val('Validando...');
        $('#admin_login').attr('disabled', 'disabled');
      },
      success:function(data)
      {
        if(data.success)
        {
          location.href = "<?php echo $base_url; ?>admin";
        }
        if(data.error)
        {
          $('#admin_login').val('Login');
          $('#admin_login').attr('disabled', false);
          if(data.error_admin_user_name != '')
          {
            $('#error_admin_user_name').text(data.error_admin_user_name);
          }
          else
          {
            $('#error_admin_user_name').text('');
          }
          if(data.error_admin_password != '')
          {
            $('#error_admin_password').text(data.error_admin_password);
          }
          else
          {
            $('#error_admin_password').text('');
          }
        }
      }
    });
  });
});
</script>