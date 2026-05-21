@props(['disabled' => false])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'ct-field']) }}>
    {{ $slot }}
</select>
