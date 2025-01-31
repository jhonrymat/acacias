@php
    $siteSetting = App\Models\SiteSetting::first();
    $logoPath = $siteSetting ? 'storage/' . $siteSetting->logo_path : 'images/logo-web.png';
@endphp

<img class="block w-40" src="{{ asset($logoPath) }}" alt="Logo">
