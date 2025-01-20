<div style="height: 100vh; margin: 0; padding: 0;">
    <style>
        html,
        body,
        iframe {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            border: none;
        }

        iframe {
            display: block;
            height: 100%;
            width: 100%;
        }
    </style>

    @foreach ($iframes as $iframe)
        <iframe title="{{ $iframe->iframe_title }}"
            src="{{ $iframe->iframe_src }}"
            allowFullScreen="true">
        </iframe>
    @endforeach
</div>
