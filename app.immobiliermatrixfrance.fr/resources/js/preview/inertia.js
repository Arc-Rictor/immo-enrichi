import {defineComponent, h, reactive} from 'vue';

export const page = reactive({props: {}});

export function setPageProps(props) {
    page.props = props;
}

// Most of the application navigates through route(), which the preview
// intercepts. A few components hardcode an absolute application path instead
// (Sidebar.vue's href="/dashboard", the Login/Register/ForgotPassword
// cross-links, ListingCreate.vue's template download). On a static host those
// would leave the preview and 404, so map the known paths onto their preview
// hash and make the rest inert rather than letting the client navigate away.
const APP_PATH_HASHES = {
    'dashboard': 'dashboard',
    'login': 'login',
    'register': 'register',
    'forgot-password': 'forgot-password',
    'reset-password': 'reset-password',
    'confirm-password': 'confirm-password',
    'verify-email': 'verify-email',
    'property-search': 'search',
    'listings': 'listings',
    'listings/create': 'create',
    'user/profile': 'profile',
    'profile': 'profile',
    'api-tokens': 'api-tokens',
    'privacy-policy': 'privacy',
    'terms-of-service': 'terms',
};

// Returns a '#hash' to navigate to, false to swallow the click, or null when
// the href is not an absolute application path and should be left alone.
export function resolvePreviewTarget(href) {
    const raw = typeof href === 'string' ? href : '';
    if (!raw.startsWith('/')) return null;
    // Already aimed at a preview hash, e.g. RegisterOptions.vue's
    // "/demo/?type=agent#register". Leave those to the existing handling.
    if (raw.includes('#')) return null;
    const path = raw.split('?')[0].replace(/^\/+|\/+$/g, '');
    if (!path) return '#login';
    const hash = APP_PATH_HASHES[path];
    return hash ? `#${hash}` : false;
}

function navigate(url) {
    if (!url || url === '#') return;
    if (typeof url === 'string' && url.startsWith('#')) {
        window.location.hash = url.slice(1);
        return;
    }
    const resolved = resolvePreviewTarget(url);
    if (resolved) {
        window.location.hash = resolved.slice(1);
        return;
    }
    if (resolved === false) return;
    const hash = typeof url === 'string' ? url.match(/#(.+)$/)?.[1] : null;
    if (hash) window.location.hash = hash;
}

function finish(options = {}) {
    options.onSuccess?.();
    options.onFinish?.();
}

export const router = {
    visit(url, options) { navigate(url); finish(options); },
    get(url, data, options) {
        const locale = String(url).match(/locale=(en|fr)/)?.[1];
        if (locale) window.__setPreviewLocale?.(locale);
        navigate(url); finish(options);
    },
    post(url, data, options) { finish(options); },
    put(url, data, options) { finish(options); },
    patch(url, data, options) { finish(options); },
    delete(url, options) { finish(options); },
    reload(options) { finish(options); },
};

export function usePage() {
    return page;
}

const clone = value => value === undefined ? undefined : JSON.parse(JSON.stringify(value));
export function useForm(initial = {}) {
    const original = clone(initial);
    const form = reactive({...initial, errors: {}, processing: false, recentlySuccessful: false, progress: null});
    const previewDestinations = {login: '#dashboard', register: '#dashboard'};
    const submit = (method, url, options = {}) => {
        form.processing = true;
        queueMicrotask(() => {
            form.processing = false;
            form.recentlySuccessful = true;
            if (method === 'post' && previewDestinations[String(url).replace(/^#/, '')]) {
                navigate(previewDestinations[String(url).replace(/^#/, '')]);
            }
            options.onSuccess?.();
            options.onFinish?.();
        });
    };
    form.get = (url, options) => submit('get', url, options);
    form.post = (url, options) => submit('post', url, options);
    form.put = (url, options) => submit('put', url, options);
    form.patch = (url, options) => submit('patch', url, options);
    form.delete = (url, options) => submit('delete', url, options);
    form.reset = (...fields) => {
        const keys = fields.length ? fields : Object.keys(original);
        keys.forEach(key => { form[key] = clone(original[key]); });
    };
    form.clearErrors = (...fields) => {
        if (!fields.length) form.errors = {};
        else fields.forEach(field => delete form.errors[field]);
    };
    form.setError = (field, message) => { form.errors[field] = message; };
    form.transform = () => form;
    return form;
}

export const Link = defineComponent({
    name: 'InertiaLink',
    inheritAttrs: false,
    props: {href: {type: [String, Object], default: '#'}, as: {type: String, default: 'a'}, method: String},
    setup(props, {attrs, slots}) {
        return () => {
            // Show the preview hash in the href too, so hovering and
            // middle-click behave sensibly rather than pointing off-site.
            const resolved = resolvePreviewTarget(props.href);
            const href = resolved ? resolved : props.href;
            return h(props.as === 'button' ? 'button' : 'a', {
                ...attrs,
                href: props.as === 'button' ? undefined : href,
                onClick: event => {
                    attrs.onClick?.(event);
                    if (event.defaultPrevented) return;
                    if (props.as === 'button' || props.method || String(props.href).startsWith('#')) {
                        event.preventDefault();
                        navigate(props.href);
                        return;
                    }
                    if (resolved !== null) {
                        event.preventDefault();
                        if (resolved) navigate(resolved);
                    }
                },
            }, slots.default?.());
        };
    },
});

export const Head = defineComponent({
    name: 'InertiaHead',
    props: {title: String},
    setup(props) {
        if (props.title) document.title = `${props.title} - ImmoAllié`;
        return () => null;
    },
});
