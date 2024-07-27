<?php
session_start();

// Verificar si no hay sesión activa, redirigir al login
if (!isset($_SESSION['user_id'])) {
    header("Location: /sisweb/app/views/auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>