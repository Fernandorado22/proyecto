<?php
$contraseña = "";
$usuario = "";
$nombre_base_de_datos = "dataphract";
try{
    print_r("dentro del try");
    $base_de_datos = new PDO('mysql:host=localhost:33;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
}catch(Exception $e){
    echo "Ocurrio algo con la base de datos:" . $e->getMessage();
}
?>