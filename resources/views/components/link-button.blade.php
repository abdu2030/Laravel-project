{{-- Link Button Component: A hyperlink styled to look like a button --}}
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'btn btn-secondary']) }}>
    {{ $slot }}
</a>
