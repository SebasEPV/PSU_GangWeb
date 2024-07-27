<?php
require("./../../../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

$results = [];

if (isset($_GET['id'])) {
  $consulta = "SELECT * FROM reviews WHERE review_id = '$_GET[id]'";
  $result = $enlace->prepare($consulta);
  $result->execute();
  $results = $result->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['title'], $_POST['content'], $_POST['fk_tier_id'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $fk_tier_id = $_POST['fk_tier_id'];

    $dataUpdate = "UPDATE reviews SET title = '$title', content = '$content', fk_tier_id = '$fk_tier_id', date_review = NOW() WHERE review_id = '$_GET[id]'";
    $updateResult = $enlace->prepare($dataUpdate);

    if ($updateResult->execute()) {
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
    }
    .card {
      background-color: #DDDCDB;
    }
    .btn {
      background-color: #00E9D2;
      color: #383838;
    }
    h1 {
      color: #00E9D2;
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
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="inputTitle">Título</label>
                    <input type="text" id="inputTitle" name="title" class="form-control" value="<?php echo htmlspecialchars($results['title']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputContent">Contenido</label>
                    <textarea id="inputContent" name="content" class="form-control" rows="4"><?php echo htmlspecialchars($results['content']); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputTier">Tier</label>
                    <input type="text" id="inputTier" name="fk_tier_id" class="form-control" value="<?php echo htmlspecialchars($results['fk_tier_id']); ?>">
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
