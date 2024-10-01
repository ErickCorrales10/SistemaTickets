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

    // Consultar el último ID de la tabla de tickets
    $sql_last_ticket = "SELECT id_ticket FROM tickets ORDER BY id_ticket DESC LIMIT 1";
    $result_ticket = $conn->query($sql_last_ticket);
    if ($result_ticket->num_rows > 0) {
        $row_ticket = $result_ticket->fetch_assoc();
        $next_ticket_id = $row_ticket['id_ticket'] + 1;
    } else {
        $next_ticket_id = 1; // Si no hay tickets, el siguiente será el 1
    }

    // Consultar el último ID de la tabla de clientes
    $sql_last_cliente = "SELECT id_cliente FROM clientes ORDER BY id_cliente DESC LIMIT 1";
    $result_cliente = $conn->query($sql_last_cliente);
    if ($result_cliente->num_rows > 0) {
        $row_cliente = $result_cliente->fetch_assoc();
        $next_cliente_id = $row_cliente['id_cliente'] + 1;
    } else {
        $next_cliente_id = 1; // Si no hay clientes, el siguiente será el 1
    }

    // Obtener los datos del formulario
    $asunto = $_POST['asunto-titulo'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $prioridad = $_POST['prioridad'];
    $estado = $_POST['estado'];
    $fecha_creacion = $_POST['fecha-creacion'];
    $fecha_resolucion = $_POST['fecha-resolucion'];
    $id_cliente = $_POST['id-cliente']; // Puedes validar que el cliente existe primero
    $nombre_cliente = $_POST['nombre'];
    $email_cliente = $_POST['email'];
    $telefono_cliente = $_POST['tel'];
    $asignado = $_POST['asignado'];
    $departamento = $_POST['departamento'];
    $notas = $_POST['notas'];

    // Insertar el cliente si no existe
    $sql_cliente = "INSERT INTO clientes (nombre_cliente, email, telefono) VALUES ('$nombre_cliente', '$email_cliente', '$telefono_cliente')";
    if ($conn->query($sql_cliente) === TRUE) {
        $id_cliente = $conn->insert_id; // Obtener el ID del cliente recién insertado
    }

    // Insertar el ticket
    $sql_ticket = "INSERT INTO tickets (asunto, descripcion, categoria, prioridad, estado, fecha_creacion, fecha_resolucion, id_cliente) 
    VALUES ('$asunto', '$descripcion', '$categoria', '$prioridad', '$estado', '$fecha_creacion', '$fecha_resolucion', '$id_cliente')";

    if ($conn->query($sql_ticket) === TRUE) {
        $ticket_id = $conn->insert_id; // Obtener el ID del ticket recién insertado

        // Insertar datos en la tabla de asignación
        $sql_asignacion = "INSERT INTO asignaciones_seguimiento (id_ticket, asignado_a, departamento) VALUES ('$ticket_id', '$asignado', '$departamento')";
        if($conn->query($sql_asignacion) === TRUE) {
            echo "Asignación registrada exitosamente.<br>";
        } else {
            echo "Error en la asignación: " . $conn->error . "<br>";
        }

        // Insertar datos en la tabla de notas
        $sql_notas = "INSERT INTO notas (id_ticket, comentario) VALUES ('$ticket_id', '$notas')";
        if($conn->query($sql_notas) === TRUE) {
            echo "Notas registradas exitosamente.<br>";
        } else {
            echo "Error al registrar las notas: " . $conn->error . "<br>";
        }

        echo "Ticket creado exitosamente";
    }else {
        echo "Error al crear el ticket: " . $conn->error . "<br>";
    }

    // Cerrar la conexión
    $conn->close();
?>