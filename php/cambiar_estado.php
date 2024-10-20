<?php

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistema_tickets";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => "Conexión fallida: " . $conn->connect_error]);
        exit();
    }

    // Obtener el valor del filtro desde la URL
    $id_ticket = $_POST['id_ticket'] ?? '';
    $nuevo_estado = $_POST['nuevo_estado'] ?? '';
    $nueva_resolucion = $_POST['nueva_resolucion'] ?? '';

    if(!empty($id_ticket) && is_numeric($id_ticket) && !empty($nuevo_estado) && !empty($nueva_resolucion)) {
        $sql = "UPDATE tickets
        SET estado = ?, resuelto = ?
        WHERE id_ticket = ?";

        // Usar prepared statements para evitar inyección SQL
        $stmt = $conn->prepare($sql);

        if($stmt === false) {
            echo json_encode(['success' => false, 'message' => "Error preparando la consulta: " . $conn->error]);
            exit();
        }

        $stmt->bind_param("ssi", $nuevo_estado, $nueva_resolucion, $id_ticket);  // sis = 's' para string,'i' es para enteros, 's' para string
        if ($stmt->execute())
            echo json_encode(['success' => true, 'message' => "Estado del ticket actualizado exitosamente"]);
        else
            echo json_encode(['success' => false, 'message' => "Error al actualizar el ticket: ". $stmt->error]);
    } else {
        echo json_encode(['success' => false, 'message' => "ID de ticket inválido o estado vacío"]);
    }

    // Cerrar la conexión
    $conn->close();

?>

