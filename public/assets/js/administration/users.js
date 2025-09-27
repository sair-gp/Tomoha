$(document).ready(function() {
    $('#usersTable').DataTable({
        paging: true,
        searching: false,
        lengthChange: false,
        info: true,
        ordering: true,
        pageLength: 5,
        columnDefs: [
            { orderable: false, targets: 5 }
        ],
        dom: 't',
        language: {
            emptyTable: "No hay datos disponibles."
        }
    });
});


async function loadUsers() {
    try {
        const response = await fetch('api/users');
        if (!response.ok) throw new Error('Error al obtener los usuarios');

        const users = await response.json();

        // Limpiar tabla antes de agregar
        table.clear();

        // Recorrer usuarios y agregarlos a la tabla
        users.forEach(user => {
            table.row.add([
                `<div class="user-info">
                    <img src="${user.avatar || '/assets/img/default-avatar.png'}" class="user-avatar">
                    <div>
                        <div class="user-name">${user.name}</div>
                        <div class="user-details">${user.email}</div>
                    </div>
                </div>`,
                user.cedula,
                `<span class="badge ${getRoleBadge(user.role)}">${capitalize(user.role)}</span>`,
                `<span class="badge ${getTypeBadge(user.type)}">${capitalize(user.type)}</span>`,
                user.address,
                user.phone,
                user.gender,
                user.age,
                `<span class="badge ${getStatusBadge(user.status)}">${capitalize(user.status)}</span>`,
                getActionButtons(user)
            ]);
        });

        table.draw();
    } catch (error) {
        console.error('Error cargando usuarios:', error);
        alert('No se pudieron cargar los usuarios. Intenta de nuevo.');
    }
}