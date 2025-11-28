<template>
    <AppLayout :title="__('Agents interested in listing your property')">
        <h1 class="text-xl font-medium">{{ __('Agents interested in listing your property') }}</h1>
        <div class="my-8">
        </div>

    </AppLayout>
</template>
<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()
const props = defineProps({
    listing: Object,
    agents: Object,
})

</script>
