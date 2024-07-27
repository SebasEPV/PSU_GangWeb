<?php
require("./../../../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

$results = [];

if (isset($_GET['id'])) {
  $consulta = "SELECT * FROM products WHERE product_id = '$_GET[id]'";
  $result = $enlace->prepare($consulta);
  $result->execute();
  $results = $result->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['product_name'], $_POST['product_price'], $_POST['product_description'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];

    $dataUpdate = "UPDATE products SET product_name = '$product_name', product_price = '$product_price', product_description = '$product_description' WHERE product_id = '$_GET[id]'";
    $updateResult = $enlace->prepare($dataUpdate);

    if ($updateResult->execute()) {
      header('Location: ./listasProducto.php');
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
  <title>Editar Producto</title>
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
              <h1>Editar producto</h1>
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
        <form method="POST">
          <div class="row">
            <div class="">
              <div class="card card-primary">
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Nombre producto</label>
                    <input type="text" name="product_name" id="inputName" class="form-control" value="<?php echo htmlspecialchars($results['product_name']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputDescription">Descripción</label>
                    <textarea name="product_description" id="inputDescription" class="form-control"><?php echo htmlspecialchars($results['product_description']); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputPrice">Precio</label>
                    <input type="number" name="product_price" id="inputPrice" class="form-control" value="<?php echo htmlspecialchars($results['product_price']); ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center mt-3" id="buttons">
            <div class="col-12 text-center">
              <a href="listasProducto.php" class="btn btn-secondary">Cancelar</a>
              <input type="submit" value="Guardar cambios" class="btn btn-success">
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</body>

</html>
