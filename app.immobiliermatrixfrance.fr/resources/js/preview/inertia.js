import {defineComponent, h, reactive} from 'vue';

export const page = reactive({props: {}});

export function setPageProps(props) {
    page.props = props;
}

function navigate(url) {
    if (!url || url === '#') return;
    if (typeof url === 'string' && url.startsWith('#')) {
        window.location.hash = url.slice(1);
        return;
    }
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
        return () => h(props.as === 'button' ? 'button' : 'a', {
            ...attrs,
            href: props.as === 'button' ? undefined : props.href,
            onClick: event => {
                attrs.onClick?.(event);
                if (event.defaultPrevented) return;
                if (props.as === 'button' || props.method || String(props.href).startsWith('#')) {
                    event.preventDefault();
                    navigate(props.href);
                }
            },
        }, slots.default?.());
    },
});

export const Head = defineComponent({
    name: 'InertiaHead',
    props: {title: String},
    setup(props) {
        if (props.title) document.title = `${props.title} - Immo-Allie`;
        return () => null;
    },
});
