<x-layout>
    <x-breadcrumbs class="mb-lg" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />

    <x-job-card :job="$job">
        <div class="mb-lg" style="color: var(--color-text-muted); line-height: 1.8;">
            {!! nl2br(e($job->description)) !!}
        </div>

        @can('apply', $job)
            <x-link-button :href="route('job.application.create', $job)" style="display: block; width: 100%; text-align: center;">
                Apply Now
            </x-link-button>
        @else
            <div class="alert alert-success" style="text-align: center; font-weight: 500;">
                You have already applied to this job.
            </div>
        @endcan
    </x-job-card>

    <x-card class="mb-lg">
        <h2 class="mb-md text-lg">
            More {{ $job->employer->company_name }} Jobs
        </h2>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach ($job->employer->jobs as $otherJob)
                <div class="flex justify-between items-center" style="padding-bottom: 1rem; border-bottom: 1px solid var(--color-border);">
                    <div>
                        <div class="font-medium">
                            <a href="{{ route('jobs.show', $otherJob) }}">
                                {{ $otherJob->title }}
                            </a>
                        </div>
                        <div class="text-sm text-muted" style="margin-top: 0.25rem;">
                            {{ $otherJob->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="font-bold text-primary">
                        ${{ number_format($otherJob->salary) }}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
