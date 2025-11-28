<template>
    <div class="ml-3 relative">
        <button @click="toggleLocale"
                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none transition">
            <img class="h-[30px] w-[30px] rounded-full object-cover"
                 :src="'/' + oppositeLocale + '.png'"
                 :alt="oppositeLocale">
        </button>
    </div>
</template>

<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

let locale = ref(usePage().props.locale);

const oppositeLocale = computed(() => {
    return locale.value === 'en' ? 'fr' : 'en';
});

const toggleLocale = () => {
    locale.value = oppositeLocale.value;
    router.get(route('locale.update', locale.value));
}
</script>

