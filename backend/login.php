<?php
session_start();
header('Content-Type: application/json');

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Conexión fallida: " . $conn->connect_error]));
}

// Obtener los datos enviados desde el formulario
$nombre_usuario = $_POST['nombre_usuario'];
$contraseña = $_POST['contraseña']; // Asegurarnos de que el nombre del campo coincide con el formulario

// Preparar la consulta SQL para verificar las credenciales
$sql = "SELECT id, contraseña FROM campesinos WHERE nombre_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verificar si la contraseña ingresada es correcta
    if (password_verify($contraseña, $row['contraseña'])) { // Cambiamos a 'contraseña' en lugar de 'password'
        // Autenticación exitosa, obtener el ID del campesino
        $campesino_id = $row['id'];

        // Guardar el ID del campesino en la sesión
        $_SESSION['campesino_id'] = $campesino_id;

        // Enviar el ID del campesino en la respuesta
        echo json_encode(['success' => true, 'campesino_id' => $campesino_id]);
    } else {
        // Contraseña incorrecta
        echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
    }
} else {
    // Usuario no encontrado
    echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
}

$stmt->close();
$conn->close();
?>


