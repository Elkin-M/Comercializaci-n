<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$nombre_usuario = $_POST['nombre_usuario'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

// Insertar los datos en la tabla campesinos
$sql = "INSERT INTO campesinos (nombre, apellidos, cedula, telefono, correo, direccion, departamento, municipio, nombre_usuario, contraseña)
        VALUES ('$nombre', '$apellidos', '$cedula', '$telefono', '$correo', '$direccion', '$departamento', '$municipio', '$nombre_usuario', '$contraseña')";

if ($conexion->query($sql) === TRUE) {
    // Redirigir a login_vendedor.php después de un registro exitoso
    header('Location: ../views/login_vendedor.php');
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>

