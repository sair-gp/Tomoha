<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGB - </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.4/sweetalert2.css">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="stylesheet" href="/assets/css/recovery.css">
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<div class="background-overlay"></div>
<div class="login-page">
  <div class="login-left"></div>

  <div class="login-right">
    <div class="login-box">
      <img src="assets/img/header_login.png" alt="Logo">
      <form autocomplete="off">
        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <a id="password-recovery">¿Olvidó su contraseña?</a>
        <button type="submit" class="btn btn-primary" id="button">Ingresar</button>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
<script src="../assets/js/login.js"></script>
<script src="../assets/js/recovery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.4/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>