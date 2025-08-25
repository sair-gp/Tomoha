document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.stepper-step');
    const panels = document.querySelectorAll('.step-panel');
    const prevBtn = document.querySelector('.btn-prev');
    const nextBtn = document.querySelector('.btn-next');
    const submitBtn = document.querySelector('.btn-submit');
    
    let currentStep = 0;
    let hasValidated = false; // Bandera para controlar cuándo mostrar errores

    // Configuración de límites de caracteres por campo
    const characterLimits = {
        '#nombre': 25,
        '#apellido': 25,
        '#numero-cedula': 8,
        '#numero-telefono': 7
    };

    // Función para aplicar límites de caracteres
    function applyCharacterLimits() {
        // Para campos de texto (nombre y apellido) - solo letras y espacios
        document.querySelectorAll('#nombre, #apellido').forEach(input => {
            input.addEventListener('input', function() {
                // Eliminar números y caracteres especiales, mantener solo letras y espacios
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                
                // Limitar longitud máxima
                const maxLength = characterLimits[`#${this.id}`];
                if (this.value.length > maxLength) {
                    this.value = this.value.substring(0, maxLength);
                }
            });
        });

        // Para campo de cédula - solo números
        const cedulaInput = document.querySelector('#numero-cedula');
        if (cedulaInput) {
            cedulaInput.addEventListener('input', function() {
                // Permitir solo números
                this.value = this.value.replace(/\D/g, '');
                
                // Limitar longitud máxima
                const maxLength = characterLimits[`#${this.id}`];
                if (this.value.length > maxLength) {
                    this.value = this.value.substring(0, maxLength);
                }
            });
        }

        // Para campo de teléfono - solo números
        const telefonoInput = document.querySelector('#numero-telefono');
        if (telefonoInput) {
            telefonoInput.addEventListener('input', function() {
                // Permitir solo números
                this.value = this.value.replace(/\D/g, '');
                
                // Limitar longitud máxima
                const maxLength = characterLimits[`#${this.id}`];
                if (this.value.length > maxLength) {
                    this.value = this.value.substring(0, maxLength);
                }
            });
        }
    }

    // Función para validar los campos del paso actual
    function validateCurrentStep() {
        const currentPanel = panels[currentStep];
        const requiredInputs = currentPanel.querySelectorAll('input[required], select[required]');
        let isValid = true;

        requiredInputs.forEach(input => {
            // Solo mostrar errores si ya se intentó validar
            if (hasValidated) {
                // Remueve mensajes de error existentes
                const existingError = input.parentNode.querySelector('.invalid-feedback');
                if (existingError) {
                    existingError.remove();
                }
                
                // Resetea estilos de error
                input.classList.remove('is-invalid');
            }
            
            // Verifica si el campo está vacío
            if (!input.value.trim()) {
                isValid = false;
                
                // Solo mostrar errores si ya se intentó validar
                if (hasValidated) {
                    input.classList.add('is-invalid');
                    
                    // Agrega mensaje de error
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
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
        
        panels.forEach((panel, index) => {
            panel.classList.toggle('active', index === stepIndex);
        });
        
        currentStep = stepIndex;
        updateButtons();
        hasValidated = false; // Resetear la bandera al cambiar de paso
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
            hasValidated = true; // Activar la bandera para mostrar errores
            // Validar campos antes de avanzar
            if (validateCurrentStep()) {
                showStep(currentStep + 1);
            } else {
                // Efecto visual para indicar error
                nextBtn.classList.add('btn-error');
                setTimeout(() => {
                    nextBtn.classList.remove('btn-error');
                }, 600);
            }
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            showStep(currentStep - 1);
        }
    });

    // Validación en tiempo real pero SIN mostrar errores
    document.querySelectorAll('input[required], select[required]').forEach(input => {
        input.addEventListener('blur', function() {
            // Solo validar sin mostrar errores
            if (hasValidated) {
                validateCurrentStep();
            }
        });
        
        // Limpiar errores al empezar a escribir
        input.addEventListener('input', function() {
            if (hasValidated) {
                this.classList.remove('is-invalid');
                const existingError = this.parentNode.querySelector('.invalid-feedback');
                if (existingError) {
                    existingError.remove();
                }
                // Validar de nuevo para ver si ya está completo
                validateCurrentStep();
            }
        });
    });

    // Aplicar límites de caracteres
    applyCharacterLimits();

    // Inicializar
    showStep(0);
});