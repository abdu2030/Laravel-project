# Overhaul Job Board Frontend & Vercel Deployment

This plan details the steps to completely revamp the job board's frontend, replacing the basic Tailwind integration with a highly aesthetic, custom Vanilla CSS design. We will also add backend enhancements, inline code comments for clarity, and a complete guide to deploying this Laravel project on Vercel.

## User Review Required

> [!IMPORTANT]
> **Design Approach**
> We will remove the current Tailwind CSS CDN and build a customized, premium design system using Vanilla CSS as per your constraints. This ensures maximum flexibility, smooth micro-animations, and a "wow" factor without relying on utility classes. Do you approve of this Vanilla CSS approach?

> [!CAUTION]
> **Vercel Deployment**
> Vercel is natively built for Node.js (like Next.js) and static sites. Deploying a monolithic Laravel app to Vercel requires using the community `vercel-php` plugin and specific routing rules (`vercel.json` + `api/index.php`). This works well but differs slightly from deploying on a traditional PHP server (like Forge or DigitalOcean). 
> Are you comfortable deploying the app natively as a PHP application via `vercel-php`, or did you originally want an entirely separate frontend (like Next.js / React) communicating with this Laravel app as an API?

## Proposed Changes

---

### 1. Frontend: Core Design System (Vanilla CSS)
We will create a comprehensive `app.css` file to define a modern, visually stunning UI.

#### [NEW] `public/css/app.css`
- Design tokens for a vibrant, modern color palette (e.g., deep purples, glassmorphism elements, crisp white contrasts).
- Typography rules utilizing Google Fonts (e.g., Inter or Outfit).
- Custom UI component classes (`.btn-primary`, `.card`, `.form-input`) with smooth hover micro-animations.
- Responsive layout rules (Flexbox/Grid).

#### [MODIFY] `resources/views/components/layout.blade.php`
- Remove the Tailwind CDN script.
- Link the new `/css/app.css` stylesheet and Google Fonts.
- Update the base HTML structure with layout containers, semantic tags (`<header>`, `<main>`), and apply new Vanilla CSS classes.

---

### 2. Frontend: Blade View Polish
Update all existing blade views to utilize the new design system classes instead of Tailwind classes, adding helpful comments to explain what the code does.

#### [MODIFY] Blade Components
- `resources/views/components/layout.blade.php`
- `resources/views/components/job-card.blade.php`
- `resources/views/components/breadcrumbs.blade.php`
- `resources/views/components/button.blade.php`
- `resources/views/components/label.blade.php`
- `resources/views/components/text-input.blade.php`
- `resources/views/components/radio-group.blade.php`

#### [MODIFY] Page Views
- `resources/views/job/index.blade.php` & `show.blade.php`
- `resources/views/auth/create.blade.php`
- `resources/views/employer/create.blade.php`
- `resources/views/job_application/create.blade.php`
- `resources/views/my_job_application/index.blade.php`
- `resources/views/my_job/index.blade.php`, `create.blade.php`, `edit.blade.php`

> [!NOTE]
> All added or significantly modified code in these views will include HTML/CSS comments explaining the purpose of the structure and visual elements.

---

### 3. Backend: Enhancements
We will ensure that the backend provides all necessary data for the frontend and add informative comments.

#### [MODIFY] Controllers
- `app/Http/Controllers/JobController.php` (etc)
- Add clear PHPDoc block comments and inline explanations of complex logic.
- Ensure the data passed to views is optimized and eagerly loaded to prevent N+1 queries.

---

### 4. Vercel Deployment Configuration
Add the required files to host Laravel directly on Vercel using `vercel-php`.

#### [NEW] `vercel.json`
- Configures Vercel to build and route via the PHP runtime instead of standard static hosting.

#### [NEW] `api/index.php`
- The entry point for Vercel's serverless functions that forwards requests to Laravel's standard `public/index.php`.

#### [NEW] `vercel_deployment_guide.md`
- Provide a step-by-step artifact explaining how to connect your repository to Vercel, set the environment variables (e.g., Database connection), and deploy successfully.

## Verification Plan

### Automated Tests
- Run `php artisan test` locally to ensure no logic was broken by the UI restructuring.

### Manual Verification
- Start the server `php artisan serve`.
- Browse the job index, register/login pages, and job submission pages to verify the new Vanilla CSS design looks stunning.
- Review the `vercel_deployment_guide.md` to ensure it's easy to follow.
