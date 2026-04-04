{{-- Job Card Component: Displays an individual job listing --}}
<x-card class="mb-lg">
    {{-- Card Header: Title and Salary --}}
    <div class="flex justify-between items-center mb-md">
        <h2 class="text-xl font-semibold">
            {{ $job->title }}
        </h2>
        <div class="text-lg font-bold text-primary">
            ${{ number_format($job->salary) }}
        </div>
    </div>

    {{-- Card Subtitle: Employer, Location, Status --}}
    <div class="flex justify-between items-center text-sm text-muted mb-md">
        <div class="flex items-center gap-md">
            <div class="font-medium text-text">{{ $job->employer->company_name }}</div>
            <div>{{ $job->location }}</div>
            @if ($job->deleted_at)
                <span class="badge" style="background-color: var(--color-error-bg); color: var(--color-error);">Deleted</span>
            @endif
        </div>
        
        {{-- Tags --}}
        <div class="flex gap-sm">
            <x-tag>
                <a href="{{ route('jobs.index', ['experiance' => $job->experiance]) }}">
                    {{ Str::ucfirst($job->experiance) }}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{ route('jobs.index', ['category' => $job->category]) }}">
                    {{ $job->category }}
                </a>
            </x-tag>
        </div>
    </div>

    {{-- Description Slot --}}
    {{-- e($job->description) Escapes HTML special characters --}}
    {{ $slot }}
</x-card>
