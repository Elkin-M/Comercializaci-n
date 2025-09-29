<?php
session_start();
header('Content-Type: application/json');

// Incluir el archivo de conexión
include '../db/conexion.php';

if ($is_pdo) {
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre_usuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if (password_verify($contraseña, $row['contraseña'])) {
                $_SESSION['campesino_id'] = $row['id'];
                echo json_encode(['success' => true, 'campesino_id' => $row['id']]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }
    } catch (PDOException $e) {
        error_log("Error PDO en login.php: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error de autenticación.']);
    }
} else {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($contraseña, $row['contraseña'])) {
            $campesino_id = $row['id'];
            $_SESSION['campesino_id'] = $campesino_id;
            echo json_encode(['success' => true, 'campesino_id' => $campesino_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }
    $stmt->close();
    $conn->close();
}
?>


