<?php
// conexion.php

// ============================================================================
// CONFIGURACIÓN DE CONEXIONES
// ============================================================================

// --- 1. CONFIGURACIÓN LOCAL (MySQLi) ---
// Asumimos que es el entorno de desarrollo (XAMPP/MAMP/etc.)
$local_config = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db'   => 'proyecto'
];

// --- 2. CONFIGURACIÓN DE PRODUCCIÓN (PostgreSQL - Render) ---
// Hostname de Render: dpg-d3d8t3a4d50c73d6ffrg-a
// Usuario: proyecto_xyoq_user
// Contraseña: PK7cs6LHCixTpHuP3vYvfxGnNqheWMBn
// Base de Datos: proyecto_xyoq
$render_config = [
    'host' => 'dpg-d3d8t3a4d50c73d6ffrg-a',
    'user' => 'proyecto_xyoq_user',
    'pass' => 'PK7cs6LHCixTpHuP3vYvfxGnNqheWMBn',
    'db'   => 'proyecto_xyoq',
    'port' => 5432 // Puerto estándar de PostgreSQL
];

// ============================================================================
// LÓGICA DE DETECCIÓN Y CONEXIÓN
// ============================================================================

// Detectamos el entorno: si Render ha inyectado su variable de hostname, es producción.
$is_render_env = getenv('RENDER_EXTERNAL_HOSTNAME') !== false;

if ($is_render_env) {
    // -----------------------------------------------------------------------
    // MODO PRODUCCIÓN: CONEXIÓN A POSTGRESQL
    // -----------------------------------------------------------------------
    
    $c = $render_config;
    
    // Cadena de conexión requerida por la función pg_connect()
    $conn_string = "host={$c['host']} port={$c['port']} dbname={$c['db']} user={$c['user']} password={$c['pass']}";
    
    // Intenta conectar usando pg_connect (requiere la extensión pgsql o pdo_pgsql)
    $conn = pg_connect($conn_string);

    if (!$conn) {
        die("Error de Conexión a PostgreSQL (Render): " . pg_last_error());
    }

    // NOTA IMPORTANTE: A partir de aquí, debes usar las funciones pg_* // (ej. pg_query($conn, $sql)) en lugar de los métodos de mysqli ($conn->query(...)).

} else {
    // -----------------------------------------------------------------------
    // MODO LOCAL: CONEXIÓN A MYSQLI
    // -----------------------------------------------------------------------
    
    $c = $local_config;
    
    // Intenta conectar usando MySQLi (requiere la extensión mysqli)
    $conn = new mysqli($c['host'], $c['user'], $c['pass'], $c['db']);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida a MySQL (Local): " . $conn->connect_error);
    }
}
?>