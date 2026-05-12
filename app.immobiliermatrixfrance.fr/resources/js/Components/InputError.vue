<script setup>
import {useTranslate} from "@/Composables/useTranslate.js";
import {ref} from "vue";
const {__} = useTranslate()
defineProps({
    message: String,
});

</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red-600">
            {{ __(message) }}
        </p>
    </div>
</template>
