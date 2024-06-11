<?php
$dns = 'mysql:host=localhost:3306;dbname=dataphract';
$contraseña = "admin";
$usuario = "admin";
$nombre_base_de_datos = "dataphract";
try{
    $base_de_datos = new PDO($dns , $usuario, $contraseña);
}catch(Exception $e){
    echo "Ocurrio algo con la base de datos:" . $e->getMessage();
}
?>