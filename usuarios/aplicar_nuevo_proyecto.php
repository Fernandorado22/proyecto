<?php
if(!isset($_POST["nombre"]) || !isset($_POST["precio"]) || !isset($_POST["tipo"]) || !isset($_POST["usuario"])) exit();

include_once "../bd/base_de_datos.php";
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$tipo = $_POST["tipo"];
$usuario = $_POST["usuario"];
try {
    $sentencia = $base_de_datos->prepare("INSERT INTO proyecto(fk_id_cliente, nombre, precio, estado) VALUES (?, ?, ?, ?);");
    $resultado = $sentencia->execute([$usuario, $nombre, $precio, $tipo]);
}catch(Exception $e){
    echo "Ocurrio un error:" . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto añadido correctamente</title>
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
        <h1>Proyecto añadido correctamente</h1>
        <div class="profile-info">
            <a href="../principal.php" class="btn">Volver a la página principal</a>
        </div>
    </div>
</body>
</html>