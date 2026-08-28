import {defineConfig} from 'vite';
import vue from '@vitejs/plugin-vue';
import {fileURLToPath, URL} from 'node:url';

// The company has been renamed to Immo-Allie, but the application source is
// read-only on this branch. Two real components carry the old display name
// (Layouts/AppLayout.vue and Components/Footer.vue), so rewrite it at build
// time rather than editing them. Delete this plugin once the rename lands in
// the application itself.
//
// Only the capitalised display spellings are matched, so identifiers such as
// the Render service name `immo-enrichi-client-preview` are untouched.
const previewRebrand = () => ({
    name: 'preview-rebrand',
    enforce: 'pre',
    transform(code, id) {
        if (id.includes('node_modules') || !/\.(vue|js)$/.test(id.split('?')[0])) return null;
        if (!code.includes('Immo-Enrichi') && !code.includes('Immo Enrichi')) return null;
        return {
            code: code.replace(/Immo-Enrichi/g, 'Immo-Allie').replace(/Immo Enrichi/g, 'Immo Allie'),
            map: null,
        };
    },
});

export default defineConfig({
    base: '/demo/',
    publicDir: 'public',
    plugins: [previewRebrand(), vue({template: {transformAssetUrls: {base: null, includeAbsolute: false}}})],
    resolve: {
        alias: {
            '@/Components/Map.vue': fileURLToPath(new URL('./resources/js/preview/MapPreview.vue', import.meta.url)),
            '@/Pages/Search/partials/LocationSearchInput.vue': fileURLToPath(new URL('./resources/js/preview/LocationSearchPreview.vue', import.meta.url)),
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
            '@inertiajs/vue3': fileURLToPath(new URL('./resources/js/preview/inertia.js', import.meta.url)),
            'spatie-media-lib-pro/media-library-pro-vue3-attachment': fileURLToPath(new URL('./resources/js/preview/media-attachment.js', import.meta.url)),
            'spatie-media-lib-pro/media-library-pro-vue3-collection': fileURLToPath(new URL('./resources/js/preview/media-collection.js', import.meta.url)),
        },
    },
    define: {_global: '({})'},
    build: {
        outDir: '../public_html/preview-app',
        emptyOutDir: true,
        rollupOptions: {input: fileURLToPath(new URL('./preview.html', import.meta.url))},
    },
});
