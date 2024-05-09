<?php
include "../bd/base_de_datos.php";
try {
    $sentencia = $base_de_datos->query("SELECT * FROM usuario;");
    $personas = $sentencia->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
    echo "Ocurrio un error:" . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            /*height: 100vh;*/
        }

        header {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        header, nav {
            width: 100%;
            display: block;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.8); /* Fondo negro con opacidad */
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center; /* Centrar elementos del menú */
        }

        nav ul li {
            display: inline-block;
            margin-right: 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff; /* Color del texto del menú */
            padding: 8px 15px;
            border-radius: 5px;
        }

        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Cambiar color al pasar el cursor */
        }

        table {
            border-collapse: collapse;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px; /* Ajusta el margen superior */
        }
        input[type="submit"] {
            padding: 8px 15px;
            border-radius: 5px;
            background-color: #fff;
            border: none;
            cursor: pointer;
        }

        form {
            width: 50%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <header>
        <h1>Empresa</h1>
    </header>
    <nav>
        <ul>
            <li><a href="../principal.php">Inicio</a></li>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="listarusuarios.php">Usuarios</a></li>
        </ul>
    </nav>
    
    <h1>Tabla de usuarios</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($personas as $proyecto){ ?>
            <tr>
                <td><?php echo $proyecto->id ?></td>
                <td><?php echo $proyecto->nombre ?></td>
                <td><?php echo $proyecto->apellidos ?></td>
                <td><?php echo $proyecto->email ?></td>
                <td><?php echo $proyecto->tipo ?></td>
                <td><a href="<?php echo "./editar_usuario.php?id=" . $proyecto->id?>">Editar</a></td>
                <td><a href="<?php echo "./eliminar_usuario.php?id=" . $proyecto->id?>">Eliminar</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <h1>Agregar usuario</h1>
    <form method="post" action="aplicar_nuevo_usuario.php">
        <fieldset>
            <label for="nombre">Nombre:</label>
            <br>
            <input name="nombre" required type="text" id="nombre" placeholder="Escribe tu nombre">
            <br><br>
            <label for="apellidos">Apellidos:</label>
            <br>
            <input name="apellidos" required type="text" id="apellidos" placeholder="Escribe tus apellidos">
            <br><br>
            <label for="pass">Contraseña:</label>
            <br>
            <input name="pass" required type="password" id="pass" placeholder="Escribe tu contraseña">
            <br><br>
            <label for="email">Email:</label>
            <br>
            <input name="email" required type="text" id="email" placeholder="Escribe tu email">
            <br><br>
            <label for="tipo">Privilegios</label>
            <select name="tipo" required name="tipo" id="tipo">
                <option value="alumno">Alumno</option>
                <option value="profesor">Profesor</option>
                <option value="administracion">Administracion</option>
            </select>
            <br><br><input type="submit" value="Registrar">
        </fieldset>
    </form>
</body>
</html>