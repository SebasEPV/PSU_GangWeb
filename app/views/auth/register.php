<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    .register-page {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #383838;
    }

    .register-box {
      width: 360px;
    }

    .card {
      background-color: #DDDCDB;
    }

    .title,
    .btn {
      background-color: #00E9D2;
    }

    .red-border {
      border-color: red !important;
    }

    .red-placeholder::placeholder,
    .err {
      color: red !important;
    }
  </style>
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="title card-header text-center">
        <h1>PSU-Gang</h1>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="./../../controllers/register.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nombre" name="Fname">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Apellido" name="Lname">
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control pass" placeholder="Contraseña" name="pass">
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control pass" placeholder="Confirma contraseña" name="pass2">
          </div>
          <?php
          if (isset($_GET['err']) && $_GET['err'] == 2) {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var inputs = document.querySelectorAll(".pass");
                inputs.forEach(function(input) {
                    input.classList.add("red-border", "red-placeholder");
                });
            });
          </script>';
          }
          ?>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Correo" name="email">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control user" placeholder="Nombre de Usuario" name="username">
          </div>
          <?php
          if (isset($_GET['err']) && $_GET['err'] == 3) {
            echo '          <script>
              document.addEventListener("DOMContentLoaded", function() {
                  var inputs = document.querySelectorAll(".user");
                  inputs.forEach(function(input) {
                      input.classList.add("red-border", "red-placeholder");
                  });
              });
            </script>';
            echo '<p class="err">Ese nombre de usuario ya existe</p>';
          }
          if (isset($_GET['err']) && $_GET['err'] == 2) {
            echo '<p class="err">Las contraseñas no son iguales</p>';
          }
          ?>
          <div class="row">
            <div class="col-8">
            </div>
            <div class="col-4">
              <input type="submit" class="btn" value="Registrarse">
            </div>
          </div>
        </form>
        <a href="./login.php" class="text-center">Ya tienes una cuenta?</a>
      </div>
    </div>
  </div>
</body>

</html>