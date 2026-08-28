import {defineConfig} from 'vite';
import vue from '@vitejs/plugin-vue';
import {fileURLToPath, URL} from 'node:url';

export default defineConfig({
    base: '/demo/',
    publicDir: 'public',
    plugins: [vue({template: {transformAssetUrls: {base: null, includeAbsolute: false}}})],
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
