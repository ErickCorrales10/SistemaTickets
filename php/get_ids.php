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

    // Obtener el siguiente ID del ticket (incremental)
    $result_ticket = $conn->query("SELECT MAX(id_ticket) AS max_ticket_id FROM tickets");
    $next_ticket_id = 1; // Si la tabla está vacía, el primer ticket será 1
    if ($result_ticket->num_rows > 0) {
        $row = $result_ticket->fetch_assoc();
        if ($row['max_ticket_id'] !== null) {
            $next_ticket_id = $row['max_ticket_id'] + 1;
        }
    }

    // Obtener el siguiente ID del cliente (incremental)
    $result_cliente = $conn->query("SELECT MAX(id_cliente) AS max_cliente_id FROM clientes");
    $next_cliente_id = 1; // Si la tabla está vacía, el primer cliente será 1
    if ($result_cliente->num_rows > 0) {
        $row = $result_cliente->fetch_assoc();
        if ($row['max_cliente_id'] !== null) {
            $next_cliente_id = $row['max_cliente_id'] + 1;
        }
    }

    // Devolver los IDs como JSON
    echo json_encode([
        'next_ticket_id' => $next_ticket_id,
        'next_cliente_id' => $next_cliente_id
    ]);

    // Cerrar la conexión
    $conn->close();
?>