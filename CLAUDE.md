# CLAUDE.md - Immobilier Matrix France (Immo-Enrichi)

## Project Overview

Real estate SaaS platform with two components:
1. **Marketing Website** (`public_html/`) - Static HTML landing pages (FR/EN), agent-focused
2. **Laravel Application** (`app.immobiliermatrixfrance.fr/`) - Full-stack property management platform

**Brand**: Immo-Enrichi (rebranded from "Immobilier Matrix France" in Nov 2025)
**Version**: 1.3.0 (Dec 2025)
**Production URLs**: `immobiliermatrixfrance.fr` (marketing), `app.immobiliermatrixfrance.fr` (app)
**Hosting**: cPanel shared hosting

## Tech Stack

### Laravel App
- **Backend**: Laravel 10, PHP 8.1+, MySQL
- **Frontend**: Vue 3 (Composition API), Inertia.js, Tailwind CSS 3, Vite 4
- **Auth**: Jetstream + Fortify + Sanctum
- **Payments**: Laravel Cashier (Stripe)
- **Media**: Spatie Media Library Pro v2
- **Testing**: Pest PHP + PHPUnit
- **Code Style**: Laravel Pint (PSR-12)

### Marketing Site
- Static HTML5, CSS3/SCSS, jQuery, Swiper.js (v9)
- **CSS**: `styles.css` (base/legacy) + `styles-new.css` (new sections: math cards, objections, ROI calc, promise block)
- **Fonts**: Unna (serif, headings) + Inter (sans-serif, body)

## Project Structure

```
Immo-fr-website/
├── public_html/                        # Marketing website (static HTML)
│   ├── en.html, fr.html                # Live pages
│   ├── en-old-*.html, fr-old-*.html    # Backups of previous versions
│   ├── en-sandbox.html, fr-sandbox.html # Sandbox pages
│   ├── styles.css                      # Base stylesheet (compiled from SCSS)
│   ├── styles-new.css                  # Additional styles (math, objections, ROI, promise)
│   ├── styles-sandbox.css              # Sandbox stylesheet
│   ├── _*.scss                         # SCSS source files
│   └── main.js                         # Swiper carousel init
│
├── app.immobiliermatrixfrance.fr/      # Laravel application
│   ├── app/
│   │   ├── Actions/                    # Business logic (Action pattern)
│   │   │   ├── Listing/               # CreateListing, UpdateListing, etc.
│   │   │   ├── Agent/
│   │   │   ├── GeoCoding/
│   │   │   └── Auth/
│   │   ├── Http/Controllers/           # Slim controllers delegating to Actions
│   │   ├── Http/Middleware/            # CheckForActiveSubscription, etc.
│   │   ├── Http/Requests/             # Form validation
│   │   ├── Models/                    # 8 models: User, Listing, Agent, Feature, etc.
│   │   ├── Policies/                  # Authorization
│   │   └── Notifications/
│   ├── resources/js/
│   │   ├── Pages/                     # Vue page components (Auth, Dashboard, Listing, Search, Admin)
│   │   ├── Components/                # Reusable Vue components (~99 total)
│   │   ├── Layouts/                   # AppLayout.vue
│   │   └── app.js                     # Entry point
│   ├── routes/web.php                 # All routes (~140 lines)
│   ├── database/migrations/           # 26 migrations
│   └── tests/                         # Pest PHP tests (19 files)
│
├── README.md                          # Project overview
├── CHANGELOG.md                       # Version history
└── CLAUDE.md                          # This file
```

## Development Commands

All commands run from `app.immobiliermatrixfrance.fr/`:

```bash
# Setup
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate

# Development (requires TWO terminals)
npm run dev              # Terminal 1: Vite dev server
php artisan serve        # Terminal 2: Laravel server
# Access at http://localhost:8000

# Build
npm run build

# Tests
./vendor/bin/pest                          # All tests
./vendor/bin/pest tests/Feature/           # Feature tests only
./vendor/bin/pest --coverage               # With coverage

# Code formatting
./vendor/bin/pint                          # Format PHP (PSR-12)
./vendor/bin/pint --test                   # Check only

# Database
php artisan migrate                        # Run migrations
php artisan migrate:fresh                  # Reset & re-run all
php artisan migrate:status                 # Check status

# Production caching
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

## Architecture Patterns

### Action-Based Business Logic
Business logic lives in `app/Actions/`, not controllers. Controllers are thin and delegate to action classes.
- Example: `CreateListing`, `UpdateListing`, `PublishOrUnPublishListing`
- Pattern: Single-responsibility action classes

### Inertia.js (Vue-Laravel Bridge)
- Controllers return `Inertia::render('Page/Component', $data)`
- Vue components receive props from Laravel
- No separate API layer needed
- Forms use `useForm()` from `@inertiajs/vue3`

### Route Model Binding
Routes bind by `reference` field, not `id`:
```php
Route::get('/listings/{listing:reference}', ...)
```

## Key Models & Relationships

- **User** (`type`: admin|agent|buyer|seller) - hasMany Listing, belongsToMany FavouriteListing
- **Listing** - belongsTo User, belongsTo Agent, belongsToMany Feature, hasMany ListingInterest
- **Agent** - hasMany Listing, hasMany ListingInterest
- **Feature** - belongsToMany Listing (property amenities)
- **ListingInterest** - tracks agent/buyer interest in listings

Media: Listings use Spatie Media Library collection `property_photos`

## User Types & Business Rules

| Type | Subscription | Key Rules |
|------|-------------|-----------|
| Agent | EUR365/year, 90-day trial | Unlimited listings, view all properties |
| Seller | EUR12/year (hidden from marketing) | One free listing, then subscription |
| Buyer | EUR12/year (hidden from marketing) | Search, favorites, express interest |
| Admin | N/A | Full system access, user management |

Middleware enforces subscriptions: `CheckForActiveSubscription`, `ValidateAgentRegistration`

## Environment Variables (Key)

```
DB_CONNECTION=mysql
STRIPE_PUBLIC_KEY=
STRIPE_SECRET_KEY=
AGENT_SUBSCRIPTION_PRODUCT=price_...
BUYER_SUBSCRIPTION_PRODUCT=price_...
SELLER_SUBSCRIPTION_PRODUCT=price_...
GOOGLE_MAPS_API_KEY=
MAIL_FROM_ADDRESS=noreply@immobiliermatrixfrance.fr
```

## Coding Conventions

### PHP
- **Style**: PSR-12 via Laravel Pint
- **Controllers**: `{Resource}Controller` (e.g., `ListingController`)
- **Actions**: `{Verb}{Resource}` (e.g., `CreateListing`)
- **Models**: Singular PascalCase (e.g., `Listing`)
- **Tables**: Plural snake_case (e.g., `favourite_listings`)
- Use eager loading to avoid N+1: `Listing::with('user', 'features', 'media')->get()`

### Vue/JS
- **Composition API** with `<script setup>` (no Options API)
- **Props**: Type validation required, emits explicitly declared
- **Styling**: Tailwind utility classes (custom color: `brandorange: '#FFA163'`)
- **State**: Props down, events up (no Vuex/Pinia)
- **Formatting**: 2-space indentation

### Git Commits
```
feat: Add property search by location
fix: Resolve agent interest approval bug
docs: Update README with deployment steps
refactor: Extract listing card to component
test: Add tests for subscription workflow
```

## Marketing Site Workflow

### Sandbox-first approach (recommended)
1. Edit sandbox files: `en-sandbox.html`, `fr-sandbox.html`, `styles-sandbox.css`
2. Sandbox pages link to each other via language switcher
3. When approved, copy sandbox -> live:
   - `en-sandbox.html` -> `en.html`
   - `fr-sandbox.html` -> `fr.html`
   - `styles-sandbox.css` -> `styles.css`

### Key notes
- Always update BOTH French and English pages identically
- Auth links must include `?locale=fr` or `?locale=en` for language persistence
- Use cache-busting parameter on CSS: `styles.css?v=YYYYMMDD`
- Both `styles.css` AND `styles-new.css` must be deployed together
- FR page uses `list2_fr.png` and `join_fr.png`; EN page uses `list2.png` and `join.png`
- Swiper carousel: needs `loopAdditionalSlides: 4` and `disableOnInteraction: false` for smooth auto-sliding with few slides
- SCSS source files (`_*.scss`) exist but compiled CSS is committed directly

## Existing Documentation

| File | Purpose |
|------|---------|
| `README.md` | Project overview, recent changes |
| `CHANGELOG.md` | Full version history |
| `public_html/CHANGELOG.md` | Marketing site changes |
| `app.immobiliermatrixfrance.fr/README.md` | Laravel setup guide |
| `app.immobiliermatrixfrance.fr/WARP.md` | Detailed dev guidelines, model schemas, code examples |

## Repository

**GitHub**: https://github.com/Arc-Rictor/immo-enrichi.git
**Default branch**: `main`

### Git Gotchas
- Repo is inside a cPanel home directory — **never stage cPanel system files** (`.bash_*`, `.cpanel/`, `.ssh/`, `.ftpquota`, etc.)
- Always stage specific files by name, never use `git add .` or `git add -A`
- `.gitignore` excludes `node_modules/`, `vendor/`, `.env`, Laravel cache/logs, build output, and cPanel dirs
- May need `git config --global --add safe.directory` if dubious ownership error occurs on Windows

## Known Gaps

- No CI/CD pipeline configured
- Test coverage missing for: subscriptions, search, favorites, media uploads, CSV imports
- No error tracking/monitoring in production
- No backup strategy documented
