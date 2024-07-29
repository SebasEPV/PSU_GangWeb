<?php
require './../../../../config/config.php';

$review_id = isset($_GET['review_id']) ? intval($_GET['review_id']) : 0;

// Consulta para obtener los detalles de la reseña
$query = "
    SELECT reviews.*, products.product_name, users.username, brands.brand_name, categories.category_name, tiers.tier_name 
    FROM reviews
    JOIN products ON reviews.fk_product_id = products.product_id
    LEFT JOIN users ON reviews.fk_author_id = users.user_id
    LEFT JOIN brands ON products.fk_brand_id = brands.brand_id
    LEFT JOIN product_categories ON products.product_id = product_categories.fk_product_id
    LEFT JOIN categories ON product_categories.fk_category_id = categories.category_id
    LEFT JOIN tiers ON products.fk_tier_id = tiers.tier_id
    WHERE reviews.review_id = :review_id";

$consulta = $enlace->prepare($query);
$consulta->bindValue(':review_id', $review_id, PDO::PARAM_INT);

if (!$consulta->execute()) {
    die("Query failed: " . print_r($consulta->errorInfo(), true));
}

$review = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$review) {
    die("Reseña no encontrada.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle de Reseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #DDDCDB;
            margin: 20px;
        }

        .btn-custom {
            background-color: #00E9D2;
            border: solid #383838 1px;
            color: #383838;
            margin-right: 8px;
        }

        .btn-custom-edit {
            background-color: #28a745;
            border: solid #383838 1px;
            color: #ffffff;
            margin-right: 8px;
        }

        .btn-custom-danger {
            background-color: #dc3545;
            border: solid #383838 1px;
            color: #ffffff;
            margin-right: 8px;
        }

        .btn-custom-add {
            background-color: #007bff;
            border: solid #383838 1px;
            color: #ffffff;
            margin-right: 8px;
        }

        .btn-custom-filter {
            background-color: #ffc107;
            border: solid #383838 1px;
            color: #383838;
            margin-right: 8px;
        }

        .btn-custom-back {
            background-color: #6c757d; /* Gris */
            border: solid #383838 1px;
            color: #ffffff;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .navbar-nav .nav-link {
            color: #383838;
        }

        .navbar-nav .nav-link:hover {
            color: #00E9D2;
        }

        .card {
            margin-top: 20px;
        }

        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>

<body>
<?php include 'navBar.php'; ?>
<?php include './../refs.html' ?>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?php echo htmlspecialchars($review['title']); ?></h1>
                <h5 class="card-subtitle mb-2 text-muted">Producto: <?php echo htmlspecialchars($review['product_name']); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Autor: <?php echo htmlspecialchars($review['username']); ?></h6>
                <p class="card-text"><strong>Calificación:</strong> <?php echo htmlspecialchars($review['tier_name']); ?></p>
                <p class="card-text"><strong>Fecha:</strong> <?php echo htmlspecialchars($review['date_review']); ?></p>
                <p class="card-text"><strong>Contenido:</strong></p>
                <p class="card-text"><?php echo nl2br(htmlspecialchars($review['content'])); ?></p>
                <a href="./reviews.php" class="btn btn-custom-back">Regresar</a>
            </div>
        </div>
    </div>
</body>

</html>
