<?php
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    die("Error al establecer la conexión a la base de datos.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = $_POST['review_name'];
    $contenido = $_POST['review_content'];
    $tier_id = $_POST['tier'];
    $product_id = $_POST['product'];
    $author_id = 1; // Reemplaza esto con el ID del autor que corresponda, por ejemplo, desde una sesión o un valor predefinido.

    // Validar los datos (puedes agregar más validaciones según sea necesario)
    if (empty($titulo) || empty($contenido) || empty($tier_id) || empty($product_id)) {
        die("Todos los campos son obligatorios.");
    }

    try {
        // Insertar la reseña en la tabla `reviews`
        $sql = "INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
                VALUES (:titulo, :contenido, :product_id, :tier_id, :author_id)";
        $stmt = $enlace->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':tier_id', $tier_id);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->execute();

        header("Location: ./../views/admin/gestionarReseñas/listasReseñas.php");

    } catch (Exception $e) {
        echo "Error al agregar la reseña: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
