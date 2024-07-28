<?php
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    die("Error al establecer la conexión a la base de datos.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['product_name'];
    $descripcion = $_POST['description'];
    $precio = $_POST['price'];
    $marca_id = $_POST['brand'];
    $categoria_id = $_POST['category'];

    // Validar los datos (puedes agregar más validaciones según sea necesario)
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($marca_id) || empty($categoria_id)) {
        die("Todos los campos son obligatorios.");
    }

    // Iniciar una transacción
    $enlace->beginTransaction();

    try {
        // Manejo de nueva marca
        if ($marca_id === 'new') {
            $newBrandName = $_POST['new_brand'];
            $stmt = $enlace->prepare("INSERT INTO brands (brand_name) VALUES (:brand_name)");
            $stmt->bindParam(':brand_name', $newBrandName);
            $stmt->execute();
            $marca_id = $enlace->lastInsertId();
        }

        // Manejo de nueva categoría
        if ($categoria_id === 'new') {
            $newCategoryName = $_POST['new_category'];
            $stmt = $enlace->prepare("INSERT INTO categories (category_name) VALUES (:category_name)");
            $stmt->bindParam(':category_name', $newCategoryName);
            $stmt->execute();
            $categoria_id = $enlace->lastInsertId();
        }

        // Insertar el producto en la tabla `products`
        $sql = "INSERT INTO products (product_name, product_description, product_price, fk_brand_id) 
                VALUES (:nombre, :descripcion, :precio, :marca_id)";
        $stmt = $enlace->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':marca_id', $marca_id);
        $stmt->execute();

        // Obtener el ID del producto insertado
        $product_id = $enlace->lastInsertId();

        // Insertar la relación en `product_categories`
        $sql = "INSERT INTO product_categories (fk_product_id, fk_category_id) 
                VALUES (:product_id, :categoria_id)";
        $stmt = $enlace->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->execute();

        // Confirmar la transacción
        $enlace->commit();
        header("Location: ./../views/admin/gestionarProductos/listasProducto.php");

    } catch (Exception $e) {
        // Si ocurre un error, revertir la transacción
        $enlace->rollBack();
        echo "Error al agregar el producto: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
