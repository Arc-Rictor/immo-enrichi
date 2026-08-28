<!--
    Preview-only. Shown when the client selects a persona that is not active
    yet. Built from the application's own DialogModal and SecondaryButton so it
    matches the modals used elsewhere in the app.
-->
<template>
    <DialogModal :show="!!persona" @close="$emit('close')">
        <template #title>
            {{ __('Coming Soon') }}
        </template>
        <template #content>
            {{ __(messageKey) }}
        </template>
        <template #footer>
            <SecondaryButton @click="$emit('close')">
                {{ __('Close') }}
            </SecondaryButton>
        </template>
    </DialogModal>
</template>

<script setup>
import {computed} from 'vue';
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useTranslate} from "@/Composables/useTranslate.js";

const props = defineProps({
    persona: {type: String, default: null},
});

defineEmits(['close']);

const {__} = useTranslate();

const messageKeys = {
    buyer: 'Buyer accounts are not available yet. Only estate agent accounts are active at this stage.',
    seller: 'Seller accounts are not available yet. Only estate agent accounts are active at this stage.',
};

const messageKey = computed(() => messageKeys[props.persona] || messageKeys.buyer);
</script>
