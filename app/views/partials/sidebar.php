<aside class="sidebar d-none d-md-flex flex-column">
  <div class="menu">

      <div class="menu-items show">
        <a href="/panel" class="menu-item active"><i class="fas fa-home me-2"></i> Panel</a>
      </div>

    <div class="menu-section">
      <div class="menu-title toggle">Catalogación <i class="fas fa-chevron-down ms-auto"></i></div>
      <div class="menu-items">
        <a href="/libros" class="menu-item"><i class="fas fa-book me-2"></i> Libros</a>
        <a href="/autores" class="menu-item"><i class="fas fa-user-edit me-2"></i> Autores</a>
        <a href="/estanterias" class="menu-item"><i class="fas fa-layer-group me-2"></i> Estanterías</a>
        <a href="/editoriales" class="menu-item"><i class="fas fa-building me-2"></i> Editoriales</a>
        <a href="/categorias" class="menu-item"><i class="fas fa-tags me-2"></i> Categorías</a>
      </div>
    </div>

    <div class="menu-section">
      <div class="menu-title toggle">Préstamos <i class="fas fa-chevron-down ms-auto"></i></div>
      <div class="menu-items">
        <a href="/prestamos" class="menu-item"><i class="fas fa-handshake me-2"></i> Gestión de Préstamos</a>
      </div>
    </div>

    <div class="menu-section">
      <div class="menu-title toggle">Administración <i class="fas fa-chevron-down ms-auto"></i></div>
      <div class="menu-items">
        <a href="/visitantes" class="menu-item"><i class="fas fa-users me-2"></i> Visitantes</a>
        <a href="/actividades" class="menu-item"><i class="fas fa-calendar-alt me-2"></i> Actividades</a>
        <a href="/reportes" class="menu-item"><i class="fas fa-chart-bar me-2"></i> Reportes</a>
        <a href="/usuarios" class="menu-item"><i class="fas fa-user-cog me-2"></i> Usuarios</a>
        <a href="/historial" class="menu-item"><i class="fas fa-history me-2"></i> Historial</a>
      </div>
    </div>

  </div>

  <div class="profile" id="profileMenu">
    <img src="/assets/img/profile.jpg" alt="Usuario">
    <div class="profile-info">
      <div class="name" id="name"></div>
      <div class="role">Administrador</div>
    </div>
    <div class="profile-options ms-auto" style="cursor:pointer;">
      <i class="fas fa-ellipsis-v"></i>
    </div>
    <div class="profile-dropdown">
      <a href="/configuracion"><i class="fas fa-cog me-2"></i> Configuración</a>
      <a href="/logout"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a>
    </div>
  </div>
</aside>

<script>
  // Toggle menú secciones
  document.querySelectorAll(".menu-title.toggle").forEach(title => {
    title.addEventListener("click", () => {
      const section = title.nextElementSibling;
      section.classList.toggle("show");
      title.querySelector("i").classList.toggle("rotate");
    });
  });

  // Perfil dropdown
  const profileMenu = document.getElementById("profileMenu");
  const options = profileMenu.querySelector(".profile-options");
  options.addEventListener("click", () => {
    profileMenu.classList.toggle("show-dropdown");
  });
  document.addEventListener("click", (e) => {
    if (!profileMenu.contains(e.target)) {
      profileMenu.classList.remove("show-dropdown");
    }
  });

  async function getSessionData() {
    try {
        const response = await fetch("/data");
        const data = await response.json();

        profileName = document.getElementById("name");
        profileName.textContent = `${data.first_name} ${data.last_name}`;
    } catch (error) {
        console.error("Error al consultar sesión:", error);
    }
}

  getSessionData();

</script>