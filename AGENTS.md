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

## Current known issue / work in progress

The application pages currently render in French because `preview.js` always exposes `resources/lang/fr/fr.json` as `page.props.language`. The real `LanguageSelector.vue` calls `router.get(route('locale.update', locale))`, but the preview compatibility router does not yet persist or apply that locale change.

The next developer should complete the locale adapter:

1. Add a small preview locale state in `preview.js`, defaulting to `fr` (or a stored locale).
2. Expose French translations for `fr` and an empty translation object for `en`; the real `useTranslate()` returns the original English key when no translation exists.
3. Make the preview `route('locale.update', locale)` preserve the current hash and include the requested locale.
4. Make the preview `router.get()` detect that locale and update the preview locale state.
5. Ensure `loadPage()` rebuilds shared props with the selected `locale` and `language` while staying on the same page.
6. Test the selector on dashboard, search, listing detail, create/edit, profile, and auth pages. The flag should change from French to English and the component text should update without leaving the page.

Do not change `useTranslate.js` or `LanguageSelector.vue`; the preview adapter should satisfy their existing contracts.

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

## Safety and scope

- Never add production secrets, API keys, Composer credentials, database credentials, Stripe credentials, or live user data to this branch.
- The source repository previously contained a committed-looking Spatie Satis credential in `auth.json`; treat it as compromised and do not copy or expose it.
- Keep the preview `noindex` headers enabled.
- Use `apply_patch` for source edits. If the Windows patch helper cannot access this nested clone, create a patch artifact in the writable Codex visualization directory and apply it with `git apply` from this clone.
- Before pushing, run the locked Render build, inspect the staged diff, run `git diff --cached --check`, commit on `client-preview`, and push to `origin client-preview`.
