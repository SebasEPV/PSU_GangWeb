<?php
require("./../../config/database.php");
mysqli_report(MYSQLI_REPORT_OFF);

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
}

$firstName = $_POST['Fname'];
$lastName = $_POST['Lname'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];
$email = $_POST['email'];
$username = $_POST['username'];

if ($pass != $pass2){
    header('Location: ./../views/auth/register.php?err=2');
    exit;
}

$consulta = "SELECT COUNT(*) FROM users WHERE username = '$username'";
try {
    $result = $enlace->prepare($consulta);
    $result->execute();
    $number_of_rows = $result->fetchColumn();
    if ($number_of_rows > 0){
        header('Location: ./../views/auth/register.php?err=3');
        exit;
    }
} catch (Exception $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit;
}


$sql_insert = "INSERT INTO users (username, first_name, last_Name, pass, email, permissions)
VALUES ('$username', '$firstName', '$lastName', '$pass', '$email', False)";

try {
    $result = $enlace->prepare($sql_insert);
    $result->execute();
    header("Location: ./../views/auth/login.php");
} catch (Exception $e) {
    echo "Error en la consulta: " . $e->getMessage();
}

