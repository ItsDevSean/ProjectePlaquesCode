<?php
$servidor = "sql7.freemysqlhosting.net";
$usuario = "sql7757835";
$contraseña = "rYr5ukw4nC";
$base_de_datos = "sql7757835"; 
$conn = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

if ($conn->connect_error) {
    die("Conexion fallida". $conn->connect_error);
}else{
    echo "Conexion OK";
}
?>