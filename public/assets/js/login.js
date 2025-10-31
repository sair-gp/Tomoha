const button = document.getElementById('button');
const email = document.getElementById('email');
const password = document.getElementById('password');

email.maxLength = 100;
password.maxLength = 50;

button.addEventListener('click', async function(event) {
    event.preventDefault();

    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    if (!emailValue || !passwordValue) {
        Swal.fire({
            icon: 'warning',
            text: 'Campos incompletos.',
            toast: true,
            position: 'top',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 4000,
            timerProgressBar: true,
        });
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailValue)) {
        Swal.fire({
            icon: 'warning',
            text: 'Ingrese un correo válido.',
            toast: true,
            position: 'top',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 4000,
            timerProgressBar: true,
        });
        return;
    }

    try {
        const response = await fetch('auth/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: emailValue, password: passwordValue })
        });

        const data = await response.json();
        if (data.status === 'success') {
            window.location.href = '/panel';
        } else {
            Swal.fire({
                icon: 'error',
                text: data.message,
                toast: true,
                position: 'top',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 10000,
                timerProgressBar: true,
            });
        }
    } catch (error) {
        console.error('Error:', error);
    }
});