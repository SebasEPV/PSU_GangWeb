<?php
session_start();
$isLoggedIn = isset($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quiénes Somos?</title>
    <link rel="stylesheet" href="./../../../public/assets/css/faq.css">
    <style>
        /* Estilos para los botones */
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            color: #fff;
        }

        .btn-success {
            background-color: #007bff;
            /* Azul */
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            /* Rojo */
            border: none;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="mainClient.php">Inicio</a></li>
                <li><a href="./../client/nosotros/faq.php">Nosotros</a></li>
                <li><a href="./../client/reseñas/reviews.php">Reseñas</a></li>
                <li class="has-children">
                    <a class="nav-link">Soporte técnico</a>
                    <ul class="dropdown">
                        <li><a href="./../client/soporteTecnico/locations.php">Ubicaciones</a></li>
                        <li><a href="./../client/soporteTecnico/chatbotLiz.php">Platica con Liz</a></li>
                        <li><a href="./../client/soporteTecnico/wattageCalculator.php">Calculadora de wattage</a></li>
                    </ul>
                </li>
                <li><a href="./../client/gestionarPerfil/verPerfil.php">Gestionar perfil</a></li>
                <?php if ($isLoggedIn) : ?>
                    <li><a href="./../../controllers/logout.php" class="btn btn-danger">Cerrar Sesión</a></li>
                <?php else : ?>
                    <li><a href="./../auth/login.php" class="btn btn-success">Regístrate</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>

</html>