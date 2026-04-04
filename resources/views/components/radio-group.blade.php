{{-- Radio Group Component: For selectable options --}}
<div class="form-group">
    @if ($allOption)
        <label for="{{ $name }}" class="flex items-center gap-sm mb-sm" style="cursor: pointer;">
            <input type="radio" name="{{ $name }}" value="" @checked(!request($name)) />
            <span>All</span>
        </label>
    @endif

    @foreach ($optionsWithLabels as $label => $option)
        <label for="{{ $name }}_{{ $loop->index }}" class="flex items-center gap-sm mb-sm" style="cursor: pointer;">
            <input id="{{ $name }}_{{ $loop->index }}" type="radio" name="{{ $name }}" value="{{ $option }}" @checked($option === ($value ?? request($name))) />
            <span>{{ $label }}</span>
        </label>
    @endforeach

    @error($name)
        <div style="color: var(--color-error); font-size: 0.85rem; margin-top: 0.25rem;">
            {{ $message }}
        </div>
    @enderror
</div>
