
document.addEventListener('DOMContentLoaded', comenzar, false)

function comenzar() {
    funcionalidadBarra()
    mostrarTicketsFiltro()
    mostrarTodosTickets()
    cerrarSesion()
}

function funcionalidadBarra() {
    let barraIzquierda = document.getElementById('barra-lateral')
    let barraIzquierdaContenedor = document.getElementById('contenedor-barra-lateral')
    let contenedorPrincipal = document.getElementById('contenedor-principal')

    function mostrarBarra() {
        barraIzquierda.style.width = '10%'
        barraIzquierdaContenedor.style.opacity = '1'
        contenedorPrincipal.style.marginLeft = '10%'
        barraIzquierda.style.border = '2px solid black'
    }

    function ocultarBarra() {
        barraIzquierda.style.width = '1%'
        barraIzquierdaContenedor.style.opacity = '0'
        contenedorPrincipal.style.marginLeft = '1%'
        barraIzquierda.style.border = 'none'
    }

    // Eventos para mostrar y ocultar la barra lateral
    barraIzquierda.addEventListener('mouseover', mostrarBarra)
    barraIzquierda.addEventListener('mouseleave', ocultarBarra)

    ocultarBarra()
}

function mostrarTicketsFiltro() {
    let ticketsEnProgreso = document.getElementById('tickets-en-progreso')
    let ticketsAbiertos = document.getElementById('tickets-abiertos')
    let ticketsCerrados = document.getElementById('tickets-cerrados')

    ticketsEnProgreso.addEventListener('click', function () {
        filtrarTickets('En Progreso')
    })

    ticketsAbiertos.addEventListener('click', function () {
        filtrarTickets('Abierto')
    })

    ticketsCerrados.addEventListener('click', function () {
        filtrarTickets('Cerrado')
    })
}

function mostrarTodosTickets() {
    const mostrarTickets = document.getElementById('mostrar-todos')

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
    let cerrarSesion = document.getElementById('cerrar-sesion')

    cerrarSesion.addEventListener('click', function(event) {
        event.preventDefault() // Evita que el enlace redirija inmediatamente

        window.location.href = 'login.html'
    })
}