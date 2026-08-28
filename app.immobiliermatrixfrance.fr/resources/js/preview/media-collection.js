import {h} from 'vue';

export const MediaLibraryCollection = {
    props: ['initialValue'],
    emits: ['change'],
    render() {
        return h('div', {class: 'grid grid-cols-2 gap-4 rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 text-center text-gray-500'}, [
            h('div', {class: 'col-span-2 text-sm'}, 'Existing property images and upload controls appear here in the live application.'),
        ]);
    },
};
