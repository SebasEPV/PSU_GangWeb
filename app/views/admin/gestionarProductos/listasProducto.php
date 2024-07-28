<?php
  require("./../../../../config/database.php");

  $con = new Database;
  $enlace = $con->getConnection();

  if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
  }

  $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
  $selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : '';
  $selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
  $priceMin = isset($_GET['price_min']) ? $_GET['price_min'] : '';
  $priceMax = isset($_GET['price_max']) ? $_GET['price_max'] : '';

  $brands = $enlace->query("SELECT brand_id, brand_name FROM brands")->fetchAll(PDO::FETCH_ASSOC);
  $categories = $enlace->query("SELECT category_id, category_name FROM categories")->fetchAll(PDO::FETCH_ASSOC);

  $sql = "
    SELECT products.product_id, products.product_name, products.product_description, products.product_price, brands.brand_name, categories.category_name
    FROM products
    JOIN brands ON products.fk_brand_id = brands.brand_id
    JOIN product_categories ON products.product_id = product_categories.fk_product_id
    JOIN categories ON product_categories.fk_category_id = categories.category_id
    WHERE products.product_name LIKE :searchTerm
  ";

  $params = ['searchTerm' => '%' . $searchTerm . '%'];

  if ($selectedBrand) {
    $sql .= " AND brands.brand_id = :brandId";
    $params['brandId'] = $selectedBrand;
  }

  if ($selectedCategory) {
    $sql .= " AND categories.category_id = :categoryId";
    $params['categoryId'] = $selectedCategory;
  }

  if ($priceMin !== '') {
    $sql .= " AND products.product_price >= :priceMin";
    $params['priceMin'] = $priceMin;
  }

  if ($priceMax !== '') {
    $sql .= " AND products.product_price <= :priceMax";
    $params['priceMax'] = $priceMax;
  }

  $consulta = $enlace->prepare($sql);
  $consulta->execute($params);

  if (!$consulta) {
    die("Query failed: " . $enlace->errorInfo()[2]);
  }

  $results = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

    .search-container {
      display: flex;
      align-items: center;
      width: 100%;
    }

    .search-bar {
      flex-grow: 1;
      margin-left: 8px;
    }

    .btn-search {
      margin-left: 8px;
    }

    .filter-container {
      margin-top: 10px;
      display: flex;
      gap: 10px;
    }
  </style>
  <script>
    function toggleDescription(id) {
      var content = document.getElementById('description-' + id);
      if (content.style.display === 'none') {
        content.style.display = 'table-row';
      } else {
        content.style.display = 'none';
      }
    }
  </script>
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
                <a href="#">Inicio</a>
                <a href="#">FAQ</a>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="search-container ml-2">
              <a type="button" href="agregarProducto.php" class="btn btn-success">Agregar producto</a>
              <form method="GET" class="d-flex search-bar">
                <input type="text" name="search" class="form-control" placeholder="Buscar productos..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit" class="btn btn-primary btn-search">Buscar</button>
              </form>
            </div>
          </div>
        </div>
      </section>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row filter-container">
            <form method="GET" class="d-flex w-100">
              <input type="hidden" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
              <select name="brand" class="form-control">
                <option value="">Todas las marcas</option>
                <?php foreach ($brands as $brand): ?>
                  <option value="<?php echo $brand['brand_id']; ?>" <?php echo $selectedBrand == $brand['brand_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($brand['brand_name']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <select name="category" class="form-control ml-2">
                <option value="">Todas las categorías</option>
                <?php foreach ($categories as $category): ?>
                  <option value="<?php echo $category['category_id']; ?>" <?php echo $selectedCategory == $category['category_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['category_name']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <input type="number" name="price_min" class="form-control ml-2" placeholder="Precio mínimo" value="<?php echo htmlspecialchars($priceMin); ?>">
              <input type="number" name="price_max" class="form-control ml-2" placeholder="Precio máximo" value="<?php echo htmlspecialchars($priceMax); ?>">
              <button type="submit" class="btn btn-primary ml-2">Aplicar</button>
            </form>
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
                  <th style="width: 20%">Producto</th>
                  <th style="width: 20%">Marca</th>
                  <th style="width: 20%">Categoría</th>
                  <th style="width: 20%">Precio</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($results as $row) : ?>
                  <tr onclick="toggleDescription(<?php echo $row['product_id']; ?>)">
                    <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['brand_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                    <td>
                      <a href="./editarProducto.php?id=<?php echo $row['product_id']; ?>" class="btn">Editar</a>
                    </td>
                  </tr>
                  <tr id="description-<?php echo $row['product_id']; ?>" class="expand-content">
                    <td colspan="6">
                      <div><?php echo htmlspecialchars($row['product_description']); ?></div>
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
