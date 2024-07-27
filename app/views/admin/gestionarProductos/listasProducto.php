<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos</title>

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

    .img-lupa {
      max-width: 30px;
      height: auto;
    }

    body {
      background-color: #DDDCDB;
    }

    h1 {
      color: #383838;
    }

    .btn {
      background-color: #00E9D2;
      border: solid #383838 1px;
      color: #383838;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="">
              <h1>Productos</h1>
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
              <div class="row mb-2">
                <div class="col-sm-6">
                  <a type="submit" href="agregarProducto.php" class="btn btn-success">Agregar producto</a>
                </div>
              </div>
            </div>
          </section>

          <section class="content">
            <div class="card">
              <div class="card-header">
              </div>
              <div class="card-body p-0">
                <table class="table table-striped projects">
                  <thead>
                    <tr>
                      <th style="width: 1%">#</th>
                      <th style="width: 24%">Producto</th>
                      <th style="width: 20%">Marca</th>
                      <th style="width: 20%">Categoria</th>
                      <th style="width: 10%">Precio</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table-row" data-toggle="collapse" data-target=".expand-content-1" aria-expanded="false" aria-controls="expand-content-1">
                      <td>1</td>
                      <td>A550BN</td>
                      <td>MSI</td>
                      <td>Fuente de poder</td>
                      <td>$1,200</td>
                      <td>
                        <a href="editarProducto.php" class="btn">Editar</a>
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
                      <td>S70 Blade 4TB</td>
                      <td>XPG</td>
                      <td>SSD</td>
                      <td>$5,800</td>
                      <td>
                      <a href="editarProducto.php" class="btn">Editar</a>
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
                      <td>Fury Renegade</td>
                      <td>Kingston</td>
                      <td>SSD</td>
                      <td>$2,800</td>
                      <td>
                      <a href="editarProducto.php" class="btn">Editar</a>
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
                      <td>RM X Shift</td>
                      <td>Corsair</td>
                      <td>Fuente de Poder</td>
                      <td>$2,500</td>
                      <td>
                      <a href="editarProducto.php" class="btn">Editar</a>
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