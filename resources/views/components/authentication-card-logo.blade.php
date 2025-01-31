@php
    $siteSetting = App\Models\SiteSetting::first();
    $logoPath = $siteSetting ? 'storage/' . $siteSetting->logo_path : 'images/logo-web.png';
@endphp

<img class="max-md:mx-auto block mx-auto w-56 mt-2" src="{{ asset($logoPath) }}" alt="Logo">
