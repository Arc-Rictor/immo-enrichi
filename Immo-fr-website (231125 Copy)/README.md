# Immobilier Matrix France - Project Overview

**Real estate platform with agent-focused marketing and full-featured backend application**

## Quick Start

This project consists of **two separate websites**:

1. **Marketing Website** (`public_html/`) - Static HTML landing pages (French & English)
   - **Purpose**: Public-facing marketing site
   - **Current Focus**: Agent-only promotion (as of Nov 2025)
   - **Technology**: HTML, CSS (SCSS), JavaScript
   - **Files**: `en.html`, `fr.html`

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
│   ├── en.html                       ← English landing page
│   ├── fr.html                       ← French landing page
│   ├── styles.css                    ← Compiled styles
│   ├── *.scss                        ← Source SCSS files
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

**To edit:**
1. Edit `public_html/en.html` or `public_html/fr.html`
2. Changes are live immediately (no build process)
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

### November 2025 - French Landing Page Content & Design Refresh (Latest)
**New Files Under Client Review:**
- `public_html/fr-changes.html` - Completely redesigned French landing page
- `public_html/changes-styles.css` - Updated stylesheet for new design

**Key Updates:**
- **Branding**: "Immobilier Matrix France" → "Immo-Erichi"
- **Navigation**: Fixed menu spacing and layout
- **Hero**: Larger, bolder heading (54px serif font)
- **Features**: 3-column responsive grid layout with improved cards
- **Footer**: Text-based "Immo-Erichi" branding
- **New Content**: Updated messaging emphasizing collaboration and agent network
- **Status**: 🔄 Under client review via `fr-changes.html`

**Deployment Plan:**
1. Client reviews and approves `fr-changes.html`
2. Upon approval, update live `fr.html` and `styles.css`
3. Clean up temporary `fr-changes.*` files

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

**Not a Git repository**: This directory structure is a local copy from the production server. Version control is not currently implemented.

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

**Last Updated**: November 2025  
**Project Version**: 1.0.2  
**Marketing Site**: Agent-focused, branding removed (Nov 2025)  
**Backend**: Full multi-tenant support maintained
