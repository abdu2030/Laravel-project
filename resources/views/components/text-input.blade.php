{{-- Text Input Component: Handles standard inputs and textareas --}}
<div class="form-group relative">
    @if ('textarea' != $type)
        @if ($formId)
            {{-- Reset button for the input --}}
            <button type="button" class="btn-clear" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--color-text-muted);"
                onclick="document.getElementById('{{ $name }}').value=''; document.getElementById('{{ $formId }}').submit(); ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" style="width: 16px; height: 16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        @endif

        <input type="{{ $type }}" placeholder="{{ $placeholder }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" id="{{ $name }}" class="form-input" 
            style="{{ $errors->has($name) ? 'border-color: var(--color-error);' : '' }} {{ $formId ? 'padding-right: 2.5rem;' : '' }}" />
    @else
        <textarea id="{{ $name }}" name="{{ $name }}" class="form-input" rows="4"
            style="{{ $errors->has($name) ? 'border-color: var(--color-error);' : '' }} {{ $formId ? 'padding-right: 2.5rem;' : '' }}">{{ old($name, $value) }}</textarea>
    @endif

    @error($name)
        <div style="color: var(--color-error); font-size: 0.85rem; margin-top: 0.25rem;">
            {{ $message }}
        </div>
    @enderror
</div>
