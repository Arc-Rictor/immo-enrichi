# HubSpot CRM Integration Report

**Project**: Immo-Enrichi Marketing Website
**Date**: 7 March 2026
**Status**: Proposal / Investigation

---

## 1. Current State

The marketing site (`immobiliermatrixfrance.fr`) currently has:

| Touchpoint | Current Behaviour | CRM Connected? |
|---|---|---|
| Contact form | Sends email to `imf-info@mail.com` via `contact.php` | No |
| 9 registration CTAs | Redirect to `app.immobiliermatrixfrance.fr/register` | No |
| 4 login links | Redirect to `app.immobiliermatrixfrance.fr/login` | No |
| Google Analytics (GA4) | Tracks page views (`G-EVPV61PVMB`) | Analytics only |

**Key gaps**:
- Contact form data is emailed but not stored in any database or CRM
- No visitor identification or lead tracking
- No way to see which pages a lead visited before making an enquiry
- No follow-up pipeline or lead management
- No connection between marketing site visits and app registrations

---

## 2. What HubSpot Can Provide

### 2.1 Tracking Code (Free)

A JavaScript snippet added to every page. Once installed it:
- Records all page views and sessions per visitor
- Sets a `hubspotutk` cookie to identify returning visitors
- When a visitor later submits a form, all prior anonymous page views are retroactively linked to their contact record
- Captures referral sources, UTM parameters, and traffic attribution
- Enables cross-domain tracking between the marketing site and the app
- Supports GDPR cookie consent banners
- **Prerequisite for all other HubSpot features**

### 2.2 Forms (Free)

Two options for getting form data into HubSpot:

**Option A: Embedded HubSpot Forms**
- HubSpot generates a JavaScript snippet per form
- Paste into HTML where you want the form to appear
- Submissions go directly to HubSpot, creating/updating contact records
- Supports progressive profiling and dependent fields
- Downside: HubSpot branding on free tier

**Option B: Custom Form + API (Recommended)**
- Keep the existing HTML contact form and `contact.php` handler
- Update `contact.php` to also POST form data to the HubSpot Forms API
- Include the `hubspotutk` cookie value to link browsing history
- Full design control, no HubSpot branding
- Fits naturally with the existing PHP backend

### 2.3 Live Chat / Chatbot (Free)

- Deploys automatically once the tracking code is installed
- Create "chatflows" in HubSpot (live agent or automated chatbot)
- Configure which pages show the chat widget and to which visitor segments
- Bots can qualify leads, book meetings, answer common questions
- Conversations stored in HubSpot's shared inbox
- HubSpot branding on free tier

### 2.4 CTA Tracking (Free)

- Create tracked buttons in HubSpot that record every view and click
- Each click is attributed to the visitor's contact record
- Useful for measuring click-through rates on "Start Your Free Trial" buttons
- Embed via JavaScript snippet
- Requires tracking code to be installed

### 2.5 Meeting Scheduler

- Calendar widget where visitors can book time with the team
- Integrates with Gmail, Outlook, Office 365
- Shows real-time availability
- **Free tier**: 1 meeting link, but must link to HubSpot-hosted page
- **Starter tier** ($20/seat/month): Embed widget directly in site

### 2.6 Cross-Domain Tracking (Free)

- Links visitor activity across `immobiliermatrixfrance.fr` and `app.immobiliermatrixfrance.fr`
- Uses link parameters (`__hsfp`, `__hssc`, `__hstc`) to merge visitor profiles
- Full journey visibility: marketing site visit to app registration in one timeline

---

## 3. HubSpot Free Tier Summary

The free CRM is permanent (not a trial):

| Feature | Free Tier | Limitation |
|---|---|---|
| Contacts | Up to 1,000,000 | Marketing contacts limited to ~1,000 |
| User seats | 2 | |
| Email marketing | 2,000 emails/month | HubSpot branding |
| Forms | Unlimited | HubSpot branding on embedded forms |
| Live chat / chatbot | Basic chatbot, 1 shared inbox | HubSpot branding |
| Meeting scheduling | 1 meeting link | Link only, no embed (embed needs Starter) |
| CTA tracking | Available | HubSpot branding |
| Pipelines | 1 per module | |
| Custom properties | 10 | |
| Dashboards | 3 dashboards, 10 reports each | |

**Not included on free**: Workflow automation, lead scoring, A/B testing, advanced analytics, HubSpot branding removal, email support.

**Starter plan** ($20/seat/month) adds: Branding removal, simple automation, meeting embed, email support, multiple pipelines.

---

## 4. Recommended Implementation

### Tier 1: Foundation (Free, ~1 hour)

**What**: Add HubSpot tracking code to `en.html` and `fr.html`.

**Result**: All visitor activity tracked in HubSpot. Enables live chat/chatbot deployment from HubSpot dashboard.

**Technical steps**:
1. Create a free HubSpot account
2. Copy the tracking code from Settings > Tracking & Analytics > Tracking Code
3. Add the snippet before `</body>` in both `en.html` and `fr.html`
4. Add the marketing site domain in HubSpot settings

---

### Tier 2: Form Integration (Free, ~2-3 hours) -- RECOMMENDED

**What**: Everything in Tier 1, plus update `contact.php` to forward form submissions to HubSpot via the Forms API.

**Result**: Every contact form submission creates a HubSpot contact record with full browsing history. No changes to the existing form design. No HubSpot branding.

**Technical steps**:
1. Complete Tier 1
2. Create a form in HubSpot (to get the Form GUID)
3. Create a Private App in HubSpot for API authentication
4. Update `contact.php` to:
   - Read the `hubspotutk` cookie from the request
   - POST form data + cookie + page context to HubSpot Forms API
   - Keep existing email delivery as a backup

**API endpoint**:
```
POST https://api.hsforms.com/submissions/v3/integration/submit/{portalId}/{formGuid}
```

**Payload structure**:
```json
{
  "fields": [
    { "name": "email", "value": "visitor@example.com" },
    { "name": "firstname", "value": "Jean" },
    { "name": "phone", "value": "+33 6 00 00 00 00" },
    { "name": "message", "value": "..." }
  ],
  "context": {
    "hutk": "<hubspotutk cookie value>",
    "pageUri": "https://immobiliermatrixfrance.fr/fr.html",
    "pageName": "Page d'accueil"
  }
}
```

**Important**: The `hutk` value links all prior anonymous page views to the new contact. Omitting it is the most common integration mistake.

---

### Tier 3: Full Pipeline (Free/Starter, ~half day)

**What**: Everything in Tiers 1-2, plus CTA tracking, meeting scheduler, and cross-domain tracking.

**Result**: Complete lead-to-customer pipeline visible in HubSpot.

**Additional steps**:
1. Set up HubSpot CTA tracking on key buttons (e.g., "Start Your Free Trial")
2. Add meeting scheduler link to the contact section
3. Configure cross-domain tracking between marketing site and app
4. Add UTM parameter capture as hidden form fields for lead source attribution

---

## 5. Prerequisites from Client

Before implementation can begin, we need:

| Item | Required For | How To Get It |
|---|---|---|
| HubSpot account | All tiers | Sign up at hubspot.com (free) |
| Portal ID | Tracking code, API | Found in HubSpot Settings > Account |
| Form GUID | Tier 2+ | Create a form in HubSpot > copy the ID |
| Private App token | Tier 2+ | Settings > Integrations > Private Apps |

---

## 6. Data Flow After Integration

```
CURRENT:
  Visitor -> Contact Form -> contact.php -> Email to imf-info@mail.com
  Visitor -> CTA Button -> app register page
  Visitor -> Page views -> GA4 only

AFTER TIER 2:
  Visitor -> Page views -> HubSpot tracking (identified visitor)
  Visitor -> Contact Form -> contact.php -> Email + HubSpot API
                                            -> Contact created in CRM
                                            -> Full browsing history attached
                                            -> Lead pipeline triggered
  Visitor -> CTA Button -> app register page
  Visitor -> Live Chat -> HubSpot inbox -> Contact created/updated
```

---

## 7. Risks and Considerations

- **GDPR**: HubSpot sets cookies. The site may need a cookie consent banner (HubSpot provides one, or use a third-party solution). This is especially relevant for French/EU visitors.
- **Free tier branding**: HubSpot branding appears on embedded forms, chat widget, and CTAs. The API approach for forms avoids this. Chat branding requires Starter plan to remove.
- **Rate limits**: HubSpot Forms API has no documented rate limit for submissions, but the existing `contact.php` rate limiting (60s between submissions) provides protection.
- **Duplicate contacts**: HubSpot deduplicates by email address. Repeat submissions update the existing contact rather than creating duplicates.
- **GA4 coexistence**: HubSpot tracking runs alongside GA4 without conflict. Both can remain active.
