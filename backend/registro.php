<?php
// Incluir el archivo de conexión
include '../db/conexion.php';

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

// Insertar los datos en la tabla campesinos usando prepared statements
$sql = "INSERT INTO campesinos (nombre, apellidos, cedula, telefono, correo, direccion, departamento, municipio, nombre_usuario, contraseña)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($is_pdo) {
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $apellidos, $cedula, $telefono, $correo, $direccion, $departamento, $municipio, $nombre_usuario, $contraseña]);
        header('Location: ../views/login_vendedor.php');
        exit();
    } catch (PDOException $e) {
        error_log("Error PDO al registrar campesino en registro.php: " . $e->getMessage());
        echo "Error al registrar campesino.";
    }
} else {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $nombre, $apellidos, $cedula, $telefono, $correo, $direccion, $departamento, $municipio, $nombre_usuario, $contraseña);

    if ($stmt->execute()) {
        header('Location: ../views/login_vendedor.php');
        exit();
    } else {
        error_log("Error mysqli al registrar campesino en registro.php: " . $stmt->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}

// Cerrar la conexión mysqli si está abierta
if (!$is_pdo && $conn) {
    $conn->close();
}
?>

