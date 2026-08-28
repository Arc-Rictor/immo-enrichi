# Immo-Enrichi client preview

## Goal

This branch provides a safe, review-only deployment of the Immo-Enrichi application for a client. The client must be able to visit the public marketing pages and then navigate through the application pages to review their layout, content, and wording. The preview does not need production functionality, authentication, a database, payments, email, uploaded media, analytics, or persistent data.

The preview must remain as faithful as possible to the existing Laravel/Vue codebase. Do not replace the genuine application pages with hand-written mock screens or redesigns. Use the existing Vue pages, layouts, components, Tailwind classes, translations, and image assets whenever possible. Only backend responses and integrations that cannot run on a static host should be substituted.

## Repository and branch

- This folder is a clone of `https://github.com/Arc-Rictor/immo-enrichi`.
- Work on the `client-preview` branch only.
- The clone is nested inside another unrelated Git repository. Run Git commands from this folder and do not stage or commit the parent repository.
- The deployed branch is `origin/client-preview`.
- The Render service is `immo-enrichi-client-preview`, created from the repository Blueprint in `render.yaml`.
- Render deploys automatically on every commit pushed to `client-preview`.

## Render deployment

`render.yaml` defines a static web service with:

- `rootDir: public_html`
- `buildCommand: sh build-faithful-preview.sh`
- `staticPublishPath: ./preview-dist`
- rewrites for `/fr`, `/en`, and `/demo`
- no-index/security response headers

`public_html/build-faithful-preview.sh` copies the public marketing files, runs `npm ci` in `app.immobiliermatrixfrance.fr`, builds the alternate Vite entry with `vite.preview.config.js`, and copies the generated application assets into `public_html/preview-dist/demo` plus the genuine application images into `public_html/preview-dist/images`.

Do not restore the old `build-preview.sh` or the old hand-written `public_html/demo` prototype. Those files were deliberately removed because they did not accurately represent the application.

## Source-faithful preview architecture

The genuine Laravel application remains under `app.immobiliermatrixfrance.fr`. It is not booted as Laravel on Render. Instead, the preview uses a separate Vite entry:

- `app.immobiliermatrixfrance.fr/preview.html` is the static HTML entry.
- `app.immobiliermatrixfrance.fr/vite.preview.config.js` builds that entry to the Render bundle.
- `app.immobiliermatrixfrance.fr/resources/js/preview.js` imports and mounts the real page components.
- `app.immobiliermatrixfrance.fr/resources/js/preview/fixtures.js` supplies fixed objects shaped like the existing Inertia controller/resource props.
- `app.immobiliermatrixfrance.fr/resources/js/preview/inertia.js` is a small compatibility layer for `Head`, `Link`, `router`, `usePage`, and `useForm`.
- `app.immobiliermatrixfrance.fr/resources/css/preview.css` mirrors the real `resources/css/app.css` but omits the unavailable Spatie media-library CSS import.
- `app.immobiliermatrixfrance.fr/resources/js/preview/PersonaChooser.vue` and `PreviewToolbar.vue` are preview-only chrome for switching persona.

The component map in `preview.js` covers the real pages:

- Authentication: login, register, forgotten/reset password, confirm password, two-factor, email verification, and agent registration completion.
- Application: dashboard, property search, listing index, listing detail, listing create/edit, available listings, and agent interest.
- Account/admin: profile, users, API tokens, privacy policy, and terms of service.

Navigation is hash-based only inside the static preview. The route helper maps the application’s named routes to hashes such as `#dashboard`, `#search`, `#listings`, `#property`, and `#profile`.

## Deliberate static substitutions

These are compatibility substitutions, not new product UI:

- Inertia requests and form submissions are inert. No request is sent and no data is persisted.
- `fixtures.js` replaces the authenticated session, database records, resource collections, feature records, and admin users.
- `Map.vue` is replaced by `preview/MapPreview.vue` so Google Maps credentials are not required.
- `LocationSearchInput.vue` is replaced by `preview/LocationSearchPreview.vue` so Google Places autocomplete is not required.
- Spatie media-library attachment/collection components are replaced by inert placeholders because the commercial vendor package is not present in the clone.

Keep these substitutions visually minimal. If the real component can render without a service, prefer the real component. Do not add invented statistics, activity feeds, properties, navigation, or redesigned layouts merely to make the preview look fuller.

## Current progress

Completed:

1. Reviewed the Laravel routes, controllers, Vue pages, layouts, shared components, translations, and resource schemas.
2. Created the `client-preview` branch and connected the Render Blueprint.
3. Replaced the original hand-written static prototype with the real Vue component build.
4. Added the fixture and Inertia compatibility adapters described above.
5. Added local application image assets to the static output.
6. Updated the Render build command to `build-faithful-preview.sh`.
7. Verified the locked-dependency build with `npm ci` and `vite v4.3.9`.
8. Mounted all 21 mapped routes in a temporary headless DOM check. The check covered authentication, dashboard, search, listing pages, forms, profile, admin, API tokens, and legal pages.
9. Pushed the source-faithful implementation in commit `9a96777c`.
10. **Fixed locale switching** (commit `032fd3c3`): Added locale state in `preview.js` with localStorage persistence, updated `route()` helper to preserve hash with locale param, `router.get()` detects locale changes, and `loadPage()` rebuilds shared props + triggers re-render. LanguageSelector now works on all pages.
11. **Added persona switching** (buyer/seller/agent/admin). An earlier attempt edited the real `AppLayout.vue` and added `Components/Navigation/UserTypeSelector.vue` to the application tree; it was reverted because it modified genuine application source and never worked (the component called `router.get()` without importing `router`, and `loadPage()` resolved the user from a hardcoded `baseUser` constant, so `user.type` could never change). Replaced with preview-only chrome:
    - `preview/PersonaChooser.vue` — entry screen, shown when no persona is stored. It reproduces the application's own account-type screen: the frame from `Pages/Auth/Register.vue` and the cards from `Components/RegisterOptions.vue`, reusing the same markup, classes, icons and translation keys. It differs only in making the buyer card selectable (the real one is marked "Coming Soon") and adding an administrator card, both required so every perspective can be reviewed.
    - `preview/PreviewToolbar.vue` — fixed switcher, rendered as a sibling of the page component so no application component is touched.
    - `preview.js` — `PERSONAS`, `personaProfiles`, `baseUserForType()`, and `choosePersona()`/`clearPersona()`; persona persists in `localStorage.previewPersona`.
12. **Fixed preview asset paths** in `build-faithful-preview.sh`. Vite rewrites absolute CSS `url()` references against `base: '/demo/'`, so `/images/*.png` was requested as `/demo/images/*.png` and 404ed (login, dashboard and layout backgrounds). Root-level public assets (`en.png`, `fr.png`, `favicon.png`) were also never copied, breaking the `LanguageSelector` flag. Both are now published.

## Active personas

Only estate agent accounts are live at this stage, so `preview/personas.js` is
the single source of truth:

- `ACTIVE_PERSONAS` — `agent` and `admin`. Selectable. Admin stays selectable so
  the administrative screens can still be reviewed.
- The rest (`buyer`, `seller`) render with the application's own "Coming Soon"
  treatment and open `preview/PersonaUnavailableDialog.vue`, built from the real
  `Components/DialogModal.vue` and `SecondaryButton.vue`. Selecting one does not
  change the stored persona.

This applies on both the entry screen and the toolbar. A persona stored in
`localStorage` that is no longer active falls back to the entry screen.

To activate a persona later, add it to `ACTIVE_PERSONAS`; nothing else changes.

## Persona switching

The real application branches on `user.type`, so the persona genuinely changes what the client sees:

- `Components/Navigation/Sidebar.vue` hides "My Properties" from buyers and shows "Users" only to admins.
- `Pages/Dashboard/Dashboard.vue` shows agent-only banners.
- `Pages/Listing/ListingCreate.vue` and `ListingEdit.vue` gate sections, a tab, and publish controls on agent/admin.
- `Pages/Listing/ListingIndex.vue` has seller-specific behaviour.

Keep persona chrome in `resources/js/preview/`. Do not add demo-only controls to real application components.

## Current known issue / work in progress

None. Verified in a local static server: all four personas across all 21 mapped routes (84 combinations) render with no console errors, and the sidebar/dashboard gating changes correctly per persona.

## Validation commands

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

The temporary headless runtime checker used during development lives outside the repository under the Codex visualization workspace. It must not be committed. Browser visual QA may be unavailable in the Windows desktop sandbox; if so, report that limitation rather than claiming a screenshot review occurred.

## Project documentation

`AGENTS.md` (this file) is the single source of truth for project information and
progress. `CLAUDE.md` is only a pointer to it. Record new decisions, progress and
known issues here.

## Safety and scope

- Never add production secrets, API keys, Composer credentials, database credentials, Stripe credentials, or live user data to this branch.
- The source repository previously contained a committed-looking Spatie Satis credential in `auth.json`; treat it as compromised and do not copy or expose it.
- Keep the preview `noindex` headers enabled.
- Use `apply_patch` for source edits. If the Windows patch helper cannot access this nested clone, create a patch artifact in the writable Codex visualization directory and apply it with `git apply` from this clone.
- Before pushing, run the locked Render build, inspect the staged diff, run `git diff --cached --check`, commit on `client-preview`, and push to `origin client-preview`.
