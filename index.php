<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Inventario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
    <form method="POST" action="login.php">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <button type="submit">Ingresar</button>
    </form>

        <p class="error-message">
            <?php
                if (isset($_GET['error'])) {
                    echo "Usuario o contraseña incorrectos.";
                }
            ?>
        </p>
    </div>
</body>
</html>
