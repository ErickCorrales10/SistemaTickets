<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla Principal - Sistema de tickets</title>
    <script src="/js/inicio.js"></script>
    <link rel="stylesheet" href="/css/inicio.css">

</head>
<body>

    <!-- Barra de navegación -->
    <div class="barra-lateral" id="barra-lateral">
        <div class="contenedor-barra-lateral" id="contenedor-barra-lateral">
            <img src="/imagenes/usuario.png" alt="Logo de usuario" class="imagen-usuario">    
            <p class="texto-usuario" id="texto-usuario">Erick Corrales<br><br>Administrador</p>    
            <hr class="linea-decorativa">                
            
            <ul class="menu-lateral">
                <li><a href="crear_ticket.html" class="menu-opcion">Crear Ticket</a></li>
                <li><a href="#" class="menu-opcion">Tickets en Progreso</a></li>
                <li><a href="#" class="menu-opcion">Tickets Abiertos</a></li>
                <li><a href="#" class="menu-opcion">Tickets Cerrados</a></li>
                <li><a href="#" class="menu-opcion">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>

    <div class="contenedor-principal" id="contenedor-principal"> 
        <!-- Contenedor principal con los tickets -->
        <main class="main-principal" id="main-principal">
            <div class="contenedor-buscar">
                <input type="text" placeholder="Buscar ticket..." class="buscar-ticket"><br>
            </div>

            <header id="header" class="header">
                <h1>Sistema de tickets</h1>
                <br>
                <div class="informacion-usuario">
                    <span>Usuario: <strong>Erick Corrales</strong></span>
                </div>
            </header>
            <section class="tabla-tickets">
                <table>
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>ID Ticket</th>
                            <th>Problema</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Fecha de Creación</th>
                            <th>Fecha de Finalización</th>
                            <th>Resuelto</th>
                        </tr>
                    </thead>
                    <tbody>
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

                        // Consultar todos los tickets
                        $sql = "SELECT c.nombre_cliente, t.id_ticket, t.asunto, t.descripcion, t.estado, t.fecha_creacion, t.fecha_resolucion, t.resuelto 
                                FROM tickets t 
                                JOIN clientes c ON t.id_cliente = c.id_cliente";
                        $result = $conn->query($sql);

                        // Mostrar los tickets en la tabla
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if(strtolower($row['estado']) == "abierto")
                                    $clase = "abierto";
                                else if(strtolower($row['estado']) == "cerrado"
                                        && strtolower($row['resuelto']) == "no")
                                    $clase = "cerrado-no";
                                else if(strtolower($row['estado']) == "en progreso")
                                    $clase = "en-progreso";
                                else if(strtolower($row['estado']) == "cerrado"
                                        && strtolower($row['resuelto']) == "si")
                                        $clase = "cerrado-si";
                                else
                                    $clase = "";

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
                        
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    
</body>
</html>