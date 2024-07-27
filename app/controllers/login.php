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
    $result = $enlace->prepare("SELECT * FROM users WHERE email = '$_POST[email]' AND pass = '$_POST[pass]'");
    if ($result) {
        $result->execute();
        $number_of_rows = $result->fetchColumn();
        if ($number_of_rows != 0) {
            $_SESSION['email'] = $_POST['email'];
            header('Location: ./../views/admin/gestionarReseñas/listasReseñas.php');
        } else {
            header('Location: ./../views/auth/login.php?err=1');
        }
    }
}

