document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.stepper-step');
    const panels = document.querySelectorAll('.step-panel');
    const prevBtn = document.querySelector('.btn-prev');
    const nextBtn = document.querySelector('.btn-next');
    const submitBtn = document.querySelector('.btn-submit');
    
    let currentStep = 0;
    let hasValidated = false;

    const characterLimits = {
        '#nombre': 25,
        '#apellido': 25,
        '#numero-cedula': 8,
        '#numero-telefono': 7
    };

    function applyCharacterLimits() {
        document.querySelectorAll('#nombre, #apellido').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                const maxLength = characterLimits[`#${this.id}`];
                if (this.value.length > maxLength) this.value = this.value.substring(0, maxLength);
            });
        });

        const cedulaInput = document.querySelector('#numero-cedula');
        if (cedulaInput) {
            cedulaInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
                const maxLength = characterLimits[`#${this.id}`];
                if (this.value.length > maxLength) this.value = this.value.substring(0, maxLength);
            });
        }

        const telefonoInput = document.querySelector('#numero-telefono');
        if (telefonoInput) {
            telefonoInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
                const maxLength = characterLimits[`#${this.id}`];
                if (this.value.length > maxLength) this.value = this.value.substring(0, maxLength);
            });
        }
    }

    function validateCurrentStep() {
        const currentPanel = panels[currentStep];
        let requiredInputs = currentPanel.querySelectorAll('input[required], select[required]');
        
        let isValid = true;

        requiredInputs.forEach(input => {
            if (hasValidated) {
                const existingError = input.parentNode.querySelector('.invalid-feedback');
                if (existingError) existingError.remove();
                input.classList.remove('is-invalid');
            }

            if (!input.value.trim()) {
                isValid = false;

                if (hasValidated) {
                    input.classList.add('is-invalid');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'Este campo es obligatorio';
                    input.parentNode.appendChild(errorDiv);
                }
            }
        });

        return isValid;
    }

    function updateButtons() {
        prevBtn.disabled = currentStep === 0;
        nextBtn.style.display = currentStep === steps.length - 1 ? 'none' : 'flex';
        submitBtn.style.display = currentStep === steps.length - 1 ? 'flex' : 'none';
    }

    function showStep(stepIndex) {
        steps.forEach((step, index) => step.classList.toggle('active', index === stepIndex));
        panels.forEach((panel, index) => panel.classList.toggle('active', index === stepIndex));
        currentStep = stepIndex;
        updateButtons();
        hasValidated = false;
    }

    nextBtn.addEventListener('click', () => {
    hasValidated = true;

    if (!validateCurrentStep()) {
        nextBtn.classList.add('btn-error');
        setTimeout(() => nextBtn.classList.remove('btn-error'), 600);
        return;
    }

        if (currentStep === 1) {
                const passwordInput = document.getElementById('password');
                const confirmInput = document.getElementById('confirm-password');
                const emailInput = document.getElementById('email');

                const password = passwordInput.value.trim();
                const confirmPassword = confirmInput.value.trim();
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            [emailInput, passwordInput, confirmInput].forEach(input => {
                const existingError = input.parentNode.querySelector('.invalid-feedback');
                if (existingError) existingError.remove();
                input.classList.remove('is-invalid');
            });

            if (!emailRegex.test(email)) {
                emailInput.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.textContent = 'Ingrese un correo válido';
                emailInput.parentNode.appendChild(errorDiv);
                return;
            }

            if (password !== confirmPassword) {
                passwordInput.classList.add('is-invalid');
                confirmInput.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.textContent = 'Las contraseñas no coinciden';
                passwordInput.parentNode.appendChild(errorDiv);
                return;
            }
        }

    showStep(currentStep + 1);
});


    prevBtn.addEventListener('click', () => showStep(currentStep - 1));

    document.querySelectorAll('input[required], select[required]').forEach(input => {
        input.addEventListener('blur', () => { if (hasValidated) validateCurrentStep(); });
        input.addEventListener('input', () => {
            if (hasValidated) {
                input.classList.remove('is-invalid');
                const existingError = input.parentNode.querySelector('.invalid-feedback');
                if (existingError) existingError.remove();
                validateCurrentStep();
            }
        });
    });

    applyCharacterLimits();
    showStep(0);

    fetchSecurityQuestions();

    submitBtn.addEventListener('click', async function(event) {
        event.preventDefault();
        hasValidated = true;

        if (!validateCurrentStep()) return;

        const formData = {
            first_name: document.getElementById('nombre').value.trim(),
            last_name: document.getElementById('apellido').value.trim(),
            tipo_cedula: document.getElementById('tipo-cedula').value,
            numero_cedula: document.getElementById('numero-cedula').value.trim(),
            codigo_telefono: document.getElementById('codigo-telefono').value,
            numero_telefono: document.getElementById('numero-telefono').value.trim(),
            email: document.getElementById('email').value.trim(),
            password: document.getElementById('password').value.trim(),
            confirm_password: document.getElementById('confirm-password').value.trim(),
            security_question: document.getElementById('security_question').value,
            security_answer: document.getElementById('security_answer').value.trim()
        };

        try {
            const response = await fetch('auth/signup', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });

            const data = await response.json();
            if (data.status === 'success') {
                window.location.href = '/';
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
});

async function fetchSecurityQuestions() {
    try {
        const response = await fetch('auth/security-questions');
        const questions = await response.json();
        const select = document.getElementById('security_question');

        questions.forEach(question => {
            const option = document.createElement('option');
            option.value = question.id;
            option.textContent = question.question_text;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error fetching security questions:', error);
    }
}
