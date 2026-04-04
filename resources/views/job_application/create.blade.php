<x-layout>
    <x-breadcrumbs class="mb-lg" :links="[
        'Jobs' => route('jobs.index'),
        $job->title => route('jobs.show', $job),
        'Apply' => '#',
    ]" />

    <x-job-card :job="$job" />
    
    <x-card>
        <h2 class="mb-lg text-xl">
            Complete Your Job Application
        </h2>

        <form action="{{ route('job.application.store', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-lg">
                <x-label for="expected_salary" :required="true">Expected Salary ($)</x-label>
                <x-text-input type="number" name="expected_salary" />
            </div>

            <div class="form-group mb-xl">
                <x-label for="cv" :required="true">Upload CV/Resume</x-label>
                <x-text-input type="file" name="cv" style="padding: 0.5rem;"/>
            </div>

            {{-- Submit Form Action --}}
            <x-button style="width: 100%; display: block;" class="btn-primary">
                Submit Application
            </x-button>
        </form>
    </x-card>
</x-layout>
