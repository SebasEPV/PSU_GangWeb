<?php
session_start();

if (!isset($_SESSION['email'])) {
   header('Location: ./../../auth/login.php?err=6');
    exit;
}

require("./../../../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
}

if (!isset($_SESSION['email'])) {
    header('Location: ./../views/auth/login.php');
    exit;
}

$email = $_SESSION['email'];

$query = $enlace->prepare("SELECT * FROM users WHERE email = :email");
$query->bindParam(':email', $email, PDO::PARAM_STR);

if ($query->execute()) {
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        die("No se encontró el usuario.");
    }
} else {
    die("Error en la consulta: " . print_r($enlace->errorInfo(), true));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #DDDCDB;
            margin: 20px;
        }

        .profile-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #383838;
        }

        .profile-info {
            margin-bottom: 10px;
        }

        .profile-label {
            font-weight: bold;
            color: #383838;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .navbar-nav .nav-link {
            color: #383838;
        }

        .navbar-nav .nav-link:hover {
            color: #00E9D2;
        }
    </style>
</head>

<body>
    <?php include 'navBar.php'; ?>
    <?php include './../refs.html'; ?>

    <div class="profile-container">
        <h1>Perfil de Usuario</h1>
        <div class="profile-info">
            <span class="profile-label">Nombre de usuario:</span> <?php echo htmlspecialchars($user['username']); ?>
        </div>
        <div class="profile-info">
            <span class="profile-label">Nombre:</span> <?php echo htmlspecialchars($user['first_name']); ?>
        </div>
        <div class="profile-info">
            <span class="profile-label">Apellido:</span> <?php echo htmlspecialchars($user['last_name']); ?>
        </div>
        <div class="profile-info">
            <span class="profile-label">Correo electrónico:</span> <?php echo htmlspecialchars($user['email']); ?>
        </div>
        <div class="profile-info">
            <span class="profile-label">Permisos:</span> <?php echo $user['permissions'] ? 'Administrador' : 'Usuario'; ?>
        </div>
        <div class="text-center">
            <a href="./editarPerfil.php" class="btn btn-primary mt-3">Editar Información</a>
            <?php if ($user['permissions']): ?>
                <a href="./../../admin/gestionarReseñas/listasReseñas.php" class="btn btn-primary mt-3">Vista de Administrador</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>