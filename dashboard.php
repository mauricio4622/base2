<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirigir si no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
