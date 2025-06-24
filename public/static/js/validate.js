// Función para validar inputs en tiempo real
function validateInput(e) {
    const input = e.target;

    // Validación para inputs de tipo texto y textarea (letras, espacios, puntos, comas y comillas)
    if (input.type === 'text' || input.tagName === 'TEXTAREA') {
        const regex = /^[A-Za-z\s,."]*$/; // Letras, espacios, comas, puntos y comillas
        if (!regex.test(input.value)) {
            input.value = input.value.replace(/[^A-Za-z\s,."]/g, ''); // Elimina caracteres no válidos
        }
    }

    // Validación para inputs de tipo número (1-200)
    if (input.type === 'number') {
        const value = parseInt(input.value);
        if (isNaN(value) || value < 1) {
            input.value = ''; // Limpia el campo si no es válido
        }
    }

    // Validación para inputs de tipo email
    if (input.type === 'email') {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Formato básico de email
        if (!regex.test(input.value)) {
            input.setCustomValidity('Ingresa un email válido'); // Mensaje de error
        } else {
            input.setCustomValidity(''); // Limpia el mensaje de error
        }
    }

    // Validación para inputs de tipo password (mínimo 8 caracteres)
    if (input.type === 'password') {
        if (input.value.length < 8) {
            input.setCustomValidity('La contraseña debe tener al menos 8 caracteres'); // Mensaje de error
        } else {
            input.setCustomValidity(''); // Limpia el mensaje de error
        }
    }

    // Validación para textarea (letras, espacios, comas, puntos y comillas)
    if (input.tagName === 'TEXTAREA') {
        const regex = /^[A-Za-z\s,."]*$/; // Letras, espacios, comas, puntos y comillas
        if (!regex.test(input.value)) {
            // Elimina solo los caracteres no válidos
            input.value = input.value.replace(/[^A-Za-z\s,."]/g, '');
        }
    }
}

// Aplicar la validación a todos los inputs y textareas
document.querySelectorAll('input, textarea').forEach(function (element) {
    element.addEventListener('input', validateInput);
});