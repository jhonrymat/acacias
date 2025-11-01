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

    <h1 class="text-3xl font-bold text-gray-900">Certificado de Residencia</h1>
    <p class="mt-4 text-gray-700 leading-relaxed max-w-3xl mx-auto">
        Nos alegra darte la bienvenida 👋. Hemos renovado esta plataforma para que puedas realizar tus trámites de forma más rápida y sencilla.
    </p>
    <p class="mt-2 text-gray-700 leading-relaxed max-w-3xl mx-auto">
        Ahora, el trámite para solicitar tu <strong>Certificado de Residencia</strong> se realiza desde un nuevo espacio diseñado especialmente para ti.
    </p>

    <div class="mt-6">
        <a href="{{ url('/certificado-residencia') }}"
           class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full shadow-md transition">
           🏠 Ir al nuevo formulario
        </a>
    </div>

    <p class="mt-3 text-sm text-gray-500 max-w-3xl mx-auto">
        Allí podrás registrar tu solicitud, hacer seguimiento y descargar tu certificado una vez esté listo.
    </p>
</div>

<div class="max-w-5xl mx-auto py-10 px-6">
    <div class="bg-gray-50 rounded-2xl shadow-sm p-8 md:p-10 border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
            🧭 ¿Qué encontrarás en el nuevo formulario?
        </h2>

        <div class="space-y-5 text-gray-700 leading-relaxed">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 text-green-600 text-2xl">✅</div>
                <p><strong>Pasos guiados:</strong> el sistema te acompaña durante todo el proceso para que no te pierdas en ningún paso.</p>
            </div>

            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 text-green-600 text-2xl">📄</div>
                <p><strong>Formulario sencillo:</strong> solo deberás ingresar tus datos personales y de residencia. Nada más.</p>
            </div>

            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 text-green-600 text-2xl">🔍</div>
                <p><strong>Consulta en línea:</strong> podrás verificar el estado de tu solicitud sin necesidad de desplazarte.</p>
            </div>

            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 text-green-600 text-2xl">📬</div>
                <p><strong>Descarga rápida:</strong> al finalizar el trámite, podrás descargar tu certificado directamente desde la plataforma.</p>
            </div>
        </div>
    </div>
</div>

<footer class="bg-gray-50 border-t border-green-200 mt-12 py-6 text-center text-gray-600 text-sm">
    <p>💡 Recuerda: si necesitas tu certificado, haz clic en el botón <strong>“Ir al nuevo formulario”</strong> para iniciar tu trámite.</p>
    <p class="mt-2">Este servicio es completamente en línea, fácil y seguro 🛡️</p>
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
