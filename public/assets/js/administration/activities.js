let table;

$(document).ready(function() {
    table = $('#Table').DataTable({
        paging: true,
        searching: true,
        lengthChange: false,
        info: true,
        ordering: true,
        pageLength: 5,
        columnDefs: [
            { orderable: false, targets: 7 }
        ],
        dom: 't',
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
    });

    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    $('#statusFilter').on('change', function() {
        const statusId = this.value;
        
        if (statusId === '') {
            table.columns(6).search('').draw();
        } else {
            const statusText = getStatusText(statusId);
            table.columns(6).search(statusText).draw();
        }
    });

    $('#addBtn').on('click', function(e) {
        e.preventDefault();
        openModal();
    });

    loadData();
});

function openModal() {
    Swal.fire({
        title: 'Agregar nueva actividad',
        html: `
            <form id="addActivityForm">
                <div class="swal2-row">
                    <div class="swal2-col">
                        <div class="form-field-group">
                            <label for="description" class="form-label">Descripción:</label>
                            <input type="text" id="description" class="form-control" placeholder="Título de la actividad">
                        </div>
                    </div>
                    <div class="swal2-col">
                        <div class="form-field-group">
                            <label for="organizer" class="form-label">Encargado:</label>
                            <input type="text" id="organizer" class="form-control" placeholder="Nombre del encargado">
                        </div>
                    </div>
                </div>
                
                <div class="swal2-row">
                    <div class="swal2-col">
                        <div class="form-field-group">
                            <label for="start_date" class="form-label">Fecha de inicio:</label>
                            <input type="date" id="start_date" class="form-control">
                        </div>
                    </div>
                    <div class="swal2-col">
                        <div class="form-field-group">
                            <label for="end_date" class="form-label">Fecha de finalización:</label>
                            <input type="date" id="end_date" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="swal2-row">
                    <div class="swal2-col">
                        <div class="form-field-group">
                            <label for="start_time" class="form-label">Hora de inicio:</label>
                            <input type="time" id="start_time" class="form-control">
                        </div>
                    </div>
                    <div class="swal2-col">
                        <div class="form-field-group">
                            <label for="end_time" class="form-label">Hora de finalización:</label>
                            <input type="time" id="end_time" class="form-control">
                        </div>
                    </div>
                </div>
            </form>
        `,
        width: '750px', // Un poco más ancho para los mensajes
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3498db',
        cancelButtonColor: '#6c757d',
        backdrop: true,
        didOpen: () => {
            resetAllErrors();
        },
        preConfirm: () => {
            resetAllErrors();
            
            const validation = validateActivityForm();
            if (!validation.valid) {
                validation.errors.forEach(error => {
                    showFieldError(error.input, error.message);
                });
                
                if (validation.errors.length > 0) {
                    validation.errors[0].input.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                    validation.errors[0].input.focus();
                }
                
                return false;
            }

            return validation.data;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            saveActivity(result.value);
        }
    });
}

function validateActivityForm() {
    const description = document.getElementById('description');
    const organizer = document.getElementById('organizer');
    const start_date = document.getElementById('start_date');
    const end_date = document.getElementById('end_date');
    const start_time = document.getElementById('start_time');
    const end_time = document.getElementById('end_time');

    const errors = [];

    // Validar campos requeridos
    if (!description.value.trim()) {
        errors.push({
            input: description,
            message: 'Descripción requerida'
        });
    }

    if (!organizer.value.trim()) {
        errors.push({
            input: organizer,
            message: 'Encargado requerido'
        });
    }

    if (!start_date.value) {
        errors.push({
            input: start_date,
            message: 'Fecha inicio requerida'
        });
    }

    if (!end_date.value) {
        errors.push({
            input: end_date,
            message: 'Fecha fin requerida'
        });
    }

    if (!start_time.value) {
        errors.push({
            input: start_time,
            message: 'Hora inicio requerida'
        });
    }

    if (!end_time.value) {
        errors.push({
            input: end_time,
            message: 'Hora fin requerida'
        });
    }

    // Validar fechas
    if (start_date.value && end_date.value) {
        const startDate = new Date(start_date.value);
        const endDate = new Date(end_date.value);
        
        if (startDate > endDate) {
            errors.push({
                input: start_date,
                message: 'La fecha de inicio debe ser menor que la fecha de finalización'
            });
        }
    }

    // Validar horas - SIEMPRE, sin importar las fechas
    if (start_time.value && end_time.value) {
        // Convertir horas a minutos para comparación correcta
        const startMinutes = formatTimeToMinutes(start_time.value);
        const endMinutes = formatTimeToMinutes(end_time.value);
        
        if (startMinutes >= endMinutes) {
            errors.push({
                input: start_time,
                message: 'La hora de inicio debe ser menor que la hora de finalización'
            });
        } else {
            // Validar duración mínima de 15 minutos
            const duration = endMinutes - startMinutes;
            if (duration < 15) {
                errors.push({
                    input: end_time,
                    message: 'La actividad debe tener una duración mínima de 15 minutos'
                });
            }
        }
    }

    if (errors.length > 0) {
        return {
            valid: false,
            errors: errors
        };
    }

    return {
        valid: true,
        data: {
            description: description.value.trim(),
            organizer: organizer.value.trim(),
            start_date: start_date.value,
            end_date: end_date.value,
            start_time: start_time.value,
            end_time: end_time.value
        }
    };
}

function showFieldError(input, message) {
    hideFieldError(input);
    
    input.classList.add('is-invalid');
    
    const errorElement = document.createElement('div');
    errorElement.className = 'invalid-feedback';
    errorElement.textContent = message;
    
    input.parentNode.appendChild(errorElement);
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

async function saveActivity(activityData) {
    try {
        const response = await fetch('api/activities', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(activityData)
        });

        if (!response.ok) throw new Error('Error al guardar la actividad');

        const result = await response.json();
        
        if (result.status === "success") {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Actividad agregada correctamente',
                icon: 'success',
                confirmButtonColor: '#3498db'
            });
            
            loadData();
        } else {
            throw new Error(result.message || 'Error al guardar');
        }

    } catch (error) {
        console.error('Error guardando actividad:', error);
        Swal.fire({
            title: 'Error',
            text: 'No se pudo guardar la actividad. Intenta de nuevo.',
            icon: 'error',
            confirmButtonColor: '#dc3545'
        });
    }
}

function getStatusText(statusId) {
    const statusMap = {
        1: 'En curso',
        2: 'Finalizada',
        3: 'Cancelada', 
        4: 'Reprogramada',
        5: 'No iniciada'
    };
    return statusMap[statusId] || '—';
}

async function loadData() {
    try {
        const response = await fetch('api/activities');
        if (!response.ok) throw new Error('Error al obtener las actividades');

        const result = await response.json();
        if (result.status !== "success") throw new Error('Respuesta inválida del servidor');

        const activities = result.data || [];

        table.clear();

        activities.forEach(activity => {
            table.row.add([
                activity.description || '—',
                activity.organizer || '—',
                formatDate(activity.start_date) || '—',
                formatDate(activity.end_date) || '—',
                formatTime(activity.start_time) || '—',
                formatTime(activity.end_time) || '—',
                activity.status_text || '—',
                activity.actions || '—'
            ]);
        });

        table.draw();
    } catch (error) {
        console.error('Error cargando actividades:', error);
        alert('No se pudieron cargar las actividades. Intenta de nuevo.');
    }
}