# Contact Form Design

**Date**: 2026-03-01
**Status**: Approved

## Summary

Replace the existing `mailto:` contact links with an inline contact form section on both FR and EN marketing pages. The form submits via AJAX to a PHP backend that sends email using `mail()`.

## Placement

- New section between FAQ (#section-11) and "Ready to Join?" (#section-12)
- Nav "Contact" link changes from `mailto:` to `#contact` anchor scroll
- Section ID: `contact`

## Form Fields

| Field | Type | Required | Validation |
|-------|------|----------|------------|
| Name | text | Yes | Non-empty, max 100 chars |
| Email | email | Yes | Valid email format |
| Phone | tel | No | Basic format check |
| Message | textarea | Yes | Non-empty, max 2000 chars |
| Locale | hidden | Auto | `fr` or `en` from page |

Honeypot field (hidden `website` input) for spam protection.

## Backend

- **File**: `public_html/contact.php`
- **Method**: PHP `mail()` (available on cPanel)
- **Recipient**: `imf-info@mail.com`
- **Subject**: `[Immo-Enrichi] New Contact: {Name}`
- **Response**: JSON `{ success: true/false, message: "..." }`
- **Security**: Honeypot check, input sanitization, rate limiting via session

## Frontend

- AJAX submission via jQuery `$.ajax()` (jQuery already loaded on site)
- Inline success/error messages (no page redirect)
- Submit button disabled during request
- Bilingual labels and messages (FR/EN hardcoded per page)

## Styling

- Matches existing site design: black/white/orange palette
- Inter font for labels and inputs
- Unna serif for section heading
- Rounded inputs, orange submit button
- Responsive: stacked layout on mobile
- Added to `styles-new.css`

## Bilingual

- FR page: French labels, placeholders, success/error messages
- EN page: English equivalents
- Hidden `locale` field sent to PHP for bilingual email subject
