// Esperar a que el contenido del DOM esté completamento cargado
document.addEventListener('DOMContentLoaded', function() {
        // Crear un objeto de fecha con la fecha actual
        const hoy = new Date()

        // Obtener el día actual, el mes (se le suma 1 ya que los meses en JavaScript empiezan desde 0) y el año
        // Asegurarse de que el día y el mes tengan siempre dos dígitos
        const dia = hoy.getDate().toString().padStart(2, '0')
        const mes = (hoy.getMonth() + 1).toString().padStart(2, '0')
        const anio = hoy.getFullYear()

            // Formatear la fecha actual en el formato 'AAAA-MM-DD'
        const fechaActual = `${anio}-${mes}-${dia}`
        
            // Crear un nuevo objeto de fecha basado en la fecha actual
        const fechaResolucion = new Date(fechaActual)

            // Establecer la fecha de resolución a 7 días después de la fecha actual
        fechaResolucion.setDate(hoy.getDate() + 7)

            // Obtener el día, mes y año de la fecha de resolución, asegurando que tengan siempre dos dígitos
        const diaResolucion = fechaResolucion.getDate().toString().padStart(2, '0')
        const mesResolucion = (fechaResolucion.getMonth() + 1).toString().padStart(2, '0')
        const anioResolucion = fechaResolucion.getFullYear()

            // Formatear la fecha de resolución en el formato 'AAAA-MM-DD'
        const fechaResolucionFormateada = `${anioResolucion}-${mesResolucion}-${diaResolucion}`
        
            // Asignar las fechas a los campos de creación de fecha y resolución en el formulario
        document.getElementById('fecha-creacion').value = fechaActual
        document.getElementById('fecha-resolucion').value = fechaResolucionFormateada

            // Agregar un evento al botón de descartar cambios, confirmando si el usuario desea cancelar
        document.getElementById('btn-descartar-ticket').addEventListener('click', function() {
            const descartar = confirm('¿Está seguro que desea descartar los cambios? Los datos no se guardarán.')
            if(descartar) {
                window.location.href = '/html/inicio.php'; // Si el usuario confirma, redirigirlo a la página de inicio
            }
        }, false)
    }, false)

