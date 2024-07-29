<?php
session_start();
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['email'])) {
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $new_email = $_POST['email'];
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Actualizar información del usuario
        $updateQuery = $enlace->prepare("UPDATE users SET username = :username, first_name = :first_name, last_name = :last_name, email = :new_email WHERE email = :email");
        $updateQuery->bindParam(':username', $username, PDO::PARAM_STR);
        $updateQuery->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $updateQuery->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $updateQuery->bindParam(':new_email', $new_email, PDO::PARAM_STR);
        $updateQuery->bindParam(':email', $email, PDO::PARAM_STR);

        if ($updateQuery->execute()) {
            // Actualizar la contraseña si es necesario
            if (!empty($current_password) && !empty($new_password) && $new_password === $confirm_password) {
                $user = $enlace->query("SELECT password FROM users WHERE email = '$email'")->fetch(PDO::FETCH_ASSOC);

                if (password_verify($current_password, $user['password'])) {
                    $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);
                    $passwordUpdateQuery = $enlace->prepare("UPDATE users SET password = :new_password WHERE email = :email");
                    $passwordUpdateQuery->bindParam(':new_password', $hashed_new_password, PDO::PARAM_STR);
                    $passwordUpdateQuery->bindParam(':email', $email, PDO::PARAM_STR);

                    if ($passwordUpdateQuery->execute()) {
                        $_SESSION['email'] = $new_email;
                        header('Location: ./verPerfil.php');
                        exit;
                    } else {
                        $error = "Error al actualizar la contraseña.";
                    }
                } else {
                    $error = "La contraseña actual es incorrecta.";
                }
            } else {
                $_SESSION['email'] = $new_email;
                header('Location: ./verPerfil.php');
                exit;
            }
        } else {
            $error = "Error al actualizar los datos.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #383838;
        }

        .wrapper {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background-color: #DDDCDB;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #383838;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-control {
            margin-bottom: 8px;
        }

        .btn {
            background-color: #00E9D2;
            color: #383838;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #ffffff;
        }

        .btn-success {
            background-color: #28a745;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>Editar Perfil</h1>
        <?php if (isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        } ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="first_name">Nombre</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Apellido</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-success" value='Guardar cambios'>
                <a href="./verPerfil.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>