<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/iniciosesion.css">
    <title>Inventario - Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        main {
            width: 50%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <main>
        <div id="form">
            <h1>Iniciar sesión</h1>
                <form action="bd/compruebausuario.php" method="POST">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required>
                <br /><br />
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="passw" name="passw" required>
                <br /><br />
                <input type="submit" value="Iniciar sesión">
            </form>
            <br>
            <br>
            <br>
        </div>
    </main>
</body>
</html>