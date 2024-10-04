// Agrega un evento de 'submit' al formulario de inicio de sesión
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault() // Evita el envío del formulario de la manera tradicional
    
        // Obtener valores de los campos de entrada
    const nombreUsuario = document.getElementById('nombre-usuario').value
    const contrasena = document.getElementById('contrasena').value

    // Realizar una solicitud POST a PHP para iniciar sesión
    fetch('/php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'nombre-usuario': nombreUsuario, // Parámetro del nombre de usuario
            'contrasena': contrasena // Parámetro de la contraseña
        })
    })
    .then(response => response.text()) // Procesar la respuesta como texto
    .then(data => {
        // Maneja la respuesta del servidor
        if (data.includes("Inicio de sesión exitoso")) {
            window.location.href = '/html/inicio.php' // Redirigir a la página principal
        } else {
            alert('Error: Inicio de sesión fallida')
            document.getElementById('mensaje-error').innerText = data // Muestra el mensaje de error
        }
    })
    .catch(error => {
        console.error('Error:', error) // Manejar errores de la solicitud
    })
})


