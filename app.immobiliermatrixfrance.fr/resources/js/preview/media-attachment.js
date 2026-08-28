import {h} from 'vue';

export const MediaLibraryAttachment = {
    emits: ['change'],
    render() {
        return h('div', {class: 'rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-10 text-center text-gray-500'}, [
            h('div', {class: 'text-sm font-medium'}, 'Select or drag files'),
            h('div', {class: 'mt-1 text-xs'}, 'Photo upload is unavailable in this review preview.'),
        ]);
    },
};
