document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault() // Evita el envío del formulario de la manera tradicional
    
    const nombreUsuario = document.getElementById('nombre-usuario').value
    const contrasena = document.getElementById('contrasena').value

    fetch('/php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'nombre-usuario': nombreUsuario,
            'contrasena': contrasena
        })
    })
    .then(response => response.text())
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
        console.error('Error:', error)
    })
})


