<template>
    <AppLayout :title="__('Available properties requiring an agent')">
        <h1 class="text-xl font-medium">{{ __('Available properties requiring an agent') }}</h1>
        <div class="my-8">
        </div>

    </AppLayout>
</template>
<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import { useTranslate} from "@/Composables/useTranslate.js";

const {__} = useTranslate()
const props = defineProps({
    listings: Object,
})

</script>
