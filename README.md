# Jos Metro BOSS System — Backend

Empowering public transit in Jos with a reliable, scalable backend that powers real‑time bus tracking, schedules, route optimization, and commuter notifications.

This repository contains the core API and services for the Jos Metro BOSS (Bus Operations Support Suite). It provides secure authentication, data management for routes and schedules, real‑time telemetry ingestion for buses, and endpoints used by the mobile/web apps.

> UI/UX scope and product intent are defined in the design brief. See: [Tin City Metro App — UI/UX Spec](https://docs.google.com/document/d/1dhvItCx9EMRMM1qeXFeqYeILz4OlUV6j7iEarQLlYOk/edit?tab=t.0).

## Core Focus

-   Real‑time bus tracking and status updates for commuters and operators
-   Route and schedule management with on‑time performance insights
-   Notifications for arrivals, service alerts, and operational changes
-   Secure, role‑based access for riders, operators, and admins
-   Scalable APIs designed for growth and reliability

## Features

-   RESTful APIs for auth, users, routes, stops, trips, vehicles, schedules, and telemetry
-   Real‑time location updates (ingestion endpoints) and live ETA projections (service layer)
-   Service alerts and notifications delivery pipeline
-   Queue‑ready architecture for background jobs and broadcasts
-   Environment‑agnostic storage (SQLite/MySQL/PostgreSQL)
-   First‑class developer ergonomics with migrations, seeders, factories, and tests

## Tech Stack

-   PHP 8.2+, Laravel Framework
-   Authentication: Laravel Sanctum
-   Database: SQLite (dev) or MySQL/PostgreSQL (prod)
-   Queues/Jobs: Laravel Queue (driver configurable)
-   Logging/Observability: Laravel logging, events

## Getting Started

Prerequisites:

-   PHP 8.2+
-   Composer
-   A database (SQLite file included for quick start)

Install and run locally:

```bash
# One-shot setup (PostgreSQL-ready)
composer setup

# Start the server
php artisan serve
```

The app will be available by default at `http://127.0.0.1:8000`.

## Configuration

Common `.env` options:

-   `APP_NAME="Jos Metro BOSS"`
-   `APP_ENV=local|production`
-   `APP_URL=` your app URL
-   `DB_CONNECTION=sqlite|mysql|pgsql`
-   `QUEUE_CONNECTION=database|redis|sync`
-   `SANCTUM_STATEFUL_DOMAINS` if using SPA/web client

PostgreSQL example:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=jos_metro
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

## Database

-   Migrations live in `database/migrations`
-   Seeders in `database/seeders`
-   Factories in `database/factories`

Useful commands:

```bash
php artisan migrate
php artisan db:seed
php artisan migrate:fresh --seed
```

## API Overview

High‑level domains exposed via API:

-   Auth and Users (registration, login, tokens)
-   Routes, Stops, Trips, Schedules
-   Vehicles (buses), Telemetry (location pings)
-   Service Alerts and Notifications

Discover routes during development:

```bash
php artisan route:list
```

Postman/Insomnia collections can be added in `/docs` as the project evolves.

## Development

-   Run tests: `php artisan test`
-   Lint/format: `vendor/bin/pint`
-   Log file: `storage/logs/laravel.log`

Recommended workflow:

1. Define or update migrations and models
2. Add controllers/services and register routes in `routes/api.php`
3. Add request validation and policies as needed
4. Add factories/seeders for realistic data
5. Write feature tests to capture behavior

## Contributing

Contributions are welcome! Please:

1. Fork the repository and create a feature branch
2. Add tests for new behavior
3. Ensure CI passes and code is formatted
4. Open a PR with a clear description and rationale

## License

This project is open source under the MIT License.
