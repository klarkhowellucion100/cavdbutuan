@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-sm text-danger space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <p class="text-danger" style="font-size:12px;">{{ $message }}</p>
        @endforeach
    </div>
@endif
