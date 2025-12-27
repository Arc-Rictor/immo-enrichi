# Project Changelog - Immobilier Matrix France

All notable project-level changes will be documented in this file.

## [1.3.0] - 2025-12-27

### Deployed - Production Update: Property Carousel & Pricing Section

#### Overview
Major production deployment featuring updated property carousel with real listings, new pricing section, restored missing content sections, and CSS optimizations.

#### Files Deployed

**HTML Files:**
- `public_html/en.html` - Property carousel updated, pricing section added, cache-busting CSS parameter, footer link fixes
- `public_html/fr.html` - Property carousel updated (French translations), pricing section added, cache-busting CSS parameter, footer link fixes

**Stylesheets:**
- `public_html/styles.css` - Added complete pricing section CSS (~230 lines), optimized spacing

**JavaScript:**
- `public_html/main.js` - Updated Swiper carousel initialization

**Images:**
- `property1.png` - Villa in Terre-de-Haut 97137
- `property2.png` - Maison in Parigné-l'Évêque 72250
- `property3.png` - Maison in Vérines 17540
- `property4.png` - Maison in La Chapelle-sur-Erdre 44240

#### Property Carousel Updates

**Replaced placeholder properties with 4 real listings:**

1. **Villa in Terre-de-Haut 97137**
   - Price: €890,000.00
   - Details: 5 bed, 5 bath, 188M²
   - Description: "Stunning 5-bedroom villa with pool and sea views..."
   - French: "Superbe villa de 5 chambres avec piscine et vue mer..."

2. **Maison in Parigné-l'Évêque 72250**
   - Price: €455,000.00
   - Details: 6 bed, 5 bath, 200M²
   - Description: "Charming 6-bedroom family home..."
   - French: "Charmante maison familiale de 6 chambres..."

3. **Maison in Vérines 17540 · Quartier Loiré**
   - Price: €460,000.00
   - Details: 6 bed, 5 bath, 155M²
   - Description: "Delightful single-story home with pool in Loiré..."
   - French: "Charmante maison de plain-pied avec piscine à Loiré..."

4. **Maison in La Chapelle-sur-Erdre 44240 · Quartier La Croix de Pierre**
   - Price: €540,000.00
   - Details: 8 bed, 5 bath, 155M²
   - Description: "Spacious 8-bedroom family home nestled within a beautiful 3200m² park..."
   - French: "Vaste maison familiale de 8 chambres nichée dans un magnifique parc de 3200m²..."

**Technical Implementation:**
- Removed all placeholder properties (originally 10+ duplicate entries)
- Created separate Swiper instances for properties carousel and testimonials carousel
- Configured responsive breakpoints for optimal viewing on all devices
- All property descriptions fully translated for French version

#### Pricing Section Added

**New Section: "Simple and Transparent Pricing"**
- Single-column centered layout with professional card design
- Annual Plan: €365/year (about €30/month)
- Three key highlights displayed as cards:
  1. List and manage your properties
  2. Flexible and easy to use
  3. A single subscription
- "Start Free Trial" CTA button
- Responsive design (3 columns → 1 column on mobile)
- French version: "Tarification simple et transparente"

**CSS Implementation:**
- Added ~230 lines of pricing-specific CSS to styles.css
- Includes: .pricing-section, .pricing-card, .pricing-highlights, .pricing-btn, etc.
- Responsive breakpoints for 1920px, 1600px, 1400px, 1024px, 768px, mobile
- Custom styling for price display (large €365 typography)

#### Content Sections Restored

**Between Property Carousel and Pricing Section:**
1. **"The simplest platform..." banner section**
   - English: "The simplest platform to collaborate and manage your properties in France."
   - French: "La plateforme la plus simple pour collaborer et gérer vos biens immobiliers en France."

2. **Three feature cards section**
   - List and manage your properties / Publier et gérer vos biens immobiliers
   - Flexible and easy to use / Flexible et facile à utiliser
   - A single subscription / Une cotisation unique
   - "Create an account" button below cards

**Why Restored:**
- These sections were accidentally removed during previous carousel cleanup
- Caused pricing section to appear immediately after carousel with formatting errors
- Now properly positioned with correct HTML structure

#### CSS Optimizations

**Spacing Adjustments:**
- Reduced pricing section top padding: 140px → 50px (desktop)
- Reduced pricing section top padding: 100px → 40px (tablet)
- Reduced pricing section top padding: 50px → 30px (mobile)
- Improved visual flow between content sections

#### Cache Management

**Cache-Busting Parameter Added:**
- Updated CSS link from `styles.css` to `styles.css?v=20251227`
- Forces browsers to reload updated stylesheet
- Prevents users from seeing cached version without CSS updates
- Applied to both en.html and fr.html

#### Bug Fixes

**Footer Logo Links:**
- Fixed en.html footer: `en-sandbox.html` → `en.html`
- Fixed fr.html footer: `fr-sandbox.html` → `fr.html`
- Ensures footer logo links to correct production page

**Carousel Styling:**
- Fixed property cards displaying with incorrect black backgrounds online
- Ensured main.js properly initializes Swiper carousels
- Verified all carousel CSS classes properly styled

#### Files Modified

```
public_html/
  - en.html (carousel updated, pricing added, cache parameter, footer fix)
  - fr.html (carousel updated with French translations, pricing added, cache parameter, footer fix)
  - styles.css (pricing CSS added, spacing optimized)
  - main.js (Swiper initialization confirmed)
  - property1.png (new image)
  - property2.png (new image)
  - property3.png (new image)
  - property4.png (new image)

Documentation:
  - README.md (updated with Dec 27 changes)
  - CHANGELOG.md (this entry)
  - public_html/CHANGELOG.md (updated)
```

#### Testing Completed

- [x] Property carousel displays 4 real listings correctly
- [x] Property carousel cycles/swipes properly
- [x] Pricing section displays with correct formatting
- [x] Pricing section spacing optimized
- [x] Missing content sections restored between carousel and pricing
- [x] CSS cache-busting parameter working
- [x] Footer logo links correct
- [x] French translations accurate
- [x] Responsive design functional on all breakpoints
- [x] All images loading correctly
- [x] Swiper carousels initializing properly

#### Deployment Notes

**Upload Order:**
1. styles.css (updated with pricing section CSS)
2. en.html (updated HTML with cache parameter)
3. fr.html (updated HTML with cache parameter)
4. main.js (Swiper initialization)
5. property1.png, property2.png, property3.png, property4.png

**Browser Cache:**
- Users may need to perform hard refresh (Ctrl+Shift+R / Cmd+Shift+R)
- Cache-busting parameter should force reload automatically

---

## [1.2.2] - 2025-12-17

### Changed - Brand Name Correction & Mobile Logo Enhancement (Sandbox)

#### Overview
Corrected brand name from "Immo-Erichi" to "Immo-Enrichi" throughout sandbox files and increased mobile logo size for better visibility.

#### Brand Name Correction

**Scope:**
- Corrected all references from "Immo-Erichi" to "Immo-Enrichi"
- Applied to both English and French sandbox pages
- Total of 20 text occurrences updated

**Locations Updated:**
- Page titles (`<title>` tags)
- Header logo `aria-label` and `alt` attributes
- Welcome headings ("Welcome to Immo-Enrichi" / "Bienvenue chez Immo-Enrichi")
- Info banner platform references
- Latest properties section text
- "Ready to join" section text
- Footer logo `aria-label` and `alt` attributes
- Copyright notices

**Note:** Image file names (`Immo-Erichi_Logo1.png`) remain unchanged as physical files.

#### Mobile Logo Enhancement

**Change:**
- Increased mobile logo size from 100px to 150px (50% increase)
- Applied to screens under 1023px width via media query

**Benefits:**
- Improved visibility on mobile devices
- Better brand presence on smaller screens
- Enhanced mobile user experience

#### Files Modified

```
public_html/
  - en-sandbox.html (brand name corrected - 10 occurrences)
  - fr-sandbox.html (brand name corrected - 10 occurrences)
  - styles-sandbox.css (mobile logo size increased)

Documentation:
  - README.md (updated with latest changes)
  - CHANGELOG.md (this entry)
  - app.immobiliermatrixfrance.fr/WARP.md (updated marketing site status)
```

#### Status

- [x] Brand name corrected in English sandbox
- [x] Brand name corrected in French sandbox
- [x] Mobile logo size increased
- [x] Documentation updated
- [ ] Changes not yet deployed to live (sandbox only)

---

## [1.2.0] - 2025-11-29

### Deployed - Immo-Erichi Rebrand Live in Production

#### Overview
Deployed the complete Immo-Erichi rebrand to production. All marketing pages now live with new branding, bilingual support, and language persistence for authentication flows.

#### Deployment Changes

**Files Deployed:**
- `fr-changes.html` → `fr.html` (replaced old French page)
- `en-changes.html` → `en.html` (replaced old English page)
- `changes-styles.css` → `styles.css` (replaced old stylesheet)

**Backup Files Created:**
- `fr.html.backup` - Original French page preserved
- `en.html.backup` - Original English page preserved
- `styles.css.backup` - Original stylesheet preserved

**Link Updates:**
- Updated CSS references in both HTML files: `changes-styles.css` → `styles.css`
- Updated language switcher links: `-changes.html` → `.html` format
- French page: Links to `en.html`
- English page: Links to `fr.html`

**Language Persistence Added:**
- All registration links now include locale parameter: `?locale=fr` or `?locale=en`
- All login links now include locale parameter: `?locale=fr` or `?locale=en`
- Ensures Laravel app receives user's preferred language from marketing site
- Applied to 6 locations per page (header, mobile menu, CTAs)

#### Git Repository Maintenance

**Cleanup:**
- Removed corrupted `.nvm` folders causing git index errors
- Fixed git status functionality

**Commits:**
- `31d49b40` - Deploy Immo-Erichi rebrand: Replace old pages with new design and English translation
- `fb9f4090` - Remove corrupted .nvm folders that were causing git index errors  
- `ae8bf970` - Add locale query parameters to all auth links for language persistence

#### Files Modified

```
public_html/
  - fr.html (deployed with locale parameters)
  - en.html (deployed with locale parameters)
  - styles.css (deployed)
  - fr.html.backup (created)
  - en.html.backup (created)
  - styles.css.backup (created)

Documentation:
  - README.md (updated to reflect deployment)
  - CHANGELOG.md (this entry)
```

#### Testing Completed

- [x] French landing page displays correctly
- [x] English landing page displays correctly
- [x] Language switcher works bidirectionally
- [x] All auth links include correct locale parameters
- [x] CSS loaded correctly on both pages
- [x] All internal links functional
- [x] Backup files preserved
- [x] Git repository clean and committed

---

## [1.1.0] - 2025-11-28

### Added - Complete Rebrand to Immo-Erichi & English Translation

#### Overview
Complete rebrand of marketing website from "Immobilier Matrix France" to "Immo-Erichi" with full bilingual support (French and English).

#### Marketing Website Changes (`public_html/`)

**New Files Created:**
- `fr-changes.html` - Redesigned French landing page with new branding
- `en-changes.html` - Full English translation of redesigned landing page
- `changes-styles.css` - Updated stylesheet for new design

**Branding Changes:**
- "Immobilier Matrix France" → "Immo-Erichi" throughout
- New text-based logo in header and footer
- Updated hero messaging emphasizing agent collaboration

**Design Updates:**
- Navigation: Fixed menu spacing, added FR/EN language switcher with flag icons
- Hero: Larger, bolder heading (54px serif font)
- Features: 3-column responsive grid layout
- Improved card styling and visual hierarchy

**English Translation:**
- Complete translation of all content sections
- Navigation and menus
- Hero section and CTAs
- Features and testimonials
- FAQ section (4 questions)
- Footer links and sections
- Property cards (location, description, bed/bath labels)
- Price format localised: "€ 144.220,00" → "€ 144,220.00"

**Status:** Under client review

#### Version Control

**Git Repository Initialised:**
- Local git repository created at `E:\Laurens_Immo_Website`
- Initial commit includes full project
- Author: Arc_Rictor <arcrictor@home.com>

#### Files Modified/Created

```
public_html/
  - fr-changes.html (redesigned French page)
  - en-changes.html (new English translation)
  - changes-styles.css (updated styles)

Documentation:
  - README.md (updated)
  - CHANGELOG.md (updated)
```

---

## [1.0.2] - 2025-11-15

### Changed - Marketing Website Branding Update

#### Overview
Removed visible branding elements from the marketing website landing pages while preserving HTML structure and layout.

#### Marketing Website Changes (`public_html/`)

**Elements Removed:**
- Header logo (SVG inline graphic) - Replaced with empty placeholder
- Hero title "Immobilier Matrix France" - Replaced with empty h1 tag

**Structure Preserved:**
- `<div class="home-logo">` container retained (empty)
- `<div class="hero-heading">` and `<h1>` tags retained (empty content)
- All CSS classes and layout structure unchanged
- Page spacing and positioning maintained

**Languages Affected:**
- English (`en.html`)
- French (`fr.html`)
- Both updated identically

#### Technical Implementation

- Logo SVG code removed, container preserved
- Hero title text content cleared
- HTML semantic structure maintained for future updates
- No CSS changes required

#### Files Modified

```
public_html/
  - en.html (logo and title content removed)
  - fr.html (logo and title content removed)
```

---

## [1.0.1] - 2025-11-15

### Changed - Marketing Strategy Shift to Agent-Only Focus

#### Overview
Updated the public marketing website (`public_html/`) to focus exclusively on real estate agents, removing all buyer and seller promotional content. This strategic change simplifies the marketing message and focuses on the primary revenue source (agent subscriptions at €365/year).

**Important**: The backend application (`app.immobiliermatrixfrance.fr/`) remains unchanged and continues to fully support all user types (Agents, Buyers, Sellers, Admins).

#### Marketing Website Changes (`public_html/`)

**Content Removed:**
- "For Sellers" information section
- "For Buyers" information section  
- "List a property in just 3 easy steps" feature section (with image)
- Seller subscription pricing (€12/year)
- Buyer subscription pricing (€12/year)
- Text phrase "to make them visible to buyers worldwide"
- Text phrase "buyers and sellers" from multiple locations
- FAQ: "Can I sell my property using the platform?"
- FAQ: "As an agent how will I be notified that a seller has uploaded a property?"
- FAQ: "How many properties can I sell as if I am not an agent?"

**Content Updated:**
- Platform description updated from "connects agents, buyers and sellers" to "connects agents"
- Ease-of-use statement updated from "for agencies, buyers and sellers" to "for agencies"
- "For Estate Agents" section centered on page (now the sole focus)

**Retained:**
- Agent subscription pricing: €365/year
- Agent features and benefits
- Agent FAQ items
- Complete agent-focused value proposition

**Languages Affected:**
- English (`en.html`)
- French (`fr.html`)
- Both updated identically

#### Backend Application Status

**No Changes to:**
- Laravel application functionality
- Database schema
- User type support (Admin, Agents, Buyers, Sellers)
- Subscription features for any user type
- API endpoints
- Vue 3 frontend components

The application continues to fully support buyers and sellers despite the marketing site changes.

#### Documentation Updates

**Created:**
- `/README.md` - Project-level overview explaining dual-site structure
- `/CHANGELOG.md` - This file, project-level changes
- `/public_html/CHANGELOG.md` - Detailed marketing site changes

**Updated:**
- `/app.immobiliermatrixfrance.fr/README.md` - Added marketing site change note
- `/app.immobiliermatrixfrance.fr/WARP.md` - Updated project context

#### Rationale

1. **Simplified Marketing Message**: Focus on one audience (agents) rather than three
2. **Primary Revenue Focus**: Agents generate €365/year vs €12/year for buyers/sellers
3. **Reduced Confusion**: Clear value proposition for target audience
4. **Backend Flexibility Maintained**: Can pivot marketing strategy without code changes

#### Impact Assessment

- **Marketing Site**: Agent-only promotional content
- **Application Access**: All user types can still register and use platform
- **Revenue Model**: Backend still supports all subscription tiers
- **Future Flexibility**: Marketing can be updated independently of backend

#### Files Modified

```
public_html/
  - en.html (10 sections removed/updated)
  - fr.html (10 sections removed/updated)

Documentation created/updated:
  - /README.md (created)
  - /CHANGELOG.md (created)
  - /public_html/CHANGELOG.md (created)
  - /app.immobiliermatrixfrance.fr/README.md (updated)
  - /app.immobiliermatrixfrance.fr/WARP.md (updated)
```

#### Testing Checklist

- [x] English landing page displays correctly
- [x] French landing page displays correctly
- [x] All agent features visible
- [x] No buyer/seller content visible
- [x] FAQ section shows only agent-relevant items
- [x] Links functional
- [x] Responsive design maintained
- [x] Documentation updated

---

## [1.0.0] - 2025-11-01

### Initial Setup

- Laravel 10 application deployed
- Vue 3 frontend implemented
- Stripe payment integration active
- Multi-language support (EN/FR)
- Static marketing website live
- Database migrations completed
- Production environment configured

---

## Documentation Structure

This CHANGELOG covers **project-level changes** affecting strategy, structure, or multiple components.

For component-specific changes, see:
- `public_html/CHANGELOG.md` - Marketing website details
- `app.immobiliermatrixfrance.fr/` - Laravel app changes (in commit history when Git is added)

---

**Changelog Format**: Based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)  
**Versioning**: Semantic versioning when Git is implemented
