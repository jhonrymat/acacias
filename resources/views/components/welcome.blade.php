@role('user')
    <script>
        // Mostrar el mensaje automáticamente al cargar la página
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                toast: true, // Activa el modo "toast"
                position: 'top-end', // Ubicación en la parte superior derecha
                icon: 'success', // Icono de éxito
                title: '¡Éxito!',
                text: 'Su correo esta verificado correctamente.',
                timer: 4000, // Duración en milisegundos
                timerProgressBar: true, // Barra de progreso para el tiempo
                showConfirmButton: false, // Oculta el botón de confirmación
            });
        });
    </script>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="" /> {{-- las clases aca no me quieren funcionar --}}

        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Bienvenido!
        </h1>

        <p class="mt-6 text-gray-500 leading-relaxed">
            Nos alegra que estén aquí. En esta plataforma, podrán gestionar y obtener sus certificados de residencia de una
            manera rápida, sencilla y sin complicaciones. Nuestro objetivo es hacer el proceso lo más eficiente posible,
            para que puedan dedicar su tiempo a lo que realmente importa.
        </p>
    </div>

    <div
        class="bg-gray-200 bg-opacity-25 border-t-2 border-green-custom grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        <div class="md:border-r-2 max-md:border-b-2 border-green-custom">
            <div class="flex items-center">
                <svg xmlns="/" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>


                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                    <a href="/">Primero que todo</a>
                </h2>
            </div>

            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                El primer paso para obtener su certificado es realizar una solicitud. Diríjanse al encabezado de esta
                página, donde encontrarán el campo 'Solicitud'. Hagan clic allí para iniciar el proceso y llenar la
                información requerida.
            </p>

        </div>

        <div class="max-md:border-b-2 max-md:border-green-custom">
            <div class="flex items-center">
                <svg xmlns="/" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                    <a href="/">Segundo</a>
                </h2>
            </div>

            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                Una vez que hayan completado su solicitud, podrán hacer un seguimiento del estado de todas sus solicitudes.
                Para ello, diríjanse nuevamente al encabezado y seleccionen el campo 'Solicitudes'. Allí verán el progreso y
                los detalles de cada una de sus solicitudes.
            </p>

        </div>


    </div>
@endrole

@role('admin')
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="" /> {{-- Las clases no están funcionando correctamente aquí --}}

        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Bienvenido, Administrador!
        </h1>

        <p class="mt-6 text-gray-500 leading-relaxed">
            Como administrador, tienes el control total de la plataforma. Desde aquí, podrás realizar ajustes generales,
            gestionar roles de usuario, supervisar solicitudes y administrar los certificados de residencia emitidos.
            Asegúrate de revisar todas las configuraciones para garantizar el correcto funcionamiento del sistema.
        </p>
    </div>

    <div class="bg-gray-200 border-t-2 border-green-custom bg-opacity-25 p-6 lg:p-8">
        Explora las opciones en la parte superior de la página para gestionar configuraciones, solicitudes y otros aspectos
        importantes de la plataforma. ¡Gracias por mantener la plataforma en óptimas condiciones!
    </div>
@endrole

@role('validador1')
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="" /> {{-- Las clases no están funcionando correctamente aquí --}}

        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Bienvenido, Validador 1!
        </h1>

        <p class="mt-6 text-gray-500 leading-relaxed">
            Como Validador 1, eres el primer filtro en el proceso de revisión de solicitudes. Tu tarea es revisar y validar
            cuidadosamente cada solicitud para asegurar que cumpla con los requisitos antes de pasar a la siguiente etapa.
            Gracias por tu atención y dedicación en este paso tan importante del proceso.
        </p>
    </div>

    <div class="bg-gray-200 border-t-2 border-green-custom bg-opacity-25 p-6 lg:p-8">
        Utiliza las opciones de la parte superior de la página para revisar y validar las solicitudes que han llegado a tu
        bandeja. ¡Gracias por tu valiosa contribución!
    </div>
@endrole

@role('validador2')
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="" /> {{-- Las clases no están funcionando correctamente aquí --}}

        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Bienvenido, Validador 2!
        </h1>

        <p class="mt-6 text-gray-500 leading-relaxed">
            Como Validador 2, tienes la tarea crítica de revisar el trabajo del Validador 1 para asegurar que no haya
            errores. Una vez que apruebes una solicitud, procederemos a generar el certificado de residencia
            correspondiente. Gracias por tu rigor y precisión en este proceso de doble verificación.
        </p>
    </div>

    <div class="bg-gray-200 border-t-2 border-green-custom bg-opacity-25 p-6 lg:p-8">
        Revisa las opciones de la parte superior de la página para realizar la revisión final y dar tu aprobación a las
        solicitudes. ¡Gracias por asegurar la calidad y precisión en cada certificado emitido!
    </div>
@endrole
