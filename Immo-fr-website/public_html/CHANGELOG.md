# Changelog - Marketing Website (public_html)

## [1.2.0] - 2025-11-23

### Added - French Landing Page Content & Design Refresh (Under Review)

#### New Files Created:
- `fr-changes.html` - Updated French landing page with new branding and layout (Under client review)
- `changes-styles.css` - Standalone stylesheet for the updated design (paired with fr-changes.html)

#### Content Updates Applied:
- **Brand Name**: "Immobilier Matrix France" → "Immo-Erichi"
- **Tagline**: "Le réseau immobilier porté par la force de ses agents" (The real estate network powered by the strength of its agents)
- **Collaboration Message**: "Ici, la collaboration remplace la concurrence" (Here, collaboration replaces competition)
- **Welcome Section**: "Bienvenue chez Immo-Erichi" with new platform messaging
- **Feature Descriptions**: Updated to emphasize collaborative platform benefits
- **Footer**: SVG logo replaced with text-based "Immo-Erichi" branding

#### UI/UX Improvements:
- **Navigation Menu**: Fixed spacing and layout for proper horizontal alignment
- **Hero Heading**: Larger, bolder serif font (54px) with improved letter-spacing
- **Feature Boxes**: Reorganized from side-by-side layout to centered 3-column grid
  - Box 1 (Orange): "Publier et gérer vos biens immobiliers"
  - Box 2 (Light Green): "Flexible et facile à utiliser"
  - Box 3 (Purple): "Une cotisation unique"
- **Feature Cards**: Added subtle background (#fafafa), padding, rounded corners, and hover effects
- **Button Placement**: "Créer un compte" button moved below all three feature boxes
- **Responsive Design**: Grid adapts to 2 columns on tablets, 1 column on mobile
- **Footer Branding**: Professional serif font styling for brand text

#### Technical Details:
- Separate stylesheet (`changes-styles.css`) created to avoid affecting live `fr.html`
- Original `fr.html` and `styles.css` remain completely unchanged
- Responsive breakpoints maintained and enhanced
- All new CSS rules scoped to prevent conflicts

#### Status:
🔄 **Under Client Review** - Ready for feedback before applying to live fr.html

#### Deployment Instructions:
1. Upload both files to `public_html/` directory
2. Client reviews via `https://immobiliermatrixfrance.fr/fr-changes.html`
3. Upon approval, update live `fr.html` with new HTML structure
4. Replace live `styles.css` with updated version
5. Delete `fr-changes.html` and `changes-styles.css` once merged

---

## [1.1.0] - 2025-11-23

### Added - B2B SaaS Redesign (In Review)

#### New Files Created:
- `fr-redesign.html` - French B2B landing page redesign (Under client review)
- `en-redesign.html` - English B2B landing page redesign (Under client review)

#### Design Approach:
Complete redesign of landing pages to position Immobilier Matrix France as a **professional B2B SaaS platform** rather than a consumer property search site.

#### Key Changes:
- **Hero Section**: Features interactive dashboard mockup instead of property images
- **Messaging**: "Boost Your Mandates. Share Your Success" (B2B focused)
- **Feature Grid**: Three core benefits - Collaboration, Direct Leads, Shared Revenue
- **Visual Design**: Professional navy/teal color scheme with modern SaaS aesthetics
- **Pricing Visibility**: Prominent €365/year pricing section
- **Shared Portfolio**: Showcase sample properties with commission data and reference numbers
- **Testimonials**: Real agent testimonials from existing landing pages
- **Interactive Elements**: Smooth scrolling navigation and expandable FAQ accordions

#### Target Audience:
Real Estate Agents & Agencies (B2B) - Emphasizes revenue generation, professional tools, and network collaboration.

#### Status:
🔄 **Under Client Review** - Ready for feedback and iterations

#### Original Files:
Original `en.html` and `fr.html` remain **completely unchanged** for reference.

---

## [1.0.2] - 2025-11-15

### Changed - Branding Elements Removed

#### Visual Elements Removed:
- **Header Logo**: SVG inline logo removed from top-left header position
  - Logo contained "IMMOBILIER MATRIX FRANCE" with "Les Agences du Futur" tagline
  - Container `<div class="home-logo">` preserved with comment placeholder
  
- **Hero Title**: Large heading "Immobilier Matrix France" removed from hero section
  - Container `<div class="hero-heading">` and empty `<h1>` tag preserved
  - Layout spacing maintained

#### Structure Preservation:
- All HTML containers and CSS classes retained
- Page layout and spacing unchanged
- Navigation menu and other header elements unaffected

#### Files Modified:
- `en.html` - Logo and title content removed
- `fr.html` - Logo and title content removed

---

## [1.0.1] - 2025-11-15

### Changed - Agent-Focused Content Update
Updated both English (en.html) and French (fr.html) landing pages to focus exclusively on real estate agents rather than buyers and sellers.

#### Content Removals:
- Removed "to make them visible to buyers worldwide" from subscription description
- Removed "For Sellers" section from info banner
- Removed "For Buyers" section from info banner
- Removed "buyers and sellers" references from platform description text
- Removed "buyers and sellers" from "easy to use" section
- Removed entire "List a property in just 3 easy steps" section (orange background section with image)
- Removed seller subscription pricing (€12/year) from FAQ
- Removed buyer subscription pricing (€12/year) from FAQ
- Removed FAQ: "Can I sell my property using the platform?"
- Removed FAQ: "Puis-je vendre mon bien immobilier par l'intermédiaire de la plateforme?"
- Removed FAQ: "As an agent how will I be notified that a seller has uploaded a property?"
- Removed FAQ: "En tant qu'agent, comment serai-je informé(e) qu'un vendeur a mis un bien en ligne?"
- Removed FAQ: "How many properties can I sell as if I am not an agent?"
- Removed FAQ: "Combien de propriétés puis-je vendre comme si je n'étais pas un agent?"
- Removed FAQ: "Prêt(e) à vous abonner?" (French only)

#### Content Updates:
- Updated platform description from "connects agents, buyers and sellers" to "connects agents"
- Updated ease-of-use text from "for agencies, buyers and sellers" to "for agencies"
- Centered "For Estate Agents" / "Pour les agents immobiliers" section in info banner

#### Remaining Content:
- Agent subscription: €365/year for unlimited property uploads
- "For Estate Agents" section remains as the sole focus
- All agent-specific features and FAQs retained

### Technical Details:
- Files modified: `en.html`, `fr.html`
- Both English and French versions updated identically
- All changes maintain existing HTML structure and CSS classes
