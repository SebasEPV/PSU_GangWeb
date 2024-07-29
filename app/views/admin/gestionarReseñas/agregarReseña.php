<?php
require("./../../../../config/database.php");
session_start();

if (!isset($_SESSION['email'])) {
  header('Location: ./../../auth/login.php?err=6');
  exit;
}

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    die("Error al establecer la conexión a la base de datos.");
}

// Obtener tiers
$consulta_tiers = $enlace->query("SELECT tier_id, tier_name FROM tiers");
$tiers = $consulta_tiers->fetchAll(PDO::FETCH_ASSOC);

// Obtener productos
$consulta_productos = $enlace->query("SELECT product_id, product_name FROM products");
$productos = $consulta_productos->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agregar Reseña</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #383838;
      margin: 20px;
      /* Margen para la página */
    }

    .wrapper {
      width: 100%; /* Ajusta el ancho al 100% del contenedor */
      max-width: 900px; /* Ancho máximo para mantener la proporción */
      padding: 20px; /* Añade padding interno */
    }

    .card {
      background-color: #DDDCDB;
      padding: 20px;
    }

    .btn {
      background-color: #00E9D2;
      color: #383838;
      margin-right: 8px;
      /* Espacio entre botones */
    }

    .btn-secondary {
      background-color: #6c757d;
      color: #ffffff;
      margin-right: 8px;
      /* Espacio entre botones */
    }

    .btn-success {
      background-color: #28a745;
      color: #ffffff;
    }

    h1 {
      color: #00E9D2;
    }

    .form-group {
      margin-bottom: 16px;
      /* Espacio entre filtros */
    }

    .form-control {
      margin-bottom: 8px;
      /* Espacio entre campos de formulario */
    }

    .buttons {
      margin-top: 20px;
      /* Espacio adicional para botones */
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
                <form action="./../../../controllers/agregarReseña.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputName">Nombre reseña</label>
                    <input type="text" id="inputName" name="review_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="inputDescription">Contenido</label>
                    <textarea id="inputDescription" name="review_content" class="form-control" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputTier">Tier</label>
                    <select id="inputTier" name="tier" class="form-control custom-select" required>
                      <option selected disabled>Seleccionar un tier</option>
                      <?php foreach ($tiers as $tier) : ?>
                        <option value="<?php echo $tier['tier_id']; ?>"><?php echo $tier['tier_name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputProduct">Producto</label>
                    <select id="inputProduct" name="product" class="form-control custom-select" required>
                      <option selected disabled>Seleccionar un producto</option>
                      <?php foreach ($productos as $producto) : ?>
                        <option value="<?php echo $producto['product_id']; ?>"><?php echo $producto['product_name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="buttons text-center">
                    <a href="listasReseñas.php" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Enviar" class="btn btn-success">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

</body>

</html>
