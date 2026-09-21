# PPM Poltekkes Kemenkes Medan — Agent Instructions

## Project Overview

This is the **Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan** web portal and CMS project.

**For complete context, ALWAYS read these documents first (in order):**
1. `.agents/docs/PRD.md` — Full requirements, phases, DB schema, conventions
2. `.agents/docs/design.md` — UI design system, brand colors, component catalog
3. `.agents/docs/plans/phase-1-admin-panel.md` — Current phase step-by-step plan
4. `.agents/docs/project-overview.md` — Quick orientation / module list
5. `.ai/rules/laravel13-architecture.md` — PHP/Laravel coding standards
6. `.ai/rules/project-map.md` — Directory structure and routing conventions
7. `.ai/rules/admin-ui.md` — Admin UI rules (modal, JS separation, file upload)

## Tech Stack
- **Backend:** Laravel 13, PHP 8.3+
- **Database:** MySQL (db: `ppm_poltekkes`)
- **Frontend:** Blade + Tailwind CSS v4
- **Architecture:** Traditional MVC — **NO Livewire**
- **Auth:** Laravel built-in auth
- **Storage:** Laravel public disk (`php artisan storage:link`)
- **Icons:** Feather Icons
- **Rich Text:** TinyMCE (CDN)
- **JS Alerts:** SweetAlert2 (CDN)

## Current Phase
**Phase 1: Backoffice Admin Panel** — building CMS admin modules.
Check `.agents/docs/PRD.md` for per-module status.

## Key Rules (Non-Negotiable)

1. **No inline JS in Blade** — JS goes in `public/dashboard/assets/scripts/<page>.js`
2. **No separate CRUD pages** — all create/edit use modals
3. **Thin controllers** — business logic in `app/Services/`
4. **Form Request for ALL validation** — never inline `$request->validate()` in controller
5. **Array validation syntax** `['required', 'string']` not pipe `'required|string'`
6. **PHP/DB in English, UI in Bahasa Indonesia**
7. **Run pint** after PHP edits: `vendor/bin/pint --dirty`
8. **No dark mode** — light mode only, white base background
9. **Brand colors from Poltekkes Kemenkes Medan logo** — see design.md §1

## Reusable Component Rule (CRITICAL)

**ALWAYS check if a component already exists before writing raw HTML.**

Components are in `resources/views/components/admin/` and `resources/views/components/layouts/`.

Before building any page:
1. Check `resources/views/components/admin/` for existing UI components.
2. Use existing components: `<x-admin.modal>`, `<x-admin.page-header>`, `<x-admin.stat-card>`, `<x-admin.badge>`, `<x-admin.flash>`, `<x-admin.form-input>`, `<x-admin.card>`, `<x-admin.empty-state>`, `<x-admin.btn-primary>`, `<x-admin.btn-danger>`, `<x-admin.image-preview>`, etc.
3. If a new reusable element is needed (will appear on 2+ pages), create a new component — don't write ad-hoc HTML.
4. See `.agents/docs/design.md` §4 for full component catalog and usage specs.

## Role System
- `super_admin` — full access to all modules including Users
- `operator_mutu` — access to all content modules, CANNOT access Users management

## Default Dev Accounts (post-seeder)
- superadmin@ppm.ac.id / password
- operator@ppm.ac.id / password

## Validation & Clean Code Standards
- ALL form validation via `app/Http/Requests/Admin/` Form Request classes.
- Controllers must be thin: receive request → call service → return redirect/response.
- Services in `app/Services/` handle business logic and file operations.
- Explicit method parameters in services (no plain array $data bags).
- Arrow functions `fn() =>` for single-line closures.
- Curly braces always required for control structures.

## File Upload Conventions
- Images: `mimes:jpg,jpeg,png,webp`, `max:2048` (2MB)
- PDF documents: `mimes:pdf`, `max:5120` (5MB), sanitize filename
- Store via `Storage::disk('public')->put(...)` or `$file->store('dir', 'public')`
- Delete old file when updating: `Storage::disk('public')->delete($oldPath)`

## Document Location Note
All AI context docs live in `.agents/docs/` (not root). This is the correct location — all docs are listed above and must be read before starting any task.

## Anti-Slop Skill
The `anti-slop` skill is available at `.agents/skills/anti-slop/`. Use it when reviewing generated code or UI for generic AI patterns that should be avoided.
