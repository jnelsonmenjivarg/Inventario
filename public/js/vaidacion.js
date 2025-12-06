function validarLogin() {
    const email = document.getElementById('email');
    const pass  = document.getElementById('password');

    if (!email.value.includes('@')) {
        alert('El correo no es válido.');
        email.focus();
        return false;
    }

    if (pass.value.length < 4) {
        alert('La contraseña debe tener al menos 4 caracteres.');
        pass.focus();
        return false;
    }

    return true;
}
