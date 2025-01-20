@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            <img class="logo" src="{{ asset('storage/' . (App\Models\SiteSetting::first()->logo_path ?? 'images/logo-web.png')) }}" alt="Logo" style="width: 230px !important">
        </a>
    </td>
</tr>
