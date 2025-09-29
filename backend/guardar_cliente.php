<?php
// ../backend/guardar_cliente.php

// Conexión a la base de datos
include '../db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Datos del cliente
	$nombre_cliente = $_POST['nombre_cliente'];
	$cedula = $_POST['cedula'];
	$correo = $_POST['correo'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$departamento = $_POST['departamento'];
	$municipio = $_POST['municipio'];
	
	// IDs del producto y campesino
	$id_producto = $_POST['id_producto'];
	$campesino_id = $_POST['campesino_id'];

	// Inserta el cliente en la tabla cliente
	$sql_cliente = "INSERT INTO cliente (nombre_cliente, cedula, correo, direccion, telefono, departamento, municipio) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($is_pdo) {
        try {
            $stmt = $pdo->prepare($sql_cliente);
            $stmt->execute([$nombre_cliente, $cedula, $correo, $direccion, $telefono, $departamento, $municipio]);
            $id_cliente = $pdo->lastInsertId();

            $sql_pedido = "INSERT INTO pedido (id_producto, id_cliente) VALUES (?, ?)";
            $stmt_pedido = $pdo->prepare($sql_pedido);
            $stmt_pedido->execute([$id_producto, $id_cliente]);

            header("Location: ../views/pedido.php?id_producto=<?php echo $id_producto;?>&campesino_id=<?php echo $campesino_id; ?>&mensaje=Cliente y pedido registrados con éxito");
            exit;
        } catch (PDOException $e) {
            error_log("Error PDO al guardar cliente/pedido en guardar_cliente.php: " . $e->getMessage());
            echo "Error al registrar cliente o crear pedido.";
        }
    } else {
        if ($stmt = $conn->prepare($sql_cliente)) {
            $stmt->bind_param("sssssss", $nombre_cliente, $cedula, $correo, $direccion, $telefono, $departamento, $municipio);

            if ($stmt->execute()) {
                $id_cliente = $conn->insert_id;

                $sql_pedido = "INSERT INTO pedido (id_producto, id_cliente) VALUES (?, ?)";

                if ($stmt_pedido = $conn->prepare($sql_pedido)) {
                    $stmt_pedido->bind_param("ii", $id_producto, $id_cliente);

                    if ($stmt_pedido->execute()) {
                        header("Location: ../views/pedido.php?id_producto=<?php echo $id_producto;?>&campesino_id=<?php echo $campesino_id; ?>&mensaje=Cliente y pedido registrados con éxito");
                        exit;
                    } else {
                        error_log("Error mysqli al crear el pedido en guardar_cliente.php: " . $stmt_pedido->error);
                        echo "Error al crear el pedido: " . $stmt_pedido->error;
                    }
                    $stmt_pedido->close();
                } else {
                    error_log("Error mysqli al preparar pedido en guardar_cliente.php: " . $conn->error);
                    echo "Error: " . $conn->error;
                }
            } else {
                error_log("Error mysqli al registrar cliente en guardar_cliente.php: " . $stmt->error);
                echo "Error al registrar cliente: " . $stmt->error;
            }
            $stmt->close();
        } else {
            error_log("Error mysqli al preparar cliente en guardar_cliente.php: " . $conn->error);
            echo "Error: " . $conn->error;
        }
    }
}

// Cerrar la conexión mysqli si está abierta
if (!$is_pdo && $conn) {
    $conn->close();
}
?>