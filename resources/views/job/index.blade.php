<x-layout>
    <x-breadcrumbs class="mb-lg" :links="['Jobs' => route('jobs.index')]" />

    <x-card class="mb-lg" style="padding: 1.5rem;">
        <form action="{{ route('jobs.index') }}" method="GET" id="filtering-form">
            <div class="grid grid-cols-2 gap-lg mb-lg">
                <div>
                    <div class="form-label">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}" placeholder="Search for any text"
                        form-id="filtering-form" />
                </div>
                <div>
                    <div class="form-label">Salary Range</div>
                    <div class="flex gap-sm">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From"
                            form-id="filtering-form" />
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To"
                            form-id="filtering-form" />
                    </div>
                </div>
                <div>
                    <div class="form-label">Experience Level</div>
                    <x-radio-group name="experiance" :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$experiance),
                        \App\Models\Job::$experiance,
                    )" />
                </div>
                <div>
                    <div class="form-label">Category</div>
                    <x-radio-group name="category" :options="\App\Models\Job::$category" />
                </div>
            </div>
            
            {{-- Submit Form Action --}}
            <x-button style="width: 100%; display: block;">Filter Results</x-button>
        </form>
    </x-card>

    @if ($jobs->isEmpty())
        <div class="empty-state">
            <h3 class="text-xl">No jobs found</h3>
            <p>Try adjusting your search filters to find what you're looking for.</p>
        </div>
    @else
        @foreach ($jobs as $job)
            <x-job-card :job="$job">
                <div style="margin-top: 1rem; display: flex; justify-content: flex-end;">
                    <x-link-button :href="route('jobs.show', $job)">
                        View Details
                    </x-link-button>
                </div>
            </x-job-card>
        @endforeach
    @endif
</x-layout>
