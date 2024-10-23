<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario para agregar un nuevo producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];

    $sql = "INSERT INTO productos (nombre, cantidad) VALUES ('$nombre', '$cantidad')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo producto agregado correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener los productos del inventario
$sql = "SELECT nombre, cantidad FROM productos";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="inventory-container">
        <h2>Sistema de Inventario</h2>
        <form action="inventario.php" method="POST">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>
            <button type="submit">Agregar Producto</button>
        </form>

        <h3>Inventario Actual</h3>
        <table>
            <tr>
                <th>Nombre del Producto</th>
                <th>Cantidad</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["cantidad"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No hay productos en el inventario.</td></tr>";
            }
            ?>
        </table>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>

