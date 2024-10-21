
// Esperar a que el contenido del DOM esté completamente cargado antes de ejecutar la función
document.addEventListener('DOMContentLoaded', comenzar, false)

function comenzar() {
        // Llamada a las funciones principales de la página
    funcionalidadBarra()
    verDetalles()
    mostrarTicketsFiltro()
    buscarTicket()
    cambiarEstado()
    cerrarSesion()
}

function funcionalidadBarra() {
        // Obtener elementos de la barra lateral y el contenedor principal
    let barraIzquierda = document.getElementById('barra-lateral')
    let barraIzquierdaContenedor = document.getElementById('contenedor-barra-lateral')
    let contenedorPrincipal = document.getElementById('contenedor-principal')

        // Función para mostrar la barra lateral (expandir)
    function mostrarBarra() {
        barraIzquierda.style.width = '10%'
        barraIzquierdaContenedor.style.opacity = '1'
        contenedorPrincipal.style.marginLeft = '10%'
        barraIzquierda.style.border = '2px solid black'
    }

        // Función para ocultar la barra lateral (colapsar)
    function ocultarBarra() {
        barraIzquierda.style.width = '1%'
        barraIzquierdaContenedor.style.opacity = '0'
        contenedorPrincipal.style.marginLeft = '1%'
        barraIzquierda.style.border = 'none'
    }

    // Eventos para mostrar y ocultar la barra lateral
    barraIzquierda.addEventListener('mouseover', mostrarBarra)
    barraIzquierda.addEventListener('mouseleave', ocultarBarra)

        // Ocultar la barra lateral por defecto al cargar la página
    ocultarBarra()
}

function mostrarTicketsFiltro() {
        // Obtener botones para filtrar tickets por estado
    let ticketsEnProgreso = document.getElementById('tickets-en-progreso')
    let ticketsAbiertos = document.getElementById('tickets-abiertos')
    let ticketsCerrados = document.getElementById('tickets-cerrados')
    let mostrarTodosTickets = document.getElementById('mostrar-todos')

        // Agregar evento de clic para mostrar solo tickets "En Progreso"
    ticketsEnProgreso.addEventListener('click', function () {
        filtrarTickets('En Progreso')
    })

        // Agregar evento de clic para mostrar solo tickets "Abiertos"
    ticketsAbiertos.addEventListener('click', function () {
        filtrarTickets('Abierto')
    })

        // Agregar evento de clic para mostrar solo tickets "Cerrados"
    ticketsCerrados.addEventListener('click', function () {
        filtrarTickets('Cerrado')
    })

        // Agregar evento de clic para mostrar todos los tickets
    mostrarTodosTickets.addEventListener('click', function () {
        filtrarTickets('todos')
    })
}

/* function mostrarTodosTickets() {
        // Obtener el botón para mostrar todos los tickets
    const mostrarTickets = document.getElementById('mostrar-todos')

        // Agregar evento de clic para mostrar todos los tickets
    mostrarTickets.addEventListener('click', function () {
        // Realizar una petición a PHP para mostrar todos los tickets
        fetch('/php/filtrar_tickets.php?estado=todos')
            .then(response => response.text())
            .then(data => {
                // Insertar los tickets en el cuerpo de la tabla
                document.querySelector('.tabla-tickets tbody').innerHTML = data
            })
            .catch(error => console.error('Error;', error))
    })
} */

function filtrarTickets(estado) {
    // Realizar una petición a PHP para filtrar los tickets por estado
    fetch(`/php/filtrar_tickets.php?estado=${estado}`)
        .then(response => response.text())
        .then(data => {
            // Insertar los tickets filtrados en el cuerpo de la tabla
            document.querySelector('.tabla-tickets tbody').innerHTML = data
        })
        .catch(error => console.error('Error;', error))
}

// Función para buscar un ticket en la tabla
const buscarTicket = () => {
    const buscarEntrada = document.getElementById('buscar-ticket')
    const tablaTickets = document.querySelector('.tabla-tickets tbody')

    // Función que filtra las filas de la tabla en base al texto ingresado
    function filtrarTickets() {
        const filtro = buscarEntrada.value.toLowerCase()
        const filas = tablaTickets.getElementsByTagName('tr')

        // Iterar sobre todas las filas de la tabla
        for (let i = 0; i < filas.length; i++) {
            const fila = filas[i]
            // Convertir el contenido de las celdas de la fila en un solo string
            const textoFila = fila.textContent.toLowerCase()

            // Si el texto de la fila contiene el filtro, mostrar la fila, de lo contrario ocultarla
            if (textoFila.includes(filtro)) {
                fila.style.display = ''
            } else {
                fila.style.display = 'none'
            }
        }
    }

    buscarEntrada.addEventListener('keyup', filtrarTickets) // Evento asociado al presionar una tecla
}

const verDetalles = () => {
    const botonesDetalles = document.querySelectorAll('.ver-detalles')
    botonesDetalles.forEach(boton => {
        boton.addEventListener('click', function () {
            const id_ticket = this.getAttribute('data-id')
            fetch('/php/detalle_ticket.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id_ticket=${id_ticket}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data)
            })
            .catch(error => console.error('Error:', error))
        })
    })
}

const cambiarEstado = () => {
    document.querySelectorAll('.cambiar-estado').forEach(button => {
        button.addEventListener('click', () => {
            const row = button.closest('tr'); // Encuentra la fila más cercana
            const selectEstado = row.querySelector('.select-estado')
            const selectResolucion = row.querySelector('.select-resolucion')
            const botonGuardarEstado = row.querySelector('.guardar-estado')

            // Muestra el select y el botón guardar
            selectEstado.style.display = 'block'
            selectResolucion.style.display = 'block'
            botonGuardarEstado.style.display = 'block'

            // Oculta el botón de "Cambiar estado"
            button.style.display = 'none'

            botonGuardarEstado.addEventListener('click', () => {
                guardarEstado(row, selectEstado, selectResolucion, button, botonGuardarEstado)
            }, {once: true})
        })
    })
}

const guardarEstado = (row, selectEstado, selectResolucion, button, botonGuardarEstado) => {
    const idTicket = row.querySelector('td:nth-child(2)').innerText; // ID del ticket (asumiendo que está en la segunda celda)
    const nuevoEstado = selectEstado.value; // Estado seleccionado
    const nuevaResolucion = selectResolucion.value; // Resolución seleccionada

    console.log(nuevoEstado)
    console.log(nuevaResolucion)

    // Enviar los datos al archivo cambiar_estado.php
    fetch('/php/cambiar_estado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id_ticket=${idTicket}&nuevo_estado=${nuevoEstado}&nueva_resolucion=${nuevaResolucion}`
    })
    .then(response => response.json())
    .then(data => {
        // Si deseas realizar alguna acción con la respuesta del servidor
        console.log('Respuesta del servidor:', data)

        if(data.success){
            window.location.reload()
        }
        else{
            alert('Hubo un error al cambiar el estado del ticket.')
        }
    })
    .catch(error => console.error('Error:', error))

    // Ocultar el select y el botón guardar después de enviar los datos
    selectEstado.style.display = 'none';
    selectResolucion.style.display = 'none';
    botonGuardarEstado.style.display = 'none';

    // Volver a mostrar el botón "Cambiar estado"
    button.style.display = 'block';
}

function cerrarSesion() {
        // Obtener el enlace para cerrar sesión
    let cerrarSesion = document.getElementById('cerrar-sesion')

        // Agregar evento de clic para gestionar el cierre de sesión
    cerrarSesion.addEventListener('click', function(event) {
        event.preventDefault() // Evita que el enlace redirija inmediatamente

        window.location.href = '/php/cerrar_sesion.php' // Redirigir al script de cerrar sesion

    })
}

/* // Muestra una alerta con el nuevo estado
fetch('/php/cambiar_estado.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `id_ticket=${id}&nuevo_estado=${nuevoEstado}`
})
.then(response => response.text())
.then(data => {
    alert(data)
})
.catch(error => console.error('Error:', error)) */