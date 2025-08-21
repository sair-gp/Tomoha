<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGB - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/signup.css">
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<div class="signup-form-container">
  <div class="signup-form-box">
    <div class="form-stepper">
      <!-- Header del stepper -->
      <div class="stepper-header">
        <div class="stepper-step active" data-step="1">
          <div class="step-indicator">1</div>
          <div class="step-label">Datos Personales</div>
        </div>
        <div class="stepper-step" data-step="2">
          <div class="step-indicator">2</div>
          <div class="step-label">Credenciales</div>
        </div>
        <div class="stepper-step" data-step="3">
          <div class="step-indicator">3</div>
          <div class="step-label">Seguridad</div>
        </div>
      </div>

      <!-- Contenido del formulario -->
      <div class="stepper-body">
        <!-- Paso 1 -->
        <div class="step-panel active" data-step="1">
          <div class="form-row">
            <div class="form-field-group col-md-6">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" id="nombre" class="form-control" required>
            </div>
            <div class="form-field-group col-md-6">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" id="apellido" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <!-- Grupo de cédula -->
            <div class="form-field-group">
              <label class="form-label">Documento de identidad *</label>
              <div class="input-combo">
                <select class="form-control">
                  <option value="V">V</option>
                  <option value="E">E</option>
                </select>
                <input type="text" class="form-control" required>
              </div>
            </div>

            <!-- Grupo de teléfono -->
            <div class="form-field-group">
              <label class="form-label">Teléfono</label>
              <div class="input-combo">
                <select class="form-control">
                  <option value="0424">0424</option>
                  <option value="0412">0412</option>
                  <option value="0416">0416</option>
                </select>
                <input type="tel" class="form-control">
              </div>
            </div>
          </div>
        </div>

        <!-- Paso 2 -->
        <div class="step-panel" data-step="2">
          <div class="form-field-group">
            <label for="email" class="form-label">Correo electrónico *</label>
            <input type="email" id="email" class="form-control" placeholder="tu@correo.com" required>
          </div>
          <div class="form-row">
            <div class="form-field-group col-md-6">
              <label for="password" class="form-label">Contraseña *</label>
              <input type="password" id="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
            </div>
            <div class="form-field-group col-md-6">
              <label for="confirm_password" class="form-label">Confirmar contraseña *</label>
              <input type="password" id="confirm_password" class="form-control" placeholder="Repite tu contraseña" required>
            </div>
          </div>
        </div>

        <!-- Paso 3 -->
        <div class="step-panel" data-step="3">
          <div class="form-field-group">
            <label for="pregunta" class="form-label">Pregunta de seguridad *</label>
            <select id="pregunta" class="form-control" required>
              <option value="" disabled selected>Selecciona una pregunta</option>
              <option>¿Nombre de tu primera mascota?</option>
              <option>¿Ciudad donde naciste?</option>
              <option>¿Mejor amigo de la infancia?</option>
            </select>
          </div>
          <div class="form-field-group">
            <label for="respuesta" class="form-label">Respuesta *</label>
            <input type="text" id="respuesta" class="form-control" required>
          </div>
        </div>
      </div>

      <!-- Botones de navegación -->
      <div class="form-actions">
        <button type="button" class="form-btn btn-prev" disabled>
          <i class="fas fa-arrow-left"></i> Anterior
        </button>
        <button type="button" class="form-btn btn-next">
          Siguiente <i class="fas fa-arrow-right"></i>
        </button>
        <button type="submit" class="form-btn btn-submit" style="display: none;">
          <i class="fas fa-check-circle"></i> Registrarse
        </button>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
<script src="../assets/js/signup.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Implementa la lógica del stepper aquí
    const steps = document.querySelectorAll('.stepper-step');
    const panels = document.querySelectorAll('.step-panel');
    const prevBtn = document.querySelector('.btn-prev');
    const nextBtn = document.querySelector('.btn-next');
    const submitBtn = document.querySelector('.btn-submit');
    
    let currentStep = 0;

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
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
            showStep(currentStep + 1);
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            showStep(currentStep - 1);
        }
    });

    // Inicializar
    showStep(0);
});
</script>
</body>
</html>