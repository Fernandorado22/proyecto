<?php
include "../bd/base_de_datos.php";
$id = $_GET["id"];
try {
    $sentencia = $base_de_datos->prepare("SELECT b.* FROM alumno_clase a INNER JOIN usuario b ON a.Alumno_ID=b.id WHERE a.Clase_ID = ?;");
    $sentencia->execute([$id]);
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
    
    <h1>Alumnos de clase</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Eliminar de la clase</th>
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
                <td><a href="<?php echo "./eliminar_alumno_clase.php?id=" . $proyecto->id?>">Eliminar</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>