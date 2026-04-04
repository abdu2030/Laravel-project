<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobBoard — Land Your Dream Career</title>
    <meta name="description" content="Discover curated job opportunities from top employers. Smart search, quick apply, and powerful employer tools.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="landing-body">
    {{-- ===== NAVBAR ===== --}}
    <header class="site-header">
        <nav class="nav-container">
            <ul class="nav-links">
                <li>
                    <a href="{{ url('/') }}" class="nav-brand">
                        <span class="nav-brand-dot"></span>
                        JobBoard
                    </a>
                </li>
                <li>
                    <a href="{{ route('jobs.index') }}" class="nav-link">Explore Jobs</a>
                </li>
            </ul>
            <ul class="nav-links">
                @auth
                    <li>
                        <a href="{{ route('my-job-application.index') }}" class="nav-link">
                            {{ auth()->user()->name ?? 'You' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my-jobs.index') }}" class="nav-link">Dashboard</a>
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
                        <a href="{{ route('Auth.create') }}" class="nav-link">Log In</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="nav-btn-signup">Get Started</a>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>

    {{-- ===== HERO with AURORA ===== --}}
    <section class="hero" id="hero">
        {{-- Animated aurora blobs --}}
        <div class="aurora">
            <div class="aurora-1"></div>
            <div class="aurora-2"></div>
            <div class="aurora-3"></div>
        </div>

        <div class="hero-inner">
            <div class="hero-chip">
                <span class="hero-chip-dot"></span>
                New roles added every day
            </div>

            <h1>
                Where talent<br>
                meets <span class="text-gradient">opportunity</span>
            </h1>

            <p class="hero-desc">
                Curated job listings, powerful filters, and one-click applications.
                Whether you're hiring or searching — JobBoard makes it effortless.
            </p>

            <div class="hero-cta">
                <a href="{{ route('jobs.index') }}" class="btn-glow btn-glow-primary">
                    Browse Open Roles &rarr;
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn-glow btn-glow-ghost">
                        Create Free Account
                    </a>
                @endguest
            </div>
        </div>
    </section>

    {{-- ===== MARQUEE — Job Categories ===== --}}
    <div class="marquee-section">
        <div class="marquee-track">
            @php
                $tags = ['Software Engineering', 'Product Design', 'Data Science', 'DevOps', 'Marketing', 'Finance', 'Healthcare', 'Education', 'Remote', 'Full-Time', 'Part-Time', 'Contract', 'Internship', 'Senior', 'Junior', 'Lead', 'Manager', 'Startup', 'Enterprise'];
                // Duplicate for seamless loop
                $allTags = array_merge($tags, $tags);
            @endphp
            @foreach ($allTags as $tag)
                <span class="marquee-item">{{ $tag }}</span>
            @endforeach
        </div>
    </div>

    {{-- ===== BENTO GRID — Features ===== --}}
    <section class="bento-section" id="features">
        <div class="bento-label">
            <span class="bento-label-line"></span>
            Platform Features
        </div>
        <h2 class="bento-title">Built for modern job seekers & employers</h2>
        <p class="bento-subtitle">
            Everything you need to find your next opportunity or your next great hire.
        </p>

        <div class="bento-grid">
            {{-- Wide card --}}
            <div class="bento-card bento-card-wide">
                <div class="bento-icon bento-icon-emerald">🔍</div>
                <h3>Advanced Filters</h3>
                <p>Search by keyword, salary range, experience level, and job category. Find exactly what matches your skills and ambitions.</p>
            </div>

            {{-- Normal card --}}
            <div class="bento-card">
                <div class="bento-icon bento-icon-cyan">⚡</div>
                <h3>Quick Apply</h3>
                <p>Upload your CV once and apply to multiple roles with a single click.</p>
            </div>

            {{-- Normal card --}}
            <div class="bento-card">
                <div class="bento-icon bento-icon-amber">📊</div>
                <h3>Employer Dashboard</h3>
                <p>Post jobs, review applicants, and manage your hiring pipeline from one place.</p>
            </div>

            {{-- Wide card --}}
            <div class="bento-card bento-card-wide">
                <div class="bento-icon bento-icon-purple">🛡️</div>
                <h3>Application Tracking</h3>
                <p>Track every application you submit. Know exactly where you stand — no more guessing, no more lost emails. Your entire job search in one view.</p>
            </div>
        </div>
    </section>

    {{-- ===== STATS STRIP ===== --}}
    <section class="stats-strip" id="stats">
        <div class="stats-row">
            <div class="stat-item">
                <div class="stat-val">2.5k+</div>
                <div class="stat-desc">Jobs Listed</div>
            </div>
            <div class="stat-item">
                <div class="stat-val">820+</div>
                <div class="stat-desc">Companies</div>
            </div>
            <div class="stat-item">
                <div class="stat-val">15k+</div>
                <div class="stat-desc">Applicants</div>
            </div>
            <div class="stat-item">
                <div class="stat-val">94%</div>
                <div class="stat-desc">Match Rate</div>
            </div>
        </div>
    </section>

    {{-- ===== CTA BANNER ===== --}}
    <section class="cta-banner" id="cta">
        <div class="cta-box">
            <h2>Ready to take the next step?</h2>
            <p>Join a growing community of professionals and employers who trust JobBoard.</p>
            <div class="cta-btns">
                <a href="{{ route('jobs.index') }}" class="btn-glow btn-glow-primary">
                    Explore All Jobs
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn-glow btn-glow-ghost">
                        Sign Up Free
                    </a>
                @endguest
            </div>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="landing-footer">
        &copy; {{ date('Y') }} JobBoard &middot; Built with Laravel &middot; All rights reserved.
    </footer>
</body>

</html>
