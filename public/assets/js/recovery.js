document.getElementById('password-recovery').addEventListener('click', () => {
  Swal.fire({
    title: 'Recuperar contraseña',
    html: recoveryHTML,
    showConfirmButton: false,
    width: '500px',
    didOpen: () => iniciarStepperRecuperacion()
  });
});

function iniciarStepperRecuperacion() {
  const steps = Swal.getPopup().querySelectorAll('.stepper-step');
  const panels = Swal.getPopup().querySelectorAll('.step-panel');
  const prevBtn = Swal.getPopup().querySelector('.btn-prev');
  const nextBtn = Swal.getPopup().querySelector('.btn-next');
  const submitBtn = Swal.getPopup().querySelector('.btn-submit');
  const stepperBody = Swal.getPopup().querySelector('.stepper-body');

  let currentStep = 0;
  let questionId = null;

  function showStep(index) {
    steps.forEach((step, i) => step.classList.toggle('active', i === index));
    panels.forEach((panel, i) => panel.classList.toggle('active', i === index));
    prevBtn.disabled = index === 0;
    nextBtn.style.display = index < 2 ? 'inline-block' : 'none';
    submitBtn.style.display = index === 2 ? 'inline-block' : 'none';
    currentStep = index;
    
    // Ajustar altura del contenedor según el step
    if (index === 0) {
      stepperBody.style.minHeight = '65px'; // Altura reducida para step 1
    } else {
      stepperBody.style.minHeight = '170px'; // Altura aumentada para steps 2 y 3
    }
  }

  function showFieldError(input, message) {
    // Limpiar errores previos
    hideFieldError(input);
    
    // Añadir clase de error al input
    input.classList.add('is-invalid');
    
    // Crear elemento de mensaje de error
    const errorElement = document.createElement('div');
    errorElement.className = 'invalid-feedback';
    errorElement.textContent = message;
    
    // Insertar después del input
    input.parentNode.appendChild(errorElement);
    
    // Añadir animación de error al botón
    nextBtn.classList.add('btn-error');
    setTimeout(() => nextBtn.classList.remove('btn-error'), 600);
  }

  function hideFieldError(input) {
    input.classList.remove('is-invalid');
    const existingError = input.parentNode.querySelector('.invalid-feedback');
    if (existingError) {
      existingError.remove();
    }
  }

  function resetAllErrors() {
    const inputs = Swal.getPopup().querySelectorAll('.form-control');
    inputs.forEach(input => hideFieldError(input));
  }

  async function handleStep() {
    resetAllErrors();
    
    if (currentStep === 0) {
      const emailInput = Swal.getPopup().querySelector('#recovery-email');
      const email = emailInput.value.trim();
      
      if (!email) {
        showFieldError(emailInput, 'Ingresa tu correo');
        return false;
      }
      
      // Validar formato de email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        showFieldError(emailInput, 'Ingresa un correo válido');
        return false;
      }

      try {
        const res = await fetch('auth/reset-password', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ step: 1, email })
        });
        const data = await res.json();
        
        if (data.status !== 'success') {
          showFieldError(emailInput, data.message);
          return false;
        }

        Swal.getPopup().querySelector('#security-question').value = data.question_text;
        questionId = data.question_id;
        showStep(1);
        return true;
      } catch (error) {
        showFieldError(emailInput, 'Error de conexión. Intenta nuevamente.');
        return false;
      }
    }

    else if (currentStep === 1) {
      const answerInput = Swal.getPopup().querySelector('#security-answer');
      const answer = answerInput.value.trim();
      
      if (!answer) {
        showFieldError(answerInput, 'Ingresa tu respuesta');
        return false;
      }

      try {
        const email = Swal.getPopup().querySelector('#recovery-email').value.trim();
        const res = await fetch('auth/reset-password', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ step: 2, email, question_id: questionId, answer })
        });
        const data = await res.json();
        
        if (data.status !== 'success') {
          showFieldError(answerInput, data.message);
          return false;
        }

        showStep(2);
        return true;
      } catch (error) {
        showFieldError(answerInput, 'Error de conexión. Intenta nuevamente.');
        return false;
      }
    }
  }

  nextBtn.addEventListener('click', async () => {
    await handleStep();
  });

  prevBtn.addEventListener('click', () => {
    resetAllErrors();
    showStep(currentStep - 1);
  });

  submitBtn.addEventListener('click', async () => {
    resetAllErrors();
    
    const passInput = Swal.getPopup().querySelector('#new-password');
    const confirmInput = Swal.getPopup().querySelector('#confirm-password');
    const pass = passInput.value.trim();
    const confirm = confirmInput.value.trim();

    if (!pass) {
      showFieldError(passInput, 'Ingresa una contraseña');
      return;
    }
    
    if (!confirm) {
      showFieldError(confirmInput, 'Confirma tu contraseña');
      return;
    }
    
    if (pass !== confirm) {
      showFieldError(confirmInput, 'Las contraseñas no coinciden');
      return;
    }

    try {
      const email = Swal.getPopup().querySelector('#recovery-email').value.trim();
      const res = await fetch('auth/reset-password', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ step: 3, email, new_password: pass })
      });
      const data = await res.json();
      
      if (data.status !== 'success') {
        // Mostrar error genérico si falla
        const errorElement = document.createElement('div');
        errorElement.className = 'invalid-feedback';
        errorElement.style.position = 'static';
        errorElement.style.marginTop = '1rem';
        errorElement.textContent = data.message;
        
        submitBtn.parentNode.insertBefore(errorElement, submitBtn.nextSibling);
        submitBtn.classList.add('btn-error');
        setTimeout(() => submitBtn.classList.remove('btn-error'), 600);
        return;
      }

      Swal.fire('Éxito', 'Tu contraseña ha sido actualizada', 'success');
    } catch (error) {
      const errorElement = document.createElement('div');
      errorElement.className = 'invalid-feedback';
      errorElement.style.position = 'static';
      errorElement.style.marginTop = '1rem';
      errorElement.textContent = 'Error de conexión. Intenta nuevamente.';
      
      submitBtn.parentNode.insertBefore(errorElement, submitBtn.nextSibling);
      submitBtn.classList.add('btn-error');
      setTimeout(() => submitBtn.classList.remove('btn-error'), 600);
    }
  });

  showStep(0);
}

const recoveryHTML = `
  <div class="form-stepper">
    <div class="stepper-header">
      <div class="stepper-step active" data-step="0"><div class="step-indicator">1</div><div class="step-label">Correo</div></div>
      <div class="stepper-step" data-step="1"><div class="step-indicator">2</div><div class="step-label">Seguridad</div></div>
      <div class="stepper-step" data-step="2"><div class="step-indicator">3</div><div class="step-label">Nueva clave</div></div>
    </div>

    <div class="stepper-body">
      <div class="step-panel active" data-step="0">
        <div class="form-field-group">
          <label for="recovery-email" class="form-label">Correo electrónico</label>
          <input type="email" id="recovery-email" class="form-control" placeholder="tu@correo.com" required>
        </div>
      </div>

      <div class="step-panel" data-step="1">
        <div class="form-field-group">
          <label for="security-question" class="form-label">Pregunta de seguridad</label>
          <input type="text" id="security-question" class="form-control" disabled>
        </div>
        <div class="form-field-group">
          <label for="security-answer" class="form-label">Respuesta</label>
          <input type="text" id="security-answer" class="form-control" required>
        </div>
      </div>

      <div class="step-panel" data-step="2">
        <div class="form-field-group">
          <label for="new-password" class="form-label">Nueva contraseña</label>
          <input type="password" id="new-password" class="form-control" required>
        </div>
        <div class="form-field-group">
          <label for="confirm-password" class="form-label">Confirmar contraseña</label>
          <input type="password" id="confirm-password" class="form-control" required>
        </div>
      </div>
    </div>

    <div class="form-actions">
      <button type="button" class="form-btn btn-prev" disabled><i class="fas fa-arrow-left"></i> Anterior</button>
      <button type="button" class="form-btn btn-next">Siguiente <i class="fas fa-arrow-right"></i></button>
      <button type="button" class="form-btn btn-submit" style="display: none;"><i class="fas fa-check-circle"></i> Actualizar contraseña</button>
    </div>
  </div>
`;