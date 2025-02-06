<div x-data="{ open: false }" x-show="open"
    @2alert.window="
        Swal.fire({
            title: event.detail.title || '¿Estás seguro?',
            text: event.detail.text || 'Vas a rechazar esta solicitudEsta acción no se puede deshacer.',
            icon: event.detail.icon || 'warning',
            showCancelButton: true,
            confirmButtonColor: event.detail.confirmButtonColor || '#3085d6',
            cancelButtonColor: event.detail.cancelButtonColor || '#d33',
            confirmButtonText: event.detail.confirmButtonText || 'Sí, continuar',
            cancelButtonText: event.detail.cancelButtonText || 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '¿Seguro que deseas continuar con rechazar la solicitud?',
                    text: 'Una vez confirmada, no podrás modificar esta acción.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, confirmar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('modalRechazar'); // Ejecuta la acción final
                    }
                });
            }
        });
    ">
</div>
