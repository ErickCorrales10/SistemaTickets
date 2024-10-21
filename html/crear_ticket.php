<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ticket - Sistema de Tickets</title>

        <!-- Enlace al archivo CSS para los estilos del formulario -->
    <link rel="stylesheet" href="/css/crear_ticket.css">

        <!-- Enlace al archivo JavaScript para funcionalidades adicionales -->
    <script src="/js/crear_ticket.js"></script>
    <script>

                // Evento que se ejecuta cuando el DOM está completamente cargado
        document.addEventListener('DOMContentLoaded', function() {
            // Hacer la solicitud AJAX para obtener los IDs
            fetch('/php/get_ids.php')
                .then(response => response.json())
                .then(data => {
                    // Insertar los valores en los campos del formulario
                    document.querySelector('input[name="id-ticket"]').value = data.next_ticket_id
                    document.querySelector('input[name="id-cliente"]').value = data.next_cliente_id
                })
                .catch(error => console.error('Error obteniendo los IDs:', error))
        })
    </script>
</head>
<body>

    <!-- Verificamos si hay una sesión activa -->
    <?php
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.html'); // Redirigimos a la página de inicio
            exit(); // Salimos de la página
        }
    ?>

    <div class="contenedor-principal" id="contenedor-principal"> 
        <!-- Contenedor principal con los tickets -->
        <main class="main-principal" id="main-principal">
            <br>

            <!-- Encabezado del formulario con el título y la información del usuario -->
            <header id="header" class="header">
                <h1>Crear ticket</h1>
                <br>
                <div class="informacion-usuario">
                    <span>Usuario: <strong>Erick Corrales</strong></span>
                </div>
            </header>
            <br><br>

            <!-- Formulario para la creación de tickets, que se envía al servidor mediante POST -->
            <form class="datos-ticket" id="datos-ticket" action="/php/crear_ticket.php" method="POST">
                <div class="contenedor-datos-ticket">   
                    <div class="seccion" id="campos-ticket">
                        <h1>Datos del ticket</h1>
                        <div class="campo">
                            <input type="text" name="id-ticket" id="id-ticket" readonly>
                            <input type="text" name="asunto-titulo" placeholder="Asunto/Título" required>
                            <textarea name="descripcion" placeholder="Descripción del problema" required></textarea>
                            <select name="categoria" required>
                                <option value="" disabled selected>Seleccione una categoría</option>
                                <option value="conectividad">Problemas de conectividad</option>
                                <option value="configuracion">Errores de configuración</option>
                                <option value="hardware">Problemas de hardware</option>
                                <option value="software">Errores de software</option>
                                <option value="matenimiento">Solicitud de mantenimiento</option>
                                <option value="seguridad">Problemas de seguridad</option>
                                <option value="otros">Otros problemas</option>
                            </select>
                            <select name="prioridad" required>
                                <option value="" disabled selected>Seleccione una prioridad</option>
                                <option value="alta">Alta</option>
                                <option value="media">Media</option>
                                <option value="baja">Baja</option>
                            </select>
                            <input type="text" name="estado" value="Abierto" required>
                            <label for="fecha-creacion" class="fecha-creacion">Fecha de creación</label>
                            <input type="date" name="fecha-creacion" id="fecha-creacion">
                            <label for="fecha-resolucion" class="fecha-resolucion">Fecha de resolución</label>
                            <input type="date" name="fecha-resolucion" id="fecha-resolucion">                    
                        </div>
                    </div>
                    <div class="seccion" id="campos-cliente">
                        <h1>Datos del cliente</h1>
                        <div class="campo">
                            <input type="text" name="nombre" placeholder="Nombre cliente" required>
                            <input type="email" name="email" placeholder="Email" required>
                            <input type="tel" name="tel" placeholder="Teléfono" required>
                        </div>
                    </div>
                    <div class="seccion" id="asignacion-seguimiento">
                        <h1>Asignación y Seguimiento</h1>
                        <div class="campo">
                            <select name="asignado" required>
                                <option value="" disabled selected>Seleccione un técnico</option>
                                <option value="erick">Erick Corrales</option>
                                <option value="luis">Luis Gutierrez</option>
                            </select>
                            <select name="departamento" required>
                                <option value="" disabled selected>Seleccione un departamento</option>
                                <option value="mantenimiento">Mantenimiento</option>
                                <option value="soporte">Soporte</option>
                                <option value="redes">Redes</option>
                                <option value="seguridad">Seguridad Informática</option>
                                <option value="basedatos">Base de Datos</option>
                            </select>
                        </div>
                    </div>
                    <div class="seccion" id="notas-internas">
                        <h1>Notas Internas</h1>
                        <div class="campo">
                            <textarea name="notas" placeholder="Comentarios internos"></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Botones para crear o descartar el ticket -->
                <div class="contenedor-boton" id="contenedor-boton">
                    <input type="submit" id="enviar-ticket" class="btn-crear-ticket" value="Crear Ticket" name="btn-crear-ticket">
                    <input type="button" class="btn-descartar-ticket" value="Descartar Ticket" name="btn-descartar-ticket" id="btn-descartar-ticket">
                </div>
            </form>
        </main>
    </div>
    
</body>
</html>