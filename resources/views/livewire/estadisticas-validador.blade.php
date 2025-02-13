<div class="w-auto mx-auto py-6 flex justify-center">
    @foreach ($iframes as $iframe)
        <div class="relative">
            <iframe title="{{ $iframe->iframe_title }}" src="{{ $iframe->iframe_src }}"
                class="border rounded-lg shadow-lg"
                {!! implode(
                    ' ',
                    array_map(
                        fn($v, $k) => "$k=\"$v\"",
                        json_decode($iframe->attributes, true) ?? [],
                        array_keys(json_decode($iframe->attributes, true) ?? []),
                    ),
                ) !!}>
            </iframe>
        </div>
    @endforeach
</div>
