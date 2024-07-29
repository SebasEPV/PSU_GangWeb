<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log In</title>

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
    .card{
      background-color: #DDDCDB;
    }
    .title, .btn {
      background-color: #00E9D2;
    }
    #error{
      color: red;
    }
    #success{
      color: green;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="title card-header text-center">
        <h1><b>PSU-Gang</b></h1>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Inicia Sesión</p>

        <form action="./../../controllers/login.php" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Correo">
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass" placeholder="Contraseña">
          </div>
          <div class>
            <?php
              if (isset($_GET['err']) && $_GET['err'] == 1){
                echo '<p id= error>Correo o contraseña incorrecta</p>';
              }
              if (isset($_GET['err']) && $_GET['err'] == 6){
                echo '<p id= error>Necesitas ingresar sesión</p>';
              }
              if (isset($_GET['success']) && $_GET['success'] == 1){
                echo '<p id= success>Tu contraseña ha sido cambiada</p>';
              }
            ?>
          </div>
          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn">Iniciar Sesión</button>
            </div>
          </div>
        </form>

        <p class="mb-1">
          <a href="./forgotPassword.php">Olvide mi contraseña</a>
        </p>
        <p class="mb-0">
          <a href="./register.php" class="text-center">Crear nueva cuenta</a>
        </p>
      </div>
    </div>
  </div>
</body>

</html>