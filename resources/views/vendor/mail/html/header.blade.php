@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            <img src="{{ asset('images/logo-web.png') }}" class="logo" alt="{{ config('app.name') }}" style="width: 230px !important">
        </a>
    </td>
</tr>
