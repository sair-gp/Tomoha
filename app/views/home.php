<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<main class="container-fluid">
  <div class="background-overlay"></div>

  <div class="row home-content justify-content-center align-items-start position-relative z-1">
    <div class="col-lg-8 d-flex flex-column p-3 bg-white text-dark border rounded-3 mb-4 content-section">
      <h2 class="mb-1 border-bottom pb-1">
        <i class="fas fa-fire text-warning me-2"></i>Libros Populares
      </h2>
      <div class="row g-1">
        <div class="col-md-4">
          <div class="card bg-white text-dark border h-100">
            <img src="/assets/img/books/libro1.jpg" class="card-img-top" alt="Portada del libro">
            <div class="card-body p-2">
              <h5 class="card-title fs-6">Cien años de soledad</h5>
              <p class="card-text small">Gabriel García Márquez</p>
              <span class="badge bg-success">Disponible</span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-white text-dark border h-100">
            <img src="/assets/img/books/libro2.jpg" class="card-img-top" alt="Portada del libro">
            <div class="card-body p-2">
              <h5 class="card-title fs-6">El Principito</h5>
              <p class="card-text small">Antoine de Saint-Exupéry</p>
              <span class="badge bg-warning">Último ejemplar</span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-white text-dark border h-100">
            <img src="/assets/img/books/libro3.jpg" class="card-img-top" alt="Portada del libro">
            <div class="card-body p-2">
              <h5 class="card-title fs-6">1984</h5>
              <p class="card-text small">George Orwell</p>
              <span class="badge bg-danger">Agotado</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 d-flex flex-column p-3 bg-white text-dark border rounded-3 mb-4 content-section">
      <h3 class="mb-1 border-bottom pb-1">
        <i class="fas fa-calendar-alt text-info me-2"></i>Próximas actividades
      </h3>
      <div class="d-flex flex-column gap-2">
        <div class="activity-card p-2">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-semibold small">Club de lectura</span>
            <small>15 Jul</small>
          </div>
          <p class="mb-1 small text-muted">"Cien años de soledad"</p>
          <small class="text-muted d-block">06:00 P.M - Biblioteca Central</small>
        </div>
        <div class="activity-card p-2">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-semibold small">Taller de escritura</span>
            <small>20 Jul</small>
          </div>
          <p class="mb-1 small text-muted">Narrativa moderna</p>
          <small class="text-muted d-block">04:00 P.M - Sala Conferencias</small>
        </div>
        <div class="activity-card p-2">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-semibold small">Presentación de libro</span>
            <small>25 Jul</small>
          </div>
          <p class="mb-1 small text-muted">Autor local</p>
          <small class="text-muted d-block">07:00 P.M - Auditorio Principal</small>
        </div>
        <div class="activity-card p-2">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-semibold small">Presentación de libro</span>
            <small>25 Jul</small>
          </div>
          <p class="mb-1 small text-muted">Autor local</p>
          <small class="text-muted d-block">07:00 P.M - Auditorio Principal</small>
        </div>
      </div>
      <div class="mt-2 text-center">
        <a href="/actividades" class="btn btn-outline-dark btn-sm">Ver todas las actividades</a>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>