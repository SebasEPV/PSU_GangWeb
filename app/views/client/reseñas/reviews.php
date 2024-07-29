<?php
require './../../../../config/config.php';

// Consultas para obtener datos de filtros
$brands = $enlace->query("SELECT * FROM brands")->fetchAll(PDO::FETCH_ASSOC);
$categories = $enlace->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$tiers = $enlace->query("SELECT * FROM tiers")->fetchAll(PDO::FETCH_ASSOC);

$searchTerm = '';
$selectedBrand = '';
$selectedCategory = '';
$selectedTier = '';

// Base de la consulta
$query = "
    SELECT reviews.*, products.product_name, users.username, brands.brand_name, categories.category_name, tiers.tier_name 
    FROM reviews
    JOIN products ON reviews.fk_product_id = products.product_id
    LEFT JOIN users ON reviews.fk_author_id = users.user_id
    LEFT JOIN brands ON products.fk_brand_id = brands.brand_id
    LEFT JOIN product_categories ON products.product_id = product_categories.fk_product_id
    LEFT JOIN categories ON product_categories.fk_category_id = categories.category_id
    LEFT JOIN tiers ON products.fk_tier_id = tiers.tier_id
    WHERE 1=1";

$params = [];

// Manejo del filtro de búsqueda
if (isset($_GET['searchbar']) && !empty($_GET['searchbar'])) {
    $searchTerm = $_GET['searchbar'];
    $query .= " AND products.product_name LIKE :searchTerm";
    $params['searchTerm'] = '%' . $searchTerm . '%';
}

// Manejo de otros filtros
if (isset($_GET['brand']) && !empty($_GET['brand'])) {
    $selectedBrand = $_GET['brand'];
    $query .= " AND brands.brand_name = :brand";
    $params['brand'] = $selectedBrand;
}

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    $query .= " AND categories.category_name = :category";
    $params['category'] = $selectedCategory;
}

if (isset($_GET['tier']) && !empty($_GET['tier'])) {
    $selectedTier = $_GET['tier'];
    $query .= " AND tiers.tier_name = :tier";
    $params['tier'] = $selectedTier;
}

$consulta = $enlace->prepare($query);
if (!$consulta->execute($params)) {
    die("Query failed: " . print_r($consulta->errorInfo(), true));
}

$reviews = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #DDDCDB;
            margin: 20px;
        }

        h1 {
            color: #383838;
        }

        .filter-container {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .form-control,
        .form-select {
            margin-right: 8px;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .navbar-nav .nav-item:last-child {
            margin-right: 0;
        }
    </style>
</head>

<body>
    <?php include 'navBar.php'; ?>

    <section class="content-header">
        <div class="container-fluid">
            <h1>Reseñas</h1>
            <div class="filter-container">
                <form method="GET" class="d-flex w-100">
                    <select name="brand" class="form-select">
                        <option value="">Seleccione Marca</option>
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?php echo htmlspecialchars($brand['brand_name']); ?>" <?php if ($selectedBrand == $brand['brand_name']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($brand['brand_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="category" class="form-select">
                        <option value="">Seleccione Categoría</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo htmlspecialchars($category['category_name']); ?>" <?php if ($selectedCategory == $category['category_name']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="tier" class="form-select">
                        <option value="">Seleccione Tier</option>
                        <?php foreach ($tiers as $tier) : ?>
                            <option value="<?php echo htmlspecialchars($tier['tier_name']); ?>" <?php if ($selectedTier == $tier['tier_name']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($tier['tier_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-warning">Filtrar</button>
                </form>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reviews)) : ?>
                            <?php foreach ($reviews as $row) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['review_id']); ?></td>
                                    <td><a href="reviewDetail.php?review_id=<?php echo htmlspecialchars($row['review_id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></td>
                                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tier_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['date_review']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">No hay reseñas disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>
