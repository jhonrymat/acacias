<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estamos en mantenimiento') }}
        </h2>
    </x-slot>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-xl sm:rounded-lg p-8 text-center w-full max-w-3xl">
            <x-application-logo class="mx-auto mb-4" /> {{-- Centra el logo --}}

            <h1 class="text-3xl font-bold text-yellow-500 flex items-center justify-center gap-2">
                🚧 Mantenimiento en progreso 🚧
            </h1>
            <p class="mt-4 text-gray-700 text-lg">
                Estamos trabajando para mejorar nuestro servicio. Regresaremos pronto. 🙌
            </p>
            <p class="mt-2 text-gray-500">¡Volveremos en breve! Tiempo estimado para la reactivación:</p>

            {{-- Contador regresivo --}}
            <div id="countdown" class="text-2xl font-semibold text-blue-600 mt-4"></div>

            <script>
                function startCountdown(durationInMinutes) {
                    let countdownElement = document.getElementById("countdown");
                    let endTime = new Date().getTime() + durationInMinutes * 60 * 1000;

                    function updateCountdown() {
                        let now = new Date().getTime();
                        let timeLeft = endTime - now;

                        if (timeLeft <= 0) {
                            countdownElement.innerHTML = "¡Estamos de vuelta! 🚀";
                            return;
                        }

                        let hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
                        let minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
                        let seconds = Math.floor((timeLeft / 1000) % 60);

                        countdownElement.innerHTML = `${hours}h ${minutes}m ${seconds}s`;

                        setTimeout(updateCountdown, 1000);
                    }

                    updateCountdown();
                }

                // Inicia el contador en 2 horas (120 minutos)
                startCountdown(120);
            </script>

            <p class="mt-4 text-gray-500">Gracias por tu paciencia y comprensión. 💙</p>
        </div>
    </div>
</x-guest-layout>
