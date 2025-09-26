<?php
// mispedidos.php

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['campesino_id'])) {
    header("Location: login_vendedor.php");
    exit();
}

// Incluir el archivo de conexión
include '../db/conexion.php';

$campesino_id = $_SESSION['campesino_id'];

// Consulta para obtener los pedidos asociados al campesino
$sql = "
    SELECT pedido.id_pedido, productos.titulo, productos.descripcion, productos.precio, productos.cantidad,
           cliente.nombre_cliente, cliente.cedula, cliente.correo, cliente.direccion, cliente.telefono, 
           cliente.departamento, cliente.municipio
    FROM pedido
    INNER JOIN productos ON pedido.id_producto = productos.id
    INNER JOIN cliente ON pedido.id_cliente = cliente.id_cliente
    WHERE productos.campesino_id = ?
";
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
    <title>Mis Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: white;
        }

        .container-main {
            max-width: 1400px;
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

        .pedidos-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .pedido-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1.5rem;
            transition: transform 0.2s;
        }

        .pedido-card:hover {
            transform: translateY(-5px);
        }

        .pedido-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .pedido-id {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0d6efd;
        }

        .pedido-fecha {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .producto-info {
            margin-bottom: 1rem;
        }

        .producto-titulo {
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
        }

        .producto-precio {
            color: #28a745;
            font-weight: 600;
        }

        .cliente-info {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .cliente-header {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        .info-item {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .info-label {
            color: #6c757d;
            min-width: 80px;
        }

        .info-value {
            color: #212529;
        }

        .estado-pedido {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .estado-nuevo {
            background-color: #cff4fc;
            color: #055160;
        }

        .estado-proceso {
            background-color: #fff3cd;
            color: #664d03;
        }

        .estado-completado {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .sin-pedidos {
            background: white;
            border-radius: 8px;
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }

        .sin-pedidos i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            .pedidos-cards {
                grid-template-columns: 1fr;
            }
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
                        <a class="nav-link" href="lista_productos.php">
                            <i class="fas fa-list"></i> Lista de Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="mis_pedidos.php">
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
            <h1><i class="fas fa-shopping-cart"></i> Mis Pedidos</h1>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="pedidos-cards">
                <?php while ($pedido = $result->fetch_assoc()): ?>
                    <div class="pedido-card">
                        <div class="pedido-header">
                            <span class="pedido-id">#<?php echo htmlspecialchars($pedido['id_pedido']); ?></span>
                            <span class="estado-pedido estado-nuevo">Nuevo Pedido</span>
                        </div>
                        
                        <div class="producto-info">
                            <div class="producto-titulo"><?php echo htmlspecialchars($pedido['titulo']); ?></div>
                            <div class="producto-precio">$<?php echo number_format($pedido['precio'], 2); ?> COP/kg</div>
                            <div class="info-item">
                                <span class="info-label">Cantidad:</span>
                                <span class="info-value"><?php echo htmlspecialchars($pedido['cantidad']); ?> kg</span>
                            </div>
                        </div>

                        <div class="cliente-info">
                            <div class="cliente-header">Información del Cliente</div>
                            <div class="info-item">
                                <span class="info-label">Cliente:</span>
                                <span class="info-value"><?php echo htmlspecialchars($pedido['nombre_cliente']); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Cédula:</span>
                                <span class="info-value"><?php echo htmlspecialchars($pedido['cedula']); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Contacto:</span>
                                <span class="info-value">
                                    <div><?php echo htmlspecialchars($pedido['correo']); ?></div>
                                    <div><?php echo htmlspecialchars($pedido['telefono']); ?></div>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Ubicación:</span>
                                <span class="info-value">
                                    <div><?php echo htmlspecialchars($pedido['direccion']); ?></div>
                                    <div><?php echo htmlspecialchars($pedido['municipio']); ?>, <?php echo htmlspecialchars($pedido['departamento']); ?></div>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="sin-pedidos">
                <i class="fas fa-shopping-cart"></i>
                <h3>No hay pedidos disponibles</h3>
                <p>Actualmente no tienes pedidos asociados a tus productos.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
