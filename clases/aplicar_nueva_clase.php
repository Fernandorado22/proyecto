<?php
if(!isset($_POST["nombre"]) || !isset($_POST["fecha"]) || !isset($_POST["hora"]) || !isset($_POST["capacidad"])) exit();

include_once "../bd/base_de_datos.php";
$nombre = $_POST["nombre"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$capacidad = $_POST["capacidad"];
try {
    $sentencia = $base_de_datos->prepare("INSERT INTO clase(nombre, fecha, hora, capacidad) VALUES (?, ?, ?, ?);");
    $resultado = $sentencia->execute([$nombre, $fecha, $hora, $capacidad]);
}catch(Exception $e){
    echo "Ocurrio un error:" . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clase añadida correctamente</title>
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
        <h1>Clase añadida correctamente</h1>
        <div class="profile-info">
            <a href="../principal.php" class="btn">Volver a la página principal</a>
        </div>
    </div>
</body>
</html>