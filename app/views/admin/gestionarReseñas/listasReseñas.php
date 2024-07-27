<?php
require("./../../../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

$consulta = $enlace->query("SELECT * FROM consultReviews");

if (!$consulta) {
  die("Query failed: " . $enlace->errorInfo()[2]);
}

$reviews = $consulta->fetchAll(PDO::FETCH_ASSOC);


?>

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

    .btn {
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
            <a href="#">Inicio</a>
            <a href="#">FAQ</a>
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
              <a type="button" href="agregarReseña.php" class="btn">Agregar reseña</a>
              <input type="text" name="searchbar" id="searchbar" class="flex-grow-1 ml-2">
              <a href="#">
                <img src="./../../../../public/assets/img/lupa.png" alt="Lupa" class="img">
                <img src="./../../../../public/assets/img/filtro.png" alt="Filtro" class="img">
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
                  <th style="width: 15%">Titulo</th>
                  <th style="width: 15%">Producto</th>
                  <th style="width: 15%">Autor</th>
                  <th>Calificación</th>
                  <th style="width: 15%" class="text-center">Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($reviews as $row) : ?>
                  <tr>
                    <td><?php echo htmlspecialchars($row['review_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['tier_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['date_review']); ?></td>
                    <td>
                      <a href="editarReseña.php?id=<?php echo $row['review_id']; ?>" class="btn">Editar</a>
                      <a href="eliminarReseña.php?id=<?php echo $row['review_id']; ?>" class="btn">Eliminar reseña</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>