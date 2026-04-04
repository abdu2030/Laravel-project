<x-layout>
  <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Create' => '#']" class="mb-lg" />

  <x-card class="mb-lg">
    <h2 class="mb-lg text-xl font-bold">Post a New Job</h2>
    <form action="{{ route('my-jobs.store') }}" method="POST">
      @csrf

      <div class="grid grid-cols-2 gap-md mb-lg">
        <div class="form-group mb-sm">
          <x-label for="title" :required="true">Job Title</x-label>
          <x-text-input name="title" />
        </div>

        <div class="form-group mb-sm">
          <x-label for="location" :required="true">Location</x-label>
          <x-text-input name="location" />
        </div>

        <div class="form-group mb-sm" style="grid-column: span 2;">
          <x-label for="salary" :required="true">Salary ($)</x-label>
          <x-text-input name="salary" type="number" />
        </div>

        <div class="form-group mb-sm" style="grid-column: span 2;">
          <x-label for="description" :required="true">Description</x-label>
          <x-text-input name="description" type="textarea" />
        </div>

        <div class="form-group mb-sm">
          <x-label for="experiance" :required="true">Experience Level</x-label>
          <x-radio-group name="experiance" :value="old('experiance')"
            :all-option="false"
            :options="array_combine(
                array_map('ucfirst', \App\Models\Job::$experiance),
                \App\Models\Job::$experiance,
            )" />
        </div>

        <div class="form-group mb-sm">
          <x-label for="category" :required="true">Category</x-label>
          <x-radio-group name="category" :all-option="false" :value="old('category')"
            :options="\App\Models\Job::$category" />
        </div>

        <div style="grid-column: span 2;">
          <x-button class="btn-primary" style="width: 100%; display: block;">Create Job</x-button>
        </div>
      </div>
    </form>
  </x-card>
</x-layout>