# Premium Laravel Job Board

A sleek, modern job board application built with **Laravel** and styled with a custom **Vanilla CSS Glassmorphism** design system. 

This platform allows users to browse job listings, register as employers to post new opportunities, and apply for open positions.

## 🚀 Features

- **Custom Premium UI**: A bespoke interface built without external CSS frameworks, featuring dynamic gradients and micro-animations.
- **Job Discovery**: Advanced filtering by salary range, experience level, category, and text search.
- **Applicant Tracking**: Employers can view applications for their posted jobs.
- **User Roles**: Separate capabilities for standard applicants and employers.
- **Vercel-Ready**: Pre-configured with `vercel.json` and `api/index.php` for seamless deployment to Vercel's Edge Network.

## 💻 Getting Started (Local Development)

Follow these steps to get the application running on your local machine:

### 1. Prerequisites
- PHP >= 8.2
- Composer
- SQLite (or another preferred database like MySQL)

### 2. Installation
Clone the repository, then install the required PHP dependencies:
```bash
composer install
```

### 3. Environment Setup
Copy the example environment file and generate your application key:
```bash
cp .env.example .env
php artisan key:generate
```

*Note: Ensure your `.env` is configured for your database. By default, you can use SQLite by setting `DB_CONNECTION=sqlite` and commenting out other `DB_*` variables, then creating a `database/database.sqlite` file.*

### 4. Database Migrations & Seeding
Run the migrations to set up your database tables, and seed them with dummy data (if available):
```bash
php artisan migrate --seed
```

### 5. Start the Server
Serve the application locally:
```bash
php artisan serve
```
Visit `http://127.0.0.1:8000` in your browser to view the application.



---
*Built with Laravel 12.x.*
