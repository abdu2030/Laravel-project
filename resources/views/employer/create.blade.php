<x-layout>
    <div style="max-width: 500px; margin: 0 auto; padding-top: var(--spacing-xl);">
        <h1 class="text-center font-bold mb-lg" style="font-size: 2rem;">
            Create Employer Profile
        </h1>
        <p class="text-center text-muted mb-xl">Set up your company profile to start posting jobs.</p>

        <x-card>
            <form action="{{ route('employer.store') }}" method="POST">
                @csrf
                <div class="form-group mb-lg">
                    <x-label for="company_name" :required="true">Company Name</x-label>
                    <x-text-input name="company_name"/>
                </div>
                <x-button style="width: 100%; display: block;" class="btn-primary">Create Profile</x-button>
            </form>
        </x-card>
    </div>
</x-layout>