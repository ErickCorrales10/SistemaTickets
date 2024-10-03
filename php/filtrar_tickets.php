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
    $estado = $_GET['estado'] ?? '';

    if($estado === 'todos') {
        $sql = "SELECT c.nombre_cliente, t.id_ticket, t.asunto, t.descripcion, t.estado, t.fecha_creacion, t.fecha_resolucion, t.resuelto
        FROM tickets t
        JOIN clientes c ON t.id_cliente = c.id_cliente";
    } else {
        // Consultar los tickets según el estado
        $sql = "SELECT c.nombre_cliente, t.id_ticket, t.asunto, t.descripcion, t.estado, t.fecha_creacion, t.fecha_resolucion, t.resuelto 
                FROM tickets t 
                JOIN clientes c ON t.id_cliente = c.id_cliente 
                WHERE t.estado LIKE '%$estado%'";
    }
    
    $result = $conn->query($sql);

    // Mostrar los tickets en la tabla
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clase = "";
            if (strtolower($row['estado']) == "abierto") {
                $clase = "abierto";
            } else if (strtolower($row['estado']) == "cerrado" && strtolower($row['resuelto']) == "no") {
                $clase = "cerrado-no";
            } else if (strtolower($row['estado']) == "en progreso") {
                $clase = "en-progreso";
            } else if (strtolower($row['estado']) == "cerrado" && strtolower($row['resuelto']) == "si") {
                $clase = "cerrado-si";
            }

            echo "<tr class='" . htmlspecialchars($clase) . "'>
                    <td>" . htmlspecialchars($row['nombre_cliente']) . "</td>
                    <td>" . htmlspecialchars($row['id_ticket']) . "</td>
                    <td>" . htmlspecialchars($row['asunto']) . "</td>
                    <td>" . htmlspecialchars($row['descripcion']) . "</td>
                    <td>" . htmlspecialchars($row['estado']) . "</td>
                    <td>" . htmlspecialchars($row['fecha_creacion']) . "</td>
                    <td>" . htmlspecialchars($row['fecha_resolucion'] ?? '-') . "</td>
                    <td>" . htmlspecialchars($row['resuelto'] ?? '-') . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay tickets disponibles.</td></tr>";
    }

    // Cerrar la conexión
    $conn->close();
?>
