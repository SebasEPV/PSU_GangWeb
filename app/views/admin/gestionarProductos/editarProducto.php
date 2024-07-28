<?php
require("./../../../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

$results = [];
$brands = [];
$categories = [];

// Obtener datos del producto si hay un id proporcionado
if (isset($_GET['id'])) {
  $consulta = "SELECT * FROM products WHERE product_id = :id";
  $result = $enlace->prepare($consulta);
  $result->execute([':id' => $_GET['id']]);
  $results = $result->fetch(PDO::FETCH_ASSOC);
}

// Obtener todas las marcas para el menú desplegable
$consultaBrands = "SELECT * FROM brands";
$resultBrands = $enlace->prepare($consultaBrands);
$resultBrands->execute();
$brands = $resultBrands->fetchAll(PDO::FETCH_ASSOC);

// Obtener todas las categorías para el menú desplegable
$consultaCategories = "SELECT * FROM categories";
$resultCategories = $enlace->prepare($consultaCategories);
$resultCategories->execute();
$categories = $resultCategories->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['product_name'], $_POST['product_price'], $_POST['product_description'], $_POST['fk_brand_id'], $_POST['fk_category_id'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $fk_brand_id = $_POST['fk_brand_id'];
    $fk_category_id = $_POST['fk_category_id'];

    $dataUpdate = "UPDATE products SET product_name = :product_name, product_price = :product_price, product_description = :product_description, fk_brand_id = :fk_brand_id WHERE product_id = :id";
    $updateResult = $enlace->prepare($dataUpdate);
    $updateParams = [
      ':product_name' => $product_name,
      ':product_price' => $product_price,
      ':product_description' => $product_description,
      ':fk_brand_id' => $fk_brand_id,
      ':id' => $_GET['id']
    ];

    if ($updateResult->execute($updateParams)) {
      // Actualizar categorías en la tabla intermedia
      $deleteOldCategories = "DELETE FROM product_categories WHERE fk_product_id = :product_id";
      $deleteStmt = $enlace->prepare($deleteOldCategories);
      $deleteStmt->execute([':product_id' => $_GET['id']]);

      $insertCategories = "INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (:product_id, :category_id)";
      $insertStmt = $enlace->prepare($insertCategories);
      foreach ($fk_category_id as $category_id) {
        $insertStmt->execute([':product_id' => $_GET['id'], ':category_id' => $category_id]);
      }

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
                    <input type="text" name="product_name" id="inputName" class="form-control" value="<?php echo htmlspecialchars($results['product_name'] ?? ''); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputDescription">Descripción</label>
                    <textarea name="product_description" id="inputDescription" class="form-control"><?php echo htmlspecialchars($results['product_description'] ?? ''); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputPrice">Precio</label>
                    <input type="number" name="product_price" id="inputPrice" class="form-control" step="0.01" value="<?php echo htmlspecialchars($results['product_price'] ?? ''); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputBrand">Marca</label>
                    <select id="inputBrand" name="fk_brand_id" class="form-control">
                      <?php foreach ($brands as $brand) : ?>
                        <option value="<?php echo $brand['brand_id']; ?>" <?php if ($brand['brand_id'] == ($results['fk_brand_id'] ?? '')) echo 'selected'; ?>>
                          <?php echo htmlspecialchars($brand['brand_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputCategories">Categorías</label>
                    <select id="inputCategories" name="fk_category_id[]" class="form-control">
                      <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['category_id']; ?>">
                          <?php echo htmlspecialchars($category['category_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
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