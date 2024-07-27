<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agregar Reseña</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #383838;
    }

    .buttons {
      justify-content: center;
    }

    .card{
      background-color: #DDDCDB;
    }
    .btn {
      background-color: #00E9D2;
      color: #383838;
    }
    h1{
      color: #00E9D2;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="">
              <h1>Agregar Reseña</h1>
            </div>
            <div class="col-sm-6">
              <nav>
                <a href="">Inicio</a>
                <a href="">FAQ</a>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="row">
          <div class="">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reseña Nueva</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Nombre reseña</label>
                  <input type="text" id="inputName" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Contenido</label>
                  <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                  <label for="inputTier">Tier</label>
                  <select id="inputTier" class="form-control custom-select">
                    <option selected disabled>Select one</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                    <option>F</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputClientCompany">Producto</label>
                  <input type="text" id="inputClientCompany" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputProjectLeader">Imagen</label>
                  <input type="text" id="inputProjectLeader" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-3" id="buttons">
          <div class="col-12 text-center">
            <a href="listasReseñas.php" class="btn btn-secondary">Cancelar</a>
            <input type="submit" value="Enviar" class="btn btn-success">
          </div>
        </div>

      </section>
    </div>
  </div>

</body>

</html>