# Immobilier Matrix France - Project Overview

**Real estate platform with agent-focused marketing and full-featured backend application**

## Quick Start

This project consists of **two separate websites**:

1. **Marketing Website** (`public_html/`) - Static HTML landing pages (French & English)
   - **Purpose**: Public-facing marketing site
   - **Current Focus**: Agent-only promotion (as of Nov 2025)
   - **Technology**: HTML, CSS (SCSS), JavaScript
   - **Files**: `fr.html` (French), `en.html` (English)
   - **Branding**: Immo-Erichi (deployed Nov 29, 2025)

2. **Laravel Application** (`app.immobiliermatrixfrance.fr/`) - Full SaaS platform
   - **Purpose**: Real estate management platform
   - **Users**: Agents, Buyers, Sellers, Admins (all supported)
   - **Technology**: Laravel 10, Vue 3, Stripe, MySQL
   - **Access**: `https://app.immobiliermatrixfrance.fr`

## Important Note: Marketing Strategy Change (November 2025)

**The marketing website now promotes only real estate agents**, removing all buyer/seller focused content. However, **the backend application still fully supports all user types** (agents, buyers, sellers, admins).

**Why the change?**
- Simplified marketing message
- Focus on primary revenue source (agent subscriptions at €365/year)
- Removed €12/year buyer/seller subscription pricing from public view

See `CHANGELOG.md` for complete details.

## Project Structure

```
Immo-fr-website/
├── README.md                          ← You are here (project overview)
├── CHANGELOG.md                       ← Project-level changes
│
├── public_html/                       ← MARKETING WEBSITE (Static HTML)
│   ├── en.html                       ← English landing page (LIVE)
│   ├── fr.html                       ← French landing page (LIVE)
│   ├── en-sandbox.html               ← English landing page (SANDBOX)
│   ├── fr-sandbox.html               ← French landing page (SANDBOX)
│   ├── styles.css                    ← Compiled styles (LIVE)
│   ├── styles-sandbox.css            ← Compiled styles (SANDBOX)
│   ├── *.scss                        ← Source SCSS files
│   ├── Immo-Erichi_Logo1.png         ← Current Immo-Erichi logo (used in sandbox header/footer)
│   ├── *.png, *.jpg                  ← Marketing images
│   └── CHANGELOG.md                  ← Marketing site changes
│
├── app.immobiliermatrixfrance.fr/    ← LARAVEL APPLICATION (Backend + Frontend)
│   ├── app/                          ← Laravel backend
│   ├── resources/js/                 ← Vue 3 frontend
│   ├── database/                     ← Migrations, seeds
│   ├── README.md                     ← Laravel app documentation
│   ├── WARP.md                       ← Development guidelines
│   └── [standard Laravel structure]
│
└── [other cPanel directories]        ← Hosting environment files
```

## Getting Started

### For Marketing Site Changes
The marketing site is **static HTML** hosted in `public_html/`.

#### Sandbox workflow (recommended)
When redesigning the landing pages, use the sandbox files first so the live pages remain untouched:
- English sandbox: `public_html/en-sandbox.html`
- French sandbox: `public_html/fr-sandbox.html`
- Shared sandbox stylesheet (both pages): `public_html/styles-sandbox.css`

Notes:
- The sandbox pages are wired to each other via the top-right language switcher.
- The sandbox pages currently include the new pricing panel section (`#pricing`) and updated navigation links.

#### Go live (when approved)
When you’re ready to publish:
1. Back up the live files (keep a copy of `public_html/en.html`, `public_html/fr.html`, `public_html/styles.css`).
2. Copy sandbox → live:
   - `en-sandbox.html` → `en.html`
   - `fr-sandbox.html` → `fr.html`
   - `styles-sandbox.css` → `styles.css`

#### Direct live edits (not recommended for redesign)
If you must edit the live pages directly:
1. Edit `public_html/en.html` or `public_html/fr.html`
2. Update `public_html/styles.css` (or SCSS sources if you rebuild CSS)
3. Update `public_html/CHANGELOG.md` if significant

**Accessible at:** `https://immobiliermatrixfrance.fr`

### For Application Development
The Laravel application is in `app.immobiliermatrixfrance.fr/`.

**To develop locally:**
```bash
cd app.immobiliermatrixfrance.fr
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate

# Terminal 1
npm run dev

# Terminal 2
php artisan serve
```

**See:** `app.immobiliermatrixfrance.fr/README.md` for full setup instructions

## User Types & Features

### Backend Application (Full Support)
- **Agents**: €365/year, unlimited listings, 90-day trial
- **Buyers**: Search, favorites, express interest
- **Sellers**: List properties, agent matching
- **Admins**: Full system management

### Marketing Website (Agent-Only Promotion)
- Only promotes agent features and €365/year subscription
- Buyer/seller features removed from public view (Nov 2025)
- Both English and French versions updated identically

## Key Technologies

### Marketing Site
- Pure HTML5, CSS3, SCSS
- jQuery for interactions
- Swiper.js for carousels
- Responsive design (mobile-first)

### Laravel Application
- **Backend**: Laravel 10.10, PHP 8.1+
- **Frontend**: Vue 3, Inertia.js, Tailwind CSS
- **Database**: MySQL
- **Payments**: Stripe (Laravel Cashier)
- **Media**: Spatie Media Library
- **Maps**: Google Maps API

## Recent Changes

### December 27, 2025 - Production Deployment: Carousel Updates & Pricing Section
**Status**: Live in production

**Files Deployed:**
- `public_html/en.html` - Updated with 4 new property carousel items, pricing section, and cache-busting CSS parameter
- `public_html/fr.html` - Updated with 4 new property carousel items (French translations), pricing section, and cache-busting CSS parameter
- `public_html/styles.css` - Added pricing section CSS and carousel styling fixes
- `public_html/main.js` - Updated Swiper initialization for properties and testimonials carousels

**Key Updates:**
- **Property Carousel**: Replaced placeholder properties with 4 real listings:
  - Villa in Terre-de-Haut 97137 (€890,000 - 5 bed, 5 bath, 188M²)
  - Maison in Parigné-l'Évêque 72250 (€455,000 - 6 bed, 5 bath, 200M²)
  - Maison in Vérines 17540 (€460,000 - 6 bed, 5 bath, 155M²)
  - Maison in La Chapelle-sur-Erdre 44240 (€540,000 - 8 bed, 5 bath, 155M²)
- **Pricing Section**: Added "Simple and Transparent Pricing" section with €365/year plan details
- **Missing Sections Restored**: Added "The simplest platform..." banner and three feature cards between carousel and pricing
- **CSS Optimizations**: Reduced gap spacing above pricing section (50px on desktop)
- **Cache Management**: Added cache-busting parameter (?v=20251227) to CSS links
- **Footer Links**: Fixed footer logo links from sandbox references to production files

**Property Images:**
- `property1.png` - Villa in Terre-de-Haut
- `property2.png` - Maison in Parigné-l'Évêque  
- `property3.png` - Maison in Vérines
- `property4.png` - Maison in La Chapelle-sur-Erdre

**Technical Implementation:**
- Separate Swiper instances for properties and testimonials carousels
- Responsive pricing card layout (3 columns on desktop, stacks on mobile)
- All content fully translated in both English and French versions

### December 17, 2025 - Brand Name Correction & Mobile Logo Enhancement
**Status**: Sandbox only (superseded by Dec 27 production deployment)

**Brand Name Correction:**
- Corrected brand name from "Immo-Erichi" to "Immo-Enrichi" throughout sandbox files
- Updated in both English and French versions (20 occurrences total)
- Locations updated: page titles, header/footer logos, welcome text, platform references, copyright notices

**Mobile Logo Enhancement:**
- Increased mobile logo size by 50% (from 100px to 150px)
- Applied to screens under 1023px width
- Improves visibility and branding on mobile devices

**Files Modified:**
- `public_html/en-sandbox.html`
- `public_html/fr-sandbox.html`
- `public_html/styles-sandbox.css`

### December 13, 2025 - Landing Page Sandbox + Pricing Panel
**Status**: Sandbox only

**Added sandbox files:**
- `public_html/en-sandbox.html`
- `public_html/fr-sandbox.html`
- `public_html/styles-sandbox.css`

**Key sandbox updates:**
- Added a pricing panel section (`#pricing`) and updated nav links to match
- Added Immo-Enrichi logo to header and footer in sandbox pages
- Improved header/footer link consistency between EN/FR sandbox pages

### November 29, 2025 - Immo-Erichi Rebrand Deployed ✅
**Status**: Live in production

**Deployed Files:**
- `public_html/fr.html` - Rebranded French landing page
- `public_html/en.html` - English landing page with full translation
- `public_html/styles.css` - Updated stylesheet for new design

**Key Updates:**
- **Branding**: "Immobilier Matrix France" → "Immo-Erichi"
- **Navigation**: Fixed menu spacing and layout, language switcher (FR/EN flags)
- **Hero**: Larger, bolder heading (54px serif font)
- **Features**: 3-column responsive grid layout with improved cards
- **Footer**: Text-based "Immo-Erichi" branding
- **New Content**: Updated messaging emphasizing collaboration and agent network
- **Bilingual**: Both French and English versions fully translated
- **Language Persistence**: All auth links include `?locale=fr` or `?locale=en` parameters to maintain user language preference when signing up or logging in

**Technical Implementation:**
- Backup files preserved: `*.html.backup`, `*.css.backup`
- All internal links updated to reference new filenames
- CSS references corrected from `changes-styles.css` to `styles.css`
- Language switcher links point to correct pages (`fr.html` ↔ `en.html`)

### November 2025 - Marketing Site Branding Update
**Removed from marketing site:**
- Header logo (SVG) - Top-left "IMMOBILIER MATRIX FRANCE" logo
- Hero title - Large "Immobilier Matrix France" heading
- HTML structure preserved (empty containers maintain layout)
- Both English and French pages updated

### November 2025 - Marketing Site Agent-Focus Update
**Removed from marketing site:**
- "For Sellers" and "For Buyers" sections
- Seller/buyer subscription pricing (€12/year)
- Multiple seller/buyer-related FAQs
- "List a property in 3 steps" section
- References to "buyers and sellers" throughout

**Kept:**
- All agent features and benefits
- Agent subscription (€365/year)
- "For Estate Agents" section (centered)
- Complete agent-focused messaging

**Backend unchanged:** All functionality remains available

## Documentation

| File | Purpose | Audience |
|------|---------|----------|
| `/README.md` | Project overview (this file) | All developers |
| `/CHANGELOG.md` | Project-level changes | All developers |
| `/public_html/CHANGELOG.md` | Marketing site changes | Frontend/content |
| `/app.immobiliermatrixfrance.fr/README.md` | Laravel app setup | Backend developers |
| `/app.immobiliermatrixfrance.fr/WARP.md` | Development guidelines | All developers |

## Environment

**Hosting**: cPanel shared hosting (production)
**Production URLs**:
- Marketing: `https://immobiliermatrixfrance.fr`
- Application: `https://app.immobiliermatrixfrance.fr`

**Version Control**: Git repository initialised (Nov 2025). Initial commit contains full project including rebranded landing pages.

## Quick Reference

### I need to...
- **Update marketing text**: Edit `public_html/en.html` or `public_html/fr.html`
- **Change agent pricing**: Update both marketing HTML and Laravel app
- **Add new Laravel features**: Work in `app.immobiliermatrixfrance.fr/`
- **Understand recent changes**: Read `CHANGELOG.md` (this level) and `public_html/CHANGELOG.md`
- **Set up dev environment**: Follow `app.immobiliermatrixfrance.fr/README.md`

## Support & Questions

For project-specific questions:
1. Check the relevant README in the component directory
2. Review CHANGELOG files for recent changes
3. Contact the development team

---

**Last Updated**: December 27, 2025  
**Project Version**: 1.3.0  
**Marketing Site**: Production deployment with carousel fixes, pricing section, and CSS optimizations (Dec 27, 2025)  
**Backend**: Full multi-tenant support maintained  
**Version Control**: Git repository active
