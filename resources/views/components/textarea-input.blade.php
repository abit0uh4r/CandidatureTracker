@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'ct-field']) }}>{{ $slot }}</textarea>
