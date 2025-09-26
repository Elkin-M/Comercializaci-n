<?php
// editar_producto.php

// Iniciar la sesión para acceder a las variables de sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['campesino_id'])) {
    header("Location: ../views/login_vendedor.php");
    exit();
}

// Incluir el archivo de conexión
include '../db/conexion.php';

// Verificar si se ha proporcionado el ID del producto
if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Obtener los datos del producto
    $sql = "SELECT * FROM productos WHERE id = ? AND campesino_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $producto_id, $_SESSION['campesino_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        header("Location: ../views/lista_productos.php");
        exit();
    }
} else {
    header("Location: ../views/lista_productos.php");
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $imagen_url = $producto['imagen_url'];

    // Verificar si se ha cargado una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $directorio_subida = 'uploads/';
        
        // Asegurarse de que la carpeta existe
        if (!is_dir($directorio_subida)) {
            mkdir($directorio_subida, 0777, true);
        }

        $archivo_subido = $directorio_subida . uniqid() . "_" . basename($_FILES['imagen']['name']);

        // Subir la imagen
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $archivo_subido)) {
            $imagen_url = $archivo_subido;
        } else {
            echo "Error al subir la imagen.";
        }
    }

    // Actualizar el producto
    $sql = "UPDATE productos SET titulo = ?, descripcion = ?, precio = ?, cantidad = ?, imagen_url = ? WHERE id = ? AND campesino_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisii", $titulo, $descripcion, $precio, $cantidad, $imagen_url, $producto_id, $_SESSION['campesino_id']);

    if ($stmt->execute()) {
        header("Location: ../views/lista_productos.php");
        exit();
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="contenedor">
        <h1>Editar Producto</h1>
        <form action="editar_producto.php?id=<?php echo $producto['id']; ?>" method="POST" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($producto['titulo']); ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" rows="4" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>

            <label for="precio">Precio (COP/kg):</label>
            <input type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>

            <label for="cantidad">Cantidad disponible (kg):</label>
            <input type="number" name="cantidad" value="<?php echo htmlspecialchars($producto['cantidad']); ?>" required>

            <label for="imagen">Imagen actual:</label>
            <img src="<?php echo $producto['imagen_url']; ?>" alt="<?php echo htmlspecialchars($producto['titulo']); ?>" class="imagen-editar">

            <label for="imagen">Cambiar imagen:</label>
            <input type="file" name="imagen" accept="image/*">

            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</body>
</html>
