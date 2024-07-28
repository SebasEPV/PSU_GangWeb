<?php
require("./../../../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

$results = [];
$tiers = [];

// Obtener datos de la reseña si hay un id proporcionado
if (isset($_GET['id'])) {
  $consulta = "SELECT * FROM reviews WHERE review_id = :id";
  $result = $enlace->prepare($consulta);
  $result->execute([':id' => $_GET['id']]);
  $results = $result->fetch(PDO::FETCH_ASSOC);
}

// Obtener todos los tiers para el menú desplegable
$consultaTiers = "SELECT * FROM tiers";
$resultTiers = $enlace->prepare($consultaTiers);
$resultTiers->execute();
$tiers = $resultTiers->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['title'], $_POST['content'], $_POST['fk_tier_id'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $fk_tier_id = $_POST['fk_tier_id'];

    $dataUpdate = "UPDATE reviews SET title = :title, content = :content, fk_tier_id = :fk_tier_id, date_review = NOW() WHERE review_id = :id";
    $updateResult = $enlace->prepare($dataUpdate);
    $updateParams = [
      ':title' => $title,
      ':content' => $content,
      ':fk_tier_id' => $fk_tier_id,
      ':id' => $_GET['id']
    ];

    if ($updateResult->execute($updateParams)) {
      header('Location: ./listasReseñas.php');
    } else {
      echo "Error al actualizar los datos: " . $enlace->errorInfo()[2];
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar reseña</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
      max-width: 1200px; /* Ancho máximo para mantener la proporción */
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
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="">
              <h1>Editar Reseña</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="row">
          <div class="">
            <div class="card card-primary">
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="inputTitle">Título</label>
                    <input type="text" id="inputTitle" name="title" class="form-control" value="<?php echo htmlspecialchars($results['title'] ?? ''); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputContent">Contenido</label>
                    <textarea id="inputContent" name="content" class="form-control" rows="4"><?php echo htmlspecialchars($results['content'] ?? ''); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputTier">Tier</label>
                    <select id="inputTier" name="fk_tier_id" class="form-control">
                      <?php foreach ($tiers as $tier) : ?>
                        <option value="<?php echo $tier['tier_id']; ?>" <?php if ($tier['tier_id'] == ($results['fk_tier_id'] ?? '')) echo 'selected'; ?>>
                          <?php echo htmlspecialchars($tier['tier_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="row justify-content-center mt-3">
                    <div class="col-12 text-center">
                      <a href="listasReseñas.php" class="btn btn-secondary">Cancelar</a>
                      <input type="submit" value="Enviar" class="btn btn-success">
                    </div>
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
