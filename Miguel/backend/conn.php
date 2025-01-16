<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "mondongo"; 
    $conn = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);
    
    if ($conn->connect_error) {
        die("Conexion fallida". $conn->connect_error);
    }
?>