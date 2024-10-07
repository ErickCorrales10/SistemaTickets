
<?php
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistema_tickets";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el valor del filtro desde la URL
    $id_ticket = $_POST['id_ticket'] ?? '';

    // echo "El valor obtenido es: " . htmlspecialchars($id_ticket);

    if(!empty($id_ticket) && is_numeric($id_ticket)) {
        $sql = "SELECT 
        c.nombre_cliente, t.id_ticket, t.asunto, t.descripcion, t.estado, t.fecha_creacion, t.fecha_resolucion, t.resuelto, 
        c.email, c.id_cliente, c.telefono,
        a.id_asignacion, a.asignado_a, a.departamento,
        n.id_nota, n.comentario
        FROM tickets t
        JOIN clientes c ON t.id_cliente = c.id_cliente
        LEFT JOIN asignaciones_seguimiento a on a.id_ticket = t.id_ticket
        LEFT JOIN notas n ON n.id_ticket = t.id_ticket
        WHERE t.id_ticket = ?";

        // Usar prepared statements para evitar inyección SQL
        $stmt = $conn->prepare($sql);

        if($stmt === false)
            die("Error preparando la consulta: ". $conn->error);

        $stmt->bind_param("i", $id_ticket);  // 'i' es para enteros
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Nombre del Cliente: " . htmlspecialchars($row['nombre_cliente']) . "\n";
                echo "ID del Ticket: " . htmlspecialchars($row['id_ticket']) . "\n";
                echo "Asunto: " . htmlspecialchars($row['asunto']) . "\n";
                echo "Descripción: " . htmlspecialchars($row['descripcion']) . "\n";
                echo "Estado: " . htmlspecialchars($row['estado']) . "\n";
                echo "Fecha de Creación: " . htmlspecialchars($row['fecha_creacion']) . "\n";
                echo "Fecha de Resolución: " . htmlspecialchars($row['fecha_resolucion'] ?? '-') . "\n";
                echo "Resuelto: " . htmlspecialchars($row['resuelto'] ?? '-') . "\n";
                echo "Email: " . htmlspecialchars($row['email']). "\n";
                echo "ID del Cliente: " . htmlspecialchars($row['id_cliente']). "\n";
                echo "Teléfono: " . htmlspecialchars($row['telefono']). "\n";
                echo "ID de Asignación: " . htmlspecialchars($row['id_asignacion']). "\n";
                echo "Asignado a: " . htmlspecialchars($row['asignado_a']). "\n";
                echo "Departamento: " . htmlspecialchars($row['departamento']). "\n";
                echo "ID de Nota: " . htmlspecialchars($row['id_nota']). "\n";
                echo "Comentario: " . htmlspecialchars($row['comentario']). "\n";
            }
        } else {
            echo "No se encontraron detalles para el ticket con ID: " . htmlspecialchars($id_ticket);
        }
    }  else {
        echo "ID de ticket inválido.";
    }

    // Cerrar la conexión
    $conn->close();
?>
