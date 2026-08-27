# Client preview deployment

This branch publishes only the current French and English marketing pages as a Render Static Site.

## Included

- French page at `/fr` and `fr.html`
- English page at `/en` and `en.html`
- Responsive styles, scripts, and referenced images
- A client-preview notice
- Demo-only contact form validation

## Deliberately disabled

- Laravel authentication and registration
- Contact-form delivery
- Production analytics
- Database, Stripe, email, and uploaded-media services

## Deploy on Render

1. In Render, choose **New > Blueprint**.
2. Connect `Arc-Rictor/immo-enrichi`.
3. Select the `client-preview` branch.
4. Render reads `render.yaml` and creates `immo-enrichi-client-preview`.

Every push to `client-preview` triggers a new static deployment.
