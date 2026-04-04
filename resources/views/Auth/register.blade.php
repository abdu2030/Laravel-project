<x-layout>
    <div style="max-width: 420px; margin: 0 auto; padding-top: var(--sp-2xl);">
        <h1 class="text-center font-bold mb-lg" style="font-size: 2rem; letter-spacing: -0.02em;">
            Create your account
        </h1>
        <p class="text-center text-muted mb-xl">Start your job search journey today</p>
        
        <x-card>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <x-label for="name" :required="true">Full Name</x-label>
                    <x-text-input name="name" value="{{ old('name') }}" placeholder="John Doe" />
                </div>
                <div class="form-group">
                    <x-label for="email" :required="true">E-mail Address</x-label>
                    <x-text-input name="email" value="{{ old('email') }}" placeholder="you@example.com" />
                </div>
                <div class="form-group">
                    <x-label for="password" :required="true">Password</x-label>
                    <x-text-input name="password" type="password" />
                </div>
                <div class="form-group">
                    <x-label for="password_confirmation" :required="true">Confirm Password</x-label>
                    <x-text-input name="password_confirmation" type="password" />
                </div>
                
                <x-button style="width: 100%; display: block;" class="btn-primary">
                    Create Account
                </x-button>
            </form>
        </x-card>

        <div class="auth-link">
            Already have an account? <a href="{{ route('Auth.create') }}">Sign in</a>
        </div>
    </div>
</x-layout>
