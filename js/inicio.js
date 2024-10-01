
document.addEventListener('DOMContentLoaded', comenzar, false)

function comenzar() {
    funcionalidadBarra()
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