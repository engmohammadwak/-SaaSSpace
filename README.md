# SaaSSpace - Laravel Project

A full Laravel application converted from the original SaaSSpace WordPress/Elementor site, with a complete Admin Dashboard to manage all website content.

## Features
- Full Laravel 11 project structure
- Admin Dashboard (protected with auth)
- Manage: Hero, Services, Case Studies, Testimonials, Pricing Plans, Clients
- Media/Image upload support
- Site Settings management
- Blade partials matching original design

## Tech Stack
- Laravel 11
- MySQL
- Blade Templates
- Vite + Tailwind CSS (Admin)
- Alpine.js
- Original CSS/JS from SaaSSpace design

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
php artisan storage:link
php artisan serve
```

## Admin Dashboard
URL: `/admin/dashboard`  
Default credentials (after seeding):
- Email: `admin@saasspace.co`
- Password: `password`

## Project Structure

```
app/Http/Controllers/
├── HomeController.php
└── Admin/
    ├── DashboardController.php
    ├── HeroController.php
    ├── ServicesController.php
    ├── ProjectsController.php
    ├── TestimonialsController.php
    ├── PricingController.php
    ├── ClientsController.php
    └── SettingsController.php

resources/views/
├── layouts/app.blade.php
├── partials/
│   ├── header.blade.php
│   ├── hero.blade.php
│   ├── about.blade.php
│   ├── clients.blade.php
│   ├── services.blade.php
│   ├── case-studies.blade.php
│   ├── testimonials.blade.php
│   ├── pricing.blade.php
│   └── footer.blade.php
└── admin/
    ├── dashboard.blade.php
    ├── hero/
    ├── services/
    ├── projects/
    ├── testimonials/
    ├── pricing/
    ├── clients/
    └── settings/
```
