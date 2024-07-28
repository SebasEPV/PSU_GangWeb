<?php
session_start();
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegúrate de que el ID es un número entero
    $consulta = "DELETE FROM reviews WHERE review_id = :id";
    $stmt = $enlace->prepare($consulta);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        die("Error al eliminar la reseña: " . print_r($stmt->errorInfo(), true));
    }
}

header('Location:./../views/admin/gestionarReseñas/listasReseñas.php');
exit();
