<?php
session_start();
 
include "base_de_datos.php";
 
$username = $_POST['correo'];
$password = $_POST['passw'];

try {
    $consulta = $base_de_datos->prepare("SELECT * FROM usuario WHERE email = :username AND pass = MD5(:password)");
    $consulta->bindParam(':username', $username);
    $consulta->bindParam(':password', $password);
    $consulta->execute();
    
    if ($consulta->rowCount() == 1) {
    
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        $_SESSION['usuario'] = $row['nombre'];
        $_SESSION['correo'] = $row['email'];
        $_SESSION['tipousuario'] = $row['tipo'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['apellidos'] = $row['apellidos'];

        header("Location: ../principal.php");
        exit();
    
    } else {
        echo "Usuario o contraseña incorrectos";
        header("Location: ../index.php");
        exit();
    }
}catch(Exception $e){
    echo "Ocurrio un error:" . $e->getMessage();
}
?>