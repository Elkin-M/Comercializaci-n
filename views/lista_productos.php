<?php
// lista_productos.php
session_start();

if (!isset($_SESSION['campesino_id'])) {
    header("Location: login_vendedor.php");
    exit();
}

include '../db/conexion.php';

$campesino_id = $_SESSION['campesino_id'];

$sql = "SELECT * FROM productos WHERE campesino_id = ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $campesino_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .container-main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
        }

        .btn-registrar {
            background-color: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-registrar:hover {
            background-color: #218838;
            color: white;
        }

        .table-responsive {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 1rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 1rem;
        }

        .table td {
            vertical-align: middle;
            padding: 1rem;
        }

        .producto-imagen {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .precio {
            font-weight: bold;
            color: #28a745;
        }

        .cantidad {
            background-color: #e9ecef;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .acciones {
            display: flex;
            gap: 0.5rem;
        }

        .btn-editar, .btn-eliminar {
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .btn-editar {
            background-color: #ffc107;
            color: #000;
        }

        .btn-eliminar {
            background-color: #dc3545;
            color: white;
        }

        .btn-editar:hover {
            background-color: #e0a800;
            color: #000;
        }

        .btn-eliminar:hover {
            background-color: #c82333;
            color: white;
        }

        /* Estilos para la sección de pedidos */
        .pedidos-section {
            margin-top: 3rem;
        }

        .pedidos-header {
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .pedidos-tabla th {
            font-size: 0.8rem;
        }

        .pedidos-tabla td {
            font-size: 0.9rem;
        }

        .sin-registros {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
            font-style: italic;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro_productos.html">
                            <i class="fas fa-plus-circle"></i> Registrar Producto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="lista_productos.php">
                            <i class="fas fa-list"></i> Lista de Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mis_pedidos.php">
                            <i class="fas fa-shopping-cart"></i> Mis Pedidos
                        </a>
                    </li>
                </ul>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> Mi Perfil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a></li>
                        <li><a class="dropdown-item" href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-main">
        <div class="page-header">
            <h1><i class="fas fa-shopping-cart"></i> Mis Productos</h1>
            <a href="registro_productos.html" class="btn-registrar">
                <i class="fas fa-plus"></i> Registrar Producto
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='../backend/" . $row['imagen_url'] . "' alt='" . htmlspecialchars($row['titulo']) . "' class='producto-imagen'></td>";
                        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                        echo "<td class='precio'>$" . number_format($row['precio'], 2) . " COP/kg</td>";
                        echo "<td><span class='cantidad'>" . htmlspecialchars($row['cantidad']) . " kg</span></td>";
                        echo "<td class='acciones'>
                                <a href='../backend/editar_producto.php?id=" . $row['id'] . "' class='btn-editar'>
                                    <i class='fas fa-edit'></i> Editar
                                </a>
                                <a href='../backend/eliminar_producto.php?id=" . $row['id'] . "' class='btn-eliminar'>
                                    <i class='fas fa-trash'></i> Eliminar
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='sin-registros'>No tienes productos registrados.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="pedidos-section">
            <div class="pedidos-header">
                <h2>Pedidos Asociados</h2>
            </div>
            
            <div class="table-responsive">
                <?php
                $sql_pedidos = "
                    SELECT pedido.id_pedido, productos.titulo, cliente.nombre_cliente, cliente.cedula, 
                           cliente.correo, cliente.direccion, cliente.telefono, cliente.departamento, cliente.municipio
                    FROM pedido
                    INNER JOIN productos ON pedido.id_producto = productos.id
                    INNER JOIN cliente ON pedido.id_cliente = cliente.id_cliente
                    WHERE productos.campesino_id = ?
                ";
                $stmt_pedidos = $conn->prepare($sql_pedidos);
                $stmt_pedidos->bind_param("i", $campesino_id);
                $stmt_pedidos->execute();
                $result_pedidos = $stmt_pedidos->get_result();

                if ($result_pedidos->num_rows > 0) {
                    echo "<table class='table pedidos-tabla'>
                            <thead>
                                <tr>
                                    <th>ID Pedido</th>
                                    <th>Producto</th>
                                    <th>Cliente</th>
                                    <th>Cédula</th>
                                    <th>Contacto</th>
                                    <th>Ubicación</th>
                                </tr>
                            </thead>
                            <tbody>";
                    while ($pedido = $result_pedidos->fetch_assoc()) {
                        echo "<tr>
                                <td>#" . htmlspecialchars($pedido['id_pedido']) . "</td>
                                <td>" . htmlspecialchars($pedido['titulo']) . "</td>
                                <td>" . htmlspecialchars($pedido['nombre_cliente']) . "</td>
                                <td>" . htmlspecialchars($pedido['cedula']) . "</td>
                                <td>
                                    <div>" . htmlspecialchars($pedido['correo']) . "</div>
                                    <div>" . htmlspecialchars($pedido['telefono']) . "</div>
                                </td>
                                <td>
                                    <div>" . htmlspecialchars($pedido['direccion']) . "</div>
                                    <div>" . htmlspecialchars($pedido['municipio']) . ", " . htmlspecialchars($pedido['departamento']) . "</div>
                                </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p class='sin-registros'>No tienes pedidos asociados a tus productos.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$stmt_pedidos->close();
$conn->close();
?>

