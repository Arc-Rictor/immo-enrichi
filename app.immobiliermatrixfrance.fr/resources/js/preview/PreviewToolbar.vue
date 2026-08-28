<!--
    Preview-only chrome. The application has no persona switcher, so this has no
    counterpart to copy. Kept deliberately small and styled with the app's own
    idiom (rounded-full pills, black/white) so it reads as a demo control rather
    than part of the product being reviewed. Rendered as a sibling of the page
    component, so no application component is modified.

    Inactive personas stay visible but report that they are not available yet,
    matching the entry screen.
-->
<template>
    <div class="fixed bottom-4 right-4 z-[9999] flex items-center gap-1 rounded-full border border-gray-200 bg-white px-2 py-2 shadow-lg">
        <button v-for="persona in personas" :key="persona"
                type="button"
                @click="select(persona)"
                :class="[
                    'rounded-full px-3 py-1 text-sm transition',
                    persona === current ? 'bg-black text-white'
                        : isActive(persona) ? 'bg-white text-gray-600 hover:bg-gray-100'
                        : 'bg-white text-gray-300 cursor-not-allowed',
                ]">
            {{ label(persona) }}
        </button>
        <button type="button"
                @click="$emit('reset')"
                :title="label('change')"
                class="ml-1 rounded-full px-2 py-1 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700">
            <ArrowPathIcon class="h-4 w-4"/>
        </button>
    </div>
</template>

<script setup>
import {ArrowPathIcon} from "@heroicons/vue/24/outline/index.js";
import {ACTIVE_PERSONAS, PERSONAS} from './personas.js';

const props = defineProps({
    current: {type: String, required: true},
    locale: {type: String, default: 'fr'},
});

const emit = defineEmits(['change', 'reset', 'blocked']);

const personas = PERSONAS;

const isActive = type => ACTIVE_PERSONAS.includes(type);

const select = persona => emit(isActive(persona) ? 'change' : 'blocked', persona);

const strings = {
    fr: {buyer: 'Acheteur', seller: 'Vendeur', agent: 'Agent', admin: 'Admin', change: 'Changer de profil'},
    en: {buyer: 'Buyer', seller: 'Seller', agent: 'Agent', admin: 'Admin', change: 'Change profile'},
};

const label = key => (strings[props.locale] || strings.fr)[key];
</script>
