<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];

    $sql = "INSERT INTO usuarios (usuario, contraseña, nombre, apellido, segundoApellido, correo, telefono, rol) 
            VALUES ('$usuario', '$contraseña', '$nombre', '$apellido', '$segundoApellido', '$correo', '$telefono', '$rol')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuarios</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Usuario: <input type="text" name="usuario" required><br>
        Contraseña: <input type="password" name="contraseña" required><br>
        Nombre: <input type="text" name="nombre" required><br>
        Apellido: <input type="text" name="apellido" required><br>
        Segundo Apellido: <input type="text" name="segundoApellido" required><br>
        Correo: <input type="email" name="correo" required><br>
        Teléfono: <input type="text" name="telefono" required><br>
        Rol: <input type="text" name="rol" required><br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>