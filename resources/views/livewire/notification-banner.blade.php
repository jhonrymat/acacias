{{-- resources/views/livewire/notification-banner.blade.php --}}
<div>
    @php
        $colorMap = [
            'red'     => 'danger',
            'green'   => 'success',
            'blue'    => 'primary',
            'yellow'  => 'warning',
            'orange'  => 'warning',
            'purple'  => 'info',
            'gray'    => 'secondary',
            'black'   => 'dark',
            'white'   => 'light',
        ];

        $bootstrapColor = $colorMap[strtolower($notification?->color ?? '')] ?? 'primary';
    @endphp

    @if ($notification && $isVisible)
        <div
            class="alert alert-{{ $bootstrapColor }} alert-dismissible fade show mb-0 position-relative"
            role="alert"
            style="border-radius: 0;">

            <div class="d-flex align-items-center justify-content-center py-2 px-4">
                <div class="text-center flex-grow-1">
                    <strong class="d-block mb-1">{{ $notification->title }}</strong>
                    <div>{!! $notification->message !!}</div>
                </div>
            </div>

            <button
                type="button"
                class="btn-close btn-close-{{ $bootstrapColor }} position-absolute top-50 end-0 translate-middle-y me-4"
                wire:click="closeBanner"
                aria-label="Cerrar">
            </button>
        </div>
    @endif
</div>
