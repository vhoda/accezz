<?php



//header.php



include('database_connection.php');



session_start();



if(!isset($_SESSION["admin_id"]))

{

  header('location:login.php');

}



?>

<!DOCTYPE html>

<html lang="en">

<head>

  <title>Admin - Accezz</title>
  <link rel="icon" type="image/png" href="logo.png" />
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>    

  <script src="https://kit.fontawesome.com/545140ded1.js" crossorigin="anonymous"></script>

  <script src="../js/jquery.min.js"></script>

  <script src="../js/popper.min.js"></script>

  <script src="../js/jquery.dataTables.min.js"></script>

</head>

<body>


<nav class="navbar navbar-expand-lg bg-light shadow-sm">

  <div class="container-fluid"> 
    <img alt="" width="30" height="24" class="d-inline-block align-text-top" src="logo.png"><a class="navbar-brand" href="index.php"> Accezz*Admin</a></img>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">

      <ul class="navbar-nav">

        <li class="nav-item">

          <a class="nav-link" href="grade.php"><i class="fa-solid fa-graduation-cap"></i>/Cursos</a>

        </li>

        <li class="nav-item">

          <a class="nav-link" href="teacher.php"><i class="fa-solid fa-chalkboard-user"></i>/Docentes</a>

        </li>

        

        <li class="nav-item">

          <a class="nav-link" href="student.php"><i class="fa-solid fa-users"></i>/Estudiantes</a>

        </li>
        <li class="nav-item">

          <a class="nav-link" href="apoderado.php"><i class="fa-solid fa-person"></i>/Apoderados</a>

        </li>
        <li class="nav-item">

          <a class="nav-link" href="attendance.php"><i class="fa-solid fa-clipboard-user"></i>/H. De Asistencias</a>

        </li>

        <li class="nav-item">
          <a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </li>

    </div>

  </div>  

</nav>