
// Esperar a que el contenido del DOM esté completamente cargado antes de ejecutar la función
document.addEventListener('DOMContentLoaded', comenzar, false)

function comenzar() {
        // Llamada a las funciones principales de la página
    funcionalidadBarra()
    mostrarTicketsFiltro()
    mostrarTodosTickets()
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
}

function mostrarTodosTickets() {
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
}

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

function cerrarSesion() {
        // Obtener el enlace para cerrar sesión
    let cerrarSesion = document.getElementById('cerrar-sesion')

        // Agregar evento de clic para gestionar el cierre de sesión
    cerrarSesion.addEventListener('click', function(event) {
        event.preventDefault() // Evita que el enlace redirija inmediatamente

        window.location.href = 'login.html' // Redirigir al usuario a la página de login

    })
}