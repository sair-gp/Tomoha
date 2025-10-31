<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de actividades</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.4/sweetalert2.css">
    <link rel="stylesheet" href="/assets/css/sidebar.css">
    <link rel="stylesheet" href="/assets/css/administration/activities.css">
</head>
<body>
    <aside class="sidebar">
        <?php include __DIR__ . '/../partials/sidebar.php'; ?>
    </aside>

    <!-- Contenido principal -->
    <div class="main-container">
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-list"></i> Lista de actividades</h2>
                <button class="btn btn-primary" id="addBtn">
                    <i class="fas fa-plus"></i> Nueva actividad
                </button>
            </div>
            <div class="card-body">
                <div class="filters">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Buscar actividades...">
                    </div>
                    <select class="filter-select" id="statusFilter">
                        <option value="">Todos los estados</option>
                        <option value="1">En curso</option>
                        <option value="2">Finalizada</option>
                        <option value="3">Cancelada</option>
                        <option value="4">Reprogramada</option>
                        <option value="5">No iniciada</option>
                    </select>
                </div>

                <table id="Table" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th class="table-tooltip" data-tooltip="Descripción">Descripción</th>
                            <th title="Encargado">Encargado</th>
                            <th title="Fecha de inicio">F. Inicio</th>
                            <th title="Fecha de finalización">F. Fin</th>
                            <th title="Hora de inicio">H. Inicio</th>
                            <th title="Hora de finalización">H. Fin</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.4/sweetalert2.min.js"></script>
    <script src="../assets/js/formatUtils.js"></script>
    <script src="../assets/js/administration/activities.js"></script>
</body>
</html>