<x-layout>
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Edit Job' => '#']" class="mb-lg" />

    <x-card class="mb-lg">
        <h2 class="mb-lg text-xl font-bold">Edit Job Post</h2>
        <form action="{{ route('my-jobs.update', $job) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-md mb-lg">
                <div class="form-group mb-sm">
                    <x-label for="title" :required="true">Job Title</x-label>
                    <x-text-input name="title" :value="$job->title" />
                </div>

                <div class="form-group mb-sm">
                    <x-label for="location" :required="true">Location</x-label>
                    <x-text-input name="location" :value="$job->location" />
                </div>

                <div class="form-group mb-sm" style="grid-column: span 2;">
                    <x-label for="salary" :required="true">Salary ($)</x-label>
                    <x-text-input name="salary" type="number" :value="$job->salary" />
                </div>

                <div class="form-group mb-sm" style="grid-column: span 2;">
                    <x-label for="description" :required="true">Description</x-label>
                    <x-text-input name="description" type="textarea" :value="$job->description" />
                </div>

                <div class="form-group mb-sm">
                    <x-label for="experiance" :required="true">Experience</x-label>
                    <x-radio-group name="experiance" :value="$job->experiance" :all-option="false" :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$experiance),
                        \App\Models\Job::$experiance,
                    )" />
                </div>

                <div class="form-group mb-sm">
                    <x-label for="category" :required="true">Category</x-label>
                    <x-radio-group name="category" :all-option="false" :value="$job->category" :options="\App\Models\Job::$category" />
                </div>

                <div style="grid-column: span 2;">
                    <x-button class="btn-primary" style="width: 100%; display: block;">Save Changes</x-button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>
