<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<main class="container-fluid">
  <div class="background-overlay"></div>

  <div class="row home-content justify-content-center align-items-start position-relative z-1">

    <!-- Carrusel de Libros -->
    <div class="col-lg-8 d-flex flex-column p-3 bg-white text-dark border rounded-3 mb-4 content-section">
      
      <div class="carousel-header d-none d-lg-flex">
        <h3 id="books-section-title" class="mb-1 border-bottom pb-1 flex-grow-1">
          <i class="fas fa-fire text-warning me-2"></i><span class="carousel-title-text">Libros populares</span>
        </h3>

        <button class="carousel-control-prev" type="button" data-bs-target="#booksCarousel" data-bs-slide="prev" aria-label="Anterior">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#booksCarousel" data-bs-slide="next" aria-label="Siguiente">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
      </div>

      <div class="carousel-header d-flex d-lg-none align-items-center mb-1 border-bottom pb-1">
        <h3 id="books-section-title-mobile" class="mb-1 flex-grow-1">
          <i class="fas fa-fire text-warning me-2"></i><span class="carousel-title-text">Libros populares</span>
        </h3>
        <div class="carousel-controls-mobile">
          <button type="button" id="prevBtnMobile" aria-label="Anterior">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button type="button" id="nextBtnMobile" aria-label="Siguiente">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>

      <div id="booksCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
        <div class="carousel-inner">

          <!-- Slide 1 -->
          <div class="carousel-item active" data-title="Libros populares">
            <div class="row justify-content-center g-2">
              <!-- Libro 1 -->
              <div class="col-md-3 custom-card-width">
                <div class="card bg-white text-dark border h-100">
                  <img src="/assets/img/books/libro1.jpg" class="card-img-top" alt="Portada del libro">
                  <div class="card-body p-2">
                    <h5 class="card-title fs-6">Cien años de soledad</h5>
                    <p class="card-text small">Gabriel García Márquez</p>
                    <span class="badge bg-success">Disponible</span>
                  </div>
                </div>
              </div>
              <!-- Libro 2 -->
              <div class="col-md-3 custom-card-width">
                <div class="card bg-white text-dark border h-100">
                  <img src="/assets/img/books/libro2.jpg" class="card-img-top" alt="Portada del libro">
                  <div class="card-body p-2">
                    <h5 class="card-title fs-6">El Principito</h5>
                    <p class="card-text small">Antoine de Saint-Exupéry</p>
                    <span class="badge bg-warning">Último ejemplar</span>
                  </div>
                </div>
              </div>
              <!-- Libro 3 -->
              <div class="col-md-3 custom-card-width">
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

          <!-- Slide 2 -->
          <div class="carousel-item" data-title="Libros nuevos">
            <div class="row justify-content-center g-2">
              <!-- Libro 1 -->
              <div class="col-md-3 custom-card-width">
                <div class="card bg-white text-dark border h-100">
                  <img src="/assets/img/books/libro7.jpg" class="card-img-top" alt="Portada del libro">
                  <div class="card-body p-2">
                    <h5 class="card-title fs-6">Libro Nuevo 1</h5>
                    <p class="card-text small">Autor Z</p>
                    <span class="badge bg-success">Disponible</span>
                  </div>
                </div>
              </div>
              <!-- Libro 2 -->
              <div class="col-md-3 custom-card-width">
                <div class="card bg-white text-dark border h-100">
                  <img src="/assets/img/books/libro5.jpg" class="card-img-top" alt="Portada del libro">
                  <div class="card-body p-2">
                    <h5 class="card-title fs-6">José Rodríguez "El Puma"</h5>
                    <p class="card-text small">José Rodríguez</p>
                    <span class="badge bg-success">Disponible</span>
                  </div>
                </div>
              </div>
              <!-- Libro 3 -->
              <div class="col-md-3 custom-card-width">
                <div class="card bg-white text-dark border h-100">
                  <img src="/assets/img/books/libro6.jpg" class="card-img-top" alt="Portada del libro">
                  <div class="card-body p-2">
                    <h5 class="card-title fs-6">Libro Nuevo 3</h5>
                    <p class="card-text small">Autor Z</p>
                    <span class="badge bg-warning">Último ejemplar</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Cronograma -->
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
    </div>

  </div>
</main>

<script src="../assets/js/home.js"></script>
<?php include __DIR__ . '/partials/footer.php'; ?>