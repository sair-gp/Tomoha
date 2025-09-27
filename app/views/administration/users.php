<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/css/sidebar.css">
    <link rel="stylesheet" href="/assets/css/administration/users.css">
</head>
<body>
    <aside class="sidebar">
        <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    </aside>

    <!-- Contenido principal -->
    <div class="main-container">
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-list"></i> Lista de Usuarios</h2>
                <button class="btn btn-primary" id="addUserBtn">
                    <i class="fas fa-plus"></i> Registrar Usuario
                </button>
            </div>
            <div class="card-body">
                <div class="filters">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Buscar usuarios...">
                    </div>
                    <select class="filter-select" id="roleFilter">
                        <option value="">Todos los roles</option>
                        <option value="admin">Administrador</option>
                        <option value="librarian">Bibliotecario</option>
                        <option value="assistant">Asistente</option>
                        <option value="visitor">Visitante</option>
                    </select>
                    <select class="filter-select" id="statusFilter">
                        <option value="">Todos los estados</option>
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                        <option value="pending">Pendiente</option>
                    </select>
                </div>

                <table id="usersTable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre y apellido</th>
                            <th>Correo electrónico</th>
                            <th>Rol</th>
                            <th>Fecha de registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filas con JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/js/administration/users.js"></script>
</body>
</html>