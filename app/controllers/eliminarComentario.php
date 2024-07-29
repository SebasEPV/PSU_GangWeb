<?php
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
}

// Manejo de eliminación de comentario
if (isset($_GET['delete'])) {
    $commentId = $_GET['delete'];
    $deleteQuery = "DELETE FROM comments WHERE comments_id = :commentId";
    $deleteStmt = $enlace->prepare($deleteQuery);
    $deleteStmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    if ($deleteStmt->execute()) {
        header("Location: ./../views/admin/gestionarComentarios/listarComentarios.php");
        exit;
    } else {
        die("No se pudo eliminar el comentario.");
    }
}
