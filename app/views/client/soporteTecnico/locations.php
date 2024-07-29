<?php
require './../../../../config/config.php';

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

// Obtener marcas
$queryLocatiosn = $enlace->query("SELECT brand_id, brand_name FROM brands");
$locations = $queryLocatiosn->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSU Gang | Ubicaciones</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Ubica nuestras casas de soporte tecnico</h1>
    <table class="table">
            <tr>
                <th scope="col">Ciudad</th>
                <th scope="col">Correo</th>
                <th scope="col">Número de telefono</th>
            </tr>
        <?php foreach($locations as $location): ?>
            <tr>
                <td><?php echo htmlspecialchars($location['location'])?></td>
                <td><?php echo htmlspecialchars($location['email'])?></td>
                <td><?php echo htmlspecialchars($location['phoneNumber'])?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>