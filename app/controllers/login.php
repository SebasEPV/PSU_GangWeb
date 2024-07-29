<?php
session_start();
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
}

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Consulta para obtener el usuario y sus permisos
    $result = $enlace->prepare("SELECT * FROM users WHERE email = :email");
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    
    if ($result->execute()) {
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['pass'] === $pass) {
            // Guardar el correo en la sesión
            $_SESSION['email'] = $email;

            // Verificar permisos del usuario
            if ($user['permissions']) {
                // Usuario con permisos, redirigir a listarReseñas.php
                header('Location: ./../views/admin/gestionarReseñas/listasReseñas.php');
            } else {
                // Usuario sin permisos, redirigir a inicio.php
                header('Location: ./../views/layouts/mainClient.php');
            }
            exit;
        } else {
            // Credenciales incorrectas
            header('Location: ./../views/auth/login.php?err=1');
            exit;
        }
    } else {
        die("Error en la consulta: " . print_r($enlace->errorInfo(), true));
    }
}