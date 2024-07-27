<?php
mysqli_report(MYSQLI_REPORT_OFF);

session_start();
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
}


if (isset($_GET['id'])){
    $id = $_GET['id'];
    $consulta = "DELETE FROM reviews WHERE review_id = " . $id;
    $result = $enlace->query($consulta);
}
header('Location:./../views/admin/gestionarReseñas/listasReseñas.php');
