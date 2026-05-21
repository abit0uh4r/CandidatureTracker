<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-xl border border-transparent bg-[#0b2d5f] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#061f42] focus:outline-none focus:ring-2 focus:ring-[#0b2d5f] focus:ring-offset-2 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
