// useTranslate.js
import {reactive} from 'vue';
import {usePage} from "@inertiajs/vue3";

export function useTranslate() {
    const state = reactive({
        // you can add other reactive properties here
    });

    function __(key, replace = {}) {
        // Your translation logic here.
        if (key === undefined) {
            return
        }
        let lowerCaseKey = key.toLowerCase();
        let language = usePage().props.language;

        let translation = Object.keys(language).reduce((acc, currKey) => {
            return lowerCaseKey === currKey.toLowerCase() ? language[currKey] : acc;
        }, key);

        Object.keys(replace).forEach((key) => {
            translation = translation.replace(`:${key}`, replace[key]);
        });

        return translation;
    }

    return {
        ...state,
        __,
    };
}
