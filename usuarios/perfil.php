<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

} else {
    echo "El ID de usuario no está definido en la sesión.";
}

include "../bd/base_de_datos.php"; 
try {
    $consulta = $base_de_datos->prepare("SELECT * FROM usuario WHERE id_usuario = :id");
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    $nombre = $usuario['nombres'];
    $apellidos = $usuario['apellidos'];
    $correo = $usuario['email'];
    $tipo = $usuario['tipo_usuario'];
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .profile-info {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-info p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .profile-info p strong {
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Perfil de Usuario</h1>
        <div class="profile-info">
            <p><strong>ID de usuario:</strong> <?php echo $id; ?></p>
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Apellidos:</strong> <?php echo $apellidos; ?></p>
            <p><strong>Correo electrónico:</strong> <?php echo $correo; ?></p>
            <p><strong>Rango de privilegios:</strong> <?php echo $tipo; ?></p>
            <!-- Agrega más información del perfil si la tienes -->

            <!-- Un botón para regresar a la página principal -->
            <a href="../principal.php" class="btn">Volver a la página principal</a>
        </div>
    </div>
</body>
</html>