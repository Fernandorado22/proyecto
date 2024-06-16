<?php
include "../bd/base_de_datos.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: iniciar_sesion.php");
    exit();
}

try {
    $sentencia = $base_de_datos->query("SELECT * FROM usuario;");
    $personas = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $consulta = $base_de_datos->query("SELECT id_usuario, nombres, apellidos FROM usuario");
    $usuarios = $consulta->fetchAll(PDO::FETCH_OBJ);
    $query = $base_de_datos->query("SELECT u.nombres, u.apellidos, p.nombre, p.precio, p.estado FROM proyecto p INNER JOIN usuario u on u.id_usuario = p.fk_id_cliente");
    $presupuestos = $query->fetchAll(PDO::FETCH_OBJ);
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
                <td><?php echo $proyecto->id_usuario ?></td>
                <td><?php echo $proyecto->nombres ?></td>
                <td><?php echo $proyecto->apellidos ?></td>
                <td><?php echo $proyecto->email ?></td>
                <td><?php echo $proyecto->tipo_usuario ?></td>
                <td><a href="<?php echo "./editar_usuario.php?id=" . $proyecto->id_usuario?>">Editar</a></td>
                <td><a href="<?php echo "./eliminar_usuario.php?id=" . $proyecto->id_usuario?>">Eliminar</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <h1>Tabla presupuesto</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre usuario</th>
                <th>Apellidos usuario</th>
                <th>Nombre proyecto</th>
                <th>Estado</th>
                <th>Presupuesto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($presupuestos as $presupuesto){ ?>
            <tr>
                <td><?php echo $presupuesto->nombres ?></td>
                <td><?php echo $presupuesto->apellidos ?></td>
                <td><?php echo $presupuesto->nombre ?></td>
                <td><?php echo $presupuesto->estado ?></td>
                <td><?php echo $presupuesto->precio ?></td>
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
                <option value="administracion">Administracion</option>
            </select>
            <br><br><input type="submit" value="Registrar">
        </fieldset>
    </form>

    <h1>Agregar proyecto</h1>
    <form method="post" action="aplicar_nuevo_proyecto.php">
        <fieldset>
            <label for="nombre">Nombre:</label>
            <br>
            <input name="nombre" required type="text" id="nombre" placeholder="Escribe tu nombre">
            <br><br>
            <label for="precio">Precio:</label>
            <br>
            <input name="precio" required type="text" id="precio" placeholder="Escribe el precio">
            <br><br>
            <label for="tipo">Estado:</label>
            <select name="tipo" required id="tipo">
                <option value="en_proceso">En proceso</option>
                <option value="finalizado">Finalizado</option>
            </select>
            <label for="usuario">Usuario:</label>
            <select name="usuario" required id="usuario">
                <?php 
                if ($usuarios) {
                    // Salida de datos de cada fila
                    foreach($usuarios as $row) {
                        echo "<option value='" . $row->id_usuario . "'>" . $row->nombres . " " . $row->apellidos . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay datos</option>";
                }
                ?>
                </select>
            <br><br><input type="submit" value="Registrar">
        </fieldset>
    </form>
</body>
</html>