<?php
// conexion.php

// Variable para determinar el tipo de conexión
$is_pdo = false;
$conn = null;
$pdo = null;

// Verificar si la variable de entorno DATABASE_URL existe (típico de Render)
$database_url = getenv('DATABASE_URL');

if ($database_url) {
    // Modo PostgreSQL con PDO (Render)
    $is_pdo = true;
    
    $db_parts = parse_url($database_url);
    
    $db_host = $db_parts['host'];
    $db_port = isset($db_parts['port']) ? $db_parts['port'] : 5432; // Default PostgreSQL port
    $db_user = $db_parts['user'];
    $db_pass = $db_parts['pass'];
    $db_name = ltrim($db_parts['path'], '/');
    
    $dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_user;password=$db_pass";
    
    try {
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error de conexión PDO: " . $e->getMessage());
    }
} else {
    // Modo MySQL con mysqli (Local)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
}
?>