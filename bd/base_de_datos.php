<?php
$contraseña = "Alisal2023";
$usuario = "proyecto";
$nombre_base_de_datos = "dataphract";
try{
    $base_de_datos = new PDO('mysql:host=192.168.19.179;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
}catch(Exception $e){
    echo "Ocurrio algo con la base de datos:" . $e->getMessage();
}
?>