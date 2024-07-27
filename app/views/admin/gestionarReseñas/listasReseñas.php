<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reseña</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    .expand-content {
      display: none;
    }

    .c2 {
      margin-top: 8px;
    }

    .img-responsive {
      max-width: 100px;
      height: auto;
    }

    .d-flex {
      display: flex;
    }

    .w-100 {
      width: 100%;
    }

    .flex-grow-1 {
      flex-grow: 1;
    }

    .ml-2 {
      margin-left: 8px;
    }

    .img {
      max-width: 30px;
      height: auto;
    }

    body {
      background-color: #DDDCDB;
    }

    h1 {
      color: #383838;
    }
    .btn{
      background-color: #00E9D2;
      border: solid #383838 1px;
      color: #383838;
    }
  </style>
</head>

<body class="hold-transition">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="">
          <h1>Reseñas</h1>
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

  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="d-flex w-100 align-items-center ml-2">
              <a type="submit" href="agregarReseña.php" class="btn">Agregar reseña</a>
              <input type="text" name="searchbar" id="searchbar" class="flex-grow-1 ml-2">
              <a href="">
                <img src="./../../../../public/assets/img/lupa.png" alt="Lupa" class="img">
                <img src="./../../../../public/assets/img/filtro.png" alt="filtro" class="img">
              </a>
            </div>
          </div>
        </div>
      </section>



      <section class="c2 content">
        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">#</th>
                  <th style="width: 20%">Reseña</th>
                  <th style="width: 30%">Autor</th>
                  <th>Calificación</th>
                  <th style="width: 15%" class="text-center">Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-row" data-toggle="collapse" data-target=".expand-content-1" aria-expanded="false" aria-controls="expand-content-1">
                  <td>1</td>
                  <td>MSI A550BN</td>
                  <td>Sebastian</td>
                  <td>D</td>
                  <td>19/07/24</td>
                  <td>
                    <a href="editarReseña.php" class="btn">Editar</a>
                    <a href="" class="btn">Eliminar reseña</a>
                  </td>
                </tr>
                <tr class="collapse expand-content-1">
                  <td colspan="6">
                    <div class="card card-body">
                      <p>Más detalles de la reseña aquí...</p>
                    </div>
                  </td>
                </tr>
                <tr class="table-row" data-toggle="collapse" data-target=".expand-content-1" aria-expanded="false" aria-controls="expand-content-1">
                  <td>2</td>
                  <td>S70 Blade SSD</td>
                  <td>Sebastian</td>
                  <td>S</td>
                  <td>15/06/24</td>
                  <td>
                    <a href="editarReseña.php" class="btn">Editar</a>
                    <a href="" class="btn">Eliminar reseña</a>
                  </td>
                </tr>
                <tr class="collapse expand-content-1">
                  <td colspan="6">
                    <div class="card card-body">
                      <p>Más detalles de la reseña aquí...</p>
                    </div>
                  </td>
                </tr>
                <tr class="table-row" data-toggle="collapse" data-target=".expand-content-1" aria-expanded="false" aria-controls="expand-content-1">
                  <td>3</td>
                  <td>Fury Renegade Kingston SSD</td>
                  <td>Sebastian</td>
                  <td>S</td>
                  <td>19/07/24</td>
                  <td>
                    <a href="editarReseña.php" class="btn">Editar</a>
                    <a href="" class="btn">Eliminar reseña</a>
                  </td>
                </tr>
                <tr class="collapse expand-content-1">
                  <td colspan="6">
                    <div class="card card-body">
                      <p>Más detalles de la reseña aquí...</p>
                    </div>
                  </td>
                </tr>
                <tr class="table-row" data-toggle="collapse" data-target=".expand-content-1" aria-expanded="false" aria-controls="expand-content-1">
                  <td>4</td>
                  <td>RM X Shift Corsair</td>
                  <td>Sebastian</td>
                  <td>S</td>
                  <td>05/06/24</td>
                  <td>
                    <a href="editarReseña.php" class="btn">Editar</a>
                    <a href="" class="btn">Eliminar reseña</a>
                  </td>
                </tr>
                <tr class="collapse expand-content-1">
                  <td colspan="6">
                    <div class="card card-body">
                      <p>Más detalles de la reseña aquí...</p>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>


      <script>
        $(document).ready(function() {
          $('.table-row').click(function() {
            var target = $(this).data('target');
            $(target).collapse('toggle');
          });
        });
      </script>

    </div>
  </div>
</body>

</html>