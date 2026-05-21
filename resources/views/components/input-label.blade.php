@props(['value'])

<label {{ $attributes->merge(['class' => 'ct-label']) }}>
    {{ $value ?? $slot }}
</label>
