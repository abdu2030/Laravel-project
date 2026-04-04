<x-layout>
    <x-breadcrumbs class="mb-lg" :links="['My Applications' => '#']" />

    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-muted" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--color-border);">
                <div style="line-height: 1.8;">
                    <div>
                        <strong>Applied:</strong> {{ $application->created_at->diffForHumans() }}
                    </div>
                    <div>
                        <strong>Other {{ Str::plural('applicant', $application->job->job_applications_count - 1) }}:</strong>
                        {{ $application->job->job_applications_count - 1 }}
                    </div>
                    <div>
                        <strong>Your asking salary:</strong> ${{ number_format($application->expected_salary) }}
                    </div>
                    <div>
                        <strong>Average Asking Salary:</strong>
                        ${{ number_format($application->job->job_applications_avg_expected_salary) }}
                    </div>
                </div>
                <div>
                    <form action="{{ route('my-job-application.destroy', $application) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button class="btn-danger">
                            Withdraw
                        </x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="empty-state">
            <div class="text-xl mb-sm">
                No job applications yet
            </div>
            <div>
                Go find some amazing opportunities <a href="{{ route('jobs.index') }}">Here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
