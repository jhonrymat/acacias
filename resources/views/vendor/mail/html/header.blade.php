@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @php
                $siteSetting = App\Models\SiteSetting::first();
                $logoPath = $siteSetting ? 'storage/' . $siteSetting->logo_path : 'images/logo-web.png';
            @endphp
            <img src="{{ asset($logoPath) }}" alt="Logo" style="width: 230px !important">
        </a>
    </td>
</tr>
