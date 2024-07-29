<?php
require("./../../../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
}

// Consultar comentarios con el nombre del producto
$query = "
    SELECT comments.*, users.username, reviews.title AS review_title, products.product_name 
    FROM comments
    LEFT JOIN users ON comments.fk_user_id = users.user_id
    LEFT JOIN reviews ON comments.fk_review_id = reviews.review_id
    LEFT JOIN products ON reviews.fk_product_id = products.product_id
";

$consulta = $enlace->query($query);
if (!$consulta) {
    die("Query failed: " . print_r($enlace->errorInfo(), true));
}

$comments = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Manejo de eliminación de comentario
if (isset($_GET['delete'])) {
    $commentId = $_GET['delete'];
    $deleteQuery = "DELETE FROM comments WHERE comments_id = :commentId";
    $deleteStmt = $enlace->prepare($deleteQuery);
    $deleteStmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    if ($deleteStmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        die("No se pudo eliminar el comentario.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comentarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        body {
            background-color: #DDDCDB;
            margin: 20px;
        }

        h1 {
            color: #383838;
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

        .navbar {
            margin-bottom: 20px;
        }

        .navbar-nav .nav-link {
            color: #383838;
        }

        .navbar-nav .nav-link:hover {
            color: #00E9D2;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .expand-content {
            display: none;
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

        .filter-container {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .form-control {
            margin-right: 8px;
        }

        .form-select {
            margin-right: 8px;
        }
    </style>

    <script>
        function confirmDeletion(commentId) {
            if (confirm("¿Está seguro de que desea eliminar este comentario?")) {
                window.location.href = "?delete=" + commentId;
            }
        }
    </script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #DDDCDB;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./../gestionarProductos/listasProductos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./../gestionarReseñas/listasReseñas.php">Reseñas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Comentarios</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="">
                            <h1>Comentarios</h1>
                        </div>
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
                                    <th style="width: 30%">Contenido</th>
                                    <th style="width: 15%">Usuario</th>
                                    <th style="width: 20%">Reseña</th>
                                    <th style="width: 20%">Producto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($comments)) : ?>
                                    <?php foreach ($comments as $comment) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($comment['comments_id']); ?></td>
                                            <td><?php echo htmlspecialchars($comment['content']); ?></td>
                                            <td><?php echo htmlspecialchars($comment['username']); ?></td>
                                            <td><?php echo htmlspecialchars($comment['review_title']); ?></td>
                                            <td><?php echo htmlspecialchars($comment['product_name']); ?></td>
                                            <td>
                                            <a href="#" onclick="confirmDeletion(<?php echo $comment['comments_id']; ?>); return false;" class="btn btn-custom-danger">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6">No hay comentarios disponibles.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>