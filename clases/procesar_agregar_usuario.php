<?php

// Verificar si se ha enviado información por el formulario
try {
    
    // Conectar a la base de datos
    include "../bd/base_de_datos.php";

    // Recoger los datos del formulario
    $clase_id = $_POST['clase_id'];
    $alumno_id = $_POST['alumno_id'];

    // Verificar si la clase y el usuario existen en la base de datos
    $consulta_clase = $base_de_datos->prepare("SELECT * FROM clase WHERE ID = :clase_id");
    $consulta_clase->bindParam(':clase_id', $clase_id);
    $consulta_clase->execute();

    $consulta_usuario = $base_de_datos->prepare("SELECT * FROM usuario WHERE id = :alumno_id");
    $consulta_usuario->bindParam(':alumno_id', $alumno_id);
    $consulta_usuario->execute();

    if ($consulta_clase->rowCount() == 1 && $consulta_usuario->rowCount() == 1) {
        // Insertar el usuario a la clase correspondiente en la tabla alumno_clase
        $insertar_usuario_clase = $base_de_datos->prepare("INSERT INTO alumno_clase (Alumno_ID, Clase_ID) VALUES (:alumno_id, :clase_id)");
        $insertar_usuario_clase->bindParam(':alumno_id', $alumno_id);
        $insertar_usuario_clase->bindParam(':clase_id', $clase_id);
        $insertar_usuario_clase->execute();

    }
}catch(Exception $e){
    echo "Ocurrio un error:" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuario añadido correctamente</title>
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
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
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
        <h1>Usuario agregado correctamente a la clase</h1>
        <div class="profile-info">
            <a href="../principal.php" class="btn">Volver a la página principal</a>
        </div>
    </div>
</body>
</html>