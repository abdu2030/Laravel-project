<x-layout>
    <div class="flex justify-between items-center mb-lg">
        <x-breadcrumbs :links="['My Jobs' => '#']" />
        <x-link-button href="{{ route('my-jobs.create') }}" class="btn-primary">Post New Job</x-link-button>
    </div>

    @forelse ($jobs as $job)
        <x-job-card :job="$job">
            <div class="text-sm text-muted" style="margin-top: 1rem; border-top: 1px solid var(--color-border); padding-top: 1rem;">
                <h3 class="font-bold text-text mb-sm">Applicants</h3>
                @forelse ($job->jobApplications as $application)
                    <div class="flex items-center justify-between" style="padding: 0.5rem 0; {{ !$loop->last ? 'border-bottom: 1px solid var(--color-border);' : '' }}">
                        <div style="line-height: 1.5;">
                            <div class="font-medium text-text">{{ $application->user->name }}</div>
                            <div class="text-xs">
                                Applied {{ $application->created_at->diffForHumans() }}
                            </div>
                        </div>

                        <div class="flex items-center gap-md">
                            <div class="font-bold text-primary">${{ number_format($application->expected_salary) }}</div>
                            {{-- Assuming it might be a link eventually --}}
                            <a href="#" class="text-xs underline" style="color: var(--color-accent);">Download CV</a>
                        </div>
                    </div>
                @empty
                    <div style="font-style: italic; color: var(--color-text-muted);">No applications yet.</div>
                @endforelse

                <div class="flex gap-sm" style="margin-top: 1.5rem; justify-content: flex-end;">
                    <x-link-button href="{{ route('my-jobs.edit', $job) }}">Edit</x-link-button>
                    <form action="{{ route('my-jobs.destroy', $job) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button class="btn-danger">Delete</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="empty-state">
            <div class="text-xl mb-sm">
                No jobs posted yet
            </div>
            <div>
                Post your first job <a href="{{ route('my-jobs.create') }}" style="color: var(--color-primary); text-decoration: underline;">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
