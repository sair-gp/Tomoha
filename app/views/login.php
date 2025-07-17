<?php include __DIR__ . '/partials/head.php'; ?>
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
        <button type="submit" class="btn btn-primary">Ingresar</button>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>