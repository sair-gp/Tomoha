let table;
$(document).ready(function() {
    table = $('#Table').DataTable({
        paging: true,
        searching: false,
        lengthChange: false,
        info: true,
        ordering: true,
        pageLength: 5,
        columnDefs: [
            { orderable: false, targets: 8 }
        ],
        dom: 't',
        language: {
            emptyTable: "No hay datos disponibles."
        }
    });
    loadData();
});

function getTypeBadge(type) {
    switch (type) {
        case 'interna': return 'badge-primary';
        case 'externa': return 'badge-warning';
        default: return 'badge-secondary';
    }
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
                activity.notes || '—',
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