## Contribution Guide

Thank you for your interest in contributing to the Jos Metro BOSS backend. Code maintainability and quality are paramount. Please follow the guidelines below to help us keep the codebase reliable, readable, and scalable.

For product and architectural context, see the backend specification: [Backend Spec](https://docs.google.com/document/d/1XC16fn2AaYaTqZ8b2_iYY4kAvbSmovcI8YUgJHiG-So/edit?tab=t.0).

### Principles

-   Keep it simple, consistent, and well‑tested.
-   Prefer clarity over cleverness; optimize for future readers.
-   Follow PSR standards (e.g., PSR‑12) and Laravel conventions.
-   Make controllers thin, business logic explicit, and side effects visible.

## How to Contribute

1. Fork the repository and create a feature branch.
2. Discuss large changes via an issue before implementation.
3. Implement your change with tests and documentation.
4. Ensure formatting and static checks pass.
5. Submit a PR with a clear description, screenshots (if applicable), and migration notes.

Branch naming: `feat/<short-topic>`, `fix/<short-topic>`, `chore/<short-topic>`, `docs/<short-topic>`.

Commit style (recommended): Conventional Commits, e.g. `feat(routes): add route search endpoint`.

## Quality Checklist (must pass before PR)

-   Tests: unit/feature tests added or updated (`php artisan test`).
-   Style: formatted with Pint (`vendor/bin/pint`).
-   Static assets build (if touched): `npm run build`.
-   No debug code, no commented‑out blocks, no dead code.
-   Backward compatibility considered (API, migrations, seed data).

## Laravel Best Practices

### Architecture & Structure

-   Keep controllers thin; move business logic into service classes or actions.
-   Encapsulate reusable DB queries in repository/services or Eloquent query scopes.
-   Use Form Request classes for validation (`app/Http/Requests`).
-   Use API Resources/Transformers for response shaping (`app/Http/Resources`).
-   Group routes logically in `routes/api.php`; apply middleware at route group level.

### Eloquent & Database

-   Prevent N+1 queries with eager loading (`with(...)`) and avoid heavy work in loops.
-   Use pagination for collection endpoints; never return unbounded lists.
-   Add appropriate indexes in migrations for frequently filtered columns.
-   Use database transactions for multi‑step write operations (`DB::transaction`).
-   Prefer mass assignment via `fillable` and guarded model attributes appropriately.
-   Use soft deletes where operationally useful; consider cascade rules explicitly.

### Validation & Security

-   Validate all input via Form Requests; avoid inline `request()->validate(...)` in controllers for complex rules.
-   Authorize access with policies/gates; never trust client‑provided IDs.
-   Sanitize/escape output in Blade (where applicable) and use API Resources for JSON.
-   Store secrets only in `.env`; never commit secrets or production configs.
-   Use Laravel Sanctum for API auth; rotate/expire tokens appropriately.

### API Design

-   Use consistent RESTful resource naming and HTTP verbs.
-   Return standardized JSON structures with proper HTTP status codes.
-   Provide error responses with machine‑readable `code`, human message, and validation details.
-   Version external APIs when introducing breaking changes (e.g., `/api/v1/...`).

### Performance & Observability

-   Cache read‑heavy queries when appropriate (configurable TTL, invalidation strategy).
-   Use queues for long‑running tasks; avoid blocking HTTP requests.
-   Log at the right levels; include correlation IDs for tracing when feasible.
-   Avoid loading entire tables into memory; stream where possible.

### Testing

-   Write tests for business logic, edge cases, and error paths.
-   Use model factories and seeders for realistic data.
-   Keep tests deterministic; avoid reliance on external services without fakes.

### Migrations & Seeders

-   Make migrations idempotent and reversible.
-   Include seeders for essential reference data.
-   Document breaking schema changes in the PR description.

## Local Development

-   Install deps: `composer install` and `npm install`.
-   One‑shot setup (PostgreSQL‑ready): `composer setup`.
-   Run server: `php artisan serve`.
-   Run tests: `php artisan test`.

## Pull Request Review

All PRs undergo code review. Be open to feedback and iterate quickly. Reviewers focus on:

-   Correctness and security
-   Readability and maintainability
-   Test coverage and performance impact
-   Alignment with architecture and the backend spec

## License

By contributing, you agree your contributions are licensed under the project’s MIT License.
