<?php
session_start();
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    die("Error al establecer la conexión a la base de datos.");
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los correos del formulario
    $email = trim($_POST['email']);
    $email2 = trim($_POST['email2']);

    // Comprobar si los correos son iguales
    if ($email !== $email2) {
        // Redirigir con el error correspondiente
        header('Location: ./../views/auth/forgotPassword.php?err=4');
        exit();
    }

    // Comprobar si el correo está registrado en la base de datos
    try {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $enlace->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();

        if ($userExists == 0) {
            // Si no se encuentra el correo, redirigir con un error
            header('Location: ./../views/auth/forgotPassword.php?err=5');
            exit();
        }

        // Redirigir a una página de confirmación o al login con un mensaje de éxito
        $_SESSION['email'] = $email;
        header('Location: ./../views/auth/restablecer_contraseña.php');
        exit();
    } catch (PDOException $e) {
        // Manejo de errores en la base de datos
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si se accede al archivo sin enviar el formulario, redirigir al formulario de inicio de sesión
    header('Location: ./../views/auth/login.php');
    exit();
}
