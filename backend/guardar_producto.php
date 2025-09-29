<?php
header('Content-Type: application/json');

// Incluir el archivo de conexión
include '../db/conexion.php';

// Obtener datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$campesino_id = $_POST['campesino_id'];

$rutaImagen = null;

// Verificar si se ha subido una imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Generar un nombre único para la imagen
    $imagenNombre = uniqid() . '.jpg';
    $rutaImagen = 'uploads/' . $imagenNombre;

    // Asegurarse de que la carpeta existe
    if (!is_dir('uploads/')) {
        mkdir('uploads/', 0777, true);
    }

    // Mover la imagen subida a la carpeta deseada
    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        error_log("Error al mover la imagen a la carpeta de destino en guardar_producto.php.");
        die(json_encode(['success' => false, 'message' => 'Error al subir la imagen.']));
    }
} else {
    die(json_encode(['success' => false, 'message' => 'No se ha subido ninguna imagen.']));
}

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO productos (titulo, descripcion, precio, cantidad, imagen_url, campesino_id) VALUES (?, ?, ?, ?, ?, ?)";

if ($is_pdo) {
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $descripcion, $precio, $cantidad, $rutaImagen, $campesino_id]);
        header("Location: ../views/lista_productos.php");
        exit();
    } catch (PDOException $e) {
        error_log("Error PDO al guardar producto en guardar_producto.php: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error al guardar el producto.']);
    }
} else {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisi", $titulo, $descripcion, $precio, $cantidad, $rutaImagen, $campesino_id);

    if ($stmt->execute()) {
        header("Location: ../views/lista_productos.php");
        exit();
    } else {
        error_log("Error mysqli al guardar producto en guardar_producto.php: " . $stmt->error);
        echo json_encode(['success' => false, 'message' => 'Error al guardar el producto: ' . $stmt->error]);
    }
    $stmt->close();
}

// Cerrar la conexión mysqli si está abierta
if (!$is_pdo && $conn) {
    $conn->close();
}
?>

