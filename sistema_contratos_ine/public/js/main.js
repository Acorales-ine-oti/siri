// Lógica de JavaScript para el frontend
document.addEventListener('DOMContentLoaded', () => {
    // Lógica para el formulario de login en index.html
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Evitar recarga de la página

            const username = loginForm.username.value;
            const password = loginForm.password.value;
            const loginMessage = document.getElementById('loginMessage');

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ username, password })
                });

                const text = await response.text(); // Leer como texto para ver el mensaje

                if (response.ok) {
                    loginMessage.style.color = 'green';
                    loginMessage.textContent = `Login exitoso: ${text}`;
                    // En un sistema real, aquí se redirigiría o se guardaría un token
                } else {
                    loginMessage.style.color = 'red';
                    loginMessage.textContent = `Error de login: ${text}`;
                }
            } catch (error) {
                console.error('Error de red o del servidor:', error);
                loginMessage.style.color = 'red';
                loginMessage.textContent = 'Error al conectar con el servidor.';
            }
        });
    }

    // Lógica para el formulario de nuevo contrato
    const newContractForm = document.getElementById('newContractForm');
    if (newContractForm) {
        newContractForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Evitar recarga de la página

            const formData = new FormData(newContractForm);
            const data = Object.fromEntries(formData.entries());

            // Convertir 'mayor_edad' y 'nacionalidad' a booleanos o su tipo esperado
            data.mayor_edad = data.mayor_edad === 'on'; // Checkbox value
            data.nacionalidad = data.nacionalidad; // Asumiendo que es un valor de texto

            try {
                const response = await fetch('/contratos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    alert('Contrato creado exitosamente!');
                    window.location.href = '/contratos'; // Redirigir a la lista
                } else {
                    const errorText = await response.text();
                    alert(`Error al crear contrato: ${errorText}`);
                }
            } catch (error) {
                console.error('Error de red o del servidor:', error);
                alert('Error al conectar con el servidor.');
            }
        });
    }
});