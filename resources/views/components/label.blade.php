{{-- Label Component: Reusable form label --}}
<label class="form-label" for="{{ $for }}">
    {{ $slot }} @if ($required)
        <span style="color: var(--color-error);">*</span>
    @endif
</label>
