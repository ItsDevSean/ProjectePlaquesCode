<?php
include("conexion.php");
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$apellido = $_POST['apellido'];

if($nombre== '' || $email== '' || $apellido== ''){
    die('HAY QUE RELLENAR TODOS LOS CAMPOS');
}

$nombre = $conn->real_escape_string($nombre);
$email = $conn->real_escape_string($email);
$apellido = $conn->real_escape_string($apellido);


$sql = "INSERT INTO usuarios (nombre, email, apellido) VALUES ('$nombre', '$email', '$apellido')";

if($conn->query($sql) === TRUE){
    echo "Usuario registrado correctamente.";
}else{
    echo "Error: " . $conn-> error;
}

$conn->close();
?>