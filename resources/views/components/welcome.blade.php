<livewire:notification-banner position="welcome" />
@role('user')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '¡Éxito!',
                text: 'Tu correo fue verificado correctamente.',
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        });
    </script>

    <div class="p-6 lg:p-10 bg-white border-b border-gray-200 text-center">
        <x-application-logo class="mx-auto mb-6" />

        <h1 class="text-3xl font-bold text-gray-900">Bienvenido a la Plataforma de Trámites</h1>
        <p class="mt-4 text-gray-700 leading-relaxed max-w-3xl mx-auto">
            Nos alegra darte la bienvenida 👋. Desde aquí puedes gestionar tus trámites de forma rápida, sencilla y segura.
        </p>
    </div>

    {{-- Sección de trámites disponibles --}}
    <div class="max-w-5xl mx-auto py-10 px-6 grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Tarjeta: Certificado de Residencia --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col justify-between">
            <div>
                <div class="text-4xl mb-3">🏠</div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Certificado de Residencia</h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Solicita tu certificado de residencia desde el nuevo formulario en línea. Podrás hacer seguimiento
                    de tu solicitud y descargar el certificado una vez esté listo.
                </p>

                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2"><span class="text-green-600">✅</span> Pasos guiados durante todo el
                        proceso</li>
                    <li class="flex items-start gap-2"><span class="text-green-600">📄</span> Solo tus datos personales y de
                        residencia</li>
                    <li class="flex items-start gap-2"><span class="text-green-600">🔍</span> Consulta el estado de tu
                        solicitud en línea</li>
                    <li class="flex items-start gap-2"><span class="text-green-600">📬</span> Descarga rápida al finalizar
                        el trámite</li>
                </ul>
            </div>

            <div class="mt-6">
                <a href="{{ url('/certificado-residencia') }}"
                    class="inline-block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full shadow-md transition">
                    Ir al formulario de Residencia
                </a>
            </div>
        </div>

        {{-- Tarjeta: Certificado de Avecindamiento --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col justify-between">
            <div>
                <div class="text-4xl mb-3">📋</div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Certificado de Avecindamiento</h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    El trámite de <strong>Certificado de Avecindamiento</strong> continúa realizándose desde esta
                    plataforma.
                    Ingresa al formulario para registrar tu solicitud y gestionar todo el proceso aquí mismo.
                </p>

                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2"><span class="text-blue-500">✅</span> Trámite disponible en esta
                        plataforma</li>
                    <li class="flex items-start gap-2"><span class="text-blue-500">📝</span> Completa el formulario con tus
                        datos</li>
                    <li class="flex items-start gap-2"><span class="text-blue-500">🔍</span> Seguimiento de tu solicitud en
                        línea</li>
                    <li class="flex items-start gap-2"><span class="text-blue-500">📬</span> Descarga tu certificado al
                        finalizar</li>
                </ul>
            </div>

            <div class="mt-6">
                <a href="{{ route('formulario-avecindamiento') }}"
                    class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full shadow-md transition">
                    Ir al formulario de Avecindamiento
                </a>
            </div>
        </div>

    </div>

    <footer class="bg-gray-50 border-t border-green-200 mt-6 py-6 text-center text-gray-600 text-sm">
        <p>💡 Selecciona el trámite que necesitas y sigue los pasos indicados.</p>
        <p class="mt-2">Todos nuestros servicios son completamente en línea, fáciles y seguros 🛡️</p>
    </footer>
@endrole


@role('admin')
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="" /> {{-- Las clases no están funcionando correctamente aquí --}}

        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Bienvenido, Administrador!
        </h1>

        <p class="mt-6 text-gray-500 leading-relaxed">
            Como administrador, tienes el control total de la plataforma. Desde aquí, podrás realizar ajustes generales,
            gestionar roles de usuario, supervisar solicitudes y administrar los certificados emitidos.
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
