<?php
session_start();
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    die("Error al establecer la conexión a la base de datos.");
}

// Verificar si la sesión contiene el email del usuario
if (!isset($_SESSION['email'])) {
    die("No hay un usuario autenticado.");
}

$pass = trim($_POST['pass']);
$pass2 = trim($_POST['pass2']);

// Verificar si las contraseñas coinciden
if ($pass != $pass2) {
    header('Location: ./../views/auth/restablecer_contraseña.php?err=8');
    exit();
}

$email = $_SESSION['email'];

try {
    // Actualizar la contraseña en la base de datos
    $query = "UPDATE users SET pass = :pass WHERE email = :email";
    $stmt = $enlace->prepare($query);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Redirigir al login con un mensaje de éxito
        header('Location: ./../views/auth/login.php?success=1');
        exit();
    } else {
        echo "No se actualizó ninguna fila. Verifica que el usuario exista.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
