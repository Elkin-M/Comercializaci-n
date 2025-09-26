<?php
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['campesino_id'])) {
    // Redirigir al dashboard si la sesión está activa
    header("Location: dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Estilos del contenedor principal */
        .contenedor {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos de los formularios */
        form {
            display: flex;
            flex-direction: column;
        }

        input {
            width: 380px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218c53;
        }

        /* Estilo de los enlaces */
        .enlace-registro {
            text-align: center;
            margin-top: 20px;
        }

        .enlace-registro a {
            color: #27ae60;
            text-decoration: none;
            font-weight: bold;
        }

        .enlace-registro a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <!-- Formulario de inicio de sesión -->
        <h2>Inicio de Sesión</h2>
        <form id="loginForm" method="POST" action="../backend/login.php">
            <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
            <div class="enlace-registro">
                <p>¿No tienes cuenta? <a href="registro_vendedor.html">Regístrate aquí</a></p>
            </div>
        </form>
     <!-- Botón para ir a inicio -->
        <a href="../index.php" class="btn-inicio">Ir a Inicio</a>
    </div>

</body>

<script>
    // Código de JavaScript para manejar el formulario de inicio de sesión
    document.getElementById('loginForm').addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevenir el envío del formulario por defecto

        const formData = new FormData(event.target);
        
        const response = await fetch('../backend/login.php', { 
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            // Guardar el ID del campesino en el almacenamiento local
            localStorage.setItem('campesino_id', data.campesino_id);
            // Redirigir a dashboard.php
            window.location.href = 'dashboard.php';
        } else {
            alert(data.message); // Mostrar el mensaje de error
        }
    });
</script>

</html>