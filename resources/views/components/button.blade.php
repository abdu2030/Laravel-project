{{-- Button Component: Render a standard button using our custom btn classes --}}
<button {{ $attributes->merge(['class' => 'btn btn-secondary']) }}>
    {{ $slot }}
</button>