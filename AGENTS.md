# ImmoAllié client preview

## Goal

This branch provides a safe, review-only deployment of the ImmoAllié application
for a client. The main site is not yet online, so the client needs somewhere to
review and approve the content, look and feel, and to experience how each page
behaves from each user's perspective.

The preview does not need production functionality, authentication, a database,
payments, email, uploaded media, analytics, or persistent data.

The preview must remain as faithful as possible to the existing Laravel/Vue
codebase. Do not replace the genuine application pages with hand-written mock
screens or redesigns. Use the existing Vue pages, layouts, components, Tailwind
classes, translations, and image assets whenever possible. Only backend
responses and integrations that cannot run on a static host should be
substituted.

## Hard constraints

Read these before changing anything.

1. **The application source is read-only.** Nothing under
   `app.immobiliermatrixfrance.fr/resources/js/Pages`, `/Layouts`,
   `/Components`, `/resources/lang`, `/app`, `/routes`, or `/config` may be
   modified on this branch. `main` must never be edited from here.
2. **Everything demo-specific lives in `resources/js/preview/` or
   `public_html/`.** When a real component needs to behave differently, use a
   Vite alias or a build-time transform in `vite.preview.config.js` — never an
   edit to the component.
3. **`client-preview` is a deploy branch, not a merge candidate.** The fixtures,
   the inert Inertia shim, the persona chooser and the account-type restriction
   are all demo-only. Nothing here should be merged back to `main`.

Verify constraint 1 before every commit:

```sh
git status --porcelain -- app.immobiliermatrixfrance.fr/resources/js/Pages app.immobiliermatrixfrance.fr/resources/js/Layouts app.immobiliermatrixfrance.fr/resources/js/Components app.immobiliermatrixfrance.fr/resources/lang app.immobiliermatrixfrance.fr/app app.immobiliermatrixfrance.fr/routes
```

Empty output means the invariant holds. It has held across every commit on this
branch so far.

## Repository and branch

- This folder is a clone of `https://github.com/Arc-Rictor/immo-enrichi`.
- Work on the `client-preview` branch only.
- The clone is nested inside another unrelated Git repository, which has no
  `.gitignore`. Run Git commands from this folder and never stage the parent.
- The deployed branch is `origin/client-preview`.
- The Render service is `immo-enrichi-client-preview`, from the Blueprint in
  `render.yaml`. Render deploys automatically on every commit pushed.
- The repository, remote and Render service keep the former `immo-enrichi`
  name. **Do not rename them** — renaming the service breaks the deployment.

## Render deployment

`render.yaml` defines a static web service with:

- `rootDir: public_html`
- `buildCommand: sh build-faithful-preview.sh`
- `staticPublishPath: ./preview-dist`
- rewrites for `/fr`, `/en`, and `/demo`
- no-index/security response headers

`public_html/build-faithful-preview.sh` copies the marketing files, runs
`npm ci`, builds the alternate Vite entry, and assembles `preview-dist`.

Two asset details the script handles, both of which caused 404s before:

- Vite rewrites absolute CSS `url()` references against `base: '/demo/'`, so
  images are published at both `/images/` and `/demo/images/`.
- Root-level public assets the app requests directly (`en.png`, `fr.png`,
  `favicon.png`, used by `LanguageSelector`) are copied to the dist root.

Do not restore the old `build-preview.sh` or the hand-written `public_html/demo`
prototype. They were removed deliberately for not representing the application.

## Source-faithful preview architecture

The Laravel application is never booted. The preview uses a separate Vite entry:

| File | Role |
| --- | --- |
| `preview.html` | Static HTML entry. Also loads Inter (see Branding). |
| `vite.preview.config.js` | Builds that entry; holds the aliases and the rebrand transform. |
| `resources/js/preview.js` | Mounts the real page components; persona and locale state. |
| `preview/fixtures.js` | Fixed objects shaped like the real Inertia props. |
| `preview/inertia.js` | Shim for `Head`, `Link`, `router`, `usePage`, `useForm`. |
| `resources/css/preview.css` | Mirrors `app.css`, minus the Spatie media-library import. |
| `preview/PersonaChooser.vue` | Entry screen. |
| `preview/PreviewToolbar.vue` | Persona switcher. |
| `preview/PersonaUnavailableDialog.vue` | "Coming Soon" dialog. |
| `preview/personas.js` | Which personas exist and which are active. |
| `preview/ApplicationLogoPreview.vue` | The ImmoAllié logo. |

`preview.js` maps 21 routes: authentication (login, register, forgotten/reset
password, confirm password, two-factor, email verification, agent registration),
application (dashboard, search, listing index/detail/create/edit, available
listings, agent interest), and account/admin (profile, users, API tokens,
privacy policy, terms).

## Deliberate static substitutions

Compatibility substitutions, not new product UI:

- Inertia requests and form submissions are inert. Nothing is sent or persisted.
- `fixtures.js` replaces the session, database records, resource collections,
  feature records and admin users.
- `Map.vue` → `preview/MapPreview.vue` (no Google Maps credentials).
- `LocationSearchInput.vue` → `preview/LocationSearchPreview.vue` (no Places).
- `ApplicationLogo.vue` → `preview/ApplicationLogoPreview.vue` (new logo).
- Spatie media-library components → inert placeholders; the commercial vendor
  package is not present in the clone.

Keep substitutions visually minimal. If a real component can render without a
service, prefer the real component. Do not invent statistics, activity feeds,
properties, navigation or layouts to make the preview look fuller.

## Navigation

Navigation is hash-based. The `route()` helper maps named routes to hashes such
as `#dashboard`, `#search`, `#listings`, `#property`, `#profile`.

Five application components hardcode an absolute path instead of calling
`route()` — `Sidebar.vue` (`/dashboard`), the Login and ForgotPassword links to
`/register`, the Register link to `/login`, and `ListingCreate.vue`
(`/download-template`). On a static host these leave the preview and 404.

`preview/inertia.js` handles this generally rather than per link:

- `resolvePreviewTarget()` maps known application paths onto their preview hash.
- Unknown application paths are made inert, so the client cannot navigate out.
- Hrefs already carrying a hash are left alone, so `RegisterOptions.vue`'s
  `/demo/?type=agent#register` cards still work.
- `preview.js` adds a capture-phase click guard for plain `<a href="/...">`
  elements that never pass through `Link`.

External links are deliberately left alone. See Outstanding items.

## Branding

The company name is written **ImmoAllié** — one word, no hyphen, accented e,
matching the logo artwork. Use that spelling everywhere.

- Preview-owned files carry the name directly.
- `Layouts/AppLayout.vue` and `Components/Footer.vue` also contain it, and are
  read-only, so the `previewRebrand` plugin in `vite.preview.config.js` rewrites
  it at build time. **Delete that plugin once the rename lands in the
  application itself.**
- Only capitalised display spellings are matched, so lowercase identifiers such
  as `immo-enrichi-client-preview` are untouched.

### Logo

`preview/ApplicationLogoPreview.vue` is aliased over `ApplicationLogo.vue`. The
marketing pages inline the same SVG. Three things to know:

- **The wordmark is live `<text>` in Inter, not outlined paths.** The
  application loads no webfont (Tailwind asks for Figtree; nothing loads it), so
  `preview.html` loads Inter from Google Fonts. The marketing pages already did.
  If Inter fails to load, the browser substitutes a fallback face and the
  letterforms will not match the design; the viewBox padding means nothing
  clips. Outlined paths would remove this dependency entirely.
- **The marketing pages inline the SVG rather than using `<img src>`,** because
  an SVG referenced through `<img>` is an isolated document and cannot load the
  page's webfont.
- **The viewBox was recentred**, from `0 0 1000 240` to `109 3 657 234`. The
  supplied artwork sat off-centre — ink spanned x 159–716, leaving 159px of
  space on the left and 284px on the right. Only the canvas changed; the artwork
  is untouched. The resulting 2.81:1 ratio is close to the old logo's 2.88:1, so
  layouts are unaffected.

A light variant is used in the marketing footer. This fixed a pre-existing
defect: the old logo was near-black artwork on a black footer, so it was
effectively invisible.

The header logo carries an inline `max-width:287px` because the stylesheet sizes
`.home-logo img` and `.home-logo svg` differently and the old logo was an
`<img>`; this preserves the previous rendered size.

## Personas

The client reviews the site as each type of user. This is not cosmetic — the
application genuinely branches on `user.type`:

- `Sidebar.vue` hides "My Properties" from buyers, shows "Users" only to admins.
- `Dashboard.vue` shows agent-only banners.
- `ListingCreate.vue` and `ListingEdit.vue` gate sections, a tab and publish
  controls on agent/admin.
- `ListingIndex.vue` has seller-specific behaviour.

`preview/personas.js` is the single source of truth:

- `PERSONAS` — every perspective the preview can render.
- `ACTIVE_PERSONAS` — currently `agent` and `admin`. Only estate agent accounts
  are live at this stage; admin stays selectable so the administrative screens
  can still be reviewed.
- `buyer` and `seller` render with the application's own "Coming Soon" treatment
  and open `PersonaUnavailableDialog.vue`, built from the real `DialogModal.vue`
  and `SecondaryButton.vue`. Selecting one does not change the stored persona.

This applies identically on the entry screen and the toolbar. A persona left in
`localStorage` that is no longer active falls back to the entry screen. To
activate a persona later, add it to `ACTIVE_PERSONAS` — nothing else changes.

`PersonaChooser.vue` reproduces the application's own account-type screen: the
frame from `Pages/Auth/Register.vue` and the cards from
`Components/RegisterOptions.vue`, reusing the same markup, classes, icons and
translation keys. It differs only by adding an administrator card. Selecting a
card sets the persona instead of starting registration.

`PreviewToolbar.vue` is the only invented UI in the preview, because the
application has no persona switcher to copy. Keep it small and obviously a demo
control. Do not add demo-only controls to real application components.

## Current status

The preview is complete and deployed. Verified against the locked Render build
(`npm ci`, `vite v4.3.9`) on a local static server:

- All mapped routes render for every persona with no console errors.
- Sidebar and dashboard gating change correctly per persona.
- Buyer and seller show the "Coming Soon" badge and dialog from both the entry
  screen and the toolbar, without changing the stored persona.
- Locale switching works on all pages, in both directions.
- The logo renders at all eight placements and is optically centred; the
  marketing header matches its previous 287×100 size and the footer logo is
  white on black.
- Pages serve as UTF-8 and the accented e renders with no mojibake.
- No earlier brand spelling remains anywhere in `preview-dist`.
- Previously 404ing assets return 200.

## Outstanding items

Genuine gaps, in priority order:

1. **The logo wordmark depends on Inter loading.** Ask the designer for a
   version with the text converted to outlines. Whether Google Fonts loads on
   the Render deployment was never confirmed from the development sandbox — it
   is worth checking on the live URL.
2. **`Sidebar.vue` links Support/FAQs to `https://www.platformstaging.co.uk/imf/fr#faqs`**
   and `Footer.vue` links Privacy Policy and Mission statement to
   `https://www.immobiliermatrixfrance.fr/` — the former brand's domain. A
   client clicking any of these leaves the demo. They are in read-only source
   and were deliberately left alone; neutralising them in the preview is a
   content decision that needs sign-off.
3. **Browser tabs read `ImmoAllié - ImmoAllié`** on the main application
   screens, because `AppLayout.vue` passes the company name as the page title
   and the Inertia `Head` appends it again. The real application behaves the
   same way, so this was left as-is deliberately: "fixing" it would make the
   preview less faithful than production.

## Observations about the application codebase

Found while working here. **Do not act on these** — the application is read-only
from this branch. They are recorded for whoever owns `main`.

- `Sidebar.vue:25` — hardcoded staging URL, ships to production as-is.
- `ListingIndex.vue:112,114` — `console.log` left in.
- `RegisterOptions.vue:11` — stray `']` inside a static class attribute;
  `cursor-not-allowed` applied to every card rather than only disabled ones; the
  `RadioGroup`/`v-model` is decorative, since navigation happens via `<Link>` and
  `selectedOption` is never read, which hands screen readers a radio group that
  does nothing; `v-slot="{ checked, active }"` destructured and unused; `title`
  never rendered.
- `RegisterOptions.vue` marks buyer "Coming Soon" but leaves **seller enabled**,
  which contradicts only estate agent accounts being live.
- Four committed `" - Copy"` files: `UserController - Copy.php`,
  `CheckForActiveSubscription - Copy.php`, `Footer - Copy.vue`,
  `UserIndex - Copy.vue`.
- `bg-[url('/images/...')]` Tailwind arbitrary values break under any non-root
  Vite base. Worked around in the build script; the durable fix is to reference
  these through Vite so they are hashed and rewritten.

## Validation

From `public_html`:

```sh
sh build-faithful-preview.sh
```

From `app.immobiliermatrixfrance.fr`:

```sh
npm ci
npx vite build --config vite.preview.config.js
```

Useful checks:

```sh
node --check resources/js/preview.js
node --check resources/js/preview/inertia.js
git diff --check
git status --short --branch
```

Verifying behaviour needs a browser: build, serve `preview-dist` over HTTP (not
`file://` — the hash routing and asset paths need a real origin), and exercise
the pages. Screenshots may be unavailable in the Windows desktop sandbox; the
DOM, console and network tools work. Hidden-tab timer throttling can stall long
`setTimeout` loops — yield with `MessageChannel` instead. Report the limitation
rather than claiming a visual review that did not happen.

## Project documentation

`AGENTS.md` (this file) is the single source of truth for project information
and progress. `CLAUDE.md` is only a pointer to it. Record new decisions,
progress and known issues here.

## Safety and scope

- Never add production secrets, API keys, Composer credentials, database
  credentials, Stripe credentials, or live user data to this branch.
- The repository previously contained a committed-looking Spatie Satis
  credential in `auth.json`; treat it as compromised and never copy or expose
  it.
- Keep the preview `noindex` headers enabled.
- Before pushing: run the locked Render build, confirm the read-only invariant
  above, inspect the staged diff, run `git diff --cached --check`, commit on
  `client-preview`, and push to `origin client-preview`. Pushing deploys.
