<?php
if(!isset($_POST["nombre"]) || !isset($_POST["apellidos"]) || !isset($_POST["email"]) || !isset($_POST["pass"]) || !isset($_POST["tipo"])) exit();

include_once "../bd/base_de_datos.php";
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$tipo = $_POST["tipo"];
try {
    $sentencia = $base_de_datos->prepare("INSERT INTO usuario(nombre, apellidos, email, pass, tipo) VALUES (?, ?, ?, MD5(?), ?);");
    $resultado = $sentencia->execute([$nombre, $apellidos, $email, $pass, $tipo]);
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
        <h1>Usuario añadido correctamente</h1>
        <div class="profile-info">
            <a href="../principal.php" class="btn">Volver a la página principal</a>
        </div>
    </div>
</body>
</html>