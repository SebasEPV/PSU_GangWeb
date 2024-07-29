<?php
require("./../../../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

// Obtener marcas
$consulta_marcas = $enlace->query("SELECT brand_id, brand_name FROM brands");
$marcas = $consulta_marcas->fetchAll(PDO::FETCH_ASSOC);

// Obtener categoría de fuentes de poder
$consulta_categorias_psu = $enlace->query("SELECT fk_product_id, fk_category_id FROM categories WHERE fk_category_id=6 ");
$categorias = $consulta_categorias->fetchAll(PDO::FETCH_ASSOC);

//Obtener reseñas
$consulta_categorias_psu = $enlace->query("SELECT fk_product_id, fk_category_id FROM categories WHERE fk_category_id=6 ");
$categorias = $consulta_categorias_psu->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agregar Producto</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #383838;
      color: #383838;
    }

    .card {
      background-color: #DDDCDB;
      width: 100%;
      max-width: 600px;
    }

    .btn {
      background-color: #00E9D2;
      color: #383838;
    }

    h1 {
      color: #00E9D2;
    }

    .form-group label {
      color: #383838;
    }
  </style>

  <script>
    function toggleNewField(selectElement, newFieldId) {
      const newField = document.getElementById(newFieldId);
      if (selectElement.value === 'new') {
        newField.style.display = 'block';
      } else {
        newField.style.display = 'none';
      }
    }
  </script>
</head>

<body>
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="">
              <h1>Agregar producto</h1>
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

      <section class="content">
        <div class="row">
          <div class="">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Producto Nuevo</h3>
              </div>
              <div class="card-body">
                <form action="./../../../controllers/agregarProducto.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="productName">Nombre producto</label>
                    <input type="text" id="productName" name="product_name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                  </div>
                  <div class="form-group">
                    <label for="brand">Marca</label>
                    <select id="brand" name="brand" class="form-control" onchange="toggleNewField(this, 'newBrandField')" required>
                      <option value="">Selecciona una marca</option>
                      <?php foreach ($marcas as $marca) : ?>
                        <option value="<?php echo $marca['brand_id']; ?>"><?php echo $marca['brand_name']; ?></option>
                      <?php endforeach; ?>
                      <option value="new">Agregar nueva marca</option>
                    </select>
                  </div>
                  <div class="form-group" id="newBrandField" style="display: none;">
                    <label for="newBrandName">Nueva marca</label>
                    <input type="text" id="newBrandName" name="new_brand" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="category">Categoría</label>
                    <select id="category" name="category" class="form-control" onchange="toggleNewField(this, 'newCategoryField')" required>
                      <option value="">Selecciona una categoría</option>
                      <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?php echo $categoria['category_id']; ?>"><?php echo $categoria['category_name']; ?></option>
                      <?php endforeach; ?>
                      <option value="new">Agregar nueva categoría</option>
                    </select>
                  </div>
                  <div class="form-group" id="newCategoryField" style="display: none;">
                    <label for="newCategoryName">Nueva categoría</label>
                    <input type="text" id="newCategoryName" name="new_category" class="form-control">
                  </div>
                  <div class="row justify-content-center mt-3">
                    <div class="col-12 text-center">
                      <a href="listasProducto.php" class="btn btn-secondary">Cancelar</a>
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
