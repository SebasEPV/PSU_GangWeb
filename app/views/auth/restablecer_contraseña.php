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

    .card{
      background-color: #DDDCDB;
    }
    .title, .btn {
      background-color: #00E9D2;
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
      <p class="login-box-msg">Ingresa tu nueva contraseña.</p>
      <form action="./../../controllers/cambiarContra2.php" method="post">
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass2" placeholder="Confirma contraseña" required>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn">Enviar</button>
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
