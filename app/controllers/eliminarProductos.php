<?php
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

if (isset($_GET['id'])) {
  $productId = $_GET['id'];

  try {
    // Start transaction
    $enlace->beginTransaction();

    // Delete references in product_categories
    $stmt = $enlace->prepare("DELETE FROM product_categories WHERE fk_product_id = :productId");
    $stmt->execute(['productId' => $productId]);

    // Delete the product
    $stmt = $enlace->prepare("DELETE FROM products WHERE product_id = :productId");
    $stmt->execute(['productId' => $productId]);

    // Commit transaction
    $enlace->commit();

    // Redirect or show success message
    header("Location: ./../views/admin/gestionarProductos/listasProducto.php");
    exit;
  } catch (Exception $e) {
    // Rollback transaction if something failed
    $enlace->rollBack();
    echo "Failed: " . $e->getMessage();
  }
} else {
  echo "No product ID provided.";
}
