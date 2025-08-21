document.addEventListener('DOMContentLoaded', function() {
  const stepper = document.getElementById('signupStepper');
  const steps = stepper.querySelectorAll('.stepper-step');
  const panes = stepper.querySelectorAll('.step-pane');
  const nextBtn = stepper.querySelector('.next-btn');
  const prevBtn = stepper.querySelector('.prev-btn');
  const submitBtn = stepper.querySelector('.submit-btn');
  let currentStep = 1;

  function updateStepper() {
    steps.forEach((step, index) => {
      if (index + 1 === currentStep) {
        step.classList.add('active');
        panes[index].classList.add('active');
      } else {
        step.classList.remove('active');
        panes[index].classList.remove('active');
      }
    });

    // Actualizar botones
    prevBtn.disabled = currentStep === 1;
    nextBtn.style.display = currentStep === steps.length ? 'none' : 'block';
    submitBtn.style.display = currentStep === steps.length ? 'block' : 'none';
    
    // Cambiar texto del último botón "Siguiente" a "Finalizar"
    if (currentStep === steps.length - 1) {
      nextBtn.textContent = 'Finalizar';
    } else {
      nextBtn.textContent = 'Siguiente';
    }
  }

  // Validar campos requeridos antes de avanzar
  function validateStep(step) {
    const currentPane = panes[step - 1];
    const requiredInputs = currentPane.querySelectorAll('[required]');
    let isValid = true;
    
    requiredInputs.forEach(input => {
      if (!input.value.trim()) {
        input.classList.add('is-invalid');
        isValid = false;
      } else {
        input.classList.remove('is-invalid');
      }
    });
    
    return isValid;
  }

  // Event Listeners
  nextBtn.addEventListener('click', () => {
    if (validateStep(currentStep) && currentStep < steps.length) {
      currentStep++;
      updateStepper();
    }
  });

  prevBtn.addEventListener('click', () => {
    if (currentStep > 1) {
      currentStep--;
      updateStepper();
    }
  });

  // Inicializar
  updateStepper();
});