document.addEventListener('DOMContentLoaded', function() {
        const hoy = new Date()

        const dia = hoy.getDate().toString().padStart(2, '0')
        const mes = (hoy.getMonth() + 1).toString().padStart(2, '0')
        const anio = hoy.getFullYear()

        const fechaActual = `${anio}-${mes}-${dia}`
        
        const fechaResolucion = new Date(fechaActual)
        fechaResolucion.setDate(hoy.getDate() + 7)

        const diaResolucion = fechaResolucion.getDate().toString().padStart(2, '0')
        const mesResolucion = (fechaResolucion.getMonth() + 1).toString().padStart(2, '0')
        const anioResolucion = fechaResolucion.getFullYear()

        const fechaResolucionFormateada = `${anioResolucion}-${mesResolucion}-${diaResolucion}`
        
        
        document.getElementById('fecha-creacion').value = fechaActual
        document.getElementById('fecha-resolucion').value = fechaResolucionFormateada

        document.getElementById('btn-descartar-ticket').addEventListener('click', function() {
            const descartar = confirm('¿Está seguro que desea descartar los cambios? Los datos no se guardarán.')
            if(descartar) {
                window.location.href = '/html/inicio.php';
            }
        }, false)
    }, false)

