<?php
session_start();
require("./../../config/database.php");

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
  throw new Exception("Error al establecer la conexión a la base de datos.");
}

// Verificar si el usuario está autenticado y si la conexión a la base de datos está establecida
if (!isset($_SESSION['email'])) {
    die("No estás autenticado.");
}

// Obtener el ID del usuario usando el correo electrónico
$email = $_SESSION['email'];
$queryUser = "SELECT user_id FROM users WHERE email = :email";
$consultaUser = $enlace->prepare($queryUser);
$consultaUser->bindParam(':email', $email, PDO::PARAM_STR);

if (!$consultaUser->execute()) {
    die("Error al obtener el ID del usuario.");
}

$user = $consultaUser->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    die("Usuario no encontrado.");
}

$user_id = $user['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['review_id'], $_POST['content']) && !empty($_POST['content'])) {
        $review_id = intval($_POST['review_id']);
        $content = trim($_POST['content']);
        
        // Inserción del comentario en la base de datos
        $query = "INSERT INTO comments (fk_review_id, fk_user_id, content) VALUES (:review_id, :user_id, :content)";
        $consulta = $enlace->prepare($query);
        $consulta->bindParam(':review_id', $review_id, PDO::PARAM_INT);
        $consulta->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $consulta->bindParam(':content', $content, PDO::PARAM_STR);

        if ($consulta->execute()) {
            header("Location: ./../views/client/reseñas/reviewDetail.php?review_id=$review_id");
            exit;
        } else {
            die("Error al agregar el comentario.");
        }
    } else {
        die("Error: contenido del comentario no válido.");
    }
} else {
    die("Método no permitido.");
}
