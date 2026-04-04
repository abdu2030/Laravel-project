<x-layout>
    <div style="max-width: 420px; margin: 0 auto; padding-top: var(--sp-2xl);">
        <h1 class="text-center font-bold mb-lg" style="font-size: 2rem; letter-spacing: -0.02em;">
            Welcome back
        </h1>
        <p class="text-center text-muted mb-xl">Sign in to your account to continue</p>
        
        <x-card>
            <form action="{{ route('Auth.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <x-label for="email" :required="true">E-mail Address</x-label>
                    <x-text-input name="email" />
                </div>
                <div class="form-group">
                    <x-label for="password" :required="true">Password</x-label>
                    <x-text-input name="password" type="password" />
                </div>
                
                <div class="flex justify-between items-center mb-lg text-sm">
                    <label for="remember" class="flex items-center gap-sm" style="cursor: pointer;">
                        <input type="checkbox" name="remember" id="remember" style="accent-color: var(--primary);">
                        <span style="color: var(--text-secondary);">Remember me</span>
                    </label>
                </div>
                
                <x-button style="width: 100%; display: block;" class="btn-primary">
                    Sign In
                </x-button>
            </form>
        </x-card>

        <div class="auth-link">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>
</x-layout>
