<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si las variables existen en $_POST
    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        // Conectar a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'inventario');

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Recibir datos del formulario
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Evitar inyecciones SQL
        $usuario = $conexion->real_escape_string($usuario);
        $contrasena = $conexion->real_escape_string($contrasena);

        // Consulta SQL
        $sql = "SELECT * FROM usuarios WHERE username = '$usuario' AND password = '$contrasena'";
        $resultado = $conexion->query($sql);

        // Verificar si la consulta devolvió resultados
        if ($resultado->num_rows > 0) {
            // Usuario y contraseña correctos
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: dashboard.php"); // Redirige a la siguiente página
        } else {
            // Usuario o contraseña incorrectos
            echo "Usuario o contraseña incorrectos.";
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        echo "Faltan datos del formulario.";
    }
}
?>
