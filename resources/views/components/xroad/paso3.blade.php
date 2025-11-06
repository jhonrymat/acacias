{{-- Paso 3: Contenido condicional según autenticación --}}
<div>
    @include('components.xroad.logout')
    @guest
        {{ redirect()->route('certificado.auth.login') }}
    @endguest

    @auth
        @php
            $userId = auth()->id();
            $solicitudBloqueante = \App\Models\Solicitud::where('user_id', $userId)
                ->whereIn('estado_id', [1, 2, 4]) // Pendiente, En Revisión, Aprobada
                ->latest()
                ->first();
        @endphp
        <script>
            var solicitudBloqueante = @json($solicitudBloqueante);
            console.log('Solicitud Bloqueante:', solicitudBloqueante);
        </script>
        <div class="container my-4">
            @if ($solicitudBloqueante)
                {{-- Caso 1: Tiene solicitud en proceso (1, 2, 4) - Alerta Negativa --}}
                <div class="container-alerta-govco mb-4">
                    <div class="alert alerta-govco alerta-error-govco aerror" role="alert">
                        <span class="alerta-icon-govco alerta-icon-error-govco aerror"></span>
                        <p class="alerta-content-text">
                            <strong>Ya tienes una solicitud en proceso.</strong><br>
                            Actualmente tienes una solicitud activa (N° #{{ $solicitudBloqueante->id }})
                            en estado: <strong>{{ $solicitudBloqueante->estado->nombre ?? 'Pendiente' }}</strong>,
                            creada el {{ $solicitudBloqueante->created_at->format('d/m/Y') }}.
                            No puedes crear una nueva hasta que esta sea resuelta.
                            <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;"
                                onclick="pasosPermitidos = [1,2,4]; irAlPaso(4);">Ver solicitudes</button>
                        </p>
                    </div>
                </div>
            @endif

            <div class="contents-example-linea-avance-govco">
                <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;"
                    onclick="pasosPermitidos = [1,2,3,4]; irAlPaso(4);">Continuar</button>
            </div>
        </div>
    @endauth
</div>
