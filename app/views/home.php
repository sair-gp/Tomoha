<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGB - </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>
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
          <button type="button" id="prevBtnMobile" aria-label="Anterior" data-bs-target="#booksCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button type="button" id="nextBtnMobile" aria-label="Siguiente" data-bs-target="#booksCarousel" data-bs-slide="next">
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
                  <img src="/assets/img/books/libro6.jpg" class="card-img-top" alt="Portada del libro">
                  <div class="card-body p-2">
                    <h5 class="card-title fs-6">Harry Potter</h5>
                    <p class="card-text small">J. K. Rowling</p>
                    <span class="badge bg-success">Disponible</span>
                  </div>
                </div>
              </div>
              <!-- Libro 2 -->
              <div class="col-md-3 custom-card-width">
                <div class="card bg-white text-dark border h-100">
                  <img src="/assets/img/books/libro5.jpg" class="card-img-top" alt="Portada del libro">
                  <div class="card-body p-2">
                    <h5 class="card-title fs-6">El Puma</h5>
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
                    <h5 class="card-title fs-6">Harry Potter</h5>
                    <p class="card-text small">J. K. Rowling</p>
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


<?php include __DIR__ . '/partials/footer.php'; ?>
<script src="../assets/js/home.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>