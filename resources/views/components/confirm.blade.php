<div
    x-data="{ open: false }"
    x-show="open"
    @confirm.window="
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: event.detail.confirmButtonText,
            cancelButtonText: event.detail.cancelButtonText
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('liberar');
            }
        });
    "
>
</div>
