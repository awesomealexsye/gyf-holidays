# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

GYF Holidays — a B2B travel company website built with Laravel 12, Blade templates, Tailwind CSS 4, and Alpine.js. Features a public-facing site (destinations, packages, enquiry forms) and an admin panel (enquiry management, dynamic SEO pages).

## Commands

- **Full dev environment:** `composer dev` (runs Laravel server, queue listener, Pail logs, and Vite concurrently)
- **Laravel server only:** `php artisan serve`
- **Vite dev:** `npm run dev`
- **Build frontend:** `npm run build`
- **Run all tests:** `composer test` (clears config cache first, then runs `php artisan test`)
- **Run single test:** `php artisan test --filter=TestClassName` or `php artisan test tests/Feature/SomeTest.php`
- **Lint/format PHP:** `vendor/bin/pint`
- **Initial setup:** `composer setup` (install, env, key:generate, migrate, npm install, build)
- **Run migrations:** `php artisan migrate`
- **Seed admin user:** `php artisan db:seed --class=AdminUserSeeder`
- **Seed data:** `php artisan db:seed --class=DataMigrationSeeder`

## Architecture

### Routing

All routes in `routes/web.php`. The catch-all `/{slug}` route for dynamic SEO pages **must remain last** in the file.

### Key Layers

- **Controllers:** `PageController` (public pages), `AdminController` (admin panel + auth), `EnquiryController` (form submissions), `SitemapController`
- **Models:** `Category`, `Package`, `DynamicPage`, `Enquiry`, `User`
- **Services:** `MailService` — sends enquiry emails via PHP `mail()`, gated by `ALLOW_MAIL_SEND` env var
- **Helpers:** `ImageHelper::webp()` — returns WebP image path if available, falls back to original
- **Middleware:** `CompressResponse` — response compression

### Views

Blade templates in `resources/views/`:
- `layouts/app.blade.php` — public site layout
- `layouts/admin.blade.php` — admin panel layout
- `pages/` — public page templates
- `admin/` — admin panel templates
- `components/` — reusable Blade components

### Configuration

`config/gyf.php` holds all company-specific data (contact info, social links, stats, business hours). Views reference this via `config('gyf.*')`.

### Frontend

Tailwind CSS 4 via Vite plugin. Alpine.js for interactive behavior. Entry points: `resources/css/app.css` and `resources/js/app.js`.

### Testing

PHPUnit with Unit and Feature test suites. Tests use SQLite in-memory database (configured in `phpunit.xml`).

### Admin Panel

Protected by `auth` middleware at `/admin/*`. Session-based auth with login/logout handled by `AdminController`.
