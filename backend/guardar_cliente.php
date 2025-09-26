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

	if ($stmt = $conn->prepare($sql_cliente)) {
		$stmt->bind_param("sssssss", $nombre_cliente, $cedula, $correo, $direccion, $telefono, $departamento, $municipio);

		if ($stmt->execute()) {
			// Obtén el id_cliente generado automáticamente
			$id_cliente = $conn->insert_id;

			// Inserta el pedido con el id_cliente y el id_producto obtenidos
			$sql_pedido = "INSERT INTO pedido (id_producto, id_cliente) VALUES (?, ?)";

			if ($stmt_pedido = $conn->prepare($sql_pedido)) {
				$stmt_pedido->bind_param("ii", $id_producto, $id_cliente);

				if ($stmt_pedido->execute()) {
					// Redirección a pedido.php con mensaje de éxito
					header("Location: ../views/pedido.php?id_producto=<?php echo $id_producto;?>&campesino_id=<?php echo $campesino_id; ?>?mensaje=Cliente y pedido registrados con éxito");
					exit;
				} else {
					echo "Error al crear el pedido: " . $stmt_pedido->error;
				}
				$stmt_pedido->close();
			} else {
				echo "Error: " . $conn->error;
			}
		} else {
			echo "Error al registrar cliente: " . $stmt->error;
		}
		$stmt->close();
	} else {
		echo "Error: " . $conn->error;
	}
}
$conn->close();
?>