<?php
// eliminar_producto.php

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['campesino_id'])) {
    header("Location: ../views/login_vendedor.php");
    exit();
}

// Incluir el archivo de conexión
include '../db/conexion.php';

// Verificar si se ha proporcionado el ID del producto en la URL
if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    $campesino_id = $_SESSION['campesino_id'];

    // Preparar la consulta de eliminación
    $sql = "DELETE FROM productos WHERE id = ? AND campesino_id = ?";

    if ($is_pdo) {
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$producto_id, $campesino_id]);
            echo "<script>
                    alert('Producto eliminado satisfactoriamente');
                    window.location.href = '../views/lista_productos.php';
                  </script>";
        } catch (PDOException $e) {
            error_log("Error PDO al eliminar producto en eliminar_producto.php: " . $e->getMessage());
            echo "<script>
                    alert('Error al eliminar el producto');
                    window.location.href = '../views/lista_productos.php';
                  </script>";
        }
    } else {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $producto_id, $campesino_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                    alert('Producto eliminado satisfactoriamente');
                    window.location.href = '../views/lista_productos.php';
                  </script>";
        } else {
            error_log("Error mysqli al eliminar producto en eliminar_producto.php: " . $conn->error);
            echo "<script>
                    alert('Error al eliminar el producto');
                    window.location.href = '../views/lista_productos.php';
                  </script>";
        }
        $stmt->close();
    }
} else {
    // Redirigir a la lista de productos si no se proporciona un ID de producto
    header("Location: ../views/lista_productos.php");
    exit();
}
?>