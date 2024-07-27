<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restablecer Contraseña</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <style>
    .login-page {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #383838;
    }

    .login-box {
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

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="title card-header text-center">
        <h1>PSU_Gang</h1>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Ingresa tu correo con el cual te registraste.</p>
        <form action="./../BackEnd/mandar_correo.php" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control email" placeholder="Correo" name="email">
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control email" placeholder="Confirma correo" name="email2">
          </div>
          <?php
          if (isset($_GET['err']) && $_GET['err'] == 4) {
            echo '          <script>
              document.addEventListener("DOMContentLoaded", function() {
                  var inputs = document.querySelectorAll(".email");
                  inputs.forEach(function(input) {
                      input.classList.add("red-border", "red-placeholder");
                  });
              });
            </script>';
            echo '<p class="err">Los correos no son iguales</p>';
          } elseif (isset($_GET['err']) && $_GET['err'] == 5) {
            echo '          <script>
            document.addEventListener("DOMContentLoaded", function() {
                var inputs = document.querySelectorAll(".email");
                inputs.forEach(function(input) {
                    input.classList.add("red-border", "red-placeholder");
                });
            });
          </script>';
            echo '<p class="err">El correo que ingresaste no esta registrado</p>';
          }
          ?>
          <div class="row">
            <div class="col-12">
              <input type="submit" class="btn" value="Enviar">
            </div>
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="login.php">Volver al Login</a>
        </p>
      </div>
    </div>
  </div>

</body>

</html>