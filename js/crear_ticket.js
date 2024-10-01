document.addEventListener('DOMContentLoaded', function() {
        const hoy = new Date()

        const dia = hoy.getDate().toString().padStart(2, '0')
        const mes = (hoy.getMonth() + 1).toString().padStart(2, '0')
        const anio = hoy.getFullYear()

        const fechaActual = `${anio}-${mes}-${dia}`
        
        document.getElementById('fecha-creacion').value = fechaActual
    }, false)