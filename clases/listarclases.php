<?php
include "../bd/base_de_datos.php";
try {
    $sentencia = $base_de_datos->query("SELECT * FROM clase;");
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
        <h1>Academia de Pintura</h1>
    </header>
    <nav>
        <ul>
            <li><a href="../principal.php">Inicio</a></li>
            <li><a href="../usuarios/perfil.php">Perfil</a></li>
            <li><a href="../usuarios/listarusuarios.php">Usuarios</a></li>
            <li><a href="listarclases.php">Clases</a></li>
        </ul>
    </nav>
    <h1>Tabla de clases</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Capacidad</th>
                <th>Alumnos</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($personas as $proyecto){ ?>
            <tr>
                <td><?php echo $proyecto->ID ?></td>
                <td><?php echo $proyecto->Nombre ?></td>
                <td><?php echo $proyecto->Fecha ?></td>
                <td><?php echo $proyecto->Hora ?></td>
                <td><?php echo $proyecto->Capacidad ?></td>
                <td><a href="<?php echo "./alumnos_clase.php?id=" . $proyecto->ID?>">Alumnos</a></td>
                <td><a href="<?php echo "./editar_clase.php?id=" . $proyecto->ID?>">Editar</a></td>
                <td><a href="<?php echo "./eliminar_clase.php?id=" . $proyecto->ID?>">Eliminar</a></td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <h1>Agregar alumno a una clase</h1>
    <form method="post" action="procesar_agregar_usuario.php">
        <!-- Campo desplegable para seleccionar la clase -->
        <div class="form-group">
            <label for="clase_id">Clase:</label>
            <select name="clase_id" id="clase_id" class="form-control" required>
                <?php
                // Conectar a la base de datos
                include "../bd/base_de_datos.php";
 
                // Consultar la lista de profesores
                $result = $base_de_datos->query("SELECT id, CONCAT(nombre, ' ', fecha, ' - ', hora) AS info_clase FROM clase");
 
                 // Mostrar opciones en el campo desplegable
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['info_clase']}</option>";
                }
                ?>
            </select>
        </div>
        <!-- Campo desplegable para seleccionar el alumno -->
        <div class="form-group">
            <label for="alumno_id">Alumno:</label>
            <select name="alumno_id" id="alumno_id" class="form-control" required>
                <?php
                // Conectar a la base de datos
                include_once "../bd/base_de_datos.php";
 
                // Consultar la lista de profesores
                $result = $base_de_datos->query("SELECT id, CONCAT(nombre, ' ', apellidos) AS info_alum FROM usuario WHERE tipo = 'alumno'");
 
                 // Mostrar opciones en el campo desplegable
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['info_alum']}</option>";
                }
                ?>
            </select>
        </div>

        <input type="submit" value="Agregar a la clase">
    </form>

    <h1>Agregar profesor a una clase</h1>
    <form method="post" action="procesar_agregar_usuario.php">
        <!-- Campo desplegable para seleccionar la clase -->
        <div class="form-group">
            <label for="clase_id">Clase:</label>
            <select name="clase_id" id="clase_id" class="form-control" required>
                <?php
                // Conectar a la base de datos
                include "../bd/base_de_datos.php";
 
                // Consultar la lista de profesores
                $result = $base_de_datos->query("SELECT id, CONCAT(nombre, ' ', fecha, ' - ', hora) AS info_clase FROM clase");
 
                 // Mostrar opciones en el campo desplegable
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['info_clase']}</option>";
                }
                ?>
            </select>
        </div>
        <!-- Campo desplegable para seleccionar el alumno -->
        <div class="form-group">
            <label for="alumno_id">Profesor:</label>
            <select name="alumno_id" id="alumno_id" class="form-control" required>
                <?php
                // Conectar a la base de datos
                include_once "../bd/base_de_datos.php";
 
                // Consultar la lista de profesores
                $result = $base_de_datos->query("SELECT id, CONCAT(nombre, ' ', apellidos) AS info_alum FROM usuario WHERE tipo = 'profesor'");
 
                 // Mostrar opciones en el campo desplegable
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['info_alum']}</option>";
                }
                ?>
            </select>
        </div>

        <input type="submit" value="Agregar a la clase">
    </form>
    <h1>Crear nueva clase</h1>
    <form method="post" action="aplicar_nueva_clase.php">
        <fieldset>
            <label for="nombre">Nombre:</label>
            <br>
            <input name="nombre" required type="text" id="nombre" placeholder="Escribe el nombre de la clase">
            <br><br>
            <label for="fecha">Fecha:</label>
            <br>
            <input name="fecha" required type="date" id="fecha">
            <br><br>
            <label for="hora">Hora</label>
            <br>
            <input name="hora" required type="time" id="hora">
            <br><br>
            <label for="capacidad">Capacidad:</label>
            <br>
            <input name="capacidad" required type="number" id="capacidad">   
            <br><br><input type="submit" value="Registrar">
        </fieldset>
    </form>
</body>
</html>