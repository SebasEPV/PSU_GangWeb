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
        nav {
            background-color: #333;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            display: block;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #444;
        }

        nav ul li ul {
            display: none;
            position: absolute;
            background-color: #444;
            top: 100%;
            left: 0;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li:hover ul {
            display: block;
        }

        nav ul li ul li a {
            padding: 0.5rem 1rem;
            width: 200px;
            background-color: #444;
        }

        nav ul li ul li a:hover {
            background-color: #555;
        }

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
                <li><a href="./../../layouts/mainClient.php">Inicio</a></li>
                <li><a href="./../nosotros/faq.php">Nosotros</a></li>
                <li><a href="./../reseñas/reviews.php">Reseñas</a></li>
                <li><a href="./../gestionarComentarios/commentsSection.php">Comentarios</a></li>
                <li class="has-children">
                    <a class="nav-link">Soporte técnico</a>
                    <ul class="dropdown">
                        <li><a href="./../soporteTecnico/locations.php">Ubicaciones</a></li>
                        <li><a href="./../soporteTecnico/chatbotLiz.php">Platica con Liz</a></li>
                        <li><a href="./../soporteTecnico/wattageCalculator.php">Calculadora de wattage</a></li>
                    </ul>
                </li>
                <?php if ($isLoggedIn) : ?>
                    <li><a href="./../../../controllers/logout.php" class="btn btn-danger">Cerrar Sesión</a></li>
                <?php else : ?>
                    <li><a href="./../../auth/login.php" class="btn btn-success">Regístrate</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>

</html>