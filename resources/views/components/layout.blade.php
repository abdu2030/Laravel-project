<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Job Board | Find Your Next Career</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    {{-- Navigation --}}
    <header class="site-header">
        <nav class="nav-container">
            <ul class="nav-links">
                <li>
                    <a href="{{ route('landing') }}" class="nav-brand">
                        <span class="nav-brand-dot"></span>
                        JobBoard
                    </a>
                </li>
                <li>
                    <a href="{{ route('jobs.index') }}" class="nav-link">Jobs</a>
                </li>
            </ul>

            <ul class="nav-links">
                @auth
                    <li>
                        <a href="{{ route('my-job-application.index') }}" class="nav-link">
                            {{ auth()->user()->name ?? 'Anonymous' }}: Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my-jobs.index') }}" class="nav-link">My Jobs</a>
                    </li>
                    <li>
                        <form action="{{ route('Auth.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="nav-link" style="background:none;border:none;cursor:pointer;font-size:inherit;">Logout</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('Auth.create') }}" class="nav-link">Sign In</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="nav-btn-signup">Sign Up</a>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>

    {{-- Main Content --}}
    <main class="container">
        @if (session('success'))
            <div role="alert" class="alert alert-success">
                <p class="alert-title">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div role="alert" class="alert alert-error">
                <p class="alert-title">Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{ $slot }}
    </main>
</body>

</html>
