{{-- <div style="height: 100vh; margin: 0; padding: 0;">
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
    @role('validador1')
    <iframe title="ppppp"
        src="https://app.powerbi.com/view?r=eyJrIjoiZmI0MzZiMWEtNTcwNS00ZGY0LThkODAtMDQzZmI2NmFkNmQxIiwidCI6IjE0YzAxM2Y3LTZkOGMtNGUyMS05MTVjLWQ2NDVjODIyMzZhZSJ9"
        allowFullScreen="true">
    </iframe>
    <iframe title="validadores"
        src="https://app.powerbi.com/view?r=eyJrIjoiNGU4M2UyYzgtY2JlMi00OTFjLWI0MmQtOTlkZDM4NDhlODQxIiwidCI6IjE0YzAxM2Y3LTZkOGMtNGUyMS05MTVjLWQ2NDVjODIyMzZhZSJ9"
        allowFullScreen="true"></iframe>
    @endrole
    @role('admin')
    <iframe title="maddicert2.0"
        src="https://app.powerbi.com/view?r=eyJrIjoiZTE3MjBiMWItNzdmOC00N2Y2LTllNjgtYzZiMTAzN2VjNjlkIiwidCI6IjE0YzAxM2Y3LTZkOGMtNGUyMS05MTVjLWQ2NDVjODIyMzZhZSJ9"
        frameborder="0" allowFullScreen="true"></iframe>
    @endrole


</div> --}}
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
