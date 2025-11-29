# Project Changelog - Immobilier Matrix France

All notable project-level changes will be documented in this file.

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
