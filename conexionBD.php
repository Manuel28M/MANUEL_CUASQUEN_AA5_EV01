<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Detalles de la conexión a la base de datos
    $servername = "127.0.0.1"; // Nombre del servidor de la base de datos
    $db_username = "root"; // Nombre de usuario de la base de datos
    $db_password = "12345678"; // Contraseña de la base de datos
    $database = "login"; // Nombre de la base de datos

    // Crear conexión
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    } 

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = '$username' AND contraseña = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Las credenciales son válidas, redirigir a la página de inicio
        header("Location: inicio.html");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        // Las credenciales no son válidas
        echo "Nombre de usuario o contraseña incorrectos";
    }

    // Cerrar conexión
    $conn->close();
}
?>
