<?php
    // Datos de conexión a la base de datos
    $host = 'localhost';  // o '127.0.0.1'
    $db = 'sistema_tickets';
    $user = 'root';  // Usuario de la base de datos
    $pass = '';      // Contraseña de la base de datos

    // Conexión a la base de datos
    $conn = new mysqli($host, $user, $pass, $db);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verifica si se han enviado datos mediante POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recibir los datos del formulario
        $nombre_usuario = $_POST['nombre-usuario'];
        $contrasena = $_POST['contrasena'];

        // Prepara y ejecuta la consulta para buscar el usuario
        $sql = "SELECT * FROM usuarios WHERE (nombre = ? OR email = ?) AND contrasena = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $nombre_usuario, $nombre_usuario, $contrasena);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica si se encontró un usuario
        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['usuario'] = $nombre_usuario; // Guarda el nombre del usuario en la sesión
            echo "Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($nombre_usuario) . "!";
            // Redirigir a la página principal del sistema o al panel de control
            // header('Location: panel.php'); // Descomenta esto y cambia a tu página
        } else {
            echo "Credenciales incorrectas. Intenta de nuevo.";
        }

        // Cierra la declaración y la conexión
        $stmt->close();
    }

    // Cierra la conexión
    $conn->close();
?>