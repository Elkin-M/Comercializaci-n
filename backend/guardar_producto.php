<?php
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
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$campesino_id = $_POST['campesino_id'];

// Verificar si se ha subido una imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Generar un nombre único para la imagen
    $imagenNombre = uniqid() . '.jpg';
    $rutaImagen = 'uploads/' . $imagenNombre;

    // Mover la imagen subida a la carpeta deseada
    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        die("Error al mover la imagen a la carpeta de destino.");
    }
} else {
    die("No se ha subido ninguna imagen.");
}

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO productos (titulo, descripcion, precio, cantidad, imagen_url, campesino_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdisi", $titulo, $descripcion, $precio, $cantidad, $rutaImagen, $campesino_id);

if ($stmt->execute()) {
    // Redirigir a lista_productos.php después de guardar el producto
    header("Location: ../views/lista_productos.php");
    exit(); // Asegúrate de que el script termine aquí
} else {
    echo "Error al guardar el producto: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

