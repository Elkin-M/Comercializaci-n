<?php
// dashboard.php

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['campesino_id'])) {
    header("Location: login_vendedor.php");
    exit();
}

// Incluir el archivo de conexión
include '../db/conexion.php';

$campesino_id = $_SESSION['campesino_id'];

// Consulta para obtener el nombre del campesino
$sql = "SELECT nombre FROM campesinos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $campesino_id);
$stmt->execute();
$stmt->bind_result($nombre_campesino);
$stmt->fetch();
$stmt->close();

// Consulta para verificar si el campesino tiene pedidos
$sql_pedidos = "SELECT COUNT(*) FROM pedido INNER JOIN productos ON pedido.id_producto = productos.id WHERE productos.campesino_id = ?";
$stmt_pedidos = $conn->prepare($sql_pedidos);
$stmt_pedidos->bind_param("i", $campesino_id);
$stmt_pedidos->execute();
$stmt_pedidos->bind_result($num_pedidos);
$stmt_pedidos->fetch();
$stmt_pedidos->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        .dashboard-greeting {
            color: black;

            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .panel {
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }

        .panel:hover {
            transform: translateY(-5px);
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>

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
                        <a class="nav-link active" href="dashboard.php">
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

    <div class="dashboard-greeting">
        <h1>Hola, <?php echo htmlspecialchars($nombre_campesino); ?>!</h1>
        <p>Bienvenido a tu panel de control</p>
    </div>

    <div class="container">
        <div class="row">
            <!-- Registrar Producto -->
            <div class="col-xs-12 col-sm-4">
                <div class="panel panel-primary">
                    <h3>Registrar Producto</h3>
                    <p>Agrega un nuevo producto a tu inventario</p>
                    <a href="registro_productos.html" class="btn btn-success">Registrar Producto</a>
                </div>
            </div>
            <!-- Lista de Productos -->
            <div class="col-xs-12 col-sm-4">
                <div class="panel panel-primary">
                    <h3>Lista de Productos</h3>
                    <p>Consulta y edita tus productos registrados</p>
                    <a href="lista_productos.php" class="btn btn-info">Ver Productos</a>
                </div>
            </div>
            <!-- Mis Pedidos -->
            <div class="col-xs-12 col-sm-4">
                <div class="panel panel-primary">
                    <h3>Mis Pedidos</h3>
                    <p>Consulta los pedidos de tus productos</p>
                    <a href="mis_pedidos.php" class="btn btn-warning">Ver Pedidos</a>
                </div>
            </div>
        </div>

        <!-- Anuncio de pedidos -->
        <?php if ($num_pedidos > 0): ?>
            <div class="alert alert-info text-center">
                <strong>Tienes <?php echo $num_pedidos; ?> pedidos pendientes!</strong> <a href="mis_pedidos.php">Ver pedidos</a>
            </div>
        <?php else: ?>
            <div class="alert alert-secondary text-center">
                <strong>No tienes pedidos pendientes.</strong>
            </div>
        <?php endif; ?>
    </div>

<!-- Bootstrap JS -->
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>