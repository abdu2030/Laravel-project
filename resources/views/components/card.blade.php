{{-- Card Component: Acts as a reusable glassmorphism container --}}
<article {{ $attributes->merge(['class' => 'card']) }}>
    {{ $slot }}
</article>
