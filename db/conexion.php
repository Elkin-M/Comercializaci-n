<?php
// conexion.php - USANDO PDO

// Detección de entorno: Render inyecta esta variable
$is_render_env = getenv('RENDER_EXTERNAL_HOSTNAME') !== false;

if ($is_render_env) {
    // POSTGRESQL (RENDER)
    $host = 'dpg-d3d8t3a4d50c73d6ffrg-a';
    $user = 'proyecto_xyoq_user';
    $pass = 'PK7cs6LHCixTpHuP3vYvfxGnNqheWMBn'; // <--- ¡ASEGÚRATE DE USAR TU CONTRASEÑA REAL!
    $db = 'proyecto_xyoq';
    $port = 5432; 

    // Cadena de Conexión PDO para PostgreSQL
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";
    $db_type = 'PostgreSQL';

} else {
    // MYSQL (LOCAL)
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'proyecto';

    // Cadena de Conexión PDO para MySQL
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $db_type = 'MySQL';
}

try {
    // Crear conexión PDO
    $conn = new PDO($dsn, $user, $pass);
    
    // Configuración estándar para PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
} catch (PDOException $e) {
    // Mostrar error si la conexión falla
    die("Conexión $db_type fallida: " . $e->getMessage());
}
?>