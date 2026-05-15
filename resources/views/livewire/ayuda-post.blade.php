<div class="container mx-auto p-8">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Página de Ayuda</h1>
        <p class="text-lg text-gray-600 mt-2">Aquí podrás encontrar los manuales correspondientes que te ayudarán a usar
            todas las funciones de la plataforma.</p>
    </div>

    <div x-data="{ open: false, manual: '' }" class="space-y-8">
        <!-- Sección de los dos manuales -->
        <div class="bg-white shadow-xl rounded-lg p-8 transition-all duration-300 hover:shadow-2xl">
            <h2 class="text-3xl font-semibold text-gray-800">Manual de Usuario</h2>
            <p class="text-gray-700 mt-4">Este manual te ayudará a comenzar a usar la plataforma, desde el registro hasta
                cómo utilizar las funciones principales.</p>
            <p class="text-gray-600 mt-2">Algunos temas cubiertos en el Manual de Usuario incluyen:</p>
            <ul class="list-disc list-inside text-gray-600 mt-2">
                <li>Creación y gestión de cuenta</li>
                <li>Funciones principales de la plataforma</li>
                <li>Consejos para empezar rápidamente</li>
                <li>Solución de problemas comunes</li>
            </ul>
            <div class="mt-6">
                <!-- Botón para abrir el Manual de Usuario -->
                <button @click="manual = 'manual_usuario'; open = true"
                    class="px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300">
                    Ver Manual de Usuario
                </button>
            </div>
        </div>
        @hasanyrole('validador1|validador2|admin')
            <div class="bg-white shadow-xl rounded-lg p-8 transition-all duration-300 hover:shadow-2xl">
                <h2 class="text-3xl font-semibold text-gray-800">Manual Técnico</h2>
                <p class="text-gray-700 mt-4">Este manual está destinado a los usuarios avanzados y administradores que
                    necesitan realizar configuraciones técnicas detalladas.</p>
                <p class="text-gray-600 mt-2">Algunos temas cubiertos en el Manual Técnico incluyen:</p>
                <ul class="list-disc list-inside text-gray-600 mt-2">
                    <li>Configuración avanzada de la plataforma</li>
                    <li>Integraciones y personalización</li>
                    <li>Gestión de permisos y roles</li>
                    <li>Solución de problemas técnicos</li>
                </ul>
                <div class="mt-6">
                    <!-- Botón para abrir el Manual Técnico -->
                    <button @click="manual = 'manual_tecnico'; open = true"
                        class="px-6 py-3 text-white bg-green-600 rounded-lg hover:bg-green-700 transition duration-300">
                        Ver Manual Técnico
                    </button>
                </div>
            </div>
        @endhasanyrole

        <!-- Modal para Visualización en el navegador -->
        <div x-show="open" x-transition.opacity
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg max-w-lg w-full shadow-xl">
                <h3 class="text-xl font-semibold text-gray-800">Ver Manual en el Navegador</h3>
                <p class="text-gray-600 mt-4"
                    x-text="manual === 'manual_usuario' ? 'Haz clic para ver el Manual de Usuario.' : 'Haz clic para ver el Manual Técnico.'">
                </p>
                <div class="mt-6 flex space-x-4">
                    <!-- Enlace para abrir el Manual de Usuario o Técnico en el visor del navegador -->
                    <a :href="manual === 'manual_usuario' ? '{{ asset('pdfs/Manual_de_Usuario.pdf') }}' :
                        '{{ asset('pdfs/Manual_Tecnico.pdf') }}'"
                        target="_blank"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        Ver en el Navegador
                    </a>
                    <button @click="open = false"
                        class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition duration-300">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
